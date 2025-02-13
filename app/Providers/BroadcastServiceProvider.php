<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
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
        Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
            Log::info('the User ID: ' . $user->id);
            Log::info('Chat ID: ' . $chatId);
            if ($user->isAdmin()) {
                return true;
            } else {
                return $user->chat->id == $chatId;
            }
        });
    }
}
