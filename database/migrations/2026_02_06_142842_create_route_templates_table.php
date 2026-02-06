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
        Schema::create('route_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Hà Nội - Hải Phòng"
            $table->foreignId('start_location_id')->constrained('locations');
            $table->foreignId('end_location_id')->constrained('locations');
            $table->integer('distance_km');
            $table->integer('estimated_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_templates');
    }
};
