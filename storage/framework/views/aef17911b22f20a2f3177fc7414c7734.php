<?php $__env->startSection('title', 'Quản lý Ghế ngồi'); ?>

<?php $__env->startSection('content-main'); ?>
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .seat-badge { background: #f3f4f6; color: #374151; padding: 6px 12px; border-radius: 8px; font-weight: 700; border: 1px solid #e5e7eb; display: inline-flex; align-items: center; gap: 5px; }
    .seat-badge i { color: #9ca3af; }
    .filter-section { background: #f9fafb; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #edf2f7; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Danh sách Ghế ngồi</h2>
            <p class="text-muted small mb-0">Quản lý sơ đồ ghế cho từng phương tiện</p>
        </div>
        <a href="<?php echo e(route('admin.seats.create')); ?>" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">
            <i class='bx bx-plus'></i> Thêm ghế thủ công
        </a>
    </div>

    
    <div class="filter-section shadow-sm">
        <form action="<?php echo e(route('admin.seats.index')); ?>" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted">Lọc theo Xe</label>
                <select name="vehicle_id" class="form-select rounded-3">
                    <option value="">-- Tất cả các xe --</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <option value="<?php echo e($vehicle->id); ?>" <?php echo e(request('vehicle_id') == $vehicle->id ? 'selected' : ''); ?>>
                            <?php echo e($vehicle->license_plate); ?> (<?php echo e($vehicle->type); ?>)
                        </option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100 rounded-3">
                    <i class='bx bx-filter-alt'></i> Lọc
                </button>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('vehicle_id')): ?>
                <div class="col-md-2">
                    <a href="<?php echo e(route('admin.seats.index')); ?>" class="btn btn-light border w-100 rounded-3">Xóa lọc</a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </form>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class='bx bx-check-circle me-2'></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <i class='bx bx-error-circle me-2'></i> <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card-box">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th style="width: 10%;">ID</th>
                        <th style="width: 25%;">Mã ghế (Số ghế)</th>
                        <th style="width: 35%;">Thuộc xe (Biển số)</th>
                        <th style="width: 20%;">Ngày tạo</th>
                        <th class="text-end" style="width: 10%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td>#<?php echo e($seat->id); ?></td>
                            <td>
                                <div class="seat-badge">
                                    <i class='bx bx-chair'></i> <?php echo e($seat->seat_number); ?>

                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?php echo e($seat->vehicle->license_plate); ?></div>
                                <div class="text-muted small"><?php echo e($seat->vehicle->type); ?></div>
                            </td>
                            <td class="text-muted small"><?php echo e($seat->created_at->format('d/m/Y H:i')); ?></td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?php echo e(route('admin.seats.edit', $seat->id)); ?>" class="btn btn-sm btn-light border">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.seats.destroy', $seat->id)); ?>" method="POST" onsubmit="return confirm('Xóa ghế này?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-light border text-danger">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Không tìm thấy ghế nào.</td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <?php echo e($seats->appends(request()->query())->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\seats\index.blade.php ENDPATH**/ ?>