<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'staff', 'customer'])->default('customer');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->enum('status', ['active', 'blocked'])->default('active');
            $table->timestamps(); // Tự động tạo created_at và updated_at
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
};