<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';

    protected $fillable = [
        'departure_location',
        'destination_location',
        'departure_date',
        'departure_time',
        'price',
        'driver_id',
        'status'
    ];

    // Mối quan hệ: Một chuyến xe thuộc về một tài xế
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}