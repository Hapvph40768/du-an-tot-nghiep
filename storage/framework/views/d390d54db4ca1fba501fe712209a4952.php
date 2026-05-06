<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?><li><?php echo e($e); ?></li><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></ul></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Chỉnh sửa Đơn ký gửi #<?php echo e($parcel->id); ?></h4>
                <form action="<?php echo e(route('admin.parcels.update', $parcel->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Tên người gửi</label>
                            <input type="text" name="sender_name" value="<?php echo e(old('sender_name', $parcel->sender_name)); ?>" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">SĐT người gửi</label>
                            <input type="text" name="sender_phone" value="<?php echo e(old('sender_phone', $parcel->sender_phone)); ?>" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Tên người nhận</label>
                            <input type="text" name="receiver_name" value="<?php echo e(old('receiver_name', $parcel->receiver_name)); ?>" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">SĐT người nhận</label>
                            <input type="text" name="receiver_phone" value="<?php echo e(old('receiver_phone', $parcel->receiver_phone)); ?>" class="form-control rounded-3">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Mô tả hàng hoá</label>
                            <textarea name="description" rows="2" class="form-control rounded-3"><?php echo e(old('description', $parcel->description)); ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Khối lượng (kg)</label>
                            <input type="number" step="0.01" name="weight" value="<?php echo e(old('weight', $parcel->weight)); ?>" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Phí vận chuyển (VNĐ)</label>
                            <input type="number" name="price" value="<?php echo e(old('price', $parcel->price)); ?>" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Trạng thái</label>
                            <select name="status" class="form-select rounded-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['pending'=>'Chờ xử lý','shipping'=>'Đang vận chuyển','completed'=>'Hoàn thành','cancelled'=>'Đã huỷ']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($val); ?>" <?php echo e(old('status', $parcel->status)==$val?'selected':''); ?>><?php echo e($label); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Tuyến đường</label>
                            <select name="route_id" class="form-select rounded-3">
                                <option value="">-- Chọn tuyến đường --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($route->id); ?>" <?php echo e(old('route_id', $parcel->route_id)==$route->id?'selected':''); ?>>
                                        <?php echo e($route->departureLocation->name ?? ''); ?> → <?php echo e($route->destinationLocation->name ?? ''); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">Cập nhật</button>
                        <a href="<?php echo e(route('admin.parcels.index')); ?>" class="btn btn-light px-4 border">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\parcels\edit.blade.php ENDPATH**/ ?>