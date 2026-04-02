<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\Ticket;
use App\Models\Payment;
use App\Models\User;
use App\Models\Route;
use App\Models\PickupPoint;
use App\Models\Driver;
use Carbon\Carbon;

class TestAssistantSeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure basic dependencies exist
        $user = User::firstOrCreate(['email' => 'assistant@test.com'], [
            'name' => 'PhụXe Test',
            'password' => bcrypt('password'),
            'role' => 'assistant'
        ]);

        $route = Route::first();
        if(!$route) {
            $route = Route::create([
                'start_location_id' => 1,
                'end_location_id' => 2,
                'distance' => 100,
                'duration' => 120,
                'price' => 150000
            ]);
        }

        $vehicle = Vehicle::first();
        if(!$vehicle) {
            $vehicle = Vehicle::create([
                'license_plate' => '29H-999.99',
                'type' => 'Limousine 34 giường',
                'total_seats' => 34,
                'status' => 'active'
            ]);
        }

        if ($vehicle->seats()->count() === 0) {
            $seats = [];
            for ($i = 1; $i <= $vehicle->total_seats; $i++) {
                $seats[] = ['vehicle_id' => $vehicle->id, 'seat_number' => 'A' . str_pad($i, 2, '0', STR_PAD_LEFT)];
            }
            Seat::insert($seats);
        }

        $pickup = PickupPoint::first();
        if(!$pickup) {
            $pickup = PickupPoint::create([
                'name' => 'Bến xe Test',
                'address' => '123 Đường Test, Hà Nội',
                'location_id' => 1
            ]);
        }

        $driver = Driver::first();
        if(!$driver) {
            $driver = Driver::create([
                'license_number' => 'TEST12345',
                'user_id' => $user->id,
                'status' => 'available'
            ]);
        }

        // 2. Tạo một chuyến xe diễn ra trong HÔM NAY (Sắp khởi hành trong 2 tiếng tới)
        $trip = Trip::create([
            'route_id' => $route->id,
            'vehicle_id' => $vehicle->id,
            'driver_id' => $driver->id,
            'trip_date' => Carbon::today()->format('Y-m-d'),
            'departure_time' => Carbon::now()->addHours(2)->format('H:i:s'),
            'arrival_time' => Carbon::now()->addHours(6)->format('H:i:s'),
            'price' => 150000,
            'status' => 'active'
        ]);

        $trip->pickupPoints()->sync([$pickup->id]);

        // 3. Tạo một số Booking giả định (Có người đã trả tiền, có người dùng tiền mặt/pending)
        $seatsList = $vehicle->seats()->take(6)->get();
        
        if($seatsList->count() >= 3) {
            // Khách 1: Đã thanh toán (Paid) hiển thị màu Vàng
            $b1 = Booking::create([
                'user_id' => $user->id,
                'trip_id' => $trip->id,
                'pickup_point_id' => $pickup->id,
                'contact_name' => 'Nguyễn Khách Đã Trả Tiền',
                'contact_phone' => '0912345678',
                'total_amount' => 150000,
                'status' => 'paid'
            ]);
            Payment::create(['booking_id' => $b1->id, 'payment_method' => 'vnpay', 'amount' => 150000, 'status' => 'success']);
            Ticket::create(['booking_id' => $b1->id, 'trip_id' => $trip->id, 'seat_id' => $seatsList[0]->id, 'status' => 'confirmed']);

            // Khách 2: Chưa thanh toán (Pending) để test nút "Thu Tiền Mặt"
            $b2 = Booking::create([
                'user_id' => $user->id,
                'trip_id' => $trip->id,
                'pickup_point_id' => $pickup->id,
                'contact_name' => 'Trần Khách Nợ Tiền',
                'contact_phone' => '0987654321',
                'total_amount' => 150000,
                'status' => 'pending'
            ]);
            Payment::create(['booking_id' => $b2->id, 'payment_method' => 'cash', 'amount' => 150000, 'status' => 'pending']);
            Ticket::create(['booking_id' => $b2->id, 'trip_id' => $trip->id, 'seat_id' => $seatsList[1]->id, 'status' => 'pending']);

            // Khách 3: Đã Check-in (Màu Xanh)
            $b3 = Booking::create([
                'user_id' => $user->id,
                'trip_id' => $trip->id,
                'pickup_point_id' => $pickup->id,
                'contact_name' => 'Lê Khách Check-in',
                'contact_phone' => '0933333333',
                'total_amount' => 150000,
                'status' => 'paid'
            ]);
            Payment::create(['booking_id' => $b3->id, 'payment_method' => 'banking', 'amount' => 150000, 'status' => 'success']);
            Ticket::create(['booking_id' => $b3->id, 'trip_id' => $trip->id, 'seat_id' => $seatsList[2]->id, 'status' => 'used']);
        }
    }
}
