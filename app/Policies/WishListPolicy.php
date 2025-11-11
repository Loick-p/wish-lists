<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WishList;
use App\Models\WishListUser;
use Illuminate\Auth\Access\Response;

class WishListPolicy
{
    public function owner(User $user, WishList $wishList): bool
    {
        $wishListUser = WishListUser::findByUserAndWishList($user, $wishList);

        return $wishListUser && $wishListUser->user()->is($user) && $wishListUser->isWishListOwner();
    }
}
