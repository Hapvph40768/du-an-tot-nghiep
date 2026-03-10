<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'license_plate',
        'type',
        'total_seats',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_seats' => 'integer',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /**
     * Các giá trị mặc định cho status (tùy chọn)
     */
    const STATUS_ACTIVE      = 'active';
    const STATUS_MAINTENANCE = 'maintenance';

    /**
     * Scope để lấy xe đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Scope để lấy xe đang bảo dưỡng
     */
    public function scopeMaintenance($query)
    {
        return $query->where('status', self::STATUS_MAINTENANCE);
    }

    /**
     * Helper method kiểm tra xe có đang hoạt động không
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Helper method kiểm tra xe có đang bảo dưỡng không
     */
    public function isMaintenance(): bool
    {
        return $this->status === self::STATUS_MAINTENANCE;
    }
}