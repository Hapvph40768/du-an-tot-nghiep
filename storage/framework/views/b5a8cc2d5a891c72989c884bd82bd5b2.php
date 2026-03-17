<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('header-title', 'TỔNG QUAN HỆ THỐNG'); ?>
<?php $__env->startSection('header-subtitle', 'Báo cáo và thống kê hoạt động'); ?>

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-primary text-white h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-2">Tổng tài xế</h6>
                        <h2 class="mb-0 fw-bold "><?php echo e($totalDrivers); ?></h2>
                    </div>
                    <i class='bx bxs-user-badge fs-1 opacity-50'></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-success text-white h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-2">Tổng chuyến xe</h6>
                        <h2 class="mb-0 fw-bold"><?php echo e($totalTrips); ?></h2>
                    </div>
                    <i class='bx bxs-bus fs-1 opacity-50'></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-warning text-dark h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-2">Số vé đã đặt</h6>
                        <h2 class="mb-0 fw-bold"><?php echo e($totalTickets); ?></h2>
                    </div>
                    <i class='bx bxs-coupon fs-1 opacity-50'></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-danger text-white h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-2">Tổng doanh thu</h6>
                        <h2 class="mb-0 fw-bold"><?php echo e(number_format($totalRevenue, 0, ',', '.')); ?> đ</h2>
                    </div>
                    <i class='bx bx-money fs-1 opacity-50'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase mb-0">Biểu đồ doanh thu & Vé đặt (7 ngày qua)</h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase mb-0">Trạng thái chuyến xe</h6>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="tripStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Nhận dữ liệu từ Controller
    const chartLabels = <?php echo json_encode($chartLabels, 15, 512) ?>;
    const revenueData = <?php echo json_encode($revenueData, 15, 512) ?>;
    const ticketData = <?php echo json_encode($ticketData, 15, 512) ?>;
    
    const tripStatusLabels = <?php echo json_encode($tripStatusLabels, 15, 512) ?>;
    const tripStatusData = <?php echo json_encode($tripStatusData, 15, 512) ?>;

    // 1. BIỂU ĐỒ DOANH THU & SỐ VÉ (Line & Bar Mix Chart)
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'bar', // Cột làm nền tảng
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Số vé đặt',
                    type: 'line', // Line chart nằm đè lên
                    data: ticketData,
                    borderColor: '#ffc107', // Màu vàng
                    backgroundColor: '#ffc107',
                    borderWidth: 2,
                    tension: 0.3,
                    yAxisID: 'y1',
                },
                {
                    label: 'Doanh thu (VNĐ)',
                    data: revenueData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)', // Màu xanh
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    yAxisID: 'y',
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: { display: true, text: 'Doanh thu' }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: { display: true, text: 'Số vé' },
                    grid: { drawOnChartArea: false } // Không vẽ lưới đè lên nhau
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
                    '#198754', // Xanh lá (Hoàn thành)
                    '#0d6efd', // Xanh dương (Đang chạy)
                    '#dc3545'  // Đỏ (Đã hủy)
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>