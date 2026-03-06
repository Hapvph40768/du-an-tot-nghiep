<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'status'
    ];

    // Ticket thuộc về user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 ticket có nhiều message
    public function messages()
    {
        return $this->hasMany(SupportMessage::class);
    }
}