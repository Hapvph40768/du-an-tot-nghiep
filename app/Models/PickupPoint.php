<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;

class PickupPoint extends Model
{
    protected $fillable = [
        'name',
        'address',
        'location_id'
    ];

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_pickup_points')
            ->withPivot('pickup_time', 'order')
            ->withTimestamps();
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
