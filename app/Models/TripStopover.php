<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripStopover extends Model
{
    use HasFactory;

    protected $table = 'trip_stopovers';

    protected $fillable = [
        'trip_id', 'stop_name', 'arrival_time', 'departure_time', 'stop_order', 'note',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
