<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Notifications\Notification;

class NotificationService
{
    /**
     * Notify all admins
     * 
     * @param Notification $notification
     */
    public function notifyAdmin(Notification $notification)
    {
        User::where('role', 'admin')->get()->each(function ($user) use ($notification) {
            $user->notify($notification);
        });
    }

    /**
     * Notify a customer
     * 
     * @param Notification $notification
     * @param int $userId
     */
    public function notifyCustomer(Notification $notification, $userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->notify($notification);
        }
    }

    /**
     * Notify a freelancer
     * 
     * @param Notification $notification
     * @param int $userId
     */
    public function notifyFreelancer(Notification $notification, $userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->notify($notification);
        }
    }
}
