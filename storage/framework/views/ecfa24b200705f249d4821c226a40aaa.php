<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h3 class="fw-bold mb-4">Cập nhật thông tin</h3>
                <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Họ tên</label>
                        <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control rounded-3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Email</label>
                        <input type="text" value="<?php echo e($user->email); ?>" class="form-control rounded-3" disabled>
                        <small class="text-muted">Không thể thay đổi email hệ thống.</small>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Vai trò</label>
                            <select name="role" class="form-select rounded-3">
                                <option value="customer" <?php echo e($user->role == 'customer' ? 'selected' : ''); ?>>Customer</option>
                                <option value="staff" <?php echo e($user->role == 'staff' ? 'selected' : ''); ?>>Staff</option>
                                <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Trạng thái</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="active" <?php echo e($user->status == 'active' ? 'selected' : ''); ?>>Hoạt động</option>
                                <option value="blocked" <?php echo e($user->status == 'blocked' ? 'selected' : ''); ?>>Khóa tài khoản</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-primary" style="background: #ff6b00; border:none; border-radius: 10px; padding: 10px 20px;">Cập nhật</button>
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-light border" style="border-radius: 10px; padding: 10px 20px;">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep-main\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>