<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing route
        $routeId = DB::table('routes')->first()?->id ?? 1;
        
        // Get existing location
        $locationId = DB::table('locations')->first()?->id ?? 1;

        // Create a driver if not exist
        if (DB::table('drivers')->count() == 0) {
            $this->command->info('✓ Tạo driver...');
            DB::table('drivers')->insert([
                [
                    'id' => 1,
                    'name' => 'Nguyễn Văn Tài Xế',
                    'phone' => '0912345678',
                    'license_number' => 'DL123456',
                    'status' => 'active'
                ],
            ]);
        }

        $driverId = DB::table('drivers')->first()?->id ?? 1;

        // Create a vehicle if not exist
        if (DB::table('vehicles')->count() == 0) {
            $this->command->info('✓ Tạo vehicle...');
            DB::table('vehicles')->insert([
                [
                    'id' => 1,
                    'license_plate' => 'ABC-1234',
                    'type' => 'Hiace',
                    'total_seats' => 16,
                    'status' => 'active'
                ],
            ]);
        }

        $vehicleId = DB::table('vehicles')->first()?->id ?? 1;

        // Create a pickup point if not exist
        if (DB::table('pickup_points')->count() == 0) {
            $this->command->info('✓ Tạo pickup point...');
            DB::table('pickup_points')->insert([
                [
                    'id' => 1,
                    'location_id' => $locationId,
                    'name' => 'Trạm bắt 1',
                    'address' => '123 Main St'
                ]
            ]);
        }

        $pickupPointId = DB::table('pickup_points')->first()?->id ?? 1;

        // Create test trips if not exist
        if (DB::table('trips')->count() == 0) {
            $this->command->info('✓ Tạo trips...');
            DB::table('trips')->insert([
                [
                    'id' => 1,
                    'route_id' => $routeId,
                    'vehicle_id' => $vehicleId,
                    'driver_id' => $driverId,
                    'trip_date' => now()->subDays(3)->toDateString(),
                    'departure_time' => '08:00:00',
                    'arrival_time' => '12:00:00',
                    'price' => 150000,
                    'status' => 'completed'
                ],
                [
                    'id' => 2,
                    'route_id' => $routeId,
                    'vehicle_id' => $vehicleId,
                    'driver_id' => $driverId,
                    'trip_date' => now()->subDays(2)->toDateString(),
                    'departure_time' => '08:00:00',
                    'arrival_time' => '12:00:00',
                    'price' => 150000,
                    'status' => 'completed'
                ],
                [
                    'id' => 3,
                    'route_id' => $routeId,
                    'vehicle_id' => $vehicleId,
                    'driver_id' => $driverId,
                    'trip_date' => now()->subDays(1)->toDateString(),
                    'departure_time' => '08:00:00',
                    'arrival_time' => '12:00:00',
                    'price' => 150000,
                    'status' => 'completed'
                ],
            ]);
        }

        // Ensure at least one admin user exists
        if (DB::table('users')->where('role','admin')->doesntExist()) {
            $this->command->info('✓ Tạo tài khoản admin mẫu...');
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'phone' => '0900000000',
                'password' => bcrypt('secret'),
                'role' => 'admin',
                'status' => 'active',
                'created_at' => now(),
            ]);
        }

        // Get user IDs (first two customers)
        $user1Id = DB::table('users')->where('role','customer')->value('id') ?? 1;
        $user2Id = DB::table('users')->where('role','customer')->skip(1)->value('id') ?? 2;

        // Create test bookings if not exist
        if (DB::table('bookings')->count() == 0) {
            $this->command->info('✓ Tạo bookings...');
            DB::table('bookings')->insert([
                [
                    'id' => 1,
                    'user_id' => $user1Id,
                    'trip_id' => 1,
                    'pickup_point_id' => $pickupPointId,
                    'total_amount' => 150000,
                    'status' => 'paid',
                    'created_at' => now(),
                ],
                [
                    'id' => 2,
                    'user_id' => $user1Id,
                    'trip_id' => 2,
                    'pickup_point_id' => $pickupPointId,
                    'total_amount' => 150000,
                    'status' => 'paid',
                    'created_at' => now(),
                ],
                [
                    'id' => 3,
                    'user_id' => $user2Id,
                    'trip_id' => 3,
                    'pickup_point_id' => $pickupPointId,
                    'total_amount' => 150000,
                    'status' => 'paid',
                    'created_at' => now(),
                ],
            ]);
        }

        // Create reviews if not exist
        if (Review::count() == 0) {
            $this->command->info('✓ Tạo reviews...');
            Review::create([
                'user_id' => $user1Id,
                'booking_id' => 1,
                'trip_id' => 1,
                'rating' => 5,
                'comment' => 'Dịch vụ tuyệt vời! Tài xế rất thân thiện và xe sạch sẽ.'
            ]);

            Review::create([
                'user_id' => $user1Id,
                'booking_id' => 2,
                'trip_id' => 2,
                'rating' => 4,
                'comment' => 'Tốt, nhưng có chút trễ. Tuy nhiên tài xế rất lịch sự.'
            ]);

            Review::create([
                'user_id' => $user2Id,
                'booking_id' => 3,
                'trip_id' => 3,
                'rating' => 3,
                'comment' => 'Bình thường, có thể cải thiện chất lượng âm thanh trong xe.'
            ]);
        }

        $this->command->info('✓ ✓ ✓ Seeder hoàn tất!');
    }
}
