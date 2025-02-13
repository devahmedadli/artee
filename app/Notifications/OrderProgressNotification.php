<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;
use App\Models\OrderProgress;
use Illuminate\Support\Facades\Log;

class OrderProgressNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $progress;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, OrderProgress $progress)
    {
        $this->order = $order;
        $this->progress = $progress;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        // Log::info('OrderProgressNotification via method called', ['notifiable' => $notifiable]);
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        // Log::info('OrderProgressNotification toMail method called', [
        //     'order' => $this->order->id,
        //     'progress' => $this->progress->id,
        //     'notifiable' => $notifiable
        // ]);

        return (new MailMessage)
            ->subject(__('New Order Progress'))
            ->greeting(__('Dear :name', ['name' => $this->order->customer->name]))
            ->line(__('There has been an update to your order.'))
            ->action(__('View Order Details'), route('customer.orders.show', $this->order->id))
            ->line(__('Thanks,'))
            ->line(config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
