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
        Schema::create('trip_pickup_points', function (Blueprint $table) {
            $table->foreignId('trip_id')->constrained('trips');
            $table->foreignId('pickup_point_id')->constrained('pickup_points');
            $table->primary(['trip_id', 'pickup_point_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_pickup_points');
    }
};
