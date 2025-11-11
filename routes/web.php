<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les listes
    Route::get('/', [WishListController::class, 'index'])->name('wish_lists.index');
    Route::get('/wish_lists/create', [WishListController::class, 'create'])->name('wish_lists.create');
    Route::post('/wish_lists/create', [WishListController::class, 'store'])->name('wish_lists.store');

    Route::group(['middleware' => 'checkWishListMembership'], function () {
        Route::get('/wish_lists/{wishList}', [WishListController::class, 'show'])->name('wish_lists.show');
        Route::get('/wish_lists/{wishList}/edit', [WishListController::class, 'edit'])->name('wish_lists.edit');
        Route::patch('/wish_lists/{wishList}/edit', [WishListController::class, 'update'])->name('wish_lists.update');
        Route::get('/wish_lists/{wishList}/users', [WishListController::class, 'users'])->name('wish_lists.users');
        Route::post('/wish_lists/{wishList}/users', [WishListController::class, 'addUser'])->name('wish_lists.add_user');
        Route::delete('/wish_lists/users/{wishListUser}', [WishListController::class, 'deleteUser'])->name('wish_lists.delete_user');

        // Routes pour les cadeaux d'un utilisateur
        Route::get('/wish_lists/{wishListUser}/gifts', [GiftController::class, 'index'])->name('gifts.index');
        Route::get('/wish_lists/{wishListUser}/gifts/create', [GiftController::class, 'create'])->name('gifts.create');
        Route::post('/wish_lists/{wishListUser}/gifts', [GiftController::class, 'store'])->name('gifts.store');
        Route::get('/wish_lists/gift/{gift}', [GiftController::class, 'edit'])->name('gifts.edit');
        Route::patch('/wish_lists/gift/{gift}', [GiftController::class, 'update'])->name('gifts.update');
        Route::delete('/wish_lists/gift/{gift}', [GiftController::class, 'destroy'])->name('gifts.destroy');
        Route::post('/wish_lists/gift/{gift}/reservation', [GiftController::class, 'reservation'])->name('gifts.reservation');
    });
});

require __DIR__.'/auth.php';
