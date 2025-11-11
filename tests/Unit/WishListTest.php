<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\WishList;
use App\Models\WishListRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishListTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateWishList(): void
    {
        $today = new \DateTime();

        $wishList = WishList::factory()->create([
            'title' => 'Wish list title',
            'description' => 'Wish list description',
            'date' => $today,
        ]);

        $this->assertDatabaseHas('wish_lists', [
            'title' => 'Wish list title',
            'description' => 'Wish list description',
            'date' => $today,
        ]);
    }

    public function testUpdateWishList(): void
    {
        $today = new \DateTime();

        $wishList = WishList::factory()->create();

        $wishList->update([
            'title' => 'Updated wish list title',
            'description' => 'Updated wish list description',
            'date' => $today,
        ]);

        $this->assertDatabaseHas('wish_lists', [
            'id' => $wishList->id,
            'title' => 'Updated wish list title',
            'description' => 'Updated wish list description',
            'date' => $today,
        ]);
    }

    public function testDeleteWishList(): void
    {
        $wishList = WishList::factory()->create();

        $wishList->delete();

        $this->assertDatabaseMissing('wish_lists', [
            'id' => $wishList->id,
        ]);
    }

    public function testAddOwnerToWishList(): void
    {
        $user = User::factory()->create();
        $wishList = WishList::factory()->create();
        $ownerRole = WishListRole::factory()->create(['name' => WishListRole::OWNER_ROLE]);

        $wishList->addOwner($user->id);

        $this->assertDatabaseHas('wish_list_users', [
            'user_id' => $user->id,
            'wish_list_id' => $wishList->id,
            'wish_list_role_id' => $ownerRole->id,
        ]);
    }
}
