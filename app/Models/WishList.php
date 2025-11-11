<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'title',
        'description',
        'date'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'wish_list_users')
            ->using(WishListUser::class)
            ->withPivot('id', 'wish_list_role_id', 'created_at')
            ->withTimestamps()
            ->orderBy('pivot_created_at', 'desc')
        ;
    }

    /**
     * Add user to wish list with owner role
     * @param User $user
     * @return void
     */
    public function addOwner(User $user): void
    {
        // Get owner role
        $ownerRole = WishListRole::getRoleByName(WishListRole::OWNER_ROLE);

        // Attach user with owner role
        $this->users()->attach($user, ['wish_list_role_id' => $ownerRole->id]);
    }

    /**
     * Add user to wish list with contributeur role
     * @param User $user
     * @return void
     */
    public function addContributor(User $user): void
    {
        // Get contributor role
        $ownerRole = WishListRole::getRoleByName(WishListRole::CONTRIBUTOR_ROLE);

        // Attach user with owner role
        $this->users()->attach($user, ['wish_list_role_id' => $ownerRole->id]);

        // TODO : Send mail
    }
}
