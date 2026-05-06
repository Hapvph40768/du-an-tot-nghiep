<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\DropoffPoint;
use Illuminate\Http\Request;

class TripDropoffPointController extends Controller
{
    /**
     * Giao diện Checkbox để gán các bến xe từ kho vào chuyến đi
     */
    public function index(Trip $trip)
    {
        $trip->load(['dropoffPoints.location', 'route.departureLocation', 'route.destinationLocation']);
        
        // Lấy toàn bộ danh mục điểm trả để Admin tích chọn
        $allDropoffPoints = DropoffPoint::with('location')->get();

        return view('admin.trips.dropoff_points.index', compact('trip', 'allDropoffPoints'));
    }

    /**
     * Xử lý gán danh sách điểm trả (Checkbox Sync)
     */
    public function store(Request $request, Trip $trip)
    {
        // Nhận mảng ID từ các checkbox
        $dropoffPointIds = $request->input('dropoff_point_ids', []);

        // Đồng bộ dữ liệu bảng trung gian
        $trip->dropoffPoints()->sync($dropoffPointIds);

        return redirect()->route('admin.trips.dropoff_points.index', $trip->id)
            ->with('success', 'Đã cập nhật lộ trình trả khách cho chuyến xe!');
    }

    /**
     * Cho phép Admin "tạo nhanh" bến mới ngay khi đang chỉnh trip
     * Nút này sẽ dẫn về trang Create của DropoffPointController kèm theo biến redirect
     */
    public function create(Trip $trip)
    {
        return redirect()->route('admin.dropoff-points.create', ['from_trip' => $trip->id]);
    }

    /**
     * Gỡ gán một điểm trả cụ thể
     */
    public function destroy(Trip $trip, $dropoffPointId)
    {
        $trip->dropoffPoints()->detach($dropoffPointId);
        return back()->with('success', 'Đã gỡ điểm trả này khỏi chuyến xe.');
    }
}
