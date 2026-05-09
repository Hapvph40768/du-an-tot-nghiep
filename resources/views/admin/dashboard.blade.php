@extends('layout.admin')

@section('title', 'Admin Dashboard')
@section('header-title', 'TỔNG QUAN HỆ THỐNG')
@section('header-subtitle', 'Báo cáo và thống kê hoạt động')

@section('content-main')
<div class="container-fluid px-0">
    <!-- Stat Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card dash-card border-0 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-uppercase fw-bold text-muted mb-0" style="font-size: 11px; letter-spacing: 1px;">Tổng tài xế</h6>
                    <div class="dash-icon-bg" style="background: rgba(255, 91, 36, 0.1); color: #ff5b24;">
                        <i class='bx bxs-user-badge'></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold text-dark" style="font-size: 32px;">{{ $totalDrivers }}</h2>
                <span class="badge bg-success bg-opacity-10 text-success fw-bold">
                    <i class='bx bx-trending-up'></i> Active
                </span>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card dash-card border-0 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-uppercase fw-bold text-muted mb-0" style="font-size: 11px; letter-spacing: 1px;">Tổng chuyến xe</h6>
                    <div class="dash-icon-bg" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <i class='bx bxs-bus'></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold text-dark" style="font-size: 32px;">{{ $totalTrips }}</h2>
                <span class="badge bg-success bg-opacity-10 text-success fw-bold">
                    <i class='bx bx-check-circle'></i> Hoạt động
                </span>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card dash-card border-0 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-uppercase fw-bold text-muted mb-0" style="font-size: 11px; letter-spacing: 1px;">Số vé đã đặt</h6>
                    <div class="dash-icon-bg" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                        <i class='bx bxs-coupon'></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold text-dark" style="font-size: 32px;">{{ $totalTickets }}</h2>
                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold">
                    <i class='bx bx-trending-up'></i> Bán ra
                </span>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card dash-card border-0 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-uppercase fw-bold text-muted mb-0" style="font-size: 11px; letter-spacing: 1px;">Tổng doanh thu</h6>
                    <div class="dash-icon-bg" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <i class='bx bx-money'></i>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold text-dark" style="font-size: 28px;">{{ number_format($totalRevenue, 0, ',', '.') }} đ</h2>
                <span class="badge bg-warning bg-opacity-10 text-warning fw-bold">
                    <i class='bx bx-line-chart'></i> Thu nhập
                </span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4">
        <!-- Revenue Chart -->
        <div class="col-lg-8">
            <div class="card border-0 h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Doanh thu & Số vé</h5>
                        <p class="text-muted small mb-0 fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 1px;">7 ngày vừa qua</p>
                    </div>
                    <div class="d-flex gap-3">
                        <span class="badge bg-light text-dark border"><i class='bx bxs-circle text-primary me-1'></i> Doanh thu</span>
                        <span class="badge bg-light text-dark border"><i class='bx bxs-circle text-warning me-1'></i> Số vé</span>
                    </div>
                </div>
                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="col-lg-4">
            <div class="card border-0 h-100 p-4">
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-1">Trạng thái chuyến</h5>
                    <p class="text-muted small mb-0 fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 1px;">Phân bổ hiện tại</p>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-grow-1" style="height: 220px;">
                    <canvas id="tripStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Nhận dữ liệu từ Controller
    const chartLabels = @json($chartLabels);
    const revenueData = @json($revenueData);
    const ticketData = @json($ticketData);
    
    const tripStatusLabels = @json($tripStatusLabels);
    const tripStatusData = @json($tripStatusData);

    // Cấu hình chung cho Chart.js
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.color = '#94a3b8';
    Chart.defaults.scale.grid.color = '#f1f5f9';

    // 1. BIỂU ĐỒ DOANH THU & SỐ VÉ
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    
    // Tạo gradient cho cột doanh thu
    const gradientRev = ctxRevenue.createLinearGradient(0, 0, 0, 400);
    gradientRev.addColorStop(0, 'rgba(255, 91, 36, 0.8)');
    gradientRev.addColorStop(1, 'rgba(255, 91, 36, 0.2)');

    new Chart(ctxRevenue, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Số vé đặt',
                    type: 'line',
                    data: ticketData,
                    borderColor: '#f59e0b',
                    backgroundColor: '#f59e0b',
                    borderWidth: 3,
                    tension: 0.4, // Đường cong mềm mại
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f59e0b',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    yAxisID: 'y1',
                },
                {
                    label: 'Doanh thu (VNĐ)',
                    data: revenueData,
                    backgroundColor: gradientRev,
                    borderRadius: 8,
                    barThickness: max => Math.min(max.chart.width / chartLabels.length / 2, 40),
                    yAxisID: 'y',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 13 },
                    cornerRadius: 8,
                    displayColors: true
                }
            },
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    border: { display: false },
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) return (value / 1000000) + 'tr';
                            if (value >= 1000) return (value / 1000) + 'k';
                            return value;
                        }
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    border: { display: false }
                }
            }
        }
    });

    // 2. BIỂU ĐỒ TRẠNG THÁI CHUYẾN XE (Doughnut Chart)
    const ctxStatus = document.getElementById('tripStatusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: tripStatusLabels,
            datasets: [{
                data: tripStatusData,
                backgroundColor: [
                    '#10b981', // Xanh ngọc (Hoàn thành)
                    '#3b82f6', // Xanh dương (Đang chạy)
                    '#ef4444'  // Đỏ (Đã hủy)
                ],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { size: 12, weight: '600' }
                    }
                }
            }
        }
    });
</script>
@endpush
