<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    
    protected $table = 'drivers'; 

    // Các cột được phép điền dữ liệu
    protected $fillable = [
        'id',
        'name',
        'phone',
        'license_number',
        'status',
        // thêm các cột khác nếu database của bạn có
    ];
}