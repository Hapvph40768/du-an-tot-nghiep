<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    protected $fillable = ['booking_id', 'trip_id', 'seat_id', 'ticket_code', 'status'];

    protected static function boot()
    {
        parent::boot();

        // Tự động sinh mã vé ngẫu nhiên khi tạo vé mới
        static::creating(function ($ticket) {
            if (empty($ticket->ticket_code)) {
                $ticket->ticket_code = self::generateUniqueTicketCode();
            }
        });
    }

    /**
     * Sinh mã vé ngẫu nhiên duy nhất
     * Format: VE-{YYYY}-{MM}-{XXXXX} (VD: VE-2026-02-A1B2C)
     */
    public static function generateUniqueTicketCode()
    {
        do {
            $code = 'VE-' . now()->format('Y-m') . '-' . strtoupper(Str::random(5));
        } while (self::where('ticket_code', $code)->exists());

        return $code;
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
