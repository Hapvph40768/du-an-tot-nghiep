<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('start_location_id')->constrained('locations')->cascadeOnDelete();
            $table->foreignId('end_location_id')->constrained('locations')->cascadeOnDelete();
            $table->integer('distance_km')->nullable();
            $table->integer('estimated_time')->nullable();
            $table->timestamps();

            $table->unique(['start_location_id', 'end_location_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};