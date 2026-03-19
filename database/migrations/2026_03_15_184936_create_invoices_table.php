<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code')->unique();
            $table->string('customer_name');
            $table->string('booking_code')->nullable();
            $table->decimal('amount', 15, 0);
            $table->string('payment_method');
            $table->string('status');
            $table->timestamps();

            // Khai báo các index theo SQL
            $table->index('invoice_code');
            $table->index('status');
            $table->index('payment_method');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};