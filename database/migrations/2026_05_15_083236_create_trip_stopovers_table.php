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
        Schema::create('trip_stopovers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips')->cascadeOnDelete();
            $table->string('stop_name'); // Tên địa điểm dừng (VD: Bến xe Thanh Hóa)
            $table->time('arrival_time')->nullable(); // Giờ đến
            $table->time('departure_time')->nullable(); // Giờ đi (rời khỏi)
            $table->integer('stop_order')->default(1); // Thứ tự điểm dừng
            $table->string('note')->nullable(); // Ghi chú thêm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_stopovers');
    }
};
