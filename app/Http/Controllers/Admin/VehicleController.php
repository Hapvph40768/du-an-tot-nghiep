<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.vehicles.index', compact('vehicles'));
    }
    public function show(Vehicle $vehicle)
    {
        $vehicle->load('seats');
        return view('admin.vehicles.show', compact('vehicle'));
    }
    public function create()
    {
        $parkings = \App\Models\Parking::with(['slots' => function($query) {
            $query->where('status', 'available');
        }])->get();
        return view('admin.vehicles.create', compact('parkings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:50|unique:vehicles,license_plate',
            'type' => 'required|string|max:100',
            'total_seats' => 'required|integer|min:1',
            'phone_vehicles' => 'nullable|string|max:15',
            'status' => 'required|in:active,maintenance',
        ]);

        // Tạo xe
        $vehicle = Vehicle::create($validated);

        if ($request->filled('parking_slot_id')) {
            \App\Models\ParkingSlot::find($request->parking_slot_id)
                ->update(['vehicle_id' => $vehicle->id, 'status' => 'occupied']);
        }

        // Tự động sinh ra danh sách ghế (Seats) dựa trên số lượng total_seats
        for ($i = 1; $i <= $vehicle->total_seats; $i++) {
            $vehicle->seats()->create([
                'seat_number' => 'A' . str_pad($i, 2, '0', STR_PAD_LEFT) // VD: A01, A02...
            ]);
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Thêm xe và tạo sơ đồ ghế tự động thành công!');
    }

    public function edit(Vehicle $vehicle)
    {
        // Lấy tất cả chỗ trống VÀ chỗ của chính chiếc xe này để load list vào Select
        $parkings = \App\Models\Parking::with(['slots' => function($query) use ($vehicle) {
            $query->where('status', 'available')
                  ->orWhere('vehicle_id', $vehicle->id);
        }])->get();
        return view('admin.vehicles.edit', compact('vehicle', 'parkings'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:50|unique:vehicles,license_plate,' . $vehicle->id,
            'type' => 'required|string|max:100',
            'total_seats' => 'required|integer|min:1',
            'phone_vehicles' => 'nullable|string|max:15',
            'status' => 'required|in:active,maintenance',
        ]);

        $vehicle->update($validated);
        
        // Quản lý chỗ đỗ xe
        if ($request->has('parking_slot_id')) {
            // Giải phóng slot cũ
            \App\Models\ParkingSlot::where('vehicle_id', $vehicle->id)
                ->update(['vehicle_id' => null, 'status' => 'available']);
                
            if (!empty($request->parking_slot_id)) {
                // Xếp vào slot mới
                \App\Models\ParkingSlot::find($request->parking_slot_id)
                    ->update(['vehicle_id' => $vehicle->id, 'status' => 'occupied']);
            }
        }
        
        return redirect()->route('admin.vehicles.index')->with('success', 'Cập nhật thông tin xe thành công!');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Giải phóng slot đỗ xe
        \App\Models\ParkingSlot::where('vehicle_id', $vehicle->id)
            ->update(['vehicle_id' => null, 'status' => 'available']);
            
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Xóa xe thành công!');
    }
}
