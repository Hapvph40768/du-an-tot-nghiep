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
        // Thêm sắp xếp theo Tỉnh để Admin dễ quản lý danh mục
        $pickupPoints = PickupPoint::with('location')
            ->orderBy('location_id')
            ->orderBy('name')
            ->paginate(20);
            
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

        // Kiểm tra tránh trùng lặp điểm đón trong cùng một tỉnh
        $exists = PickupPoint::where('location_id', $validated['location_id'])
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'Điểm đón này đã tồn tại ở tỉnh này!'])->withInput();
        }

        PickupPoint::create($validated);
        return redirect()->route('admin.pickup-points.index')->with('success', 'Đã thêm điểm đón vào danh mục hệ thống!');
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
        return redirect()->route('admin.pickup-points.index')->with('success', 'Cập nhật danh mục điểm đón thành công!');
    }

    public function destroy(PickupPoint $pickupPoint)
    {
        // Kiểm tra xem điểm đón này có đang được gán cho chuyến xe nào không trước khi xóa (Nếu cần)
        $pickupPoint->delete();
        return redirect()->route('admin.pickup-points.index')->with('success', 'Xóa điểm đón khỏi danh mục thành công!');
    }
}