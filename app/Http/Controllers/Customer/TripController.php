<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    // Xử lý tìm kiếm chuyến xe
    public function search(Request $request)
    {
        $request->validate([
            'start_location_id' => 'required|exists:locations,id',
            'end_location_id' => 'required|exists:locations,id',
            'trip_date' => 'nullable|date',
        ]);

        // Nếu request gửi date lên thì dùng, nếu không thì lấy danh sách từ hôm nay trở đi
        $query = Trip::with(['route.departureLocation', 'route.destinationLocation', 'vehicle'])
            ->withCount(['seatLocks' => function ($q) {
                $q->where('locked_until', '>', now());
            }])
            ->whereHas('route', function ($q) use ($request) {
                $q->where('start_location_id', $request->start_location_id)
                      ->where('end_location_id', $request->end_location_id);
            })
            ->where('status', 'active');

        // Bỏ việc fix cứng $tripDate = now() vì các chuyến xe chạy hàng ngày và người dùng không nhập ngày
        if ($request->filled('trip_date')) {
            $query->where('trip_date', $request->trip_date);
        }

        $trips = $query->orderBy('trip_date', 'desc')->get();

        return view('customer.trips.search_result', compact('trips'));
    }

    // Xem chi tiết 1 chuyến xe (hiển thị sơ đồ ghế và chọn điểm đón)
    public function show(Trip $trip)
    {
        // Load kèm xe, danh sách ghế, và các điểm đón trả khách
        $trip->load(['vehicle.seats', 'pickupPoints.location', 'route.departureLocation', 'route.destinationLocation']);
        
        // Lấy danh sách ID các ghế đã được đặt hoặc đang bị khóa
        $bookedSeatIds = $trip->seatLocks()->where('locked_until', '>', now())->pluck('seat_id')->toArray();

        return view('customer.trips.show', compact('trip', 'bookedSeatIds'));
    }
}