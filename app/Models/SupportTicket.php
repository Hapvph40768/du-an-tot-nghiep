<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportTicket extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'status',
    ];

    protected $casts = [
        'type'   => 'string',
        'status' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(SupportMessage::class);
    }

    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    public function getLatestMessage()
    {
        return $this->messages()->latest('created_at')->first();
    }
}
