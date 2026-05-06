<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trip_dropoff_points', function (Blueprint $table) {
            $table->foreignId('trip_id')->constrained('trips')->cascadeOnDelete();
            $table->foreignId('dropoff_point_id')->constrained('dropoff_points')->cascadeOnDelete();
            
            // Khai báo khóa chính kết hợp (composite primary key)
            $table->primary(['trip_id', 'dropoff_point_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_dropoff_points');
    }
};
