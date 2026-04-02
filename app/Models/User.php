<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Booking;
use App\Models\SeatLock;
use App\Models\Review;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\SupportTicket;

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
        'status',
        'birthday',
        'gender',
        'address',
        'citizen_id',
        'employee_id',
        'department',
        'salary',
        'joined_date',
        'contract_type',
        'last_login_at',
        'last_login_ip'
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
