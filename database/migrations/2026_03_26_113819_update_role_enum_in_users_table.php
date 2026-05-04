<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Sử dụng Schema builder để tương thích đa nền tảng
        Schema::table('users', function (Blueprint $table) {
            // Nếu cần đổi enum, ta có thể dùng raw SQL cho MySQL
            // Hoặc đơn giản là đảm bảo column đã tồn tại với đúng giá trị
        });

        // Dùng DB::statement cho MySQL để update enum
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'staff', 'customer', 'driver', 'assistant') DEFAULT 'customer'");
        }
    }

    public function down()
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'staff', 'customer') DEFAULT 'customer'");
        }
    }
};
