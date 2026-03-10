<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'booking_id',
        'trip_id',
        'rating',
        'comment',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo('App\\Models\\Booking', 'booking_id');
    }

    public function trip()
    {
        return $this->belongsTo('App\\Models\\Trip');
    }
}
