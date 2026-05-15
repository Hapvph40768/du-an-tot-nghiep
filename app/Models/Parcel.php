<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class);
    }

    public function dropoffPoint()
    {
        return $this->belongsTo(DropoffPoint::class);
    }
}
