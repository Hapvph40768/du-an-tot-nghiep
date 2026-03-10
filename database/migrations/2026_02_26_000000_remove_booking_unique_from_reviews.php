<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // drop foreign key first (it includes the unique index in MySQL)
            $table->dropForeign(['booking_id']);
            // then drop the unique constraint on booking_id so multiple reviews can share the same booking
            $table->dropUnique(['booking_id']);
            // re-add foreign key without uniqueness
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unique('booking_id');
        });
    }
};
