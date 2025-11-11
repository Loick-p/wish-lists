<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormGiftRequest;
use App\Models\Gift;
use App\Models\WishListUser;
use App\Services\FileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GiftController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(WishListUser $wishListUser): View
    {
        $wishList = $wishListUser->wishList;

        $gifts = $wishListUser->user()->is(Auth::user()) ? $wishListUser->getUserGifts(Auth::id())
            : $wishListUser->gifts;

        return view('gifts.index', compact( 'wishListUser', 'gifts', 'wishList'));
    }

    public function create(WishListUser $wishListUser): View
    {
        return view('gifts.create', compact('wishListUser'));
    }

    public function store(FormGiftRequest $request, WishListUser $wishListUser): RedirectResponse
    {
        $giftData = $request->validated();

        if ($request->hasFile('image')) {
            $giftData['image'] = $this->fileService->upload($request->file('image'), 'gifts');
        }

        Gift::create($giftData);

        toastr('Le cadeau a bien été ajouté');
        return redirect()->route('gifts.index', ['wishListUser' => $wishListUser]);
    }

    public function edit(Gift $gift): View
    {
        $wishListUser = $gift->wishListUser;
        return view('gifts.edit', compact('gift', 'wishListUser'));
    }

    public function update(FormGiftRequest $request, Gift $gift): RedirectResponse
    {
        $giftData = $request->validated();

        if ($request->hasFile('image')) {
            $giftData['image'] = $this->fileService->upload($request->file('image'), 'gifts');
        }

        $gift->update($giftData);

        toastr('Le cadeau a bien été modifié');
        return redirect()->route('gifts.index', ['wishListUser' => $gift->wishListUser]);
    }

    public function destroy(Gift $gift): RedirectResponse
    {
        Gate::authorize('manage', $gift);

        $wishListUser = $gift->wishListUser;

        $gift->delete();

        toastr('Le cadeau a bien été supprimé');
        return redirect()->route('gifts.index', ['wishListUser' => $wishListUser]);
    }

    public function reservation(Gift $gift): RedirectResponse
    {
        Gate::authorize('reservation', $gift);

        $gift->reservation();

        toastr($gift->reserved_by ? 'Le cadeau a bien été réservé' : 'La réservation a bien été annulée');
        return redirect()->route('gifts.index', ['wishListUser' => $gift->wishListUser]);
    }
}
