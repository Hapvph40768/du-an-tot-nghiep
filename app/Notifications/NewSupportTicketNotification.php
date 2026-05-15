<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSupportTicketNotification extends Notification
{
    use Queueable;

    protected $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Yêu cầu hỗ trợ mới',
            'message' => 'Khách hàng ' . ($this->ticket->customer_name ?? $this->ticket->customer_email ?? 'ẩn danh') . ' vừa gửi một yêu cầu hỗ trợ.',
            'url' => route('admin.support_tickets.show', $this->ticket->id),
            'icon' => 'bx bx-support'
        ];
    }
}
