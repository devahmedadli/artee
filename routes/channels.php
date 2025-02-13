<?php

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat.{chatId}', function (User $user, int $chatId) {
    // Logic to determine if the user can access this chat
    // Log the user and chat ID
    Log::info('User ID: ' . $user->id);
    Log::info('Chat ID: ' . $chatId);
    if ($user->isAdmin()) {
        return true;
    } else {
        return $user->chat->id == $chatId;
    }
});
