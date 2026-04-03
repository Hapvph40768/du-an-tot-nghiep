<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h3 class="fw-bold mb-4 text-primary">Cập nhật lịch trình: #<?php echo e($trip->id); ?></h3>
                <form action="<?php echo e(route('admin.trips.update', $trip->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Tuyến đường</label>
                            <select name="route_id" class="form-select rounded-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($route->id); ?>" <?php echo e($trip->route_id == $route->id ? 'selected' : ''); ?>>
                                        <?php echo e($route->departureLocation->name); ?> → <?php echo e($route->destinationLocation->name); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ngày khởi hành</label>
                            <input type="date" name="trip_date" class="form-control rounded-3" value="<?php echo e($trip->trip_date); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Giờ xuất bến</label>
                            <input type="time" name="departure_time" class="form-control rounded-3" value="<?php echo e($trip->departure_time); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Giờ đến</label>
                            <input type="time" name="arrival_time" class="form-control rounded-3" value="<?php echo e($trip->arrival_time); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Xe phụ trách</label>
                            <select name="vehicle_id" class="form-select rounded-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($vehicle->id); ?>" <?php echo e($trip->vehicle_id == $vehicle->id ? 'selected' : ''); ?>>
                                        <?php echo e($vehicle->license_plate); ?> (<?php echo e($vehicle->type); ?>)
                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Trạng thái chuyến đi</label>
                            <select name="status" class="form-select rounded-3 fw-bold text-primary">
                                <option value="active" <?php echo e($trip->status == 'active' ? 'selected' : ''); ?>>Đang mở bán</option>
                                <option value="completed" <?php echo e($trip->status == 'completed' ? 'selected' : ''); ?>>Đã hoàn thành</option>
                                <option value="cancelled" <?php echo e($trip->status == 'cancelled' ? 'selected' : ''); ?>>Hủy chuyến</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Điều chỉnh Giá vé</label>
                            <input type="number" name="price" class="form-control rounded-3" value="<?php echo e($trip->price); ?>">
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-top">
                        <button type="submit" class="btn btn-success px-5 py-2 fw-bold" style="border-radius: 10px;">Lưu cập nhật</button>
                        <a href="<?php echo e(route('admin.trips.index')); ?>" class="btn btn-light px-4 border ms-2" style="border-radius: 10px;">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\trips\edit.blade.php ENDPATH**/ ?>