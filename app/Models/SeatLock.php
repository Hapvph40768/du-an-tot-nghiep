<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatLock extends Model
{
    // Thêm dòng này để báo cho Laravel biết bảng này không dùng timestamps
    public $timestamps = false;

    protected $fillable = ['seat_id', 'user_id', 'trip_id', 'locked_until'];
    protected $casts = [
        'locked_until' => 'datetime',
    ];
}
