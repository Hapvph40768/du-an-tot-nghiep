<?php $__env->startSection('title', 'Chi tiết đơn hàng - ' . $order->order_code); ?>
<?php $__env->startSection('header-title', 'CHI TIẾT ĐƠN HÀNG'); ?>
<?php $__env->startSection('header-subtitle', 'Mã: ' . $order->order_code); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .order-card {
        border-radius: 1.25rem; border: none;
        box-shadow: 0 10px 30px rgba(255, 122, 24, 0.1); transition: all 0.3s ease;
    }
    .order-card:hover { transform: scale(1.02); box-shadow: 0 15px 40px rgba(255, 122, 24, 0.2); }
    .bg-gradient-orange { background: linear-gradient(135deg, #ffb347 0%, #ff7a18 100%); }
    .btn-orange {
        background: linear-gradient(135deg, #ffb347 0%, #ff7a18 100%); color: white;
        border: none; border-radius: 0.75rem; font-weight: bold; transition: all 0.3s ease;
    }
    .btn-orange:hover {
        background: linear-gradient(135deg, #ff7a18 0%, #e65c00 100%); color: white;
        transform: translateY(-3px); box-shadow: 0 8px 20px rgba(255, 122, 24, 0.4);
    }
    .badge-status { font-size: 0.9rem; padding: 0.5em 1em; border-radius: 2rem; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="card order-card bg-white">
                <div class="card-header bg-gradient-orange text-white text-center py-4 border-0" style="border-radius: 1.25rem 1.25rem 0 0;">
                    <h4 class="mb-0 fw-bold text-uppercase">Chi Tiết Đơn Hàng</h4>
                    <p class="mb-0 mt-1 opacity-75 small">Mã: <?php echo e($order->order_code); ?></p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                            <span class="text-muted fw-semibold">Khách hàng</span>
                            <span class="fw-bold"><?php echo e($order->user->name ?? 'Khách vãng lai'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                            <span class="text-muted fw-semibold">Số tiền</span>
                            <span class="fw-bold fs-5" style="color: #ff7a18;"><?php echo e(number_format($order->amount)); ?> VNĐ</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                            <span class="text-muted fw-semibold">Phương thức</span>
                            <span class="badge bg-secondary badge-status text-uppercase"><?php echo e($order->payment_method); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom-0">
                            <span class="text-muted fw-semibold">Trạng thái</span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status == 'pending'): ?>
                                <span class="badge bg-warning text-dark badge-status">⏳ Chờ xử lý</span>
                            <?php elseif($order->status == 'paid' || $order->status == 'completed'): ?>
                                <span class="badge bg-success badge-status">✅ Đã thanh toán</span>
                            <?php else: ?>
                                <span class="badge bg-info text-dark badge-status"><?php echo e(ucfirst($order->status)); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </li>
                    </ul>

                    <div class="d-grid gap-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status == 'pending'): ?>
                            <a href="<?php echo e(route('payments.create', $order->id)); ?>" class="btn btn-orange py-3 fs-6">
                                <i class='bx bx-credit-card me-2'></i> Thanh toán với MoMo
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-light text-secondary fw-bold py-3 fs-6 rounded-4 border">
                            Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\orders\show.blade.php ENDPATH**/ ?>