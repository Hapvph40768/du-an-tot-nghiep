<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // MySQL only enforces CHECK constraints starting from 8.0.16 –
        // Laravel's Blueprint doesn't have a dedicated helper for checks,
        // so we use a raw statement. keep it single-line to avoid escape issues.
        DB::statement(
            "ALTER TABLE `reviews` ADD CONSTRAINT `reviews_rating_between_1_and_5` CHECK (`rating` BETWEEN 1 AND 5)"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement(
            "ALTER TABLE `reviews` DROP CHECK `reviews_rating_between_1_and_5`"
        );
    }
};
