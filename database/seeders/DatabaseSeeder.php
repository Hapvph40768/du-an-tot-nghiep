<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * ADMIN mặc định
         */
        User::create([
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0900000000',
            'password' => Hash::make('123456'),
            'avatar' => null,
            'status' => 'active',
        ]);

        /**
         * STAFF mẫu
         */
        User::factory()->count(3)->create([
            'role' => 'staff',
        ]);

        /**
         * CUSTOMER mẫu
         */
        User::factory()->count(5)->create([
            'role' => 'customer',
        ]);
    }
}
