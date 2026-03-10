<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'trip_id',
        'pickup_point_id',
        'total_amount',
        'status'
    ];

    // Quan hệ
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
}