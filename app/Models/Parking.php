<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = ['name', 'location', 'description'];

    public function slots()
    {
        return $this->hasMany(ParkingSlot::class);
    }
}
