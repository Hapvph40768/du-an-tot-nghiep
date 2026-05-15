<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id', 'name', 'date_of_birth', 'gender', 'phone', 'email', 'address',
        'avatar', 'id_card_number', 'license_number', 'license_class',
        'license_issued_date', 'license_expiry_date', 'license_image',
        'experience_years', 'personal_info', 'status',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
