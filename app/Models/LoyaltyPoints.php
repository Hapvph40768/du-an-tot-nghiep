<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPoints extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    const UPDATED_AT = 'last_updated';


    protected $table = 'loyalty_points';

    protected $fillable = [
        'user_id', 'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
