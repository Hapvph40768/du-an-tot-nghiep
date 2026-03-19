<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeatLock;
use App\Models\Trip;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SeatLockController extends Controller
{
    public function index(Request $request)
    {
        // Chỉ lấy những ghế ĐANG BỊ KHÓA (locked_until > now)
        $query = SeatLock::with(['trip.route', 'seat', 'user', 'booking'])
                         ->where('locked_until', '>', now())
                         ->orderBy('locked_until', 'asc');

        if ($request->has('trip_id')) {
            $query->where('trip_id', $request->trip_id);
        }

        $seatLocks = $query->paginate(30);
        $trips = Trip::with('route')->where('status', 'active')->get(); 

        return view('admin.seat_locks.index', compact('seatLocks', 'trips'));
    }

    public function create()
    {
        $trips = Trip::with('route')->where('status', 'active')->get();
        $seats = Seat::all(); 
        $users = User::where('role', 'customer')->get();

        return view('admin.seat_locks.create', compact('trips', 'seats', 'users'));
    }

    // Xử lý lưu khóa ghế theo SỐ PHÚT
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'seat_id' => 'required|exists:seats,id',
            'user_id' => 'nullable|exists:users,id',
            'lock_minutes' => 'required|integer|min:1', 
        ]);

        // Tính toán thời gian hết hạn khóa ghế
        $lockedUntil = now()->addMinutes($request->lock_minutes);

        // KIỂM TRA QUAN TRỌNG: Ghế này có ĐANG bị khóa trong thời điểm hiện tại không?
        // Chỉ bão lỗi nếu ghế đó có locked_until > thời gian hiện tại
        $isLocked = SeatLock::where('trip_id', $validated['trip_id'])
                          ->where('seat_id', $validated['seat_id'])
                          ->where('locked_until', '>', now())
                          ->exists();

        if ($isLocked) {
            return back()->with('error', 'Ghế này hiện đang được giữ chỗ bởi người khác, chưa hết hạn!')->withInput();
        }

        // Tạo bản ghi khóa ghế
        SeatLock::create([
            'trip_id' => $validated['trip_id'],
            'seat_id' => $validated['seat_id'],
            'user_id' => $validated['user_id'],
            'locked_until' => $lockedUntil,
        ]);

        return redirect()->route('admin.seat_locks.index', ['trip_id' => $validated['trip_id']])
                         ->with('success', "Đã khóa ghế thành công trong {$request->lock_minutes} phút!");
    }

    public function destroy(SeatLock $seatLock)
    {
        $tripId = $seatLock->trip_id;
        $seatLock->delete();

        return redirect()->route('admin.seat_locks.index', ['trip_id' => $tripId])
                         ->with('success', 'Đã mở khóa ghế thủ công!');
    }
}