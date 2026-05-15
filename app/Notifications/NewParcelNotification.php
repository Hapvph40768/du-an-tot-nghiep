<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewParcelNotification extends Notification
{
    use Queueable;

    protected $parcel;

    /**
     * Create a new notification instance.
     */
    public function __construct($parcel)
    {
        $this->parcel = $parcel;
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
            'title' => 'Đơn ký gửi mới',
            'message' => 'Khách hàng ' . ($this->parcel->sender_name ?? 'ẩn danh') . ' vừa tạo một đơn ký gửi hàng hoá.',
            'url' => route('admin.parcels.show', $this->parcel->id),
            'icon' => 'bx bx-package'
        ];
    }
}
