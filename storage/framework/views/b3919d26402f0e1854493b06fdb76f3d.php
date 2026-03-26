<?php $__env->startSection('content-main'); ?>
    <div class="container py-4">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Thêm tài xế mới</h4>
            </div>

            <div class="card-body">

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <strong>Có lỗi xảy ra:</strong>
                        <ul class="mb-0 mt-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <li><?php echo e($error); ?></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form action="<?php echo e(route('admin.drivers.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên tài xế</label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>" required>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số bằng lái</label>
                            <input type="text" name="license_number" class="form-control"
                                value="<?php echo e(old('license_number')); ?>" required>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số năm kinh nghiệm</label>
                            <input type="number" name="experience_years" class="form-control"
                                value="<?php echo e(old('experience_years')); ?>" min="0">
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                                <option value="busy" <?php echo e(old('status') == 'busy' ? 'selected' : ''); ?>>Busy</option>
                                <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                            </select>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ảnh tài xế</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Thông tin cá nhân</label>
                            <textarea name="personal_info" rows="4" class="form-control"><?php echo e(old('personal_info')); ?></textarea>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="<?php echo e(route('admin.drivers.index')); ?>" class="btn btn-secondary">
                            Quay lại danh sách
                        </a>

                        <button type="submit" class="btn btn-success">
                            Thêm tài xế
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/drivers/create.blade.php ENDPATH**/ ?>