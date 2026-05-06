<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type'); // 'percent' or 'fixed'
            $table->decimal('value', 12, 0);
            $table->enum('discount_type', ['fixed', 'percent'])->default('fixed');
            $table->decimal('discount_value', 15, 2)->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('max_uses')->nullable();
            $table->integer('current_uses')->default(0);
            $table->integer('usage_limit')->default(100);
            $table->integer('used_count')->default(0);
            $table->timestamps();

            $table->index('code', 'idx_promo_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
