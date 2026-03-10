<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Route;
use App\Models\Vehicle;
use App\Models\Driver;


class TripController extends Controller
{
    // Danh sách chuyến
    public function index()
    {
        $trips = Trip::with([
            'route.startLocation',
            'route.endLocation',
            'vehicle',
            'driver'
        ])->latest()->paginate(10);

        return view('admin.trips.index', compact('trips'));
    }

    // Form thêm
    public function create()
    {
        $routes = Route::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('admin.trips.create', compact('routes', 'vehicles', 'drivers'));
    }

    // Lưu chuyến
    public function store(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'departure_time' => 'required|date',
            'trip_date' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);

        Trip::create([
            'route_id' => $request->route_id,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'trip_date' => $request->trip_date,
            'price' => $request->price,
            'departure_time' => str_replace('T', ' ', $request->departure_time),
        ]);

        return redirect()->route('admin.trips.index')
            ->with('success', 'Thêm chuyến thành công!');
    }

    // Form sửa
    public function edit(Trip $trip)
    {
        $routes = Route::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('admin.trips.edit', compact(
            'trip',
            'routes',
            'vehicles',
            'drivers'
        ));
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'departure_time' => 'required'
        ]);

        $trip = Trip::findOrFail($id);

        $datetime = $request->departure_date . ' ' . $request->departure_time;

        $trip->update([
            'route_id' => $request->route_id,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'departure_time' => $datetime,
            'price' => $request->price
        ]);

        return redirect()->route('admin.trips.index')
            ->with('success', 'Cập nhật chuyến thành công!');
    }

    // Xoá
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->route('admin.trips.index')
            ->with('success', 'Xoá chuyến thành công!');
    }
}
