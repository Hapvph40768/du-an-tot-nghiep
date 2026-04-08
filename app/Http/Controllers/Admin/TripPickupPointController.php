<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\PickupPoint;
use Illuminate\Http\Request;

class TripPickupPointController extends Controller
{
    /**
     * Giao diện Checkbox để gán các bến xe từ kho vào chuyến đi
     */
    public function index(Trip $trip)
    {
        $trip->load(['pickupPoints.location', 'route.departureLocation', 'route.destinationLocation']);
        
        // Lấy toàn bộ danh mục điểm đón để Admin tích chọn
        $allPickupPoints = PickupPoint::with('location')->get();

        return view('admin.trips.pickup_points.index', compact('trip', 'allPickupPoints'));
    }

    /**
     * Xử lý gán danh sách điểm đón (Checkbox Sync)
     */
    public function store(Request $request, Trip $trip)
    {
        // Nhận mảng ID từ các checkbox
        $pickupPointIds = $request->input('pickup_point_ids', []);

        // Đồng bộ dữ liệu bảng trung gian
        $trip->pickupPoints()->sync($pickupPointIds);

        return redirect()->route('admin.trips.pickup_points.index', $trip->id)
            ->with('success', 'Đã cập nhật lộ trình dừng đón cho chuyến xe!');
    }

    /**
     * Cho phép Admin "tạo nhanh" bến mới ngay khi đang chỉnh trip
     * Nút này sẽ dẫn về trang Create của PickupPointController kèm theo biến redirect
     */
    public function create(Trip $trip)
    {
        // Gợi ý: Bạn có thể redirect sang trang tạo gốc
        return redirect()->route('admin.pickup-points.create', ['from_trip' => $trip->id]);
    }

    /**
     * Gỡ gán một điểm đón cụ thể
     */
    public function destroy(Trip $trip, $pickupPointId)
    {
        $trip->pickupPoints()->detach($pickupPointId);
        return back()->with('success', 'Đã gỡ điểm dừng này khỏi chuyến xe.');
    }
}