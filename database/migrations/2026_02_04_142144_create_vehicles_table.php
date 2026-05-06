<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate', 50)->unique()->nullable();
            $table->string('type', 100)->nullable();
            $table->unsignedInteger('total_seats')->nullable();
            $table->string('phone_vehicles', 15)->nullable();
            $table->enum('status', ['active', 'maintenance', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('status', 'idx_veh_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};