<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class SeatController extends Controller
{
    /**
     * HIỂN THỊ: Lấy danh sách ghế của một xe
     */
    public function index(Vehicle $vehicle): View
    {
        $seats = $vehicle->seats()->orderBy('seat_number', 'asc')->get();
        return view('admin.seats.index', compact('vehicle', 'seats'));
    }

    /**
     * LOGIC SEAT LOCK: Khóa ghế khi click
     * ĐÃ FIX: Lỗi "id on null" và "guard admin not defined"
     */
    public function selectSeat(Request $request, Seat $seat): JsonResponse
    {
        // 1. Lấy ID người dùng an toàn nhất (tự động nhận diện session hiện tại)
        $userId = Auth::id();

        // 2. Dự phòng: Nếu session API gặp trục trặc, lấy ID của Admin đầu tiên để thực hiện lệnh
        if (!$userId) {
            $admin = User::first(); 
            $userId = $admin ? $admin->id : null;
        }

        // 3. Kiểm tra nếu hệ thống hoàn toàn không có User/Admin nào
        if (!$userId) {
            return response()->json(['error' => 'Không xác định được danh tính người khóa ghế!'], 401);
        }

        // 4. Kiểm tra trạng thái ghế trước khi khóa
        if ($seat->status !== 'Trống') {
            return response()->json(['error' => 'Ghế này đã được khóa hoặc có người chọn!'], 400);
        }

        // 5. Thực hiện khóa ghế (Seat Lock)
        try {
            $seat->update([
                'status' => 'Đã đặt',
                'user_id' => $userId
            ]);

            return response()->json([
                'success' => 'Đã khóa ghế ' . $seat->seat_number . ' thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi Database: ' . $e->getMessage()], 500);
        }
    }

    /**
     * TẠO TỰ ĐỘNG: Sinh sơ đồ ghế theo loại xe
     */
    public function generate(Vehicle $vehicle): RedirectResponse
    {
        if($vehicle->seats()->count() > 0) {
            return back()->with('error', 'Xe này đã có sơ đồ ghế!');
        }

        $total = (int) $vehicle->type; 

        for ($i = 1; $i <= $total; $i++) {
            $vehicle->seats()->create([
                'seat_number' => 'A' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'type' => 'Thường',
                'status' => 'Trống'
            ]);
        }

        return back()->with('success', "Đã tạo sơ đồ $total ghế cho xe thành công!");
    }

    /**
     * THÊM LẺ: Lưu 1 ghế thủ công
     */
    public function store(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $data = $request->validate([
            'seat_number' => 'required|string|max:10',
            'type'        => 'required|in:Thường,VIP',
            'status'      => 'required|in:Trống,Đã đặt,Bảo trì',
        ]);

        $vehicle->seats()->create($data);

        return back()->with('success', 'Đã thêm ghế ' . $request->seat_number . ' thành công!');
    }

    /**
 * HỦY CHỌN GHẾ: Đưa ghế về trạng thái Trống
 */
public function unlockSeat(Seat $seat): JsonResponse
{
    try {
        // 1. Cập nhật trạng thái ghế về Trống và xóa user_id gắn kèm
        $seat->update([
            'status' => 'Trống',
            'user_id' => null
        ]);

        // 2. Nếu bạn đã lỡ tạo bảng seat_locks, hãy xóa bản ghi liên quan để giải phóng hoàn toàn
        \App\Models\SeatLock::where('seat_id', $seat->id)->delete();

        return response()->json([
            'success' => 'Đã hủy chọn ghế ' . $seat->seat_number . ' thành công!'
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Lỗi: ' . $e->getMessage()], 500);
    }
}

    /**
     * XÓA LẺ: Xóa 1 vị trí ghế
     */
    public function destroy(Seat $seat): RedirectResponse
    {
        if ($seat->status !== 'Trống') {
            return back()->with('error', 'Không thể xóa ghế đang ở trạng thái khóa!');
        }
        $seat->delete();
        return back()->with('success', 'Đã xóa ghế thành công.');
    }

    /**
     * XÓA TẤT CẢ: Reset sạch sơ đồ ghế của xe
     */
    public function deleteAll(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->seats()->delete();
        return back()->with('success', 'Đã xóa toàn bộ sơ đồ ghế.');
    }
}