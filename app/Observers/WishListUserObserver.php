<?php

namespace App\Observers;

use App\Models\WishListUser;
use App\Notifications\AddUserWishListNotification;

class WishListUserObserver
{
    /**
     * Handle the WishListUser "created" event.
     */
    public function created(WishListUser $wishListUser): void
    {
        // Notification
        $wishListUser->user->notify(new AddUserWishListNotification($wishListUser->wishList, $wishListUser->user));
    }

    /**
     * Handle the WishListUser "deleting" event.
     */
    public function deleting(WishListUser $wishListUser): void
    {
        // Suppression de tous les cadeaux liés à la liste utilisateur
        $wishListUser->gifts()->each(function ($gift) {
            $gift->delete();
        });
    }
}
