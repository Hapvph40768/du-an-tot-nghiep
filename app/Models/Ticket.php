<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['booking_id', 'trip_id', 'seat_id', 'ticket_code', 'status'];

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
