<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('trip_id')->nullable()->constrained('trips')->cascadeOnDelete();
            $table->foreignId('seat_id')->nullable()->constrained('seats')->cascadeOnDelete();
            $table->string('ticket_code')->unique()->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'used', 'no_show'])->default('pending');
            $table->timestamps();

            $table->unique(['trip_id', 'seat_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};