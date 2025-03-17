<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $isAdmin;
    protected $type;
    public function __construct(Order $order, bool $isAdmin = false, $type = 'service')
    {
        $this->order = $order;
        $this->isAdmin = $isAdmin;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->isAdmin ? $this->toAdminMail() : $this->toCustomerMail();
    }

    protected function toCustomerMail()
    {
        $serviceName = $this->type == 'service' ? $this->order->service->{app()->getLocale() . '_name'} : $this->order->product->{app()->getLocale() . '_name'};
        return (new MailMessage)
            ->view('emails.customer.orders.order-placed', [
                'order' => $this->order,
                'serviceName' => $serviceName,
                'type' => $this->type
            ])
            ->subject(__('Order placed successfully'));
    }

    protected function toAdminMail()
    {
        $serviceName = $this->type == 'service' ? $this->order->service->{app()->getLocale() . '_name'} : $this->order->product->{app()->getLocale() . '_name'};
        return (new MailMessage)
            ->view('emails.admin.orders.order-placed', [
                'order' => $this->order,
                'serviceName' => $serviceName,
                'type' => $this->type
            ])
            ->subject(__('New Order Received'));
    }
}
