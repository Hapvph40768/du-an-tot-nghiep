<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'trip_id', 'pickup_point_id', 'contact_name', 'contact_phone', 'total_amount', 'status', 'cancellation_reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function seatLocks()
    {
        return $this->hasMany(SeatLock::class);
    }
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
