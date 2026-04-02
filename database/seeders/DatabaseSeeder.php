<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

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

        // 1. Users (15 users total)
        $users = [];
        $users[] = \App\Models\User::create([
            'name'     => 'Admin Mạnh Hùng',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '0988888888',
        ]);
        $users[] = \App\Models\User::create([
            'name'     => 'Nhân Viên CSKH',
            'email'    => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'staff',
            'phone'    => '0922222222',
        ]);
        $users[] = \App\Models\User::create([
            'name'     => 'Khách Hàng',
            'email'    => 'khachhang@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'phone'    => '0911111111',
        ]);

        for ($i = 0; $i < 12; $i++) {
            $users[] = \App\Models\User::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role'     => 'customer',
                'phone'    => '09' . $faker->numerify('########'),
            ]);
        }
        $customers = collect($users)->where('role', 'customer')->values();

        // 2. Locations (15 locations)
        $locNames = ['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ', 'Nha Trang', 'Đà Lạt', 'Vũng Tàu', 'Thanh Hóa', 'Nghệ An', 'Huế', 'Quy Nhơn', 'Bình Thuận', 'Đồng Nai', 'Bình Dương'];
        $locModels = [];
        foreach ($locNames as $loc) {
            $locModels[] = \App\Models\Location::create(['name' => $loc]);
        }

        // 3. Pickup Points (15 pickup points)
        $pickupPoints = [];
        foreach ($locModels as $model) {
            $pickupPoints[] = \App\Models\PickupPoint::create([
                'location_id' => $model->id,
                'name'        => 'Bến xe ' . $model->name,
                'address'     => $faker->address,
            ]);
        }

        // 4. Routes (15 routes)
        $routeModels = [];
        $existingRoutes = [];
        for ($i = 0; $i < 15; $i++) {
            do {
                $start = $locModels[array_rand($locModels)];
                $end = $locModels[array_rand($locModels)];
            } while ($start->id == $end->id || isset($existingRoutes[$start->id . '-' . $end->id]));
            
            $existingRoutes[$start->id . '-' . $end->id] = true;
            $routeModels[] = \App\Models\Route::create([
                'start_location_id' => $start->id,
                'end_location_id'   => $end->id,
                'distance_km'       => rand(100, 1500),
                'estimated_time'    => rand(2, 30),
            ]);
        }

        // 5. Drivers (15 drivers)
        $driverModels = [];
        for ($i = 0; $i < 15; $i++) {
            $driverModels[] = \App\Models\Driver::create([
                'name'             => $faker->name,
                'phone'            => '090' . rand(1000000, 9999999),
                'license_number'   => 'FC' . $faker->unique()->numerify('#####'),
                'experience_years' => rand(3, 15),
                'status'           => 'active',
            ]);
        }

        // 6. Vehicles + Seats (15 vehicles)
        $vehicleModels = [];
        $vehicleTypes = [
            ['type' => 'Limousine', 'seats' => 34, 'basePrice' => 350000],
            ['type' => 'Giường nằm', 'seats' => 40, 'basePrice' => 250000],
            ['type' => 'Ghế ngồi', 'seats' => 29, 'basePrice' => 150000],
        ];

        for ($i = 0; $i < 15; $i++) {
            $typeInfo = $vehicleTypes[array_rand($vehicleTypes)];
            $v = \App\Models\Vehicle::create([
                'license_plate'  => rand(10, 99) . ['B', 'C', 'F'][rand(0,2)] . '-' . rand(10000, 99999),
                'type'           => $typeInfo['type'],
                'total_seats'    => $typeInfo['seats'],
                'phone_vehicles' => '02' . rand(10000000, 99999999),
                'status'         => 'active',
            ]);
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

        // 7. Trips (15 trips)
        $tripsScheduled = [];
        for ($i = 0; $i < 15; $i++) {
            $route = $routeModels[array_rand($routeModels)];
            $veh = $vehicleModels[array_rand($vehicleModels)];
            $drv = $driverModels[array_rand($driverModels)];
            
            $date = Carbon::now()->addDays(rand(-2, 7))->toDateString();
            $depTime = Carbon::createFromTime(rand(5, 20), 0, 0);
            $arrTime = (clone $depTime)->addHours(ceil($route->estimated_time));
            
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
            
            $startLoc = \App\Models\Location::find($route->start_location_id);
            $tripPickup = \App\Models\PickupPoint::where('location_id', $startLoc->id)->first();
            if ($tripPickup) {
                $trip->pickupPoints()->attach($tripPickup->id);
            }
            $tripsScheduled[] = $trip;
        }

        // 8. Bookings, Tickets, Payments (15 bookings)
        $usedSeats = [];
        for ($i = 0; $i < 15; $i++) {
            $trip = $tripsScheduled[array_rand($tripsScheduled)];
            $customer = $customers->random();
            $pickupPointId = $trip->pickupPoints->first()->id ?? null;
            if (!$pickupPointId) continue;

            if (!isset($usedSeats[$trip->id])) $usedSeats[$trip->id] = [];
            
            $seats = \App\Models\Seat::where('vehicle_id', $trip->vehicle_id)
                        ->whereNotIn('id', $usedSeats[$trip->id])
                        ->inRandomOrder()
                        ->take(2)
                        ->get();
                        
            if ($seats->isEmpty()) continue;

            $booking = \App\Models\Booking::create([
                'user_id'         => $customer->id,
                'trip_id'         => $trip->id,
                'pickup_point_id' => $pickupPointId,
                'total_amount'    => $trip->price * 2,
                'status'          => 'paid',
                'contact_name'    => $customer->name,
                'contact_phone'   => $customer->phone,
                'created_at'      => now()->subDays(rand(1, 10)),
                'updated_at'      => now(),
            ]);

            foreach ($seats as $seat) {
                $usedSeats[$trip->id][] = $seat->id;
                \App\Models\Ticket::create([
                    'booking_id'  => $booking->id,
                    'trip_id'     => $trip->id,
                    'seat_id'     => $seat->id,
                    'ticket_code' => 'TK' . strtoupper(substr(md5(rand()), 0, 6)),
                    'status'      => 'confirmed',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
                
                \App\Models\SeatLock::create([
                    'trip_id'      => $trip->id,
                    'seat_id'      => $seat->id,
                    'user_id'      => $customer->id,
                    'booking_id'   => $booking->id,
                    'locked_until' => now()->addDays(5),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
            
            \App\Models\Payment::create([
                'booking_id'       => $booking->id,
                'payment_method'   => 'vnpay',
                'amount'           => $booking->total_amount,
                'status'           => 'success',
                'transaction_code' => 'VN' . rand(100000000, 999999999),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // 8.1. Reviews (15 reviews)
            \App\Models\Review::create([
                'booking_id' => $booking->id,
                'user_id'    => $customer->id,
                'rating'     => rand(3, 5),
                'comment'    => 'Dịch vụ rất tốt, tài xế thân thiện.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 9. SupportTickets & SupportMessages (15 tickets)
        $bookingsList = \App\Models\Booking::all();
        for ($i = 0; $i < 15; $i++) {
            $customer = $customers->random();
            $booking = count($bookingsList) > 0 ? $bookingsList->random() : null;
            
            $ticket = \App\Models\SupportTicket::create([
                'user_id'     => $customer->id,
                'booking_id'  => $booking ? $booking->id : null,
                'type'        => ['payment', 'ticket', 'complaint'][array_rand(['payment', 'ticket', 'complaint'])],
                'description' => 'Cần hỗ trợ về chuyến đi ' . rand(100, 999),
                'status'      => ['open', 'processing', 'closed'][array_rand(['open', 'processing', 'closed'])],
                'created_at'  => now()->subDays(rand(1, 10)),
                'updated_at'  => now(),
            ]);

            \App\Models\SupportMessage::create([
                'support_ticket_id' => $ticket->id,
                'sender_id'         => $customer->id,
                'sender_type'       => 'user',
                'message'           => 'Tôi muốn đổi ngày đi, vui lòng hỗ trợ tôi.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }

        // 10. Parkings, ParkingSlots, ParkingHistories (15 parkings)
        $parkings = [];
        for ($i = 0; $i < 15; $i++) {
            $parkings[] = \App\Models\Parking::create([
                'name'        => 'Bãi đỗ xe ' . $faker->company,
                'location'    => $faker->address,
                'description' => 'Bãi đỗ xe an toàn 24/7.',
            ]);
        }

        $vIndex = 0;
        $statuses = ['available', 'occupied', 'reserved'];
        
        foreach ($parkings as $parking) {
            for ($r = 1; $r <= 3; $r++) {
                for ($c = 1; $c <= 5; $c++) {
                    $vehicleId = null;
                    $status = $statuses[array_rand($statuses)];
                    
                    if ($r == 2 && $c == 3 && isset($vehicleModels[$vIndex])) {
                        $vehicleId = $vehicleModels[$vIndex]->id;
                        $status = 'occupied';
                        $vIndex++;
                    }
                    
                    $slot = \App\Models\ParkingSlot::create([
                        'parking_id' => $parking->id,
                        'vehicle_id' => $vehicleId,
                        'slot_code'  => 'P' . $parking->id . '-A' . $r . '0' . $c,
                        'row'        => $r,
                        'column'     => $c,
                        'zone'       => 'A',
                        'slot_type'  => 'bus',
                        'status'     => $status,
                    ]);

                    if ($vehicleId) {
                        \App\Models\ParkingHistory::create([
                            'slot_id'         => $slot->id,
                            'vehicle_id'      => $slot->vehicle_id,
                            'check_in_time'   => now()->subHours(rand(1, 10)),
                        ]);
                    }
                }
            }
        }
    }
}
