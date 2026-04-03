
<?php $__env->startSection('title', 'Gán điểm đón cho chuyến xe'); ?>
<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="<?php echo e(route('admin.trips.index')); ?>" class="text-decoration-none text-muted small fw-bold"><i class='bx bx-left-arrow-alt'></i> QUAY LẠI LỊCH TRÌNH</a>
        <h2 class="fw-bold text-dark mt-2">Thiết lập lộ trình dừng đón</h2>
        <p class="text-muted">Chuyến: <span class="text-primary fw-bold"><?php echo e($trip->route->departureLocation->name); ?> → <?php echo e($trip->route->destinationLocation->name); ?></span></p>
    </div>

    <form action="<?php echo e(route('admin.trips.pickup_points.store', $trip->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row">
            
            <div class="col-md-7">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold m-0">Chọn từ danh mục hệ thống</h5>
                        <a href="<?php echo e(route('admin.pickup-points.create')); ?>" target="_blank" class="text-primary small text-decoration-none fw-bold">+ Tạo điểm mới vào kho</a>
                    </div>
                    
                    <div class="scroll-area" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead class="sticky-top bg-white">
                                <tr class="small text-muted">
                                    <th width="50">Chọn</th>
                                    <th>Tên điểm / Địa chỉ</th>
                                    <th>Tỉnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $allPickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="pickup_point_ids[]" value="<?php echo e($point->id); ?>" 
                                               class="form-check-input" <?php echo e($trip->pickupPoints->contains($point->id) ? 'checked' : ''); ?>>
                                    </td>
                                    <td>
                                        <div class="fw-bold"><?php echo e($point->name); ?></div>
                                        <div class="text-muted small"><?php echo e($point->address); ?></div>
                                    </td>
                                    <td><span class="badge bg-light text-dark"><?php echo e($point->location->name); ?></span></td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="col-md-5">
                <div class="card shadow-sm border-0 rounded-4 p-4 sticky-top" style="top: 20px;">
                    <h5 class="fw-bold mb-3">Lộ trình hiện tại</h5>
                    <div class="bg-light p-3 rounded-3 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $trip->pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2"><?php echo e($index + 1); ?></span>
                                <span class="small fw-bold text-dark"><?php echo e($p->name); ?></span>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <p class="text-muted small m-0 italic">Chưa chọn điểm dừng nào.</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background: #ff6b00; border:none; border-radius: 10px;">
                        CẬP NHẬT LỘ TRÌNH
                    </button>
                    <p class="text-center text-muted small mt-3 italic"><i class='bx bx-info-circle'></i> Tick chọn ở bảng bên trái và nhấn Cập nhật để gán điểm đón.</p>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\trips\pickup_points\index.blade.php ENDPATH**/ ?>