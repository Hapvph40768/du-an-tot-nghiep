<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'province_code',
        'latitude',
        'longitude',
        'is_active',
        'note',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

}
