<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('admin', 'staff', 'customer', 'driver', 'assistant') 
            DEFAULT 'customer'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('admin', 'staff', 'customer') 
            DEFAULT 'customer'
        ");
    }
};
