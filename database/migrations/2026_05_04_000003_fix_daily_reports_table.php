<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->renameColumn('report_date', 'date');
            $table->integer('total_trips')->default(0)->after('date');
            $table->text('note')->nullable()->after('total_revenue');
        });
    }

    public function down(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->renameColumn('date', 'report_date');
            $table->dropColumn(['total_trips', 'note']);
        });
    }
};
