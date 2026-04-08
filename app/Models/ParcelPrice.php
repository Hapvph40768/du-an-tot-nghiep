<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParcelPrice extends Model
{
    protected $fillable = [
        'route_id',
        'weight_from',
        'weight_to',
        'price',
        'description',
    ];

    protected $casts = [
        'weight_from' => 'decimal:2',
        'weight_to' => 'decimal:2',
        'price' => 'decimal:0',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}

