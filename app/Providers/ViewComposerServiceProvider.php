<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message; // Adjust this based on your actual Message model
use Illuminate\Support\Facades\Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // View::composer('layouts.home', function ($view) {
        //     if (Auth::check()) {
        //         $unreadMessagesCount = Auth::user()->unreadMessagesCount();
        //         $view->with('unreadMessagesCount', $unreadMessagesCount);
        //     }
        // });
    }
}
