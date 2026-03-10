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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->enum('role', ['admin', 'staff', 'customer'])
                  ->default('customer');

            $table->string('name');

            $table->string('email')->unique()->nullable();

            $table->string('phone', 20)->unique()->nullable();

            $table->string('password');

            $table->string('avatar')->nullable();

            $table->enum('status', ['active', 'blocked'])
                  ->default('active');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
