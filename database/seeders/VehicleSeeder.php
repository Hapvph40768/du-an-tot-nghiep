<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class VehicleSeeder extends Seeder
{
public function run(): void
{
    \App\Models\Vehicle::create([
        'name' => 'Xe Limousine VIP 01',
        'license_plate' => '29A-123.45',
        'type' => '16'
    ]);
}
}