<?php

namespace App\Providers;

use App\Models\Gift;
use App\Models\WishListUser;
use App\Observers\GiftObserver;
use App\Observers\WishListUserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gift::observe(GiftObserver::class);
        WishListUser::observe(WishListUserObserver::class);
    }
}
