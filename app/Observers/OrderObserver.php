<?php

namespace App\Observers;

use App\Models\Chat;
use App\Models\Order;
use App\Models\Message;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderCompletedNotification;
use App\Models\ProductOrder;
class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(ProductOrder | Order $order): void
    {
        // After creating the order
        try {
            // $order->customer->notify(new OrderCreatedNotification($order, false, $order instanceof ProductOrder ? 'product' : 'service'));
            app(\App\Services\NotificationService::class)->notifyAdmin(new \App\Notifications\OrderCreatedNotification($order, true, $order instanceof ProductOrder ? 'product' : 'service'));
            app(\App\Services\NotificationService::class)->notifyCustomer(new \App\Notifications\OrderCreatedNotification($order, false, $order instanceof ProductOrder ? 'product' : 'service'), $order->customer->id);
        } catch (\Exception $e) {
            \Log::error('Error notifying admin: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // send notification if order status is completed
        if ($order->status == 'completed') {
            $order->customer->notify(new OrderCompletedNotification($order));
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
