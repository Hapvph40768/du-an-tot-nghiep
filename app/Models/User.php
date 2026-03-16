<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'role',
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'status'
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function seatLocks()
    {
        return $this->hasMany(SeatLock::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }
}
