<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['name' => 'Hà Nội'],
            ['name' => 'Hải Phòng'],
            ['name' => 'Hạ Long'],
            ['name' => 'TP. Hồ Chí Minh'],
            ['name' => 'Đà Nẵng'],
            ['name' => 'Huế'],
            ['name' => 'Nha Trang'],
            ['name' => 'Cần Thơ'],
            ['name' => 'Vũng Tàu'],
            ['name' => 'Quảng Ninh'],
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate(['name' => $location['name']]);
        }
    }
}
