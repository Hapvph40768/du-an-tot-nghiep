<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverTripController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $driver = $user->driver;

        if (!$driver) {
            return redirect()->route('driver.home')
                ->with('error', 'Bạn không phải tài xế hoặc chưa được gán tài khoản tài xế.');
        }

        $trips = Trip::with([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle',
            'pickupPoints'
        ])
            ->where('driver_id', $driver->id)
            ->orderBy('trip_date', 'desc')
            ->orderBy('departure_time')
            ->paginate(12);

        return view('driver.trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        $trip->load([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle',
            'pickupPoints',
            'tickets' => function ($query) {
                $query->where('status', '!=', 'cancelled')
                    ->with(['seat', 'booking.user']);  
            },
            'bookings.user'   
        ]);

        return view('driver.trips.show', compact('trip'));
    }

    public function start(Trip $trip, Request $request)
    {

        if ($trip->status !== 'active') {
            return back()->with('error', 'Chuyến này không thể bắt đầu.');
        }

        $trip->update(['status' => 'running']);

        return redirect()->route('driver.trips.show', $trip)
            ->with('success', 'Chuyến xe đã bắt đầu!');
    }
}
