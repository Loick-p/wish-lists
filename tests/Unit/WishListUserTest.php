<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\WishList;
use App\Models\WishListRole;
use App\Models\WishListUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishListUserTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateWishListUser(): void
    {
        $wishList = WishList::factory()->create();
        $wishListRole = WishListRole::factory()->create(['name' => WishListRole::OWNER_ROLE]);
        $user = User::factory()->create();
        $wishListUser = WishListUser::factory()->create([
            'wish_list_id' => $wishList->id,
            'wish_list_role_id' => $wishListRole->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('wish_list_users', [
            'wish_list_id' => $wishList->id,
            'wish_list_role_id' => $wishListRole->id,
            'user_id' => $user->id,
        ]);
    }

    public function testIsWishListOwnerReturnsTrueWhenRoleIsOwner(): void
    {
        $wishList = WishList::factory()->create();
        $wishListRole = WishListRole::factory()->create(['name' => WishListRole::OWNER_ROLE]);
        $user = User::factory()->create();
        $wishListUser = WishListUser::factory()->create([
            'wish_list_id' => $wishList->id,
            'wish_list_role_id' => $wishListRole->id,
            'user_id' => $user->id,
        ]);

        $this->assertTrue($wishListUser->isWishListOwner());
    }

    public function testIsWishListOwnerReturnsFalseWhenRoleIsNotOwner(): void
    {
        $wishList = WishList::factory()->create();
        $wishListRole = WishListRole::factory()->create(['name' => WishListRole::CONTRIBUTOR_ROLE]);
        $user = User::factory()->create();
        $wishListUser = WishListUser::factory()->create([
            'wish_list_id' => $wishList->id,
            'wish_list_role_id' => $wishListRole->id,
            'user_id' => $user->id,
        ]);

        $this->assertFalse($wishListUser->isWishListOwner());
    }
}
