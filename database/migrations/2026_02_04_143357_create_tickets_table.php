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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings');
            $table->foreignId('trip_id')->constrained('trips');
            $table->foreignId('seat_id')->constrained('seats');
            $table->string('ticket_code')->unique()->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'used'])->default('pending');
            $table->unique(['trip_id', 'seat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
