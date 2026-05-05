<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = ['user_id', 'booking_id', 'type', 'description', 'assigned_admin_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function assignedAdmin()
    {
        return $this->belongsTo(User::class, 'assigned_admin_id');
    }
    public function messages() {
    return $this->hasMany(SupportMessage::class, 'support_ticket_id');
    }
}
