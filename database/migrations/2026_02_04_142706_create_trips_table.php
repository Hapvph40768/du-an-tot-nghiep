<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
            $table->foreignId('driver_id')->constrained('drivers')->cascadeOnDelete();
            $table->date('trip_date')->nullable();
            $table->time('departure_time')->nullable();
            $table->time('arrival_time')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['active', 'running', 'broken', 'completed', 'cancelled'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['vehicle_id', 'trip_date', 'departure_time']);
            $table->index(['trip_date', 'route_id', 'status'], 'idx_trips_search');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};