<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['license_plate', 'type', 'total_seats','phone_vehicles', 'status'];
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
    public function parkingSlot()
    {
        return $this->hasOne(ParkingSlot::class);
    }
    public function parkingHistories()
    {
        return $this->hasMany(ParkingHistory::class);
    }
}
