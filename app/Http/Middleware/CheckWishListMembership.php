<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckWishListMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupération de la WishList
        $wishList = $request->route('wishList')
            ?? $request->route('wishListUser')?->wishList
            ?? $request->route('gift')?->wishListUser->wishList
            ?? null;

        if(!$wishList){
            abort(404, 'La liste est introuvable.');
        }

        if(!$wishList->users->contains(Auth::user())){
            abort(403, 'Vous n\'avez pas accès à cette liste.');
        }

        return $next($request);
    }
}
