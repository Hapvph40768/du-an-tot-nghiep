<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trip_pickup_points', function (Blueprint $table) {
            $table->foreignId('trip_id')->constrained('trips')->cascadeOnDelete();
            $table->foreignId('pickup_point_id')->constrained('pickup_points')->cascadeOnDelete();
            
            // Khai báo khóa chính kết hợp (composite primary key)
            $table->primary(['trip_id', 'pickup_point_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trip_pickup_points');
    }
};