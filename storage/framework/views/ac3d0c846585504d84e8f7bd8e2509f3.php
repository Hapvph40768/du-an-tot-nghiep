<?php $__env->startSection('content-main'); ?>

<div class="top-header">
    <div class="header-title">
        <h1>Sửa Đánh giá</h1>
        <p>Chỉnh sửa đánh giá #<?php echo e($review->id); ?></p>
    </div>
    <div></div>
</div>

<?php if($errors->any()): ?>
    <div style="background:#fff1f0;border:1px solid #ffa39e;padding:12px 16px;border-radius:8px;margin-bottom:20px;color:#c0392b;">
        <ul style="margin:0;padding-left:18px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
    <form action="<?php echo e(route('admin.reviews.update', $review->id)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div style="margin-bottom:12px;">
            <label>Người dùng</label>
            <select name="user_id" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn người dùng --</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $review->user_id ? 'selected' : ''); ?>><?php echo e($user->name); ?> (<?php echo e($user->email); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Booking</label>
            <select name="booking_id" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn booking --</option>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($b->id); ?>" <?php echo e($b->id == $review->booking_id ? 'selected' : ''); ?>>#<?php echo e($b->id); ?> - User <?php echo e($b->user_id); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Trip</label>
            <select name="trip_id" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn trip --</option>
                <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($t->id); ?>" <?php echo e($t->id == $review->trip_id ? 'selected' : ''); ?>>#<?php echo e($t->id); ?> - <?php echo e($t->departure_time ?? ''); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Rating</label>
            <select name="rating" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn rating --</option>
                <?php for($i=1;$i<=5;$i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e($i == $review->rating ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Comment</label>
            <textarea name="comment" rows="4" style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;"><?php echo e($review->comment); ?></textarea>
        </div>

        <div style="display:flex;gap:8px;">
            <button type="submit" style="background:#ff5b24;color:#fff;padding:10px 16px;border-radius:8px;border:none;">Lưu</button>
            <a href="<?php echo e(route('admin.reviews.index')); ?>" style="background:#f0f0f0;padding:10px 16px;border-radius:8px;text-decoration:none;color:#333;">Hủy</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/reviews/edit.blade.php ENDPATH**/ ?>