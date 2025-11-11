<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Gift extends Model
{
    use HasFactory, HasUuids;

    CONST string DEFAULT_GIFT_IMAGE = 'default_gift_image.png';

    protected $fillable = [
        'wish_list_users_id',
        'title',
        'description',
        'image',
        'link',
        'added_by',
        'reserved_by',
        'reserved_at'
    ];

    public function wishListUser(): BelongsTo
    {
        return $this->belongsTo(WishListUser::class, 'wish_list_users_id', 'id');
    }

    public function addedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function reservedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reserved_by', 'id');
    }

    public function reservation(): void
    {
        $this->update([
            'reserved_by' => $this->reservedByUser ? null : Auth::id()
        ]);
    }
}
