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
    Schema::create('seat_locks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('seat_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamp('locked_until'); // Cột quan trọng để check 10 phút
        $table->timestamps();
        
        // Đảm bảo 1 ghế chỉ có 1 bản ghi lock hiệu lực
        $table->unique('seat_id'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_locks');
    }
};
