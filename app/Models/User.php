<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Tên bảng trong CSDL
    protected $table = 'users';

    // Khóa chính
    protected $primaryKey = 'id';

    // Nếu bảng có created_at, updated_at
    public $timestamps = true;

    // Các cột cho phép insert / update
    protected $fillable = [
        'role',
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'status'
    ];

    // Ẩn khi trả dữ liệu
    protected $hidden = [
        'password'
    ];
}
