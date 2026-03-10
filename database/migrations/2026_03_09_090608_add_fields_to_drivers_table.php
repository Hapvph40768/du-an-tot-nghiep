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
        Schema::table('drivers', function (Blueprint $table) {
            // Thêm cột experience_years kiểu số nguyên, cho phép null
            $table->integer('experience_years')->nullable();
            
            // Thêm cột personal_info kiểu văn bản dài, cho phép null
            $table->text('personal_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Xóa 2 cột này nếu chạy lệnh rollback
            $table->dropColumn(['experience_years', 'personal_info']);
        });
    }
};