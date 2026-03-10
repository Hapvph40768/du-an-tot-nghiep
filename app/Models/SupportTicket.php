<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportTicket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type',
        'description',
        'status',
    ];

    protected $casts = [
        'type'   => 'string',
        'status' => 'string',
    ];

    // Ticket thuộc về user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 1 ticket có nhiều message
    public function messages(): HasMany
    {
        return $this->hasMany(SupportMessage::class);
    }

    // Kiểm tra ticket còn mở
    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    // Lấy tin nhắn mới nhất
    public function getLatestMessage()
    {
        return $this->messages()->latest('created_at')->first();
    }
}