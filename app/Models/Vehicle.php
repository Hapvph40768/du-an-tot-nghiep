<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    public $timestamps = false;

    protected $fillable = [
        'license_plate',
        'type',
        'total_seats',
        'status',
    ];
}
