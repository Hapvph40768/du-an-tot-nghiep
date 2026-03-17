<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatLock extends Model
{
    protected $fillable = ['trip_id', 'seat_id', 'user_id', 'booking_id', 'locked_until'];
    protected $casts = ['locked_until' => 'datetime'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
