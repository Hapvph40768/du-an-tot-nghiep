<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name'];

    public function pickupPoints()
    {
        return $this->hasMany(PickupPoint::class);
    }
    public function routesAsStart()
    {
        return $this->hasMany(Route::class, 'start_location_id');
    }
    public function routesAsEnd()
    {
        return $this->hasMany(Route::class, 'end_location_id');
    }
}
