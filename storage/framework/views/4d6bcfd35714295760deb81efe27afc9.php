<?php $__env->startSection('content-main'); ?>

<div class="top-header">
    <div class="header-title">
        <h1>Chi Tiết Tuyến Xe</h1>
        <p>Tuyến xe #<?php echo e($route->id); ?></p>
    </div>
</div>

<div style="max-width: 800px;">
    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        <div style="margin-bottom: 24px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div>
                    <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">ID</p>
                    <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;"><?php echo e($route->id); ?></p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Trạng thái</p>
                    <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">Hoạt động</p>
                </div>
            </div>

            <div style="border-top: 1px solid #f0f2f5; padding-top: 24px; margin-bottom: 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Điểm bắt đầu</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;"><?php echo e($route->startLocation->name ?? '--'); ?></p>
                    </div>
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Điểm đến</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;"><?php echo e($route->endLocation->name ?? '--'); ?></p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Khoảng cách</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;"><?php echo e($route->distance_km); ?> km</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Thời gian dự kiến</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;"><?php echo e($route->estimated_time); ?> phút</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px;">
            <a href="<?php echo e(route('routes.edit', $route->id)); ?>" style="display: inline-block; background-color: #fff7e6; color: #ff7a45; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">Sửa</a>
            <a href="<?php echo e(route('routes.index')); ?>" style="display: inline-block; background-color: #f0f2f5; color: #333; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">Quay lại</a>
            <form action="<?php echo e(route('routes.destroy', $route->id)); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" style="background-color: #fee; color: #c33; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;" onclick="return confirm('Bạn chắc chứ?')">Xóa</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/routes/show.blade.php ENDPATH**/ ?>