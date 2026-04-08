<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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
            'name'     => 'Admin Mạnh Hùng',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '0988888888',
        ]);

        \App\Models\User::create([
            'name'     => 'Nhân Viên CSKH',
            'email'    => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'staff',
            'phone'    => '0922222222',
        ]);

        $customer = \App\Models\User::create([
            'name'     => 'Khách Hàng A',
            'email'    => 'khachhang@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'phone'    => '0911111111',
        ]);

        // Tạo thêm 12 khách hàng mẫu
        $extraCustomers = [
            ['name' => 'Trần Thị Mai',    'email' => 'mai.tran@gmail.com',   'phone' => '0912345601'],
            ['name' => 'Nguyễn Văn Nam',  'email' => 'nam.nguyen@gmail.com', 'phone' => '0912345602'],
            ['name' => 'Lê Thị Hoa',      'email' => 'hoa.le@gmail.com',     'phone' => '0912345603'],
            ['name' => 'Phạm Đình Long',  'email' => 'long.pham@gmail.com',  'phone' => '0912345604'],
            ['name' => 'Hoàng Thị Lan',   'email' => 'lan.hoang@gmail.com',  'phone' => '0912345605'],
            ['name' => 'Vũ Đức Minh',    'email' => 'minh.vu@gmail.com',   'phone' => '0912345606'],
            ['name' => 'Nguyễn Thị Hương','email' => 'huong.ng@gmail.com',  'phone' => '0912345607'],
            ['name' => 'Đinh Văn Khởi',  'email' => 'khoi.dinh@gmail.com', 'phone' => '0912345608'],
            ['name' => 'Bùi Thị Loan',    'email' => 'loan.bui@gmail.com',   'phone' => '0912345609'],
            ['name' => 'Tô Văn Hùng',    'email' => 'hung.to@gmail.com',    'phone' => '0912345610'],
            ['name' => 'Đặng Thị Ngọc',  'email' => 'ngoc.dang@gmail.com',  'phone' => '0912345611'],
            ['name' => 'Lý Minh Tuấn',    'email' => 'tuan.ly@gmail.com',    'phone' => '0912345612'],
        ];
        $allCustomers = [$customer];
        foreach ($extraCustomers as $c) {
            $allCustomers[] = \App\Models\User::create([
                'name'     => $c['name'],
                'email'    => $c['email'],
                'password' => Hash::make('password'),
                'role'     => 'customer',
                'phone'    => $c['phone'],
            ]);
        }

        // 2. Locations
        $locations = [
            'Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ', 'Nha Trang', 'Đà Lạt', 'Vũng Tàu'
        ];
        $locModels = [];
        foreach ($locations as $loc) {
            $locModels[$loc] = \App\Models\Location::create(['name' => $loc]);
        }

        // 3. Pickup Points
        $pickupPoints = [];
        $pickupData = [
            'Hà Nội' => ['name' => 'Bến xe Mỹ Đình', 'address' => '20 Phạm Hùng, Nam Từ Liêm, Hà Nội'],
            'TP. Hồ Chí Minh' => ['name' => 'Bến xe Miền Đông', 'address' => '292 Đinh Bộ Lĩnh, Bình Thạnh, TP.HCM'],
            'Đà Nẵng' => ['name' => 'Bến xe Trung tâm Đà Nẵng', 'address' => '185 Tôn Đức Thắng, Liên Chiểu, Đà Nẵng'],
            'Hải Phòng' => ['name' => 'Bến xe Niệm Nghĩa', 'address' => '275 Trần Nguyên Hãn, Lê Chân, Hải Phòng'],
            'Cần Thơ' => ['name' => 'Bến xe Trung tâm Cần Thơ', 'address' => 'Khu đô thị Nam Cần Thơ, Cái Răng'],
            'Nha Trang' => ['name' => 'Bến xe phía Nam Nha Trang', 'address' => 'Km6 Đường 23/10, Vĩnh Trung, Nha Trang'],
            'Đà Lạt' => ['name' => 'Bến xe liên tỉnh Đà Lạt', 'address' => 'Số 1 Tô Hiến Thành, Phường 3, Đà Lạt'],
            'Vũng Tàu' => ['name' => 'Bến xe Vũng Tàu', 'address' => '192 Nam Kỳ Khởi Nghĩa, Phường 3, Vũng Tàu']
        ];

        foreach ($locModels as $locName => $model) {
            $pickupPoints[$locName] = \App\Models\PickupPoint::create([
                'location_id' => $model->id,
                'name'        => $pickupData[$locName]['name'],
                'address'     => $pickupData[$locName]['address'],
            ]);
        }

        // 4. Routes
        $routesData = [
            ['start' => 'Hà Nội', 'end' => 'TP. Hồ Chí Minh', 'dist' => 1700, 'time' => 32],
            ['start' => 'TP. Hồ Chí Minh', 'end' => 'Hà Nội', 'dist' => 1700, 'time' => 32],
            ['start' => 'Hà Nội', 'end' => 'Đà Nẵng', 'dist' => 766, 'time' => 14],
            ['start' => 'Đà Nẵng', 'end' => 'Hà Nội', 'dist' => 766, 'time' => 14],
            ['start' => 'TP. Hồ Chí Minh', 'end' => 'Đà Lạt', 'dist' => 308, 'time' => 6],
            ['start' => 'Đà Lạt', 'end' => 'TP. Hồ Chí Minh', 'dist' => 308, 'time' => 6],
            ['start' => 'TP. Hồ Chí Minh', 'end' => 'Vũng Tàu', 'dist' => 96, 'time' => 2],
            ['start' => 'Vũng Tàu', 'end' => 'TP. Hồ Chí Minh', 'dist' => 96, 'time' => 2],
            ['start' => 'Hà Nội', 'end' => 'Hải Phòng', 'dist' => 120, 'time' => 2],
            ['start' => 'Hải Phòng', 'end' => 'Hà Nội', 'dist' => 120, 'time' => 2],
            ['start' => 'TP. Hồ Chí Minh', 'end' => 'Nha Trang', 'dist' => 430, 'time' => 8],
            ['start' => 'Nha Trang', 'end' => 'TP. Hồ Chí Minh', 'dist' => 430, 'time' => 8],
            ['start' => 'TP. Hồ Chí Minh', 'end' => 'Cần Thơ', 'dist' => 165, 'time' => 3],
        ];

        $routeModels = [];
        foreach ($routesData as $r) {
            $routeModels[] = \App\Models\Route::create([
                'start_location_id' => $locModels[$r['start']]->id,
                'end_location_id'   => $locModels[$r['end']]->id,
                'distance_km'       => $r['dist'],
                'estimated_time'    => $r['time'],
            ]);
        }

        // 5. Drivers
        $driverNames = ['Nguyễn Văn Tài', 'Trần Hữu Chiến', 'Lê Đại Hành', 'Phạm Quang Minh', 'Hoàng Thái Hùng', 'Vũ Đức Nhã', 'Ngô Bình An', 'Đặng Thành Công'];
        $driverModels = [];
        foreach ($driverNames as $index => $name) {
            $driverModels[] = \App\Models\Driver::create([
                'name'             => $name,
                'phone'            => '090' . rand(1000000, 9999999),
                'license_number'   => 'FC' . rand(10000, 99999),
                'experience_years' => rand(3, 15),
                'status'           => 'active',
            ]);
        }

        // 6. Vehicles + Seats
        $vehicleTypes = [
            ['type' => 'Limousine', 'seats' => 34, 'basePrice' => 350000],
            ['type' => 'Giường nằm', 'seats' => 40, 'basePrice' => 250000],
            ['type' => 'Ghế ngồi', 'seats' => 29, 'basePrice' => 150000],
        ];
        
        $vehicleModels = [];
        foreach ($vehicleTypes as $typeInfo) {
            for ($i = 0; $i < 4; $i++) { // Create 4 of each type
                $v = \App\Models\Vehicle::create([
                    'license_plate'  => rand(10, 99) . ['B', 'C', 'F'][rand(0,2)] . '-' . rand(10000, 99999),
                    'type'           => $typeInfo['type'],
                    'total_seats'    => $typeInfo['seats'],
                    'phone_vehicles' => '02' . rand(10000000, 99999999),
                    'status'         => 'active',
                ]);
                
                // Add a dynamic basePrice property simply to be used later in this run
                $v->basePrice = $typeInfo['basePrice'];
                $vehicleModels[] = $v;

                $seatsData = [];
                $half = ceil($typeInfo['seats'] / 2);
                for ($s = 1; $s <= $typeInfo['seats']; $s++) {
                    $seatsData[] = [
                        'vehicle_id'  => $v->id,
                        'seat_number' => ($s <= $half ? 'A' : 'B') . str_pad(($s <= $half ? $s : $s - $half), 2, '0', STR_PAD_LEFT),
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                }
                \App\Models\Seat::insert($seatsData);
            }
        }

        // 7. Trips
        $tripsScheduled = [];
        $days = [-2, -1, 0, 1, 2, 3, 4, 5, 6, 7]; // Past 2 days, today, next 7 days
        $usedUniqueTripKeys = []; // To track unique vehicle + date + time combinations
        
        foreach ($days as $dayOffset) {
            $date = Carbon::now()->addDays($dayOffset)->toDateString();
            
            // For each route, create trips
            foreach ($routeModels as $rKey => $route) {
                // Ensure popular routes have more trips
                $numTrips = ($route->distance_km < 400) ? rand(2, 4) : rand(1, 2);
                for ($t = 0; $t < $numTrips; $t++) {
                    $veh = $vehicleModels[array_rand($vehicleModels)];
                    $drv = $driverModels[array_rand($driverModels)];
                    
                    $startHour = rand(5, 20); // 5 AM to 8 PM
                    $depTime = Carbon::createFromTime($startHour, 0, 0);
                    $arrTime = (clone $depTime)->addHours(ceil($route->estimated_time));
                    
                    $uniqueKey = $veh->id . '-' . $date . '-' . $depTime->format('H:i:s');
                    if (isset($usedUniqueTripKeys[$uniqueKey])) {
                        continue; // skip to avoid unique constraint violation
                    }
                    $usedUniqueTripKeys[$uniqueKey] = true;

                    // Simple pricing logic based on distance
                    $price = max(100000, ($route->distance_km * 500) + $veh->basePrice);
                    $price = round($price / 10000) * 10000;

                    $trip = \App\Models\Trip::create([
                        'route_id'       => $route->id,
                        'vehicle_id'     => $veh->id,
                        'driver_id'      => $drv->id,
                        'trip_date'      => $date,
                        'departure_time' => $depTime->format('H:i:s'),
                        'arrival_time'   => $arrTime->format('H:i:s'),
                        'price'          => $price,
                        'status'         => 'active',
                    ]);
                    
                    // Attach pickup points (find pickup point corresponding to start_location of route)
                    $startLoc = \App\Models\Location::find($route->start_location_id);
                    if ($startLoc && isset($pickupPoints[$startLoc->name])) {
                        $trip->pickupPoints()->attach($pickupPoints[$startLoc->name]->id);
                    }

                    if ($dayOffset >= 0 && $dayOffset <= 3) {
                        $tripsScheduled[] = $trip;
                    }
                }
            }
        }

        // 8. Bookings - tạo 15 đơn đặt vé
        shuffle($tripsScheduled);
        $numBookings = min(15, count($tripsScheduled));
        $allPickupPointsList = array_values($pickupPoints);
        for ($i = 0; $i < $numBookings; $i++) {
            $trip = $tripsScheduled[$i];
            $bookingCustomer = $allCustomers[array_rand($allCustomers)];

            $pickupPointId = $trip->pickupPoints->first()->id ?? null;
            if (!$pickupPointId) continue;

            // Một số đơn có điểm trả, một số không
            $dropoffId = ($i % 3 === 0) ? ($allPickupPointsList[array_rand($allPickupPointsList)]->id ?? null) : null;
            // Đảm bảo dropoff != pickup
            if ($dropoffId === $pickupPointId) $dropoffId = null;

            $numSeats = rand(1, 3);
            $booking = \App\Models\Booking::create([
                'user_id'          => $bookingCustomer->id,
                'trip_id'          => $trip->id,
                'pickup_point_id'  => $pickupPointId,
                'dropoff_point_id' => $dropoffId,
                'total_amount'     => $trip->price * $numSeats,
                'status'           => ($i < 12) ? 'paid' : 'pending',
                'contact_name'     => $bookingCustomer->name,
                'contact_phone'    => $bookingCustomer->phone,
                'created_at'       => now()->subDays(rand(0, 7)),
                'updated_at'       => now(),
            ]);

            // Gán ghế ngẫu nhiên
            $seats = \App\Models\Seat::where('vehicle_id', $trip->vehicle_id)
                ->whereNotIn('id', \App\Models\SeatLock::where('trip_id', $trip->id)->pluck('seat_id'))
                ->take($numSeats)->get();

            foreach ($seats as $seat) {
                \App\Models\Ticket::create([
                    'booking_id'  => $booking->id,
                    'trip_id'     => $trip->id,
                    'seat_id'     => $seat->id,
                    'ticket_code' => 'VE-' . now()->format('Y') . '-' . strtoupper(substr(md5(uniqid()), 0, 6)),
                    'status'      => ($booking->status === 'paid') ? 'confirmed' : 'pending',
                    'created_at'  => $booking->created_at,
                    'updated_at'  => now(),
                ]);

                \App\Models\SeatLock::create([
                    'trip_id'      => $trip->id,
                    'seat_id'      => $seat->id,
                    'user_id'      => $bookingCustomer->id,
                    'booking_id'   => $booking->id,
                    'locked_until' => now()->addDays(10),
                    'created_at'   => $booking->created_at,
                    'updated_at'   => now(),
                ]);
            }

            if ($booking->status === 'paid') {
                \App\Models\Payment::create([
                    'booking_id'       => $booking->id,
                    'payment_method'   => ['vnpay', 'cash', 'bank_transfer'][rand(0, 2)],
                    'amount'           => $booking->total_amount,
                    'status'           => 'success',
                    'transaction_code' => 'VN' . rand(100000000, 999999999),
                    'created_at'       => $booking->created_at,
                    'updated_at'       => now(),
                ]);
            }
        }

        // 9. Bãi đỗ xe + Sơ đồ slot (from old code)
        $parking = \App\Models\Parking::create([
            'name'        => 'Bến xe trung tâm (Bãi xe số 1)',
            'location'    => 'Khu phân luồng VIP - Hà Nội',
            'description' => 'Bãi đỗ dành cho xe giường nằm tuyến cố định.',
        ]);

        $statuses = ['available', 'occupied', 'reserved', 'available', 'available'];
        $baseVehicle = $vehicleModels[0];

        // Khu A - 3 hàng x 4 cột
        for ($r = 1; $r <= 3; $r++) {
            for ($c = 1; $c <= 4; $c++) {
                $isMySlot = ($r === 2 && $c === 2);
                \App\Models\ParkingSlot::create([
                    'parking_id' => $parking->id,
                    'vehicle_id' => $isMySlot ? $baseVehicle->id : null,
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
