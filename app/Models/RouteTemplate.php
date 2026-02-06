<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteTemplate extends Model
{
    protected $table = 'route_templates';
    public $timestamps = true;

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