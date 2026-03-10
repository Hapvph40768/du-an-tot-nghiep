<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Thêm 2 cột mới sau cột license_number
            $table->integer('experience_years')->default(0)->after('license_number')->comment('Số năm kinh nghiệm');
            $table->text('personal_info')->nullable()->after('experience_years')->comment('Thông tin cá nhân');
        });
    }

    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['experience_years', 'personal_info']);
        });
    }
};