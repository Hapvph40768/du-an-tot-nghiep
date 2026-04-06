<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripStopover extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $table = 'trip_stopovers';

    protected $fillable = [
        'trip_id', 'pickup_point_id', 'arrival_time_planned', 'stop_order',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class);
    }
}
