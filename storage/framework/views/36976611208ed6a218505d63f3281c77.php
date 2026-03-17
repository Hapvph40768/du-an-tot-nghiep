<?php $__env->startSection('content-main'); ?>
    <div class="top-header">
        <div style="display: flex; gap: 12px;">
            <a href="<?php echo e(route('admin.drivers.create')); ?>"
                style="background-color: #ff5b24; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="bx bx-plus" style="font-size: 16px;"></i> Thêm tài xế
            </a>
        </div>
    </div>

  

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Tài xế</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Liên hệ</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Bằng lái</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Trạng thái</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Ngày tham gia</th>
                    <th style="padding: 16px; text-align: center; font-weight: 600; color: #666;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr style="border-bottom: 1px solid #f0f2f5;">
                        <td style="padding: 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div
                                    style="width: 48px; height: 48px; border-radius: 50%; overflow: hidden; flex-shrink: 0; background: #f0f2f5;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->image && file_exists(public_path($driver->image))): ?>
                                        <img src="<?php echo e(asset($driver->image)); ?>" alt="<?php echo e($driver->name); ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($driver->name)); ?>&background=random&color=fff&size=128&bold=true"
                                            alt="<?php echo e($driver->name); ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #333;"><?php echo e($driver->name); ?></div>
                                    <div style="color: #888; font-size: 12px;">ID: #<?php echo e($driver->id); ?></div>
                                </div>
                            </div>
                        </td>

                        <td style="padding: 16px; color: #333;">
                            <div style="font-weight: 500;"><?php echo e($driver->phone ?? 'Chưa cập nhật'); ?></div>
                            <div style="color: #888; font-size: 12px;">user<?php echo e($driver->id); ?>@example.com</div>
                        </td>

                        <td style="padding: 16px;">
                            <span
                                style="background: #f0f2f5; color: #333; padding: 4px 12px; border-radius: 6px; font-size: 13px;">
                                <?php echo e($driver->license_number ?? 'Chưa có'); ?>

                            </span>
                        </td>

                        <td style="padding: 16px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->status == 'active'): ?>
                                <span
                                    style="background: #f6ffed; color: #52c41a; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Đang hoạt động
                                </span>
                            <?php elseif($driver->status == 'busy'): ?>
                                <span
                                    style="background: #fff7e6; color: #fa8c16; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Đang chạy
                                </span>
                            <?php else: ?>
                                <span
                                    style="background: #f0f2f5; color: #666; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Đã nghỉ
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>

                        <td style="padding: 16px; color: #666;">
                            <?php echo e($driver->created_at ? $driver->created_at->format('d/m/Y') : 'N/A'); ?>

                        </td>

                        <td style="padding: 16px; text-align: center;">
                            <a href="<?php echo e(route('admin.drivers.edit', $driver->id)); ?>"
                                style="display: inline-block; background-color: #fff7e6; color: #fa8c16; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin: 0 4px;">
                                Sửa
                            </a>

                            <form action="<?php echo e(route('admin.drivers.destroy', $driver->id)); ?>" method="POST"
                                style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    style="background-color: #fee; color: #c33; padding: 6px 12px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa tài xế <?php echo e(addslashes($driver->name)); ?>?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="6" style="padding: 40px 16px; text-align: center; color: #999; font-size: 15px;">
                            Chưa có tài xế nào trong hệ thống
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 24px; display: flex; justify-content: center;">
        <?php echo e($drivers->appends(request()->query())->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/drivers/index.blade.php ENDPATH**/ ?>