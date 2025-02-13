<?php

namespace App\Observers;

use App\Models\OrderProgress;
use Illuminate\Support\Facades\Log;
use App\Notifications\OrderProgressNotification;

class OrderProgressObserver
{
    /**
     * Handle the OrderProgress "created" event.
     */
    public function created(OrderProgress $orderProgress): void
    {

        // After creating the progress
        $orderProgress->order->customer->notify(new OrderProgressNotification($orderProgress->order, $orderProgress));
        // log
        Log::info('OrderProgress created', ['order_progress' => $orderProgress]);
    }

    /**
     * Handle the OrderProgress "updated" event.
     */
    public function updated(OrderProgress $orderProgress): void
    {
        //
    }

    /**
     * Handle the OrderProgress "deleted" event.
     */
    public function deleted(OrderProgress $orderProgress): void
    {
        //
    }

    /**
     * Handle the OrderProgress "restored" event.
     */
    public function restored(OrderProgress $orderProgress): void
    {
        //
    }

    /**
     * Handle the OrderProgress "force deleted" event.
     */
    public function forceDeleted(OrderProgress $orderProgress): void
    {
        //
    }
}
