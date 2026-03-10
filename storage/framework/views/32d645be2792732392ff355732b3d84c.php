<?php $__env->startSection('content-main'); ?>

<div class="top-header">
    <div class="header-title">
        <h1>Chi tiết Đánh giá</h1>
        <p>Đánh giá #<?php echo e($review->id); ?></p>
    </div>
    <div></div>
</div>

<div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
    <p><strong>ID:</strong> <?php echo e($review->id); ?></p>
    <p><strong>Người dùng:</strong> <?php echo e($review->user->name ?? ('#' . $review->user_id)); ?></p>
    <p><strong>Booking:</strong> #<?php echo e($review->booking_id); ?></p>
    <p><strong>Trip:</strong> #<?php echo e($review->trip_id); ?></p>
    <p><strong>Rating:</strong> <?php echo e($review->rating); ?> / 5</p>
    <p><strong>Comment:</strong></p>
    <div style="background:#fafafa;padding:12px;border-radius:8px;margin-top:8px;"><?php echo e($review->comment); ?></div>

    <div style="margin-top:16px;display:flex;gap:8px;">
        <a href="<?php echo e(route('admin.reviews.edit', $review->id)); ?>" style="background:#fff7e6;padding:10px 16px;border-radius:8px;text-decoration:none;color:#ff7a45;">Sửa</a>
        <a href="<?php echo e(route('admin.reviews.index')); ?>" style="background:#f0f0f0;padding:10px 16px;border-radius:8px;text-decoration:none;color:#333;">Quay lại</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/reviews/show.blade.php ENDPATH**/ ?>