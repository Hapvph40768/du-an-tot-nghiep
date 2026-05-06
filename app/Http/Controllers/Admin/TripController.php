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
            $query->whereHas('vehicle', function ($q) use ($search) {
                $q->where('license_plate', 'like', "%{$search}%");
            })->orWhereHas('driver', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
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

        $totalSeats = $trip->vehicle->seats()->count();
        $bookedSeats = \App\Models\Ticket::where('trip_id', $trip->id)->whereIn('status', ['pending', 'confirmed'])->count();
        $availableSeats = max(0, $totalSeats - $bookedSeats);

        return view('admin.trips.show', compact('trip', 'availableSeats', 'totalSeats', 'bookedSeats'));
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
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
                \Illuminate\Validation\Rule::unique('trips')->where(function ($query) use ($request) {
                    return $query->where('trip_date', $request->trip_date)
                                 ->where('departure_time', $request->departure_time);
                })
            ],
            'driver_id' => 'required|exists:drivers,id',
            'trip_date' => 'nullable|date',
            'departure_time' => 'nullable|date_format:H:i',
            'arrival_time' => 'nullable|date_format:H:i',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled',
        ], [
            'vehicle_id.unique' => 'Xe này đã được xếp lịch chạy vào ngày và giờ này. Vui lòng chọn xe khác hoặc đổi thời gian khởi hành.',
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
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
                \Illuminate\Validation\Rule::unique('trips')->where(function ($query) use ($request) {
                    return $query->where('trip_date', $request->trip_date)
                                 ->where('departure_time', $request->departure_time);
                })->ignore($trip->id)
            ],
            'driver_id' => 'required|exists:drivers,id',
            'trip_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled',
        ], [
            'vehicle_id.unique' => 'Xe này đã được xếp lịch chạy vào ngày và giờ này. Vui lòng chọn xe khác hoặc đổi thời gian khởi hành.',
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
