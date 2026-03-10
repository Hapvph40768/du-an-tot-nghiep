<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\RouteTemplate;
use Illuminate\Database\Seeder;

class RouteTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo locations trước (nếu chưa có)
        $hanoi = Location::firstOrCreate(['name' => 'Hà Nội']);
        $haiPhong = Location::firstOrCreate(['name' => 'Hải Phòng']);
        $haLong = Location::firstOrCreate(['name' => 'Hạ Long']);
        $hcm = Location::firstOrCreate(['name' => 'TP. Hồ Chí Minh']);
        $danang = Location::firstOrCreate(['name' => 'Đà Nẵng']);
        $hue = Location::firstOrCreate(['name' => 'Huế']);

        // Tạo route templates
        RouteTemplate::firstOrCreate(
            ['name' => 'Hà Nội - Hải Phòng'],
            [
                'start_location_id' => $hanoi->id,
                'end_location_id' => $haiPhong->id,
                'distance_km' => 120,
                'estimated_time' => 150,
            ]
        );

        RouteTemplate::firstOrCreate(
            ['name' => 'Hà Nội - Hạ Long'],
            [
                'start_location_id' => $hanoi->id,
                'end_location_id' => $haLong->id,
                'distance_km' => 160,
                'estimated_time' => 200,
            ]
        );

        RouteTemplate::firstOrCreate(
            ['name' => 'Hà Nội - TP. Hồ Chí Minh'],
            [
                'start_location_id' => $hanoi->id,
                'end_location_id' => $hcm->id,
                'distance_km' => 1600,
                'estimated_time' => 1200,
            ]
        );

        RouteTemplate::firstOrCreate(
            ['name' => 'Đà Nẵng - Huế'],
            [
                'start_location_id' => $danang->id,
                'end_location_id' => $hue->id,
                'distance_km' => 100,
                'estimated_time' => 120,
            ]
        );
    }
}
