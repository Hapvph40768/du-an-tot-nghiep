<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Seat extends Model
{
    protected $fillable = [
        'vehicle_id',
        'seat_number',
        'type',
        'status',
        'user_id',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function currentLock(): HasOne
    {
        return $this->hasOne(SeatLock::class, 'seat_id')->latestOfMany();
    }
}