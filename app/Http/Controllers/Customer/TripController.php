<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        if ($request->filled('trip_date')) {
            $query->whereDate('trip_date', $request->trip_date)
                  ->where(DB::raw("CONCAT(trip_date, ' ', departure_time)"), '>=', now());
        } else {
            $query->where(DB::raw("CONCAT(trip_date, ' ', departure_time)"), '>=', now());
        }

        $trips = $query->orderBy('trip_date', 'desc')->get();

        return view('customer.trips.search_result', compact('trips'));
    }

    // Xem chi tiết 1 chuyến xe (hiển thị chọn số lượng vé và chọn điểm đón)
    public function show(Trip $trip)
    {
        // Load kèm xe và các điểm đón trả khách
        $trip->load(['vehicle', 'pickupPoints']);
        
        $totalSeats = $trip->vehicle->seats()->count();
        $bookedSeats = \App\Models\Ticket::where('trip_id', $trip->id)
                            ->whereIn('status', ['pending', 'confirmed'])
                            ->count();
        
        $availableSeats = max(0, $totalSeats - $bookedSeats);

        return view('customer.trips.show', compact('trip', 'availableSeats'));
    }
}