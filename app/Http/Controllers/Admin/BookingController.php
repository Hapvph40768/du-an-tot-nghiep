<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Load các quan hệ cần thiết để hiển thị ra bảng
        $bookings = Booking::with(['user', 'trip.route', 'pickupPoint'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'trip.route.startLocation', 'trip.route.endLocation', 'trip.driver', 'trip.vehicle', 'tickets.seat', 'tickets.trip', 'pickupPoint', 'payment']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Admin cập nhật trạng thái của đơn hàng (vd: từ pending sang paid hoặc cancelled)
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $booking->update($validated);

        // Nếu admin hủy đơn, có thể gọi logic cập nhật trạng thái vé (tickets) thành cancelled ở đây

        return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật trạng thái vé thành công!');
    }
}