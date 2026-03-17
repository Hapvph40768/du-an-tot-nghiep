<?php $__env->startSection('content-main'); ?>
    <div class="top-header">
        <div style="display: flex; gap: 12px;">
            <a href="<?php echo e(route('admin.vehicles.create')); ?>"
                style="background-color: #ff5b24; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="bx bx-plus" style="font-size: 16px;"></i> Thêm xe
            </a>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Phương tiện</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Loại xe / Số ghế</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Trạng thái</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Ngày tạo</th>
                    <th style="padding: 16px; text-align: center; font-weight: 600; color: #666;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr style="border-bottom: 1px solid #f0f2f5;">
                        <td style="padding: 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div
                                    style="width: 48px; height: 48px; border-radius: 8px; overflow: hidden; background: linear-gradient(135deg, #fff3e0, #ffe0b2); border: 1px solid #ffe8cc; flex-shrink: 0;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($vehicle->image) && file_exists(public_path($vehicle->image))): ?>
                                        <img src="<?php echo e(asset($vehicle->image)); ?>" alt="<?php echo e($vehicle->license_plate); ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else: ?>
                                        <div
                                            style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #ff8c00; font-weight: bold; font-size: 18px;">
                                            <?php echo e(strtoupper(substr($vehicle->license_plate ?? 'XE', 0, 2))); ?>

                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #333;"><?php echo e($vehicle->license_plate); ?></div>
                                    <div style="color: #888; font-size: 12px;">ID: #<?php echo e($vehicle->id); ?></div>
                                </div>
                            </div>
                        </td>

                        <td style="padding: 16px; color: #333;">
                            <?php echo e($vehicle->type ?? 'Chưa xác định'); ?>

                            <div style="color: #888; font-size: 12px;"><?php echo e($vehicle->total_seats ?? '?'); ?> chỗ</div>
                        </td>

                        <td style="padding: 16px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vehicle->status == 'active'): ?>
                                <span
                                    style="background: #f6ffed; color: #52c41a; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Hoạt động
                                </span>
                            <?php else: ?>
                                <span
                                    style="background: #fff7e6; color: #fa8c16; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Bảo dưỡng
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>

                        <td style="padding: 16px; color: #666;">
                            <?php echo e($vehicle->created_at ? $vehicle->created_at->format('d/m/Y') : 'N/A'); ?>

                        </td>

                        <td style="padding: 16px; text-align: center;">
                            <a href="<?php echo e(route('admin.vehicles.edit', $vehicle->id)); ?>"
                                style="display: inline-block; background-color: #fff7e6; color: #fa8c16; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin: 0 4px;">
                                Sửa
                            </a>

                            <form action="<?php echo e(route('admin.vehicles.destroy', $vehicle->id)); ?>" method="POST"
                                style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    style="background-color: #fee; color: #c33; padding: 6px 12px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa xe <?php echo e(addslashes($vehicle->license_plate)); ?>?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="5" style="padding: 40px 16px; text-align: center; color: #999; font-size: 15px;">
                            Chưa có phương tiện nào trong hệ thống
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 24px; display: flex; justify-content: center;">
        <?php echo e($vehicles->appends(request()->query())->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/vehicles/index.blade.php ENDPATH**/ ?>