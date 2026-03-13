<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Trip;
use App\Models\PickupPoint;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user','trip','pickupPoint'])
            ->orderBy('id','desc')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $trips = Trip::all();
        $pickupPoints = PickupPoint::all();

        return view('admin.bookings.create',
            compact('users','trips','pickupPoints'));
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id'         => 'required|exists:users,id',
        'trip_id'         => 'required|exists:trips,id',
        'pickup_point_id' => 'required|exists:pickup_points,id',
        'status'          => 'required|in:pending,paid,cancelled',
    ],[
        'user_id.required' => 'Vui lòng chọn người dùng',
        'user_id.exists'   => 'Người dùng không tồn tại',

        'trip_id.required' => 'Vui lòng chọn chuyến đi',
        'trip_id.exists'   => 'Chuyến đi không tồn tại',

        'pickup_point_id.required' => 'Vui lòng chọn điểm đón',
        'pickup_point_id.exists'   => 'Điểm đón không tồn tại',

        'status.required' => 'Vui lòng chọn trạng thái',
        'status.in'       => 'Trạng thái không hợp lệ',
    ]);

    Booking::create($request->all());

    return redirect()->route('bookings.index')
        ->with('success','Thêm booking thành công');
}

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $users = User::all();
        $trips = Trip::all();
        $pickupPoints = PickupPoint::all();

        return view('admin.bookings.edit',
            compact('booking','users','trips','pickupPoints'));
    }

    public function update(Request $request, Booking $booking)
{
    $request->validate([
        'status' => 'required|in:pending,paid,cancelled',
    ],[
        'status.required' => 'Vui lòng chọn trạng thái',
        'status.in'       => 'Trạng thái không hợp lệ',
    ]);

    $booking->update($request->all());

    return redirect()->route('bookings.index')
        ->with('success','Cập nhật booking thành công');
}

    public function destroy(Booking $booking)
    {
        // Không cho xóa nếu đã thanh toán
        if ($booking->status === 'paid') {
            return redirect()->route('bookings.index')
                ->with('error','Không thể xóa booking đã thanh toán');
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success','Xóa booking thành công');
    }
}