<?php $__env->startSection('title', 'Kết quả giao dịch'); ?>
<?php $__env->startSection('header-title', 'KẾT QUẢ GIAO DỊCH'); ?>
<?php $__env->startSection('header-subtitle', 'Trạng thái thanh toán đơn hàng'); ?>

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 text-center">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'success'): ?>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">✓</div>
                    <h3 class="fw-bold text-dark mb-2">Thanh toán thành công 🎉</h3>
                    <p class="text-muted mb-4">Đơn hàng của bạn đã được thanh toán.</p>
                <?php elseif($status === 'waiting'): ?>
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">⏱</div>
                    <h3 class="fw-bold text-dark mb-2">Đang chờ xác nhận</h3>
                    <p class="text-muted mb-4">Chúng tôi đang kiểm tra giao dịch chuyển khoản của bạn.</p>
                <?php elseif($status === 'cod'): ?>
                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">📦</div>
                    <h3 class="fw-bold text-dark mb-2">Đặt vé thành công</h3>
                    <p class="text-muted mb-4">Vui lòng thanh toán khi nhận vé.</p>
                <?php else: ?>
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">✗</div>
                    <h3 class="fw-bold text-dark mb-2">Thanh toán thất bại ❌</h3>
                    <p class="text-muted mb-4">Đã có lỗi xảy ra hoặc bạn đã hủy giao dịch.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="bg-light rounded-4 p-3 text-start border mb-4 text-sm">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Mã đơn hàng:</span>
                        <span class="fw-bold"><?php echo e($order->order_code ?? 'N/A'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Số tiền:</span>
                        <span class="fw-bold" style="color: #ff7a18;"><?php echo e(number_format($order->amount ?? 0)); ?> VNĐ</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Phương thức:</span>
                        <span class="fw-bold text-uppercase"><?php echo e($order->payment_method ?? 'N/A'); ?></span>
                    </div>
                </div>

                <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-light border text-dark fw-bold py-3 rounded-4 w-100 shadow-sm hover-bg-gray">
                    Quay lại bảng điều khiển
                </a>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\checkout\payment_result.blade.php ENDPATH**/ ?>