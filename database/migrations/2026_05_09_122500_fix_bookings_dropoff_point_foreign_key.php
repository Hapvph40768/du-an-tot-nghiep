<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Fix the foreign key on bookings.dropoff_point_id:
     * It was pointing to pickup_points(id) — must point to dropoff_points(id).
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the wrong foreign key
            $table->dropForeign('bookings_dropoff_point_id_foreign');
        });

        Schema::table('bookings', function (Blueprint $table) {
            // Re-add pointing to the correct table
            $table->foreign('dropoff_point_id')
                  ->references('id')
                  ->on('dropoff_points')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_dropoff_point_id_foreign');
        });

        // Set the column to null to avoid constraint violation when rolling back
        DB::table('bookings')->update(['dropoff_point_id' => null]);

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('dropoff_point_id')
                  ->references('id')
                  ->on('pickup_points')
                  ->nullOnDelete();
        });
    }
};
