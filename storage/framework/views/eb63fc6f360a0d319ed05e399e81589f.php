<?php $__env->startSection('content-main'); ?>
    <div style="padding: 24px;">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
            <div>
                <small style="color:#888;">Quản lý thông tin tài khoản</small>
            </div>

            <a href="<?php echo e(route('admin.users.index')); ?>"
                style="padding:8px 16px; border-radius:8px; background:#f5f5f5; text-decoration:none; color:#333; font-weight:500;">
                ← Quay lại
            </a>
        </div>

        <div style="background:white; border-radius:16px; padding:32px; box-shadow:0 4px 20px rgba(0,0,0,0.05);">

            <div style="display:grid; grid-template-columns:300px 1fr; gap:32px;">

                <div style="text-align:center; border-right:1px solid #f0f2f5; padding-right:24px;">

                    <div style="position:relative; display:inline-block;">
                        <img src="<?php echo e($user->avatar ?? 'https://via.placeholder.com/150'); ?>"
                            style="width:160px; height:160px; border-radius:50%; object-fit:cover; box-shadow:0 4px 12px rgba(0,0,0,0.1);">

                        <span
                            style="
                        position:absolute;
                        bottom:10px;
                        right:10px;
                        width:16px;
                        height:16px;
                        border-radius:50%;
                        border:3px solid white;
                        background: <?php echo e($user->status === 'active' ? '#52c41a' : '#ff4d4f'); ?>;
                    "></span>
                    </div>

                    <h4 style="margin-top:16px; font-weight:700;"><?php echo e($user->name); ?></h4>

                    <div style="margin-top:8px;">
                        <span
                            style="
                        padding:6px 14px;
                        border-radius:20px;
                        font-size:13px;
                        font-weight:600;
                        color:white;
                        background:
                        <?php echo e($user->role === 'admin' ? '#ff4d4f' : ($user->role === 'staff' ? '#faad14' : '#1890ff')); ?>;
                    ">
                            <?php echo e(ucfirst($user->role)); ?>

                        </span>
                    </div>

                    <div style="margin-top:10px;">
                        <span
                            style="
                        padding:6px 14px;
                        border-radius:20px;
                        font-size:13px;
                        font-weight:600;
                        background:
                            <?php echo e($user->status === 'active' ? '#f6ffed' : '#fff1f0'); ?>;
                        color:
                            <?php echo e($user->status === 'active' ? '#389e0d' : '#cf1322'); ?>;
                    ">
                            <?php echo e($user->status === 'active' ? 'Hoạt động' : 'Bị chặn'); ?>

                        </span>
                    </div>

                    <form action="<?php echo e(route('admin.users.toggle-status', $user)); ?>" method="POST" style="margin-top:20px;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <button type="submit"
                            style="
                            width:100%;
                            padding:10px;
                            border:none;
                            border-radius:8px;
                            font-weight:600;
                            cursor:pointer;
                            background:
                                <?php echo e($user->status === 'active' ? '#fff1f0' : '#f6ffed'); ?>;
                            color:
                                <?php echo e($user->status === 'active' ? '#cf1322' : '#389e0d'); ?>;
                        ">
                            <?php echo e($user->status === 'active' ? '🚫 Chặn tài khoản' : '✅ Mở khóa'); ?>

                        </button>
                    </form>

                </div>

                <div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                        <div style="padding:16px; border-radius:12px; background:#fafafa;">
                            <small style="color:#888;">Email</small>
                            <div style="font-weight:600; margin-top:4px;">
                                <?php echo e($user->email ?? 'Chưa cập nhật'); ?>

                            </div>
                        </div>

                        <div style="padding:16px; border-radius:12px; background:#fafafa;">
                            <small style="color:#888;">Số điện thoại</small>
                            <div style="font-weight:600; margin-top:4px;">
                                <?php echo e($user->phone ?? 'Chưa cập nhật'); ?>

                            </div>
                        </div>

                        <div style="padding:16px; border-radius:12px; background:#fafafa;">
                            <small style="color:#888;">Ngày tạo</small>
                            <div style="font-weight:600; margin-top:4px;">
                                <?php echo e($user->created_at->format('d/m/Y H:i')); ?>

                            </div>
                            <small style="color:#aaa;">
                                <?php echo e($user->created_at->diffForHumans()); ?>

                            </small>
                        </div>

                        <div style="padding:16px; border-radius:12px; background:#fafafa;">
                            <small style="color:#888;">Cập nhật lần cuối</small>
                            <div style="font-weight:600; margin-top:4px;">
                                <?php echo e($user->updated_at->format('d/m/Y H:i')); ?>

                            </div>
                        </div>

                    </div>

                    <div style="margin-top:24px; padding:16px; border-radius:12px; background:#f0f5ff; color:#1d39c4;">
                        ℹ️ Đây là thông tin cơ bản của người dùng trong hệ thống.
                    </div>

                </div>

            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\users\show.blade.php ENDPATH**/ ?>