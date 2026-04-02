<?php $__env->startSection('title', 'Quản lý Người dùng'); ?>

<?php $__env->startSection('content-main'); ?>
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

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/users/index.blade.php ENDPATH**/ ?>