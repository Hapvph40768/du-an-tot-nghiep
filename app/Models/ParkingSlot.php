<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingSlot extends Model
{
    protected $fillable = ['parking_id', 'vehicle_id', 'slot_code', 'row', 'column', 'floor', 'zone', 'slot_type', 'status'];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function histories()
    {
        return $this->hasMany(ParkingHistory::class, 'slot_id');
    }
}
