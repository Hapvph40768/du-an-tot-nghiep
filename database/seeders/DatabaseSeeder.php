<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa toàn bộ dữ liệu cũ theo thứ tự (tránh lỗi FK)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('parking_histories')->truncate();
        DB::table('parking_slots')->truncate();
        DB::table('parkings')->truncate();
        DB::table('tickets')->truncate();
        DB::table('seat_locks')->truncate();
        DB::table('bookings')->truncate();
        DB::table('payments')->truncate();
        DB::table('reviews')->truncate();
        DB::table('support_messages')->truncate();
        DB::table('support_tickets')->truncate();
        DB::table('trip_pickup_points')->truncate();
        DB::table('trips')->truncate();
        DB::table('seats')->truncate();
        DB::table('vehicles')->truncate();
        DB::table('drivers')->truncate();
        DB::table('pickup_points')->truncate();
        DB::table('routes')->truncate();
        DB::table('locations')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Users
        \App\Models\User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '0988888888',
        ]);

        $customer = \App\Models\User::create([
            'name'     => 'Khách Hàng',
            'email'    => 'khachhang@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'phone'    => '0911111111',
        ]);

        // 2. Locations
        $hanoi = \App\Models\Location::create(['name' => 'Hà Nội']);
        $hcm   = \App\Models\Location::create(['name' => 'TP. Hồ Chí Minh']);

        // 3. Pickup Point
        $pickup = \App\Models\PickupPoint::create([
            'location_id' => $hanoi->id,
            'name'        => 'Bến xe trung tâm Hà Nội',
            'address'     => 'Đường số 1, Hà Nội',
        ]);

        // 4. Route
        $route = \App\Models\Route::create([
            'start_location_id' => $hanoi->id,
            'end_location_id'   => $hcm->id,
            'distance_km'       => 1700,
            'estimated_time'    => 30,
        ]);

        // 5. Driver
        $driver = \App\Models\Driver::create([
            'name'             => 'Nguyễn Văn Tài',
            'phone'            => '0901234567',
            'license_number'   => 'FC12345',
            'experience_years' => 5,
            'status'           => 'active',
        ]);

        // 6. Vehicle + Seats
        $vehicle = \App\Models\Vehicle::create([
            'license_plate'  => '29B-12345',
            'type'           => 'Limousine',
            'total_seats'    => 34,
            'phone_vehicles' => '023849032',
            'status'         => 'active',
        ]);

        $seatsData = [];
        for ($s = 1; $s <= 34; $s++) {
            $seatsData[] = [
                'vehicle_id'  => $vehicle->id,
                'seat_number' => ($s <= 17 ? 'A' : 'B') . str_pad(($s <= 17 ? $s : $s - 17), 2, '0', STR_PAD_LEFT),
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }
        \App\Models\Seat::insert($seatsData);

        // 7. Trip (hôm nay)
        $trip = \App\Models\Trip::create([
            'route_id'       => $route->id,
            'vehicle_id'     => $vehicle->id,
            'driver_id'      => $driver->id,
            'trip_date'      => now()->toDateString(),
            'departure_time' => '08:00:00',
            'arrival_time'   => '20:00:00',
            'price'          => 500000,
            'status'         => 'active',
        ]);

        // Gắn pickup point vào trip
        $trip->pickupPoints()->attach($pickup->id);

        // 8. Bãi đỗ xe + Sơ đồ slot
        $parking = \App\Models\Parking::create([
            'name'        => 'Bến xe trung tâm (Bãi xe số 1)',
            'location'    => 'Khu phân luồng VIP - Hà Nội',
            'description' => 'Bãi đỗ dành cho xe giường nằm tuyến cố định.',
        ]);

        $statuses = ['available', 'occupied', 'reserved', 'available', 'available'];

        // Khu A - 3 hàng x 4 cột
        for ($r = 1; $r <= 3; $r++) {
            for ($c = 1; $c <= 4; $c++) {
                // Ô A202 (hàng 2, cột 2) = vị trí của xe chúng ta
                $isMySlot = ($r === 2 && $c === 2);
                \App\Models\ParkingSlot::create([
                    'parking_id' => $parking->id,
                    'vehicle_id' => $isMySlot ? $vehicle->id : null,
                    'slot_code'  => 'A' . $r . '0' . $c,
                    'row'        => $r,
                    'column'     => $c,
                    'zone'       => 'A',
                    'slot_type'  => 'bus',
                    'status'     => $isMySlot ? 'occupied' : $statuses[array_rand($statuses)],
                ]);
            }
        }

        // Khu B VIP - 1 hàng x 5 cột
        for ($c = 1; $c <= 5; $c++) {
            \App\Models\ParkingSlot::create([
                'parking_id' => $parking->id,
                'vehicle_id' => null,
                'slot_code'  => 'B-' . $c,
                'row'        => 1,
                'column'     => $c,
                'zone'       => 'B (VIP Limousine)',
                'slot_type'  => 'vip',
                'status'     => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
