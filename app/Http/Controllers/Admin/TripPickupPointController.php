<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\PickupPoint;
use App\Models\Location;
use Illuminate\Http\Request;

class TripPickupPointController extends Controller
{
    // Hiển thị danh sách để gán vào Trip
    public function index(Trip $trip)
    {
        $trip->load('pickupPoints');
        $allPickupPoints = PickupPoint::with('location')->get();

        return view('admin.trips.pickup_points.index', compact('trip', 'allPickupPoints'));
    }

    // Form tạo mới một điểm đón (Vẫn cần $trip để biết sau khi tạo xong thì quay về đâu)
    public function create(Trip $trip)
    {
        $locations = Location::all();
        return view('admin.trips.pickup_points.create', compact('trip', 'locations'));
    }

    // Lưu điểm đón mới vào DATABASE và gán luôn vào TRIP này
    public function storeNew(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        // 1. Tạo điểm đón mới vào bảng pickup_points
        $newPoint = \App\Models\PickupPoint::create($validated);

        // 2. Gán ngay điểm này vào chuyến xe hiện tại
        $trip->pickupPoints()->attach($newPoint->id);

        return redirect()->route('admin.trips.pickup_points.index', $trip->id)
            ->with('success', 'Đã tạo và thêm điểm đón mới!');
    }
    // Cập nhật danh sách điểm đón (Checkbox)
    public function store(Request $request, Trip $trip)
    {
        $request->validate([
            'pickup_point_ids' => 'required|array',
            'pickup_point_ids.*' => 'exists:pickup_points,id'
        ]);

        $trip->pickupPoints()->sync($request->pickup_point_ids);
        return back()->with('success', 'Cập nhật lộ trình thành công!');
    }

    public function destroy(Trip $trip, $pickupPointId)
    {
        $trip->pickupPoints()->detach($pickupPointId);
        return back()->with('success', 'Đã gỡ điểm đón khỏi chuyến xe.');
    }
}
