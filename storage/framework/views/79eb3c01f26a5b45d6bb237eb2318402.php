<?php $__env->startSection('title', 'Quản lý Người dùng'); ?>

<?php $__env->startSection('content-main'); ?>
<<<<<<< HEAD
    <div class="top-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <small style="color: #666;">Tổng: <?php echo e($users->total()); ?> người dùng</small>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding:16px;">ID</th>
                    <th style="padding:16px;">Người dùng</th>
                    <th style="padding:16px;">Vai trò</th>
                    <th style="padding:16px;">Trạng thái</th>
                    <th style="padding:16px;">Email / Phone</th>
                    <th style="padding:16px;">Ngày tạo</th>
                    <th style="padding:16px; text-align:center;">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr style="border-bottom: 1px solid #f0f2f5;">

                        
                        <td style="padding:16px;">#<?php echo e($user->id); ?></td>

                        
                        <td style="padding:16px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <img src="<?php echo e($user->avatar ?? 'https://via.placeholder.com/40'); ?>"
                                    style="width:40px; height:40px; border-radius:50%;">
                                <div>
                                    <div style="font-weight:600;"><?php echo e($user->name); ?></div>
                                    <small style="color:#999;">ID: <?php echo e($user->id); ?></small>
                                </div>
                            </div>
                        </td>

                        
                        <td style="padding:16px;">
                            <span
                                style="
                                padding:4px 10px;
                                border-radius:6px;
                                font-size:12px;
                                font-weight:600;
                                color:white;
                                background:
                                    <?php echo e($user->role === 'admin' ? '#ff4d4f' : ($user->role === 'staff' ? '#faad14' : '#1890ff')); ?>;
                            ">
                                <?php echo e(ucfirst($user->role)); ?>

                            </span>
                        </td>

                        
                        <td style="padding:16px;">
                            <span
                                style="
                                padding:4px 10px;
                                border-radius:6px;
                                font-size:12px;
                                font-weight:600;
                                color:white;
                                background:
                                    <?php echo e($user->status === 'active' ? '#52c41a' : '#ff4d4f'); ?>;
                            ">
                                <?php echo e($user->status === 'active' ? 'Hoạt động' : 'Đã chặn'); ?>

                            </span>
                        </td>

                        
                        <td style="padding:16px;">
                            <?php echo e($user->email ?? '-'); ?> <br>
                            <small><?php echo e($user->phone ?? '-'); ?></small>
                        </td>

                        
                        <td style="padding:16px; color:#999;">
                            <?php echo e($user->created_at->diffForHumans()); ?>

                        </td>

                        
                        <td style="padding:16px; text-align:center;">

                            
                            <a href="<?php echo e(route('admin.users.show', $user)); ?>"
                                style="background:#e6f7ff; color:#1890ff; padding:6px 12px; border-radius:6px; font-size:12px; font-weight:600; text-decoration:none; margin-right:6px;">
                                Xem
                            </a>

                            
                            <form action="<?php echo e(route('admin.users.toggle-status', $user)); ?>" method="POST"
                                style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>

                                <button type="submit"
                                    style="
                                        padding:6px 12px;
                                        border:none;
                                        border-radius:6px;
                                        font-size:12px;
                                        font-weight:600;
                                        cursor:pointer;
                                        background:
                                            <?php echo e($user->status === 'active' ? '#fff1f0' : '#f6ffed'); ?>;
                                        color:
                                            <?php echo e($user->status === 'active' ? '#cf1322' : '#389e0d'); ?>;
                                    ">
                                    <?php echo e($user->status === 'active' ? 'Chặn' : 'Mở'); ?>

                                </button>
                            </form>

                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="7" style="padding:32px; text-align:center; color:#999;">
                            Không có người dùng nào
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>

    </div>

    <div style="margin-top:20px; display:flex; justify-content:center;">
        <?php echo e($users->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
=======
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0; table-layout: fixed; }
    .custom-table thead th { background-color: #f9fafb; color: #6b7280; font-weight: 600; font-size: 12px; text-transform: uppercase; padding: 16px; border-bottom: 2px solid #edf2f7; text-align: left; }
    .custom-table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; text-align: left; font-size: 14px; }
    .btn-primary-custom { background-color: var(--primary-color); border: none; color: white; padding: 8px 18px; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: 0.3s; }
    .btn-primary-custom:hover { background-color: var(--primary-hover); color: white; transform: translateY(-2px); }
    .badge-role { padding: 5px 10px; border-radius: 8px; font-size: 11px; font-weight: 600; }
    .role-admin { background: #fee2e2; color: #dc2626; }
    .role-staff { background: #e0e7ff; color: #4338ca; }
    .role-customer { background: #f3f4f6; color: #374151; }
    .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 5px; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Quản lý tài khoản</h2>
            <p class="text-muted small mb-0">Hệ thống có tổng cộng <?php echo e($users->total()); ?> thành viên</p>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            <i class='bx bx-check-circle'></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card-box">
        <div class="table-responsive">
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 25%;">Họ tên / Email</th>
                        <th style="width: 15%;">Số điện thoại</th>
                        <th style="width: 15%;">Vai trò</th>
                        <th style="width: 15%;">Trạng thái</th>
                        <th style="width: 15%;">Ngày tạo</th>
                        <th class="text-end pe-4" style="width: 15%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?php echo e($user->name); ?></div>
                                <div class="text-muted small"><?php echo e($user->email); ?></div>
                            </td>
                            <td><?php echo e($user->phone ?? '—'); ?></td>
                            <td>
                                <span class="badge-role role-<?php echo e($user->role); ?>">
                                    <?php echo e(ucfirst($user->role)); ?>

                                </span>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->status == 'active'): ?>
                                    <span class="text-success small fw-bold"><span class="status-dot bg-success"></span>Hoạt động</span>
                                <?php else: ?>
                                    <span class="text-danger small fw-bold"><span class="status-dot bg-danger"></span>Đã khóa</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-muted small"><?php echo e($user->created_at->format('d/m/Y')); ?></td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-light border" title="Sửa">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" onsubmit="return confirm('Xóa người dùng này?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-light border text-danger" title="Xóa">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <?php echo e($users->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
>>>>>>> 9c9ec7d6db15ce235832f97d90478d9c32b652ce

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/users/index.blade.php ENDPATH**/ ?>