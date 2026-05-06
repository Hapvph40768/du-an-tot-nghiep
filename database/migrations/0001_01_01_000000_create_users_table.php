<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'staff', 'customer', 'driver', 'assistant'])->default('customer');
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('address')->nullable();
            $table->string('citizen_id', 20)->unique()->nullable();
            $table->string('employee_id', 20)->unique()->nullable();
            $table->string('department')->nullable();
            $table->decimal('salary', 15, 2)->nullable();
            $table->date('joined_date')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->integer('points')->default(0);
            $table->string('phone', 20)->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('google_id')->nullable();
            $table->rememberToken();
            $table->string('avatar')->nullable();
            $table->enum('status', ['active', 'blocked'])->default('active');
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['role', 'status'], 'idx_users_role_status');
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
};