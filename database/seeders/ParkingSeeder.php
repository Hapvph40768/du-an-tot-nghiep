<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\Vehicle;
use App\Models\Booking;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tắt check khóa ngoại để xóa dữ liệu cũ
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ParkingSlot::truncate();
        Parking::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Tạo bãi đỗ xe chính
        $parking = Parking::create([
            'name' => 'Bến xe trung tâm (Bãi xe số 1)',
            'location' => 'Khu phân luồng VIP',
            'description' => 'Bãi đỗ dành cho xe giường nằm tuyến cố định.'
        ]);

        // 2. Lấy ID xe của Booking số 2 (Booking mà user đang xem trên màn hình)
        $booking2 = Booking::with('trip.vehicle')->find(2);
        $myVehicleId = $booking2 && $booking2->trip ? $booking2->trip->vehicle_id : null;

        // Nếu không có, lấy xe đầu tiên
        if (!$myVehicleId) {
            $firstVehicle = Vehicle::first();
            $myVehicleId = $firstVehicle ? $firstVehicle->id : null;
        }

        // 3. Tạo Sơ đồ Grid
        $statuses = ['available', 'occupied', 'reserved', 'available', 'available']; // Tỉ lệ available cao hơn

        // KHU A (3 hàng x 4 cột)
        for ($r = 1; $r <= 3; $r++) {
            for ($c = 1; $c <= 4; $c++) {
                // Cố định xe của khách hàng vào hàng 2 cột 2 (nếu chưa gán)
                if ($r == 2 && $c == 2 && $myVehicleId) {
                    ParkingSlot::create([
                        'parking_id' => $parking->id,
                        'vehicle_id' => $myVehicleId,
                        'slot_code' => 'A' . $r . '0' . $c,
                        'row' => $r,
                        'column' => $c,
                        'zone' => 'A',
                        'slot_type' => 'bus',
                        'status' => 'occupied' // Đang đỗ
                    ]);
                    $myVehicleId = null; // Chỉ gán 1 lần
                } else {
                    $randomStatus = $statuses[array_rand($statuses)];
                    ParkingSlot::create([
                        'parking_id' => $parking->id,
                        'vehicle_id' => null,
                        'slot_code' => 'A' . $r . '0' . $c,
                        'row' => $r,
                        'column' => $c,
                        'zone' => 'A',
                        'slot_type' => 'bus',
                        'status' => $randomStatus
                    ]);
                }
            }
        }

        // KHU B (1 hàng x 5 cột) - Khu đỗ xe Limousine/VIP
        for ($c = 1; $c <= 5; $c++) {
            $randomStatus = $statuses[array_rand($statuses)];
            ParkingSlot::create([
                'parking_id' => $parking->id,
                'vehicle_id' => null,
                'slot_code' => 'B-' . $c,
                'row' => 1,
                'column' => $c,
                'zone' => 'B (VIP Limousine)',
                'slot_type' => 'vip',
                'status' => $randomStatus
            ]);
        }
    }
}
