<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DropoffPoint extends Model
{
    protected $fillable = [
        'location_id',
        'name',
        'address',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_dropoff_points');
    }
}
