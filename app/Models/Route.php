<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['start_location_id', 'end_location_id', 'distance_km', 'estimated_time'];

    public function departureLocation()
    {
        return $this->belongsTo(Location::class, 'start_location_id');
    }

    public function destinationLocation()
    {
        return $this->belongsTo(Location::class, 'end_location_id');
    }
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
