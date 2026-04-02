<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\Seat;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::with(['route', 'vehicle', 'driver']);
        
        if ($request->has('date')) {
            $query->whereDate('trip_date', $request->date);
        } else {
            $query->whereDate('trip_date', '>=', now());
        }

        $trips = $query->orderBy('trip_date')->orderBy('departure_time')->paginate(10);
        return view('staff.trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        $trip->load(['route', 'vehicle.seats', 'tickets', 'bookings.user']);
        
        // Sơ đồ ghế đơn giản
        $seats = $trip->vehicle->seats;
        $occupiedSeatIds = $trip->tickets->pluck('seat_id')->toArray();

        return view('staff.trips.show', compact('trip', 'seats', 'occupiedSeatIds'));
    }
}
