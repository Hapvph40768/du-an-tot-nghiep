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
        Schema::create('parcel_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->cascadeOnDelete();
            $table->decimal('weight_from', 8, 2); // kg
            $table->decimal('weight_to', 8, 2);   // kg
            $table->decimal('price', 12, 0);      // VND
            $table->text('description')->nullable();
            $table->timestamps();

            // Unique constraint: mỗi tuyến có 1 giá cho 1 khoảng trọng lượng
            $table->unique(['route_id', 'weight_from', 'weight_to']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcel_prices');
    }
};
