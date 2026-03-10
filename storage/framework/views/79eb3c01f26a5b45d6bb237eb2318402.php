<?php $__env->startSection('content-main'); ?>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold"><i class="bx bx-user me-2 text-primary"></i> Quản lý Người dùng</h3>
            <small class="text-muted">Tổng: <?php echo e($users->total()); ?> người dùng</small>
        </div>

        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Tìm tên, email, phone..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Tất cả vai trò</option>
                        <option value="admin"     <?php echo e(request('role') === 'admin'     ? 'selected' : ''); ?>>Admin</option>
                        <option value="staff"     <?php echo e(request('role') === 'staff'     ? 'selected' : ''); ?>>Staff</option>
                        <option value="customer"  <?php echo e(request('role') === 'customer'  ? 'selected' : ''); ?>>Customer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active"  <?php echo e(request('status') === 'active'  ? 'selected' : ''); ?>>Active</option>
                        <option value="blocked" <?php echo e(request('status') === 'blocked' ? 'selected' : ''); ?>>Blocked</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Người dùng</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Email / Phone</th>
                            <th>Ngày tạo</th>
                            <th class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>#<?php echo e($user->id); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo e($user->avatar); ?>" alt="<?php echo e($user->name); ?>" class="rounded-circle me-3" width="40" height="40">
                                        <div>
                                            <div class="fw-semibold"><?php echo e($user->name); ?></div>
                                            <small class="text-muted">ID: <?php echo e($user->id); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($user->role === 'admin' ? 'danger' : ($user->role === 'staff' ? 'warning' : 'info')); ?>">
                                        <?php echo e(ucfirst($user->role)); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($user->status === 'active' ? 'success' : 'danger'); ?>">
                                        <?php echo e(ucfirst($user->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php echo e($user->email ?? '-'); ?><br>
                                    <small><?php echo e($user->phone ?? '-'); ?></small>
                                </td>
                                <td class="text-muted small"><?php echo e($user->created_at->diffForHumans()); ?></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('admin.users.show', $user)); ?>" class="btn btn-sm btn-outline-info">Xem</a>
                                    <form action="<?php echo e(route('admin.users.toggle-status', $user)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="btn btn-sm <?php echo e($user->status === 'active' ? 'btn-outline-danger' : 'btn-outline-success'); ?>">
                                            <?php echo e($user->status === 'active' ? 'Chặn' : 'Mở'); ?>

                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="7" class="text-center py-5 text-muted">Không tìm thấy người dùng nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                <?php echo e($users->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/users/index.blade.php ENDPATH**/ ?>