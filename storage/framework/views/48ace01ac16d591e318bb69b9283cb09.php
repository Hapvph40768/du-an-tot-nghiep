<?php $__env->startSection('title', 'Cập nhật Tài xế'); ?>

<?php $__env->startSection('content-main'); ?>

    <style>
        .form-control-custom {
            background-color: #f8f9fa;
            border: 1px solid transparent;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            background-color: #fff;
            border-color: #f97316;
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .upload-box {
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            background: #f8fafc;
            transition: all 0.3s;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .upload-box:hover {
            border-color: #f97316;
        }
    </style>

    <div class="container-fluid py-4">

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <a href="<?php echo e(route('admin.drivers.index')); ?>"
                    class="text-decoration-none text-muted fw-bold small hover-orange">
                    <i class='bx bx-arrow-back me-1'></i> Quay lại
                </a>
                <h3 class="fw-bold text-dark mt-2">Cập nhật: <span style="color: #f97316;"><?php echo e($driver->name); ?></span></h3>
            </div>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">ID: #<?php echo e($driver->id); ?></span>
        </div>

        <form action="<?php echo e(route('admin.drivers.update', $driver->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row g-4">
                <!-- Cột chính: Thông tin chi tiết -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-4" style="color: #f97316;">
                                <i class='bx bx-edit me-2'></i>Chỉnh sửa thông tin
                            </h5>

                            <div class="mb-4">
                                <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-custom"
                                    value="<?php echo e(old('name', $driver->name)); ?>" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-light text-muted rounded-start-3">
                                            <i class='bx bx-phone'></i>
                                        </span>
                                        <input type="text" name="phone"
                                            class="form-control form-control-custom rounded-end-3"
                                            value="<?php echo e(old('phone', $driver->phone)); ?>" required>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Số bằng lái (GPLX) <span class="text-danger">*</span></label>
                                    <input type="text" name="license_number" class="form-control form-control-custom"
                                        value="<?php echo e(old('license_number', $driver->license_number)); ?>" required>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['license_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Số năm kinh nghiệm</label>
                                    <div class="input-group">
                                        <input type="number" name="experience_years" min="0" max="50"
                                            class="form-control form-control-custom"
                                            value="<?php echo e(old('experience_years', $driver->experience_years ?? 0)); ?>">
                                        <span class="input-group-text">Năm</span>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['experience_years'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select form-control-custom" required>
                                        <option value="active"
                                            <?php echo e(old('status', $driver->status) == 'active' ? 'selected' : ''); ?>>🟢 Sẵn sàng
                                            (Active)</option>
                                        <option value="busy"
                                            <?php echo e(old('status', $driver->status) == 'busy' ? 'selected' : ''); ?>>🟠 Đang
                                            chạy (Busy)</option>
                                        <option
                                            value="inactive"<?php echo e(old('status', $driver->status) == 'inactive' ? 'selected' : ''); ?>>
                                            ⚫ Ngừng hoạt động (Inactive)</option>
                                    </select>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label">Thông tin cá nhân / Ghi chú</label>
                                <textarea name="personal_info" rows="3" class="form-control form-control-custom"><?php echo e(old('personal_info', $driver->personal_info ?? '')); ?></textarea>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['personal_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột phụ: Ảnh + Nút hành động -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 text-center">
                            <h5 class="fw-bold mb-4 text-start" style="color: #f97316;">
                                <i class='bx bx-image me-2'></i>Ảnh đại diện
                            </h5>

                            <label for="imageUpload" class="upload-box d-block mx-auto" style="width: 100%; height: 240px;">
                                <img id="preview-img"
                                    src="<?php echo e($driver->image ? asset($driver->image) : 'https://via.placeholder.com/300?text=Upload+Driver+Image'); ?>"
                                    class="w-100 h-100 object-fit-cover">

                                <div
                                    class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-60 text-white py-2 small">
                                    <i class='bx bx-camera me-1'></i> Nhấn để thay đổi ảnh
                                </div>
                            </label>

                            <input type="file" name="image" id="imageUpload" class="d-none" accept="image/*"
                                onchange="previewFile(this)">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-3 fw-bold rounded-3 shadow"
                            style="background: #f97316; border: none;">
                            <i class='bx bx-check-double me-2'></i> CẬP NHẬT TÀI XẾ
                        </button>
                        <a href="<?php echo e(route('admin.drivers.index')); ?>"
                            class="btn btn-outline-secondary py-3 fw-bold rounded-3">
                            Hủy bỏ
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewFile(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/drivers/edit.blade.php ENDPATH**/ ?>