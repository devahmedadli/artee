<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCustomerRegistered extends Notification
{
    use Queueable;

    protected $customer;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hello ' . $notifiable->name)
                    ->subject('New customer registered')
                    ->line('A new customer has registered on the platform.')
                    ->line('Name: ' . $this->customer->name)
                    ->line('Email: ' . $this->customer->email)
                    ->action('View customer', route('customers.show', $this->customer->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
