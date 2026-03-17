<?php $__env->startSection('content-main'); ?>
    <div class="top-header">
        <div style="display: flex; gap: 12px;">
            <a href="<?php echo e(route('admin.trips.create')); ?>"
                style="background-color: #ff5b24; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="bx bx-plus"></i> Thêm chuyến đi
            </a>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding: 16px;">Tuyến đường</th>
                    <th style="padding: 16px;">Xe</th>
                    <th style="padding: 16px;">Tài xế</th>
                    <th style="padding: 16px;">Ngày đi</th>
                    <th style="padding: 16px;">Giờ đi</th>
                    <th style="padding: 16px;">Giờ đến</th>
                    <th style="padding: 16px; text-align:center;">Giá</th>
                    <th style="padding: 16px; text-align:center;">Trạng thái</th>
                    <th style="padding: 16px; text-align:center;">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr style="border-bottom: 1px solid #f0f2f5;">

                        <td style="padding: 16px;">
                            <div style="font-weight: 600;">
                                <?php echo e($trip->route->startLocation->name ?? 'N/A'); ?>

                            </div>
                            <div style="font-size: 12px; color: #888;">
                                → <?php echo e($trip->route->endLocation->name ?? 'N/A'); ?>

                            </div>
                        </td>

                        <td style="padding: 16px;">
                            <span style="background:#f0f2f5; padding:4px 12px; border-radius:6px;">
                                <?php echo e($trip->vehicle->type ?? 'Chưa có xe'); ?>

                            </span>
                        </td>

                        <td style="padding: 16px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:40px; height:40px; border-radius:50%; overflow:hidden;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->driver && $trip->driver->image && file_exists(public_path($trip->driver->image))): ?>
                                        <img src="<?php echo e(asset($trip->driver->image)); ?>" style="width:100%; height:100%;">
                                    <?php else: ?>
                                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($trip->driver->name ?? 'Driver')); ?>"
                                            style="width:100%; height:100%;">
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div>
                                    <div style="font-weight:600;">
                                        <?php echo e($trip->driver->name ?? 'N/A'); ?>

                                    </div>
                                    <div style="font-size:12px; color:#888;">
                                        <?php echo e($trip->driver->phone ?? ''); ?>

                                    </div>
                                </div>
                            </div>
                        </td>

                        <td style="padding: 16px;">
                            <?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?>

                        </td>

                        <td style="padding: 16px;">
                            <?php echo e($trip->departure_time); ?>

                        </td>

                        <td style="padding: 16px;">
                            <?php echo e($trip->arrival_time); ?>

                        </td>

                        <td style="padding: 16px; text-align:center;">
                            <?php echo e(number_format($trip->price)); ?>đ
                        </td>

                        <td style="padding: 16px; text-align:center;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->status == 'active'): ?>
                                <span style="background:#f6ffed; color:#52c41a; padding:4px 12px; border-radius:6px;">
                                    Hoạt động
                                </span>
                            <?php elseif($trip->status == 'completed'): ?>
                                <span style="background:#e6f7ff; color:#1890ff; padding:4px 12px; border-radius:6px;">
                                    Hoàn thành
                                </span>
                            <?php else: ?>
                                <span style="background:#fff1f0; color:#f5222d; padding:4px 12px; border-radius:6px;">
                                    Đã hủy
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>

                        <td style="padding: 16px; text-align:center;">
                            <a href="<?php echo e(route('admin.trips.edit', $trip->id)); ?>"
                                style="background:#fff7e6; color:#fa8c16; padding:6px 12px; border-radius:6px; text-decoration:none;">
                                Sửa
                            </a>

                            <form action="<?php echo e(route('admin.trips.destroy', $trip->id)); ?>" method="POST"
                                style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    style="background:#fee; color:#c33; padding:6px 12px; border:none; border-radius:6px;"
                                    onclick="return confirm('Xóa chuyến này?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="9" style="padding: 60px; text-align: center; vertical-align: middle; color: #999;">
                            Chưa có chuyến đi nào
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>

        <div style="margin-top:20px; text-align:center;">
            <?php echo e($trips->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/trips/index.blade.php ENDPATH**/ ?>