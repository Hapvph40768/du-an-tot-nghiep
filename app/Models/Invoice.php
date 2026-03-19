<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_code', 'customer_name', 'booking_code', 'amount', 'payment_method', 'status'];
}
