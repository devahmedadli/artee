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
        return (new MailMessage)
            ->subject(__('Order placed successfully'))
            ->greeting(__('Dear :name', ['name' => $this->order->customer->name]))
            ->line(__('Thank you for your order. We are pleased to confirm that your order has been successfully placed.'))
            ->line(__('Order Details:'))
            ->line(__('Order Number: :orderNumber', ['orderNumber' => $this->order->order_number]))
            ->line(__('Date of Order: :date', ['date' => $this->order->created_at->format('M d, Y')]))
            ->line(__($this->type == 'service' ? 'Service: :service' : 'Product: :product', ['service' => $this->order->service->name, 'product' => $this->order->product->name]))
            ->line(__('Total Amount: :amount USD', ['amount' => number_format($this->order->total)]))
            ->action(__('View Order Details'), route('customer.orders.show', [$this->order->id, $this->order->type]))
            ->line(__('If you have any questions or need further assistance, please don\'t hesitate to contact us.'))
            ->line(__('Thank you for choosing our services. We appreciate your business!'))
            ->line(__('Best regards,'))
            ->line(__('Techs Gate Co.'))
            ->action(__('www.artee.com.sa'), 'https://www.artee.com.sa');
    }

    protected function toAdminMail()
    {
        return (new MailMessage)
            ->subject(__('New Order Received'))
            ->greeting(__('Hello Admin'))
            ->line(__('A new order has been placed.'))
            ->line(__('Order Details:'))
            ->line(__('Order Number: :orderNumber', ['orderNumber' => $this->order->order_number]))
            ->line(__('Customer Name: :name', ['name' => $this->order->customer->name]))
            ->line(__('Date of Order: :date', ['date' => $this->order->created_at->format('M d, Y')]))
            ->line(__($this->type == 'service' ? 'Service: :service' : 'Product: :product', ['service' => $this->order->service->name, 'product' => $this->order->product->name]))
            ->line(__('Total Amount: :amount USD', ['amount' => number_format($this->order->total)]))
            ->action(__('View Order Details'), route('orders.show', [$this->order->id, $this->type]))
            ->line(__('Please process this order as soon as possible.'));
    }
}
