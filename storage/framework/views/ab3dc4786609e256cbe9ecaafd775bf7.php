<?php $__env->startSection('content-main'); ?>
    <?php echo $__env->yieldContent('content'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>