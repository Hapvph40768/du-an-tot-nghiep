<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['route_id', 'vehicle_id', 'driver_id', 'trip_date', 'departure_time', 'arrival_time', 'price', 'status'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function pickupPoints()
    {
        return $this->belongsToMany(PickupPoint::class, 'trip_pickup_points');
    }
    public function dropoffPoints()
    {
        return $this->belongsToMany(DropoffPoint::class, 'trip_dropoff_points');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function seatLocks()
    {
        return $this->hasMany(SeatLock::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
    public function stopovers()
    {
        return $this->hasMany(TripStopover::class)->orderBy('stop_order');
    }
}
