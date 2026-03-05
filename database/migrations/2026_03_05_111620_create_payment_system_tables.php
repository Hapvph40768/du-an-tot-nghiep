<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Bảng Orders (Đơn hàng)
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1); // Giả lập user 1
            $table->string('order_code')->unique();
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled', 'waiting_verify'])->default('pending');
            $table->string('payment_method');
            $table->timestamps();
        });

        // 2. Bảng Payments (Trạng thái tổng quan của việc thanh toán)
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('method');
            $table->string('status')->default('pending');
            $table->string('transaction_code')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        // 3. Bảng Transactions (Lịch sử gọi API/Webhook với Gateway)
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('gateway');
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('status');
            $table->text('raw_response')->nullable(); // Lưu lại log từ gateway để đối soát
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('orders');
    }
};