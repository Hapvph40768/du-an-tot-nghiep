<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('order_code')->unique();
            $table->decimal('amount', 15, 2);
            $table->string('payment_method', 50); // vnpay, momo, bank_transfer, cod
            $table->string('status', 50)->default('pending'); // pending, paid, failed, waiting_verify, completed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};