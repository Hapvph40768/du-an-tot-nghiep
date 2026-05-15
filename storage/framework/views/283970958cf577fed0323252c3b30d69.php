

<?php $__env->startSection('title', 'Báo cáo Thống kê Chuyên sâu'); ?>
<?php $__env->startSection('header-title', 'THỐNG KÊ CHI TIẾT'); ?>
<?php $__env->startSection('header-subtitle', 'Phân tích dữ liệu doanh thu và đặt vé'); ?>

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="row g-4 mb-4">
        <!-- Biểu đồ Doanh thu -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase mb-0">Doanh thu & Số lượng đơn đặt (7 ngày qua)</h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Tình trạng vé -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase mb-0">Tỉ lệ Trạng thái Vé</h6>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="ticketStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- TOP Tuyến Đường -->
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h6 class="fw-bold m-0"><i class='bx bx-trending-up text-success'></i> TOP 5 Tuyến Đường Bán Chạy Nhất</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="bg-light">
                            <tr class="text-muted small text-uppercase">
                                <th>Tuyến đường</th>
                                <th class="text-center">Số lượng chỗ bán ra</th>
                                <th class="text-end">Doanh thu mang lại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $topRoutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr>
                                <td class="fw-bold"><?php echo e($route->start_name); ?> - <?php echo e($route->end_name); ?></td>
                                <td class="text-center"><span class="badge bg-primary"><?php echo e(number_format($route->total_bookings)); ?> vé</span></td>
                                <td class="text-end text-danger fw-bold"><?php echo e(number_format($route->total_revenue)); ?> đ</td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="3" class="text-center text-muted py-4">Chưa có dữ liệu</td></tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dữ liệu Doanh thu
    const chartLabels = <?php echo json_encode($chartLabels, 15, 512) ?>;
    const revenueData = <?php echo json_encode($revenueData, 15, 512) ?>;
    const bookingData = <?php echo json_encode($bookingData, 15, 512) ?>;
    
    // Dữ liệu Vé
    const ticketStatusData = <?php echo json_encode($ticketStatusData, 15, 512) ?>;

    // Xây dựng Biểu đồ Doanh thu
    const ctxRev = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRev, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Doanh thu (VNĐ)',
                    data: revenueData,
                    borderColor: '#ff6b00',
                    backgroundColor: 'rgba(255, 107, 0, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    yAxisID: 'y'
                },
                {
                    label: 'Số lượng đặt vé',
                    data: bookingData,
                    type: 'bar',
                    backgroundColor: '#e2e8f0',
                    borderColor: '#cbd5e1',
                    borderWidth: 1,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { type: 'linear', position: 'left', title: { display: true, text: 'VNĐ' } },
                y1: { type: 'linear', position: 'right', title: { display: true, text: 'Đơn' }, grid: { drawOnChartArea: false } }
            }
        }
    });

    // Xây dựng Biểu đồ Vé
    const ctxTkt = document.getElementById('ticketStatusChart').getContext('2d');
    new Chart(ctxTkt, {
        type: 'pie',
        data: {
            labels: ['Đã xác nhận', 'Chờ xử lý', 'Đã hủy'],
            datasets: [{
                data: [ticketStatusData.confirmed, ticketStatusData.pending, ticketStatusData.cancelled],
                backgroundColor: ['#22c55e', '#f59e0b', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/statistics/index.blade.php ENDPATH**/ ?>