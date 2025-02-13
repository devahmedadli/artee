<?php

namespace App\Listeners;

use App\Models\Customer;
use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompleteUserCreation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        dd(
            Customer::create([
                'user_id'   => $event->user->id,
                'address'   => $event->request->address,
                'company'   => $event->request->company,
                'lang'      => $event->request->lang,
            ])
        );
        // Create a new customer record linked to the user
        


    }
}
