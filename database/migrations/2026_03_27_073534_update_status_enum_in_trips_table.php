<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE trips 
            MODIFY COLUMN status 
            ENUM('active', 'running', 'broken', 'completed', 'cancelled') 
            DEFAULT 'active'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE trips 
            MODIFY COLUMN status 
            ENUM('active', 'completed', 'cancelled') 
            DEFAULT 'active'
        ");
    }
};