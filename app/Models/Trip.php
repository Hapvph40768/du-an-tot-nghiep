<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'route_id',
        'vehicle_id',
        'driver_id',
        'departure_time',
        'trip_date',
        'price'
    ];

    // Quan hệ tuyến
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    // Quan hệ xe
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Quan hệ tài xế
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
