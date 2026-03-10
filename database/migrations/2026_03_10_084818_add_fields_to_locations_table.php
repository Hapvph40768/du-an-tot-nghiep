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
        Schema::table('locations', function (Blueprint $table) {

            $table->string('address')->nullable()->after('name');
            $table->string('city', 100)->nullable()->after('address');
            $table->string('province_code', 10)->nullable()->after('city');

            $table->decimal('latitude', 10, 7)->nullable()->after('province_code');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');

            $table->text('note')->nullable()->after('longitude');

            $table->boolean('is_active')
                ->default(true)
                ->after('note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {

            $table->dropColumn([
                'address',
                'city',
                'province_code',
                'latitude',
                'longitude',
                'note',
                'is_active'
            ]);
        });
    }
};
