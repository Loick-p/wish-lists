<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WishListRole extends Model
{
    use HasFactory, HasUuids;

    const OWNER_ROLE = 'owner';
    const CONTRIBUTOR_ROLE = 'contributor';

    protected $fillable = [
        'name'
    ];

    /**
     *
     * @param string $roleName
     * @return WishListRole|null
     * @throws ModelNotFoundException
     */
    public static function getRoleByName(string $roleName): ?WishListRole
    {
        return self::where('name', $roleName)->firstOrFail();
    }
}
