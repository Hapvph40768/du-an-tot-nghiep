<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seat_locks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->nullable()->constrained('trips')->cascadeOnDelete();
            $table->foreignId('seat_id')->nullable()->constrained('seats')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->dateTime('locked_until')->nullable();
            $table->timestamps();

            $table->unique(['trip_id', 'seat_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seat_locks');
    }
};