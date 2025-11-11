<?php

namespace App\Policies;

use App\Models\Gift;
use App\Models\User;

class GiftPolicy
{
    public function manage(User $user, Gift $gift): bool
    {
        return $gift->addedByUser->is($user);
    }

    public function reservation(User $user, Gift $gift): bool
    {
        $wishListUser = $gift->wishListUser;
        if ($gift->addedByUser->is($user) && $wishListUser->user->is($user)) {
            return false;
        }

        return $gift->reservedByUser === null || $gift->reservedByUser->is($user);
    }
}
