<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingHistory extends Model
{
    protected $fillable = ['vehicle_id', 'slot_id', 'check_in_time', 'check_out_time'];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function slot()
    {
        return $this->belongsTo(ParkingSlot::class, 'slot_id');
    }
}
