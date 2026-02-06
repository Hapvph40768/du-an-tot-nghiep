<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'routes';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'start_location_id',
        'end_location_id',
        'distance_km',
        'estimated_time'
    ];

    public function startLocation()
    {
        return $this->belongsTo(Location::class, 'start_location_id');
    }

    public function endLocation()
    {
        return $this->belongsTo(Location::class, 'end_location_id');
    }
}