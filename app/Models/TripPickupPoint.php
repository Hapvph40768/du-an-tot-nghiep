<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TripPickupPoint extends Pivot
{
    protected $table = 'trip_pickup_points';

    public $timestamps = false; 

    public $incrementing = false;

    protected $fillable = [
        'trip_id',
        'pickup_point_id'
    ];
}