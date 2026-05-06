<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Báo cáo Doanh thu hàng ngày</h3>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>Ngày</th>
                        <th>Số đặt vé</th>
                        <th>Số vé xuất</th>
                        <th>Tổng doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td><i class='bx bx-calendar'></i> <?php echo e(\Carbon\Carbon::parse($report->report_date)->format('d/m/Y')); ?></td>
                        <td><span class="badge bg-primary"><?php echo e(number_format($report->total_bookings)); ?></span></td>
                        <td><span class="badge bg-info text-dark"><?php echo e(number_format($report->total_tickets)); ?></span></td>
                        <td><strong><?php echo e(number_format($report->total_revenue)); ?> ₫</strong></td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr><td colspan="4" class="text-center text-muted py-4">Chưa có dữ liệu báo cáo nào</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3"><?php echo e($reports->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\daily_reports\index.blade.php ENDPATH**/ ?>