

<?php $__env->startSection('header-title', 'Quản lý Tài khoản'); ?>
<?php $__env->startSection('header-subtitle', 'Phân quyền và quản lý người dùng hệ thống'); ?>

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid px-0">
    <!-- Header Summary -->
    <div class="card border-0 mb-4 p-4 dash-card">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
            <div class="d-flex align-items-center gap-4">
                <div class="dash-icon-bg" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width: 60px; height: 60px;">
                    <i class='bx bx-group fs-1'></i>
                </div>
                <div>
                    <h3 class="fw-bold text-dark mb-1">NGƯỜI DÙNG</h3>
                    <p class="text-muted small fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">Hệ thống có <?php echo e($users->total()); ?> thành viên</p>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="bg-light px-4 py-2 rounded-3 border text-center">
                    <p class="text-success small fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">Active</p>
                    <p class="fw-bold text-dark fs-5 mb-0"><?php echo e($users->where('status', 'active')->count()); ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="alert alert-success d-flex align-items-center mb-4 border-0 shadow-sm" style="border-radius: 12px;">
        <i class='bx bx-check-circle fs-4 me-2'></i>
        <div class="fw-bold"><?php echo e(session('success')); ?></div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Table Container -->
    <div class="card border-0 p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Họ tên / Email</th>
                        <th>Vai Trò</th>
                        <th>Liên Hệ</th>
                        <th>Trạng Thái</th>
                        <th class="text-end pe-4">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark"><?php echo e($user->name); ?></span>
                                <span class="text-muted small"><?php echo e($user->email); ?></span>
                            </div>
                        </td>
                        <td>
                            <?php
                                $roleConfig = [
                                    'admin' => ['bg' => 'danger', 'label' => 'Quản trị'],
                                    'staff' => ['bg' => 'warning', 'label' => 'Nhân viên'],
                                    'customer' => ['bg' => 'secondary', 'label' => 'Khách hàng'],
                                ][$user->role] ?? ['bg' => 'secondary', 'label' => $user->role];
                            ?>
                            <span class="badge bg-<?php echo e($roleConfig['bg']); ?> bg-opacity-10 text-<?php echo e($roleConfig['bg']); ?> border border-<?php echo e($roleConfig['bg']); ?> border-opacity-25">
                                <?php echo e($roleConfig['label']); ?>

                            </span>
                        </td>
                        <td>
                            <span class="text-dark fw-bold"><?php echo e($user->phone ?? '—'); ?></span>
                        </td>
                        <td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->status == 'active'): ?>
                                <div class="d-flex align-items-center gap-2 text-success fw-bold small">
                                    <i class='bx bxs-circle' style="font-size: 8px;"></i>
                                    <span>Đang chạy</span>
                                </div>
                            <?php else: ?>
                                <div class="d-flex align-items-center gap-2 text-danger fw-bold small">
                                    <i class='bx bxs-circle' style="font-size: 8px;"></i>
                                    <span>Đã khóa</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-light border text-primary" title="Cài đặt">
                                    <i class='bx bx-cog'></i>
                                </a>
                                <form action="<?php echo e(route('admin.users.toggle-status', $user->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-light border <?php echo e($user->status === 'active' ? 'text-danger' : 'text-success'); ?>" title="Khóa/Mở khóa">
                                        <i class='bx bx-<?php echo e($user->status === 'active' ? 'lock-alt' : 'lock-open-alt'); ?>'></i>
                                    </button>
                                </form>
                                <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" onsubmit="return confirm('Xác nhận xóa tài khoản?')" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Xóa">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted mb-2"><i class='bx bx-search fs-1'></i></div>
                            <p class="fw-bold text-muted mb-0">Không tìm thấy dữ liệu phù hợp</p>
                        </td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($users->hasPages()): ?>
        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center p-4">
            <small class="text-muted fw-bold">Hiển thị <?php echo e($users->count()); ?> / <?php echo e($users->total()); ?> người dùng</small>
            <div>
                <?php echo e($users->links('pagination::bootstrap-5')); ?>

            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/users/index.blade.php ENDPATH**/ ?>