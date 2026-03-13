<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
// Các Model dưới đây sẽ được gọi sau khi chúng ta tạo xong
// use App\Models\Trip;
// use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Thống kê tổng quan
        // Dữ liệu thật từ bảng drivers
        $totalDrivers = Driver::count(); 
        
        // Dữ liệu giả lập tạm thời (Sẽ thay thế bằng query thật ở các bước sau)
        $totalTrips = 150; 
        $totalTickets = 1250; 
        $totalRevenue = 45500000; 

        // 2. Dữ liệu cho Biểu đồ (Giả lập 7 ngày qua)
        $chartLabels = ['01/10', '02/10', '03/10', '04/10', '05/10', '06/10', '07/10'];
        
        // Biểu đồ Doanh thu (VNĐ)
        $revenueData = [4500000, 6000000, 5500000, 8000000, 4000000, 9500000, 8000000];
        
        // Biểu đồ Số vé đặt
        $ticketData = [20, 35, 30, 45, 15, 50, 42];

        // Biểu đồ Trạng thái chuyến xe
        $tripStatusLabels = ['Đã hoàn thành', 'Đang chạy', 'Đã hủy'];
        $tripStatusData = [110, 25, 15];

        return view('admin.dashboard', compact(
            'totalDrivers', 'totalTrips', 'totalTickets', 'totalRevenue',
            'chartLabels', 'revenueData', 'ticketData',
            'tripStatusLabels', 'tripStatusData'
        ));
    }
}