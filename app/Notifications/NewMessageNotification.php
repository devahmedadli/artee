<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\ChMessage;
use Chatify\ChatifyMessenger;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct(ChMessage $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('New Message Received'))
            ->line(__('You have received a new message from ') . $this->message->sender->name)
            ->line(__('Message: ') . \Illuminate\Support\Str::limit($this->message->body, 100))
            ->action(__('View Message'), route('login'))
            ->line(__('Thank you for using our application!'));
    }
} 