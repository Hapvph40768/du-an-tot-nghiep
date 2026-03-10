<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('departure_location')->comment('Điểm đi');
            $table->string('destination_location')->comment('Điểm đến');
            $table->date('departure_date')->comment('Ngày khởi hành');
            $table->time('departure_time')->comment('Giờ khởi hành');
            $table->decimal('price', 12, 2)->comment('Giá vé');
            $table->unsignedBigInteger('driver_id')->nullable()->comment('Tài xế phụ trách');
            $table->enum('status', ['pending', 'running', 'completed', 'cancelled'])->default('pending')->comment('Trạng thái chuyến');
            $table->timestamps();

            // Khóa ngoại liên kết với bảng drivers
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trips');
    }
};