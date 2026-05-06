

<?php $__env->startSection('header-title', 'CHI TIẾT GIÁ KÝ GỬI'); ?>
<?php $__env->startSection('header-subtitle', 'Thông tin chi tiết bảng giá ký gửi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-bottom p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <?php echo e($parcelPrice->route->departureLocation->name ?? '...'); ?> 
                            <i class="fas fa-arrow-right text-muted mx-2"></i> 
                            <?php echo e($parcelPrice->route->destinationLocation->name ?? '...'); ?>

                        </h5>
                        <a href="<?php echo e(route('admin.parcel_prices.index')); ?>" class="btn btn-sm btn-secondary">
                            <i class='bx bx-arrow-back'></i> Quay lại
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Từ (kg)</label>
                                <p class="fw-bold text-lg"><?php echo e(number_format($parcelPrice->weight_from, 2)); ?> kg</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Đến (kg)</label>
                                <p class="fw-bold text-lg"><?php echo e(number_format($parcelPrice->weight_to, 2)); ?> kg</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small">Giá (VNĐ)</label>
                        <p class="fw-bold text-danger" style="font-size: 1.5rem;">
                            <?php echo e(number_format($parcelPrice->price, 0, ',', '.')); ?> đ
                        </p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parcelPrice->description): ?>
                        <div class="mb-4">
                            <label class="form-label text-muted small">Mô tả</label>
                            <p class="text-dark"><?php echo e($parcelPrice->description); ?></p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="border-top pt-4 mt-4">
                        <label class="form-label text-muted small">Thông tin hệ thống</label>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Ngày tạo</small>
                                <p class="fw-bold"><?php echo e($parcelPrice->created_at->format('d/m/Y H:i')); ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Lần cập nhật cuối</small>
                                <p class="fw-bold"><?php echo e($parcelPrice->updated_at->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light p-4 d-flex gap-2 justify-content-end">
                    <a href="<?php echo e(route('admin.parcel_prices.edit', $parcelPrice->id)); ?>" class="btn btn-warning">
                        <i class='bx bx-edit'></i> Chỉnh sửa
                    </a>
                    <form action="<?php echo e(route('admin.parcel_prices.destroy', $parcelPrice->id)); ?>" method="POST" style="display:inline;" 
                        onsubmit="return confirm('Xác nhận xóa bảng giá này?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">
                            <i class='bx bx-trash'></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\parcel_prices\show.blade.php ENDPATH**/ ?>