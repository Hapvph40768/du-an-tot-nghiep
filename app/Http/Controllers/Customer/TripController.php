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
            'trip_date' => 'required|date|after_or_equal:today',
        ]);

        // Tìm các chuyến xe thuộc tuyến đường có điểm đi/đến tương ứng và đúng ngày
        $trips = Trip::with(['route', 'vehicle'])
            ->whereHas('route', function ($query) use ($request) {
                $query->where('start_location_id', $request->start_location_id)
                      ->where('end_location_id', $request->end_location_id);
            })
            ->where('trip_date', $request->trip_date)
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
        $bookedSeatIds = $trip->seatLocks()->pluck('seat_id')->toArray();

        return view('customer.trips.show', compact('trip', 'bookedSeatIds'));
    }
}