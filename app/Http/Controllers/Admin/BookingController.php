<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // Load các quan hệ cần thiết để hiển thị ra bảng
        $query = Booking::with(['user', 'trip.route', 'pickupPoint']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('contact_phone', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%")
                  ->orWhereHas('tickets', function ($q2) use ($search) {
                      $q2->where('ticket_code', 'like', "%{$search}%");
                  });
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(20);

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

        if ($booking->status === 'paid' && $request->status === 'pending') {
            return back()->with('error', 'Không thể lùi trạng thái từ Đã thanh toán về Chưa thanh toán.');
        }

        $booking->update($validated);

        // Nếu admin hủy đơn, có thể gọi logic cập nhật trạng thái vé (tickets) thành cancelled ở đây

        return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật trạng thái vé thành công!');
    }

    public function export(Booking $booking)
    {
        $booking->load(['user', 'trip.route.startLocation', 'trip.route.endLocation', 'trip.driver', 'trip.vehicle', 'tickets.seat', 'pickupPoint']);
        return view('admin.bookings.export', compact('booking'));
    }
}