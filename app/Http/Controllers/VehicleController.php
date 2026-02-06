<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('id', 'desc')->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|unique:vehicles,license_plate',
            'total_seats'   => 'required|integer|min:1',
            'status'        => 'required|in:active,maintenance',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')
            ->with('success', 'Thêm xe thành công');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'license_plate' => 'required|unique:vehicles,license_plate,' . $vehicle->id,
            'total_seats'   => 'required|integer|min:1',
            'status'        => 'required|in:active,maintenance',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')
            ->with('success', 'Cập nhật xe thành công');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Xóa xe thành công');
    }
    public function show(Vehicle $vehicle)
{
    return view('admin.vehicles.show', compact('vehicle'));
}
}
