<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Đơn đặt vé mới',
            'message' => 'Khách hàng ' . ($this->booking->contact_name ?? 'ẩn danh') . ' vừa đặt vé chuyến ' . ($this->booking->trip->route->name ?? 'xe'),
            'url' => route('admin.bookings.show', $this->booking->id),
            'icon' => 'bx bx-receipt'
        ];
    }
}
