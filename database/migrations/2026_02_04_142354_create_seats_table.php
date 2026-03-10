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
        Schema::create('seats', function (Illuminate\Database\Schema\Blueprint $table) {
    $table->id();
    $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
    $table->string('seat_number'); // Ví dụ: A1, A2, B1...
    $table->enum('type', ['Thường', 'VIP'])->default('Thường');
    $table->enum('status', ['Trống', 'Đã đặt', 'Bảo trì'])->default('Trống');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
