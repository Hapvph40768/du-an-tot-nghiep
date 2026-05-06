<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\StaffLog;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $now = Carbon::now();

        // 1. CHUYẾN SẮP KHỞI HÀNH HOẶC ĐANG CHẠY (Ưu tiên những chuyến gần giờ nhất)
        // Nếu không có chuyến tương lai, lấy các chuyến gần đây nhất để hiển thị
        $upcomingTrips = Trip::with(['route.startLocation', 'route.endLocation', 'vehicle', 'tickets'])
            ->whereDate('trip_date', '>=', $today)
            ->orderBy('trip_date', 'asc')
            ->orderBy('departure_time', 'asc')
            ->take(5)
            ->get()
            ->map(function($trip) use ($now) {
                // Tính toán tỷ lệ lấp đầy & Khách No-show / Chưa lên xe
                $totalSeats = $trip->vehicle ? $trip->vehicle->total_seats : 0;
                $soldTickets = $trip->tickets->count();
                $checkedIn = $trip->tickets->where('status', 'used')->count();
                $noShow = $trip->tickets->where('status', 'no_show')->count();
                $waiting = $soldTickets - $checkedIn - $noShow;

                $trip->capacity_data = [
                    'total' => $totalSeats,
                    'sold' => $soldTickets,
                    'checked_in' => $checkedIn,
                    'waiting' => $waiting,
                    'percent' => $totalSeats > 0 ? round(($checkedIn / $totalSeats) * 100) : 0
                ];
                
                // Cảnh báo nếu chuyến chạy trong vòng 2 tiếng mà vẫn còn khách chờ (< 2 hour warning)
                $tripDateTime = Carbon::parse($trip->trip_date . ' ' . $trip->departure_time);
                $trip->is_urgent = $tripDateTime->isFuture() && $tripDateTime->diffInHours($now) <= 2 && $waiting > 0;
                $trip->is_departed = $tripDateTime->isPast();

                return $trip;
            });

        // 2. CÔNG VIỆC CẦN XỬ LÝ NGAY (Booking chưa thanh toán của các chuyến đi hôm nay/ngày mai)
        $urgentBookings = Booking::with(['user', 'trip.route.startLocation'])
            ->where('status', 'pending')
            ->whereHas('trip', function($q) use ($today) {
                // Chỉ lấy booking của các chuyến xe xuất phát trong hôm nay hoặc ngày mai
                $q->whereDate('trip_date', '>=', $today)
                  ->whereDate('trip_date', '<=', $today->copy()->addDay());
            })
            ->orderBy('created_at', 'asc')
            ->take(8)
            ->get();

        // 3. DOANH THU & CHỈ SỐ TRONG CA (Hôm nay)
        // Lấy tổng tất cả các booking đã thanh toán hôm nay
        $todayRevenue = Booking::where('status', 'paid')
            ->whereDate('updated_at', $today)
            ->sum('total_amount');

        $todayTripCount = Trip::whereDate('trip_date', $today)->count();
        $todayBookingsCount = Booking::whereDate('created_at', $today)->count();
        $pendingBookingsCount = Booking::where('status', 'pending')->count();

        // 4. ACTIVITY LOG (Minh bạch thao tác)
        $recentLogs = StaffLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('staff.dashboard', compact(
            'upcomingTrips', 
            'urgentBookings', 
            'todayRevenue', 
            'todayTripCount', 
            'todayBookingsCount', 
            'pendingBookingsCount',
            'recentLogs'
        ));
    }
}
