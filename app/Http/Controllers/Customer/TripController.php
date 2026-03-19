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

        $tripDate = $request->trip_date ?: now()->toDateString();

        // Tìm các chuyến xe thuộc tuyến đường có điểm đi/đến tương ứng
        $trips = Trip::with(['route.departureLocation', 'route.destinationLocation', 'vehicle'])
            ->withCount(['seatLocks' => function ($query) {
                $query->where('locked_until', '>', now());
            }])
            ->whereHas('route', function ($query) use ($request) {
                $query->where('start_location_id', $request->start_location_id)
                      ->where('end_location_id', $request->end_location_id);
            })
            ->where('trip_date', $tripDate)
            ->where('status', 'active')
            ->get();

        return view('customer.trips.search_result', compact('trips'));
    }

    // Xem chi tiết 1 chuyến xe (hiển thị sơ đồ ghế và chọn điểm đón)
    public function show(Trip $trip)
    {
        // Load kèm xe, danh sách ghế, và các điểm đón trả khách
        $trip->load(['vehicle.seats', 'pickupPoints']);
        
        // Lấy danh sách ID các ghế đã được đặt hoặc đang bị khóa
        $bookedSeatIds = $trip->seatLocks()->where('locked_until', '>', now())->pluck('seat_id')->toArray();

        return view('customer.trips.show', compact('trip', 'bookedSeatIds'));
    }
}