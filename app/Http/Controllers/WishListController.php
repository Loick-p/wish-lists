<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWishListUserRequest;
use App\Http\Requests\FormWishListRequest;
use App\Models\User;
use App\Models\WishList;
use App\Models\WishListUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class WishListController extends Controller
{
    public function index(): View
    {
        return view('wish_lists.index')->with(
            'wishLists', Auth::user()->wishLists()->orderBy('created_at', 'desc')->get()
        );
    }

    public function create(): View
    {
        return view('wish_lists.create');
    }

    public function store(FormWishListRequest $request): RedirectResponse
    {
        $wishList = WishList::create($request->validated());

        // Add owner to wish list
        $wishList->addOwner(Auth::user());

        toastr('La liste a bien été créée');
        return redirect()->route('wish_lists.show', ['wishList' => $wishList]);
    }

    public function show(WishList $wishList): View
    {
        $wishList->load('users');
        return view('wish_lists.show')->with('wishList', $wishList);
    }

    public function edit(WishList $wishList): View
    {
        Gate::authorize('owner', $wishList);
        return view('wish_lists.edit', compact('wishList'));
    }

    public function update(FormWishListRequest $request, WishList $wishList): RedirectResponse
    {
        Gate::authorize('owner', $wishList);

        $wishList->update($request->validated());

        toastr('La liste a bien été modifiée');
        return redirect()->route('wish_lists.show', ['wishList' => $wishList]);
    }

    public function users(WishList $wishList): View
    {
        Gate::authorize('owner', $wishList);

        return view('wish_lists.users')->with('wishList', $wishList);
    }

    public function addUser(AddWishListUserRequest $request, WishList $wishList): RedirectResponse
    {
        Gate::authorize('owner', $wishList);

        // Récupération de l'utilisateur
        $user = User::findByEmail($request->validated()['email']);

        // Vérification si l'utilisateur n'est pas déjà dans la liste
        $wishListUser = WishListUser::findByUserAndWishList($user, $wishList);
        if($wishListUser){
            return back()->withErrors(['userAlreadyMember' => 'L\'utilisateur fait déjà partie de cette liste.']);
        }

        // Ajout de l'utilisateur
        $wishList->addContributor($user);

        toastr('L\'utilisateur a bien été ajouté');
        return redirect()->route('wish_lists.users', ['wishList' => $wishList]);
    }

    public function deleteUser(WishListUser $wishListUser): RedirectResponse
    {
        $wishList = $wishListUser->wishList;
        Gate::authorize('owner', $wishList);

        $wishListUser->delete();

        toastr('L\'utilisateur a bien été supprimé');
        return redirect()->route('wish_lists.users', ['wishList' => $wishList]);
    }
}
