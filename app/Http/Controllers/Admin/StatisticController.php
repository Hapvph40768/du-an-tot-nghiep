<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DailyReport;
use App\Models\Trip;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        // Thống kê Doanh thu theo 7 ngày gần nhất (từ bảng tickets hoặc bookings)
        $sevenDaysAgo = Carbon::today()->subDays(6);
        
        // Nhóm doanh thu theo từng ngày
        $revenueStats = Booking::where('status', 'paid')
            ->whereDate('created_at', '>=', $sevenDaysAgo)
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total_revenue, COUNT(*) as total_bookings')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = [];
        $revenueData = [];
        $bookingData = [];

        for ($i = 6; $i >= 0; $i--) {
            $dateCursor = Carbon::today()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::parse($dateCursor)->format('d/m');
            
            $stat = $revenueStats->firstWhere('date', $dateCursor);
            $revenueData[] = $stat ? $stat->total_revenue : 0;
            $bookingData[] = $stat ? $stat->total_bookings : 0;
        }

        // Tình trạng bán vé hiện tại (Tổng số vé)
        $ticketStatusData = [
            'confirmed' => Ticket::where('status', 'confirmed')->count(),
            'pending' => Ticket::where('status', 'pending')->count(),
            'cancelled' => Ticket::where('status', 'cancelled')->count(),
        ];

        // Lấy danh sách tuyến đường bán chạy nhất
        $topRoutes = DB::table('bookings')
            ->join('trips', 'bookings.trip_id', '=', 'trips.id')
            ->join('routes', 'trips.route_id', '=', 'routes.id')
            ->join('locations as start_loc', 'routes.start_location_id', '=', 'start_loc.id')
            ->join('locations as end_loc', 'routes.end_location_id', '=', 'end_loc.id')
            ->where('bookings.status', 'paid')
            ->select(
                'routes.id',
                'start_loc.name as start_name',
                'end_loc.name as end_name',
                DB::raw('COUNT(bookings.id) as total_bookings'),
                DB::raw('SUM(bookings.total_amount) as total_revenue')
            )
            ->groupBy('routes.id', 'start_name', 'end_name')
            ->orderByDesc('total_revenue')
            ->limit(5)
            ->get();

        return view('admin.statistics.index', compact(
            'chartLabels',
            'revenueData',
            'bookingData',
            'ticketStatusData',
            'topRoutes'
        ));
    }
}
