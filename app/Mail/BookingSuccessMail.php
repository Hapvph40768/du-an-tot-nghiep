<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;

    public function __construct(Booking $booking)
    {
        // Eager load tất cả relations cần thiết cho email
        $booking->loadMissing([
            'trip.route.startLocation',
            'trip.route.endLocation',
            'trip.vehicle',
            'trip.driver',
            'tickets.seat',
            'pickupPoint',
            'dropoffPoint',
        ]);
        $this->booking = $booking;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Đặt vé thành công - Mã đơn #' . str_pad($this->booking->id, 6, '0', STR_PAD_LEFT),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-success',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
