<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\OrderProgress;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Observers\OrderProgressObserver;
use Illuminate\Support\Facades\Broadcast;

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
        Order::observe(OrderObserver::class);
        OrderProgress::observe(OrderProgressObserver::class);

        Gate::define('admin', function () {
            return auth()->check() && auth()->user()->role == 'admin';
        });
        Gate::define('freelancer', function () {
            return auth()->check() && auth()->user()->role == 'freelancer';
        });
        Gate::define('customer', function () {
            return auth()->check() && auth()->user()->role == 'customer';
        });


    }
}
