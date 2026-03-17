<?php $__env->startSection('content-main'); ?>
    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <form action="<?php echo e(route('admin.trips.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">

                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Tuyến đường <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="route_id"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px;" required>
                        <option value="">-- Chọn tuyến đường --</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($route->id); ?>" <?php echo e(old('route_id') == $route->id ? 'selected' : ''); ?>>
                                <?php echo e($route->startLocation->name); ?> → <?php echo e($route->endLocation->name); ?>

                            </option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['route_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #c33; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Xe <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="vehicle_id"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                        <option value="">-- Chọn xe --</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($vehicle->id); ?>" <?php echo e(old('vehicle_id') == $vehicle->id ? 'selected' : ''); ?>>
                                <?php echo e($vehicle->type); ?>

                            </option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Tài xế <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="driver_id" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"
                        required>
                        <option value="">-- Chọn tài xế --</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($driver->id); ?>" <?php echo e(old('driver_id') == $driver->id ? 'selected' : ''); ?>>
                                <?php echo e($driver->name); ?>

                            </option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Ngày đi <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="date" name="trip_date" value="<?php echo e(old('trip_date')); ?>"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Giờ đi <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="time" name="departure_time" value="<?php echo e(old('departure_time')); ?>"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Giờ đến <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="time" name="arrival_time" value="<?php echo e(old('arrival_time')); ?>"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Giá vé (VNĐ) <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="number" name="price" value="<?php echo e(old('price')); ?>"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" min="0"
                        required>
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Trạng thái <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="status" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"
                        required>
                        <option value="active">Hoạt động</option>
                        <option value="completed">Hoàn thành</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>

            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit"
                    style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600;">
                    Thêm chuyến đi
                </button>

                <a href="<?php echo e(route('admin.trips.index')); ?>"
                    style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border-radius: 8px; font-weight: 600; text-decoration: none;">
                    Hủy
                </a>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/trips/create.blade.php ENDPATH**/ ?>