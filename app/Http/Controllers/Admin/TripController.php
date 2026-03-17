<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Route;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['route.startLocation', 'route.endLocation', 'vehicle', 'driver'])
            ->orderBy('trip_date', 'desc')
            ->orderBy('departure_time', 'desc')
            ->paginate(20);

        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        $routes = Route::with(['startLocation', 'endLocation'])->get();
        $vehicles = Vehicle::where('status', 'active')->get();
        $drivers = Driver::where('status', 'active')->get();

        return view('admin.trips.create', compact('routes', 'vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'trip_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $isConflict = Trip::where('trip_date', $validated['trip_date'])
            ->where(function ($query) use ($validated) {
                $query->where('driver_id', $validated['driver_id'])
                    ->orWhere('vehicle_id', $validated['vehicle_id']);
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('departure_time', [$validated['departure_time'], $validated['arrival_time']])
                    ->orWhereBetween('arrival_time', [$validated['departure_time'], $validated['arrival_time']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('departure_time', '<=', $validated['departure_time'])
                            ->where('arrival_time', '>=', $validated['arrival_time']);
                    });
            })
            ->exists();

        if ($isConflict) {
            return back()
                ->withErrors(['conflict' => 'Xe hoặc tài xế đã có chuyến trong khoảng thời gian này!'])
                ->withInput();
        }

        Trip::create($validated);

        return redirect()
            ->route('admin.trips.index')
            ->with('success', 'Lên lịch chuyến đi thành công!');
    }

    public function edit(Trip $trip)
    {
        $routes = Route::with(['startLocation', 'endLocation'])->get();
        $vehicles = Vehicle::where('status', 'active')->get();
        $drivers = Driver::where('status', 'active')->get();

        return view('admin.trips.edit', compact('trip', 'routes', 'vehicles', 'drivers'));
    }

    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'trip_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $trip->update($validated);
        return redirect()->route('admin.trips.index')->with('success', 'Cập nhật chuyến đi thành công!');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('admin.trips.index')->with('success', 'Hủy chuyến đi thành công!');
    }
}
