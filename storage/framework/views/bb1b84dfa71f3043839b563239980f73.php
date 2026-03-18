<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h3 class="fw-bold mb-4">Lên lịch Chuyến xe mới</h3>
                <form action="<?php echo e(route('admin.trips.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Chọn Tuyến đường</label>
                            <select name="route_id" class="form-select rounded-3 shadow-sm">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($route->id); ?>"><?php echo e($route->departureLocation->name); ?> → <?php echo e($route->destinationLocation->name); ?> (<?php echo e($route->distance_km); ?>km)</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày khởi hành</label>
                            <input type="date" name="trip_date" class="form-control rounded-3" >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Giờ xuất bến</label>
                            <input type="time" name="departure_time" class="form-control rounded-3" >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Giờ đến dự kiến</label>
                            <input type="time" name="arrival_time" class="form-control rounded-3" >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Chọn Xe</label>
                            <select name="vehicle_id" class="form-select rounded-3">
                                <option value="">-- Chọn điểm xe --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->license_plate); ?> - <?php echo e($vehicle->type); ?> (<?php echo e($vehicle->total_seats); ?> ghế  )</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tài xế phụ trách</label>
                            <select name="driver_id" class="form-select rounded-3">
                                <option value="">-- Chọn tài xế --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($driver->id); ?>"><?php echo e($driver->name); ?> (SĐT: <?php echo e($driver->phone); ?>)</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Giá vé (VNĐ)</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control rounded-3" placeholder="Ví dụ: 250000" required>
                                <span class="input-group-text">đ</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Trạng thái ban đầu</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="active">Mở bán (Active)</option>
                                <option value="cancelled">Hủy chuyến</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="background: #ff6b00; border:none; border-radius: 10px;">Xác nhận tạo chuyến</button>
                        <a href="<?php echo e(route('admin.trips.index')); ?>" class="btn btn-light px-4 border ms-2" style="border-radius: 10px;">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/trips/create.blade.php ENDPATH**/ ?>