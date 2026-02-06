<?php $__env->startSection('content-main'); ?>

<div class="top-header">
    <div class="header-title">
        <h1>Quản lý Tuyến Xe</h1>
        <p>Danh sách tất cả các tuyến xe trong hệ thống</p>
    </div>
    <div style="display: flex; gap: 12px;">
        <a href="<?php echo e(route('routes.create')); ?>" style="background-color: #ff5b24; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">+ Tạo tuyến xe</a>
    </div>
</div>

<?php if($message = Session::get('success')): ?>
    <div style="background-color: #f6ffed; border: 1px solid #b7eb8f; color: #52c41a; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        <?php echo e($message); ?>

    </div>
<?php endif; ?>

<div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
        <thead>
            <tr style="border-bottom: 2px solid #f0f2f5;">
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">ID</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Điểm bắt đầu</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Điểm đến</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Khoảng cách</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Thời gian</th>
                <th style="padding: 16px; text-align: center; font-weight: 600; color: #666;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid #f0f2f5;">
                    <td style="padding: 16px;"><?php echo e($route->id); ?></td>
                    <td style="padding: 16px;"><?php echo e($route->startLocation->name ?? '--'); ?></td>
                    <td style="padding: 16px;"><?php echo e($route->endLocation->name ?? '--'); ?></td>
                    <td style="padding: 16px;"><?php echo e($route->distance_km); ?> km</td>
                    <td style="padding: 16px;"><?php echo e($route->estimated_time); ?> phút</td>
                    <td style="padding: 16px; text-align: center;">
                        <a href="<?php echo e(route('routes.show', $route->id)); ?>" style="display: inline-block; background-color: #e6f7ff; color: #1890ff; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin-right: 6px;">Xem</a>
                        <a href="<?php echo e(route('routes.edit', $route->id)); ?>" style="display: inline-block; background-color: #fff7e6; color: #ff7a45; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin-right: 6px;">Sửa</a>
                        <form action="<?php echo e(route('routes.destroy', $route->id)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" style="background-color: #fee; color: #c33; padding: 6px 12px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;" onclick="return confirm('Bạn chắc chứ?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" style="padding: 32px; text-align: center; color: #999;">Chưa có tuyến xe nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div style="margin-top: 20px; display: flex; justify-content: center;">
    <?php echo e($routes->links()); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/routes/index.blade.php ENDPATH**/ ?>