<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    // Thêm 'experience_years' và 'personal_info' vào mảng này
    protected $fillable = [
        'name',
        'phone',
        'license_number',
        'experience_years', // Cột mới thêm
        'personal_info',    // Cột mới thêm
        'status',
        'image',
    ];
}