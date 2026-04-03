<?php $__env->startSection('title', 'Chi tiết chuyến xe #' . $trip->id); ?>

<?php $__env->startSection('content-main'); ?>
<style>
    :root { --primary-color: #ff6b00; --secondary-bg: #f8fafc; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; height: 100%; }
    .label-custom { font-size: 11px; text-transform: uppercase; font-weight: 700; color: #94a3b8; letter-spacing: 0.5px; }
    .value-custom { font-size: 16px; font-weight: 700; color: #1e293b; display: block; margin-top: 4px; }
    
    /* Lộ trình dừng */
    .timeline-item { position: relative; padding-left: 30px; padding-bottom: 20px; border-left: 2px dashed #e2e8f0; }
    .timeline-item:last-child { border-left: none; padding-bottom: 0; }
    .timeline-item::before { content: ''; position: absolute; left: -7px; top: 0; width: 12px; height: 12px; background: var(--primary-color); border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #ff6b0033; }
    
    /* Sơ đồ ghế */
    .seat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; background: #f1f5f9; padding: 20px; border-radius: 12px; }
    .seat-box { aspect-ratio: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; background: white; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; font-weight: 700; }
    .seat-occupied { background: #fee2e2; color: #ef4444; border-color: #fecaca; }
    .seat-available { background: #f0fdf4; color: #22c55e; border-color: #bbf7d0; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <a href="<?php echo e(route('admin.trips.index')); ?>" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> QUAY LẠI DANH SÁCH
            </a>
            <h2 class="fw-bold text-dark m-0 mt-2">
                <?php echo e($trip->route->departureLocation->name); ?> 
                <i class='bx bx-right-arrow-alt text-primary'></i> 
                <?php echo e($trip->route->destinationLocation->name); ?>

            </h2>
            <div class="mt-1">
                <span class="badge bg-primary rounded-pill">Mã chuyến: #TRIP-<?php echo e($trip->id); ?></span>
                <span class="badge bg-light text-dark border rounded-pill ms-1"><?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?></span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.trips.edit', $trip->id)); ?>" class="btn btn-light border px-4 rounded-3"><i class='bx bx-edit'></i> Chỉnh sửa</a>
            <a href="<?php echo e(route('admin.trips.pickup_points.index', $trip->id)); ?>" class="btn btn-dark px-4 rounded-3"><i class='bx bx-map-pin'></i> Lộ trình</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Vận hành & Tài chính</h5>
                <div class="row g-4">
                    <div class="col-6">
                        <span class="label-custom">Giờ xuất bến</span>
                        <span class="value-custom text-primary fs-4"><?php echo e($trip->departure_time); ?></span>
                    </div>
                    <div class="col-6">
                        <span class="label-custom">Giờ đến dự kiến</span>
                        <span class="value-custom"><?php echo e($trip->arrival_time); ?></span>
                    </div>
                    <div class="col-12">
                        <span class="label-custom">Giá vé niêm yết</span>
                        <span class="value-custom text-danger fs-5"><?php echo e(number_format($trip->price)); ?> VNĐ</span>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3">
                            <span class="label-custom">Phương tiện</span>
                            <span class="value-custom"><?php echo e($trip->vehicle->license_plate); ?> (<?php echo e($trip->vehicle->type); ?>)</span>
                            <hr class="my-2">
                            <span class="label-custom">Tài xế phụ trách</span>
                            <span class="value-custom"><?php echo e($trip->driver->name); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Danh sách điểm đón khách</h5>
                <div class="ps-2 mt-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $trip->pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="timeline-item">
                            <div class="fw-bold text-dark"><?php echo e($point->name); ?></div>
                            <div class="text-muted small"><?php echo e($point->address); ?></div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="text-center py-4">
                            <i class='bx bx-map-alt fs-2 text-muted opacity-25'></i>
                            <p class="text-muted small mt-2">Chưa thiết lập điểm dừng cho chuyến này.</p>
                            <a href="<?php echo e(route('admin.trips.pickup_points.index', $trip->id)); ?>" class="btn btn-sm btn-outline-primary mt-2">Thiết lập ngay</a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h5 class="fw-bold m-0">Tình trạng chỗ ngồi</h5>
                    <span class="badge bg-success small">Đang mở bán</span>
                </div>
                
                <div class="seat-grid">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trip->vehicle->seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            $isBooked = in_array($seat->id, $bookedSeatIds ?? []);
                        ?>
                        <div class="seat-box <?php echo e($isBooked ? 'seat-occupied' : 'seat-available'); ?>" title="Ghế <?php echo e($seat->seat_number); ?>">
                            <i class='bx bx-chair fs-5'></i>
                            <?php echo e($seat->seat_number); ?>

                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                <div class="mt-4 d-flex justify-content-center gap-3">
                    <small class="text-muted"><i class='bx bxs-square text-success'></i> Trống</small>
                    <small class="text-muted"><i class='bx bxs-square text-danger'></i> Đã đặt</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<<<<<<<< HEAD:storage/framework/views/0a1f963c5dd4e54143d4fe2b5d4cac08.php
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\trips\show.blade.php ENDPATH**/ ?>
========
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/trips/show.blade.php ENDPATH**/ ?>
>>>>>>>> e98431d6fb3526cbcb5dbf624114d5e1b9705d42:storage/framework/views/06ec8af6e946f66299676e0350c5ce7c.php
