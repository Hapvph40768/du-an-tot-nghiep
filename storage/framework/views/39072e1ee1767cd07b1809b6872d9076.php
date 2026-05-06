<?php $__env->startSection('title', 'Quản lý Đơn hàng'); ?>
<?php $__env->startSection('header-title', 'QUẢN LÝ ĐƠN HÀNG'); ?>
<?php $__env->startSection('header-subtitle', 'Theo dõi và xử lý đặt vé'); ?>

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <form action="<?php echo e(route('orders.index')); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class='bx bx-search'></i></span>
                        <input type="text" name="keyword" value="<?php echo e(request('keyword')); ?>" class="form-control" placeholder="Tìm theo mã đơn, tên, SĐT...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Chờ xác nhận</option>
                        <option value="paid" <?php echo e(request('status') == 'paid' ? 'selected' : ''); ?>>Đã thanh toán</option>
                        <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Hoàn thành</option>
                        <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <button type="submit" class="btn btn-primary w-100">Lọc Dữ Liệu</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3">Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Chuyến xe</th>
                        <th>Ghế</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td class="px-3 fw-bold text-primary"><?php echo e($order->order_code); ?></td>
                        <td>
                            <div class="fw-bold"><?php echo e($order->user ? $order->user->name : 'Khách vãng lai'); ?></div>
                            <small class="text-muted"><?php echo e($order->user ? $order->user->phone : ''); ?></small>
                        </td>
                        <td><span class="text-muted">Đang cập nhật...</span></td>
                        <td><span class="text-muted">...</span></td>
                        
                        <td class="fw-bold text-danger"><?php echo e(number_format($order->amount, 0, ',', '.')); ?> đ</td>
                        <td>
                            <div><?php echo e($order->created_at->format('d/m/Y')); ?></div>
                            <small class="text-muted"><?php echo e($order->created_at->format('H:i')); ?></small>
                        </td>
                        <td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status == 'pending'): ?>
                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                            <?php elseif($order->status == 'paid'): ?>
                                <span class="badge bg-info text-dark">Đã thanh toán</span>
                            <?php elseif($order->status == 'completed'): ?>
                                <span class="badge bg-success">Hoàn thành</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Đã hủy</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary mx-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($order->id); ?>" title="Chỉnh sửa">
                                <i class='bx bx-edit'></i> Sửa
                            </button>

                            <form action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                    <i class='bx bx-trash'></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal<?php echo e($order->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($order->id); ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editModalLabel<?php echo e($order->id); ?>">Cập nhật Đơn hàng: <?php echo e($order->order_code); ?></h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo e(route('orders.update', $order->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Tổng tiền (VNĐ)</label>
                                                <input type="number" name="amount" class="form-control" value="<?php echo e($order->amount); ?>">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Trạng thái</label>
                                                <select name="status" class="form-select">
                                                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Chờ xác nhận</option>
                                                    <option value="paid" <?php echo e($order->status == 'paid' ? 'selected' : ''); ?>>Đã thanh toán</option>
                                                    <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Hoàn thành</option>
                                                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Đã hủy</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Không tìm thấy đơn hàng nào.</td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            <?php echo e($orders->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\orders\index.blade.php ENDPATH**/ ?>