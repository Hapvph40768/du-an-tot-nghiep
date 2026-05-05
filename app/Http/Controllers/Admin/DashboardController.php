<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- THỐNG KÊ 4 Ô CARD ---
        $totalDrivers = Driver::count();
        $totalTrips = Trip::count();
        $totalTickets = Ticket::count();
        $totalRevenue = Payment::where('status', 'success')->sum('amount');

        // --- DỮ LIỆU BIỂU ĐỒ DOANH THU & VÉ (7 NGÀY QUA) ---
        $chartLabels = [];
        $revenueData = [];
        $ticketData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::now()->subDays($i)->format('d/m');

            // Tính doanh thu theo ngày
            $revenueData[] = Payment::where('status', 'success')
                ->whereDate('created_at', $date)
                ->sum('amount');

            // Tính số vé đặt theo ngày
            $ticketData[] = Ticket::whereDate('created_at', $date)->count();
        }

        // --- DỮ LIỆU BIỂU ĐỒ TRÒN (TRẠNG THÁI CHUYẾN XE) ---
        $tripStatusLabels = ['Hoàn thành', 'Đang chạy', 'Đã hủy'];
        $tripStatusData = [
            Trip::where('status', 'completed')->count(),
            Trip::where('status', 'active')->count(),
            Trip::where('status', 'cancelled')->count(),
        ];

        // --- TRUYỀN TẤT CẢ BIẾN SANG VIEW ---
        return view('admin.dashboard.index', compact(
            'totalDrivers',
            'totalTrips',
            'totalTickets',
            'totalRevenue',
            'chartLabels',
            'revenueData',
            'ticketData',
            'tripStatusLabels',
            'tripStatusData'
        ));
    }
}