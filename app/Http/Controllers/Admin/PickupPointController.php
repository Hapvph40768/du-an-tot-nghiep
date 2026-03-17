<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickupPoint;
use App\Models\Location;
use Illuminate\Http\Request;

class PickupPointController extends Controller
{
    public function index()
    {
        $pickupPoints = PickupPoint::with('location')->paginate(20);
        return view('admin.pickup_points.index', compact('pickupPoints'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.pickup_points.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        PickupPoint::create($validated);
        return redirect()->route('admin.pickup_points.index')->with('success', 'Thêm điểm đón thành công!');
    }

    public function edit(PickupPoint $pickupPoint)
    {
        $locations = Location::all();
        return view('admin.pickup_points.edit', compact('pickupPoint', 'locations'));
    }

    public function update(Request $request, PickupPoint $pickupPoint)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $pickupPoint->update($validated);
        return redirect()->route('admin.pickup_points.index')->with('success', 'Cập nhật điểm đón thành công!');
    }

    public function destroy(PickupPoint $pickupPoint)
    {
        $pickupPoint->delete();
        return redirect()->route('admin.pickup_points.index')->with('success', 'Xóa điểm đón thành công!');
    }
}