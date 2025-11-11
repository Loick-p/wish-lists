<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WishList;
use App\Models\WishListRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WishListUser>
 */
class WishListUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wish_list_id' => WishList::factory(),
            'wish_list_role_id' => WishListRole::factory(),
            'user_id' => User::factory(),
        ];
    }
}
