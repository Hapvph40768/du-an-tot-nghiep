<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?><li><?php echo e($e); ?></li><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></ul></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Thêm Quy tắc Giá vé mới</h4>
                <form action="<?php echo e(route('admin.price_rules.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Tên quy tắc (VD: Tết Nguyên Đán 2025)</label>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control rounded-3 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Loại điều chỉnh</label>
                            <select name="type" class="form-select rounded-3">
                                <option value="percentage" <?php echo e(old('type')=='percentage'?'selected':''); ?>>Tăng theo % (Phần trăm)</option>
                                <option value="fixed" <?php echo e(old('type')=='fixed'?'selected':''); ?>>Tăng cố định (VNĐ)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Giá trị điều chỉnh</label>
                            <input type="number" name="value" value="<?php echo e(old('value')); ?>" step="0.01" class="form-control rounded-3 <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="VD: 15 hoặc 50000">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Ngày bắt đầu áp dụng</label>
                            <input type="date" name="start_date" value="<?php echo e(old('start_date')); ?>" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Ngày kết thúc áp dụng</label>
                            <input type="date" name="end_date" value="<?php echo e(old('end_date')); ?>" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">Lưu quy tắc</button>
                        <a href="<?php echo e(route('admin.price_rules.index')); ?>" class="btn btn-light px-4 border">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/price_rules/create.blade.php ENDPATH**/ ?>