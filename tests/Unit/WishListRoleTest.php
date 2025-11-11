<?php

namespace Tests\Unit;

use App\Models\WishListRole;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishListRoleTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateWishListRole(): void
    {
        $wishListRole = WishListRole::factory()->create([
            'name' => 'owner',
        ]);

        $this->assertDatabaseHas('wish_list_roles', [
            'name' => 'owner',
        ]);
    }

    public function testUpdateWishListRole(): void
    {
        $wishListRole = WishListRole::factory()->create([
            'name' => 'contributor',
        ]);

        $wishListRole->update([
            'name' => 'contributor',
        ]);

        $this->assertDatabaseHas('wish_list_roles', [
            'id' => $wishListRole->id,
            'name' => 'contributor',
        ]);
    }

    public function testDeleteWishListRole(): void
    {
        $wishListRole = WishListRole::factory()->create();

        $wishListRole->delete();

        $this->assertDatabaseMissing('wish_list_roles', [
            'id' => $wishListRole->id,
        ]);
    }

    public function testCanFindWishListRoleWithGetRoleByName(): void
    {
        $wishListRole = WishListRole::factory()->create([
            'name' => 'owner',
        ]);
        $foundWishListRole = WishListRole::getRoleByName(WishListRole::OWNER_ROLE);

        $this->assertNotNull($foundWishListRole);
        $this->assertEquals($wishListRole->id, $foundWishListRole->id);
    }

    public function testThrowsExceptionIfWishListRoleNotFound(): void
    {
        $this->expectException(ModelNotFoundException::class);

        WishListRole::getRoleByName('non_existent_wish_list_role');
    }
}
