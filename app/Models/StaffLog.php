<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffLog extends Model
{
    protected $fillable = [
        'user_id', 
        'action', 
        'model_type', 
        'model_id', 
        'description', 
        'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
