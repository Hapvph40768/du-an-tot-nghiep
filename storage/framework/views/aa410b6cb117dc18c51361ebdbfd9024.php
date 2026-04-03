

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Chỉnh sửa thông tin ghế</h4>
                
                <form action="<?php echo e(route('admin.seats.update', $seat->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Thuộc xe</label>
                        <select name="vehicle_id" class="form-select rounded-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($vehicle->id); ?>" <?php echo e($seat->vehicle_id == $vehicle->id ? 'selected' : ''); ?>>
                                    <?php echo e($vehicle->license_plate); ?> (<?php echo e($vehicle->type); ?>)
                                </option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Mã số ghế</label>
                        <input type="text" name="seat_number" value="<?php echo e(old('seat_number', $seat->seat_number)); ?>" class="form-control rounded-3">
                    </div>

                    <div class="pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">Cập nhật</button>
                        <a href="<?php echo e(route('admin.seats.index', ['vehicle_id' => $seat->vehicle_id])); ?>" class="btn btn-light px-4 border ms-2">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\seats\edit.blade.php ENDPATH**/ ?>