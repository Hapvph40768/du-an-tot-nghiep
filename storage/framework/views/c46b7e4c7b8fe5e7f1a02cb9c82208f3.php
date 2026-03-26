<?php $__env->startSection('title', 'Sơ đồ ghế xe ' . $vehicle->license_plate); ?>

<?php $__env->startSection('content-main'); ?>
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    
    /* Style cho thông tin tóm tắt */
    .info-badge { background: #fff8f3; border: 1px solid #ffe8d6; border-radius: 12px; padding: 15px; }
    .info-label { color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 4px; }
    .info-value { color: #111827; font-weight: 700; font-size: 16px; }

    /* Style cho Sơ đồ ghế */
    .seat-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 15px;
        background: #f8fafc;
        padding: 20px;
        border-radius: 15px;
        border: 2px dashed #e2e8f0;
    }
    .seat-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        transition: 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .seat-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(255, 107, 0, 0.1);
    }
    .seat-icon { font-size: 24px; color: #94a3b8; margin-bottom: 5px; }
    .seat-name { font-weight: 800; color: #1e293b; font-size: 14px; }
    
    .status-tag { font-size: 11px; padding: 2px 8px; border-radius: 20px; font-weight: 600; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="<?php echo e(route('admin.vehicles.index')); ?>" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> QUAY LẠI DANH SÁCH
            </a>
            <h2 class="fw-bold text-dark m-0 mt-2">Chi tiết phương tiện: <?php echo e($vehicle->license_plate); ?></h2>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.vehicles.edit', $vehicle->id)); ?>" class="btn btn-light border px-4 rounded-3">
                <i class='bx bx-edit'></i> Chỉnh sửa xe
            </a>
            <a href="<?php echo e(route('admin.seats.index', ['vehicle_id' => $vehicle->id])); ?>" class="btn btn-dark px-4 rounded-3">
                <i class='bx bx-cog'></i> Quản lý ghế
            </a>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Thông tin chung</h5>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="info-label">Biển số</div>
                        <div class="info-value"><?php echo e($vehicle->license_plate); ?></div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Loại xe</div>
                        <div class="info-value"><?php echo e($vehicle->type); ?></div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Số chỗ ngồi</div>
                        <div class="info-value text-primary"><?php echo e($vehicle->total_seats); ?> ghế</div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Số điện thoại</div>
                        <div class="info-value">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vehicle->phone_vehicles): ?>
                                <i class='bx bxs-phone-call text-success me-1'></i> <?php echo e($vehicle->phone_vehicles); ?>

                            <?php else: ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Trạng thái</div>
                        <div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vehicle->status == 'active'): ?>
                                <span class="badge bg-success small">Sẵn sàng</span>
                            <?php else: ?>
                                <span class="badge bg-danger small">Bảo trì</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 p-3 bg-light rounded-3 small text-muted">
                    <i class='bx bx-info-circle'></i> Sơ đồ ghế này được tạo tự động dựa trên tổng số ghế khi bạn thêm xe mới vào hệ thống.
                </div>
            </div>
        </div>

        
        <div class="col-md-8">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">Sơ đồ ghế thực tế</h5>
                    <span class="text-muted small">Tổng số: <?php echo e($vehicle->seats->count()); ?> vị trí</span>
                </div>

                <div class="seat-container">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $vehicle->seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="seat-card">
                            <i class='bx bx-chair seat-icon'></i>
                            <div class="seat-name"><?php echo e($seat->seat_number); ?></div>
                            <span class="status-tag bg-light text-muted border mt-1 d-inline-block">Trống</span>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="col-12 text-center py-5">
                            <i class='bx bx-error-alt fs-1 text-muted opacity-25'></i>
                            <p class="text-muted mt-2">Chưa có dữ liệu ghế cho xe này.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/vehicles/show.blade.php ENDPATH**/ ?>