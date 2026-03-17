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

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:50|unique:vehicles,license_plate',
            'type' => 'required|string|max:100', // VD: Limousine 9 chỗ, Giường nằm 40 chỗ
            'total_seats' => 'required|integer|min:1',
            'status' => 'required|in:active,maintenance',
        ]);

        // Tạo xe
        $vehicle = Vehicle::create($validated);

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
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:50|unique:vehicles,license_plate,' . $vehicle->id,
            'type' => 'required|string|max:100',
            'total_seats' => 'required|integer|min:1',
            'status' => 'required|in:active,maintenance',
        ]);

        $vehicle->update($validated);
        return redirect()->route('admin.vehicles.index')->with('success', 'Cập nhật thông tin xe thành công!');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Xóa xe thành công!');
    }
}