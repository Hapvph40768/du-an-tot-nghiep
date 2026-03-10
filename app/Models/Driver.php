<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'drivers';

    // Các cột được phép mass assignment
    protected $fillable = [
        'name',
        'phone',
        'license_number',
        'experience_years',
        'personal_info',
        'status',
        'image',
    ];
}
