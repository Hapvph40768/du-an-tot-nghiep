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
        Schema::table('users', function (Blueprint $table) {
            // Cá nhân
            $table->date('birthday')->nullable()->after('name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('birthday');
            $table->text('address')->nullable()->after('gender');
            $table->string('citizen_id', 20)->unique()->nullable()->after('address');

            // Công việc
            $table->string('employee_id', 20)->unique()->nullable()->after('citizen_id');
            $table->string('department')->nullable()->after('employee_id');
            $table->decimal('salary', 15, 2)->nullable()->after('department');
            $table->date('joined_date')->nullable()->after('salary');
            $table->string('contract_type')->nullable()->after('joined_date');

            // Bảo mật & Traceability
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn([
                'birthday', 'gender', 'address', 'citizen_id',
                'employee_id', 'department', 'salary', 'joined_date', 'contract_type',
                'last_login_at', 'last_login_ip'
            ]);
        });
    }
};
