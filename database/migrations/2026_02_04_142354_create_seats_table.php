<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
            $table->string('seat_number', 20)->nullable();
            $table->tinyInteger('floor')->default(1);
            $table->integer('row')->nullable();
            $table->integer('column')->nullable();
            $table->enum('type', ['standard', 'vip'])->default('standard');
            $table->decimal('extra_price', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['vehicle_id', 'seat_number'], 'unique_vehicle_seat');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};