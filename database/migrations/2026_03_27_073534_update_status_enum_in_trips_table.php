<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('active', 'running', 'broken', 'completed', 'cancelled') DEFAULT 'active'");
        }
        // SQLite không hỗ trợ MODIFY COLUMN, bỏ qua khi test
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('active', 'completed', 'cancelled') DEFAULT 'active'");
        }
    }
};