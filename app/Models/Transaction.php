<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'order_code', 'amount', 'currency', 'payment_method', 'status', 'gateway_transaction_id', 'gateway_payload'];

    // Cast chuỗi JSON lưu trong CSDL thành mảng array trong PHP
    protected $casts = [
        'gateway_payload' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
