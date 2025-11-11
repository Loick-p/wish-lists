<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WishListUser extends Pivot
{
    use HasFactory, HasUuids;

    protected $table = 'wish_list_users';

    protected $fillable = [
        'wish_list_id',
        'user_id',
        'wish_list_role_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wishList(): BelongsTo
    {
        return $this->belongsTo(WishList::class);
    }

    public function wishListRole(): BelongsTo
    {
        return $this->belongsTo(WishListRole::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class, 'wish_list_users_id', 'id')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Find WishListUser by User and WishList
     * @param User $user
     * @param WishList $wishList
     * @return WishListUser|null
     */
    public static function findByUserAndWishList(User $user, WishList $wishList): ?WishListUser
    {
        return self::where('user_id', $user->id)
            ->where('wish_list_id', $wishList->id)
            ->first()
        ;
    }

    /**
     * Check if the user is the owner of the list
     * @return bool
     */
    public function isWishListOwner(): bool
    {
        return $this->wishListRole->name === WishListRole::OWNER_ROLE;
    }

    /**
     * Get gifts added by the WishListUser user
     * @param string $userId
     * @return Collection
     */
    public function getUserGifts(string $userId): Collection
    {
        return $this->gifts()
            ->where('added_by', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
