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
            ->view('emails.customer.messages.new-message', [
                'message' => $this->message,
            ])
            ->subject(__('New Message Received'));
    }
} 