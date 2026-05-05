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
    public function index(Request $request)
    {
        $query = Trip::with(['route.departureLocation', 'route.destinationLocation', 'vehicle', 'driver', 'pickupPoints']);

        // Tìm kiếm theo biển số xe hoặc tên tài xế
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('vehicle', function ($q2) use ($search) {
                    $q2->where('license_plate', 'like', "%{$search}%");
                })->orWhereHas('driver', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Lọc theo ngày khởi hành
        if ($request->filled('date_from')) {
            $query->where('trip_date', '>=', $request->date_from);
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $trips = $query->orderBy('trip_date', 'desc')->paginate(15);

        return view('admin.trips.index', compact('trips'));
    }
    public function show(Trip $trip)
    {
        $trip->load([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle.seats',
            'driver',
            'pickupPoints'
        ]);

        $bookedSeatIds = $trip->seatLocks()->pluck('seat_id')->toArray();

        return view('admin.trips.show', compact('trip', 'bookedSeatIds'));
    }

    public function create()
    {
        // Truyền dữ liệu ra view để Admin chọn khi tạo chuyến mới
        $routes = Route::with(['departureLocation', 'destinationLocation'])->get();
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
            'trip_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,running,broken,completed,cancelled',
        ]);

        Trip::create($validated);
        return redirect()->route('admin.trips.index')->with('success', 'Lên lịch chuyến đi thành công!');
    }

    public function edit(Trip $trip)
    {
        $routes = Route::with(['departureLocation', 'destinationLocation'])->get();
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
            'trip_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,running,broken,completed,cancelled',
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
