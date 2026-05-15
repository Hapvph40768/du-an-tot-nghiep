<?php $__env->startSection('title', 'Chi tiết Tài xế'); ?>
<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?php echo e(route('admin.drivers.index')); ?>" class="btn btn-light border rounded-3">
            <i class='bx bx-left-arrow-alt'></i>
        </a>
        <div class="flex-grow-1">
            <h4 class="fw-bold m-0">Hồ sơ Tài xế</h4>
        </div>
        <a href="<?php echo e(route('admin.drivers.edit', $driver->id)); ?>" class="btn btn-outline-primary rounded-3 px-4">
            <i class='bx bx-edit'></i> Chỉnh sửa
        </a>
    </div>

    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->avatar): ?>
                    <img src="<?php echo e(Storage::url($driver->avatar)); ?>" class="rounded-circle mx-auto mb-3" style="width:100px;height:100px;object-fit:cover;" alt="Avatar">
                <?php else: ?>
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-light" style="width:100px;height:100px;">
                        <i class='bx bxs-user text-muted' style="font-size:48px;"></i>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <h5 class="fw-bold mb-1"><?php echo e($driver->name); ?></h5>
                <span class="badge <?php echo e($driver->status === 'active' ? 'bg-success' : 'bg-secondary'); ?> px-3 py-2 rounded-pill">
                    <?php echo e($driver->status === 'active' ? 'Đang hoạt động' : 'Ngừng hoạt động'); ?>

                </span>

                <hr class="my-3">

                <div class="text-start small">
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-cake text-muted'></i>
                        <span><?php echo e($driver->date_of_birth ? \Carbon\Carbon::parse($driver->date_of_birth)->format('d/m/Y') : '—'); ?></span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-user text-muted'></i>
                        <span><?php echo e(['male'=>'Nam','female'=>'Nữ','other'=>'Khác'][$driver->gender] ?? '—'); ?></span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-phone text-muted'></i>
                        <span><?php echo e($driver->phone ?? '—'); ?></span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-envelope text-muted'></i>
                        <span><?php echo e($driver->user->email ?? '—'); ?></span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-id-card text-muted'></i>
                        <span><?php echo e($driver->id_card_number ?? '—'); ?></span>
                    </div>
                    <div class="d-flex gap-2">
                        <i class='bx bx-map text-muted'></i>
                        <span><?php echo e($driver->address ?? '—'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-8">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h6 class="fw-bold text-uppercase text-muted small mb-3" style="border-left:4px solid #ff6b00; padding-left:10px;">Thông tin Bằng lái xe</h6>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Số bằng lái</p>
                        <p class="fw-bold"><?php echo e($driver->license_number ?? '—'); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Hạng bằng lái</p>
                        <p class="fw-bold"><?php echo e($driver->license_class ?? '—'); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Ngày cấp</p>
                        <p class="fw-bold"><?php echo e($driver->license_issued_date ? \Carbon\Carbon::parse($driver->license_issued_date)->format('d/m/Y') : '—'); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Ngày hết hạn</p>
                        <?php
                            $expired = $driver->license_expiry_date && \Carbon\Carbon::parse($driver->license_expiry_date)->isPast();
                        ?>
                        <p class="fw-bold <?php echo e($expired ? 'text-danger' : ''); ?>">
                            <?php echo e($driver->license_expiry_date ? \Carbon\Carbon::parse($driver->license_expiry_date)->format('d/m/Y') : '—'); ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expired): ?> <span class="badge bg-danger ms-1">Hết hạn</span> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Số năm kinh nghiệm</p>
                        <p class="fw-bold"><?php echo e($driver->experience_years); ?> năm</p>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->license_image): ?>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Ảnh bằng lái</p>
                        <a href="<?php echo e(Storage::url($driver->license_image)); ?>" target="_blank">
                            <img src="<?php echo e(Storage::url($driver->license_image)); ?>" class="rounded-3 border" style="height:70px;" alt="Bằng lái">
                        </a>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-bold text-uppercase text-muted small mb-3" style="border-left:4px solid #ff6b00; padding-left:10px;">
                    Lịch sử chuyến xe (<?php echo e($driver->trips->count()); ?> chuyến)
                </h6>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->trips->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-sm align-middle small">
                        <thead class="table-light"><tr>
                            <th>#</th><th>Tuyến</th><th>Ngày</th><th>Giờ</th><th>Trạng thái</th>
                        </tr></thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $driver->trips->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr>
                                <td><?php echo e($trip->id); ?></td>
                                <td><?php echo e($trip->route->startLocation->name ?? '?'); ?> → <?php echo e($trip->route->endLocation->name ?? '?'); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?></td>
                                <td><?php echo e(substr($trip->departure_time, 0, 5)); ?></td>
                                <td><span class="badge bg-<?php echo e($trip->status === 'completed' ? 'success' : ($trip->status === 'active' ? 'primary' : 'secondary')); ?>"><?php echo e($trip->status); ?></span></td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p class="text-muted small mb-0">Chưa có chuyến xe nào.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/drivers/show.blade.php ENDPATH**/ ?>