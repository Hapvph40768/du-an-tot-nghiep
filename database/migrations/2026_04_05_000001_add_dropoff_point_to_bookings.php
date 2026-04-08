<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('dropoff_point_id')
                  ->nullable()
                  ->after('pickup_point_id')
                  ->constrained('pickup_points')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['dropoff_point_id']);
            $table->dropColumn('dropoff_point_id');
        });
    }
};
