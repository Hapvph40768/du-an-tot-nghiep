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

        // Tìm chuyến từ hôm nay trở đi (trong vòng 30 ngày), không chỉ riêng 1 ngày
        $query = Trip::with(['route.departureLocation', 'route.destinationLocation', 'vehicle'])
            ->withCount(['seatLocks' => function ($q) {
                $q->where('locked_until', '>', now());
            }])
            ->whereHas('route', function ($q) use ($request) {
                $q->where('start_location_id', $request->start_location_id)
                      ->where('end_location_id', $request->end_location_id);
            })
            ->where('status', 'active')
            ->whereBetween('trip_date', [now()->toDateString(), now()->addDays(30)->toDateString()]);

        $trips = $query->orderBy('trip_date', 'asc')->orderBy('departure_time', 'asc')->get();

        return view('customer.trips.search_result', compact('trips'));
    }

    // Xem chi tiết 1 chuyến xe (hiển thị sơ đồ ghế và chọn điểm đón/trả)
    public function show(Trip $trip)
    {
        // Load kèm xe, danh sách ghế, điểm đón, và thông tin tuyến
        $trip->load(['vehicle.seats', 'pickupPoints.location', 'route.departureLocation', 'route.destinationLocation']);

        // Lấy danh sách ID các ghế đã được đặt hoặc đang bị khóa
        $bookedSeatIds = $trip->seatLocks()->where('locked_until', '>', now())->pluck('seat_id')->toArray();

        // Lấy tất cả điểm đón thuộc địa điểm đi và địa điểm đến
        $departureLocationId = $trip->route->start_location_id;
        $destinationLocationId = $trip->route->end_location_id;

        $pickupPointsDeparture = \App\Models\PickupPoint::where('location_id', $departureLocationId)->get();
        $pickupPointsArrival = \App\Models\PickupPoint::where('location_id', $destinationLocationId)->get();

        return view('customer.trips.show', compact('trip', 'bookedSeatIds', 'pickupPointsDeparture', 'pickupPointsArrival'));
    }
}