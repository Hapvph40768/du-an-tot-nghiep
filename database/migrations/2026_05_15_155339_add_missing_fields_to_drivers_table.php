<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('email')->nullable()->after('phone');
            $table->text('address')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('address');
            $table->string('id_card_number', 20)->nullable()->after('avatar');
            $table->string('license_class', 10)->nullable()->after('license_number');
            $table->date('license_issued_date')->nullable()->after('license_class');
            $table->date('license_expiry_date')->nullable()->after('license_issued_date');
            $table->string('license_image')->nullable()->after('license_expiry_date');
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth', 'gender', 'email', 'address', 'avatar',
                'id_card_number', 'license_class', 'license_issued_date',
                'license_expiry_date', 'license_image',
            ]);
        });
    }
};
