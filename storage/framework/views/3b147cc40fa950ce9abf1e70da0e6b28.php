<?php $__env->startSection('title', 'Thêm Địa điểm mới'); ?>

<?php $__env->startSection('content-main'); ?>

    <style>
        /* Giữ nguyên style từ trang index + bổ sung cho form */
        :root {
            --primary-color: #ff6b00;
            --primary-hover: #e65100;
            --bg-light: #f9fafb;
        }

        .card-box {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
            padding: 24px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .form-control-custom,
        .form-select-custom {
            background-color: var(--bg-light);
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.2s;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            background-color: #fff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
            outline: none;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 107, 0, 0.25);
        }

        .btn-outline-secondary-custom {
            border-color: #d1d5db;
            color: #4b5563;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-outline-secondary-custom:hover {
            background-color: #f3f4f6;
            color: #374151;
        }

        #map-preview {
            height: 300px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            margin-top: 10px;
        }

        .pac-container {
            z-index: 1051 !important;
        }
    </style>

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="<?php echo e(route('admin.locations.index')); ?>" class="text-decoration-none text-muted fw-bold small">
                    <i class='bx bx-arrow-back me-1'></i> Quay lại danh sách
                </a>
                <h2 class="fw-bold text-dark mt-2">Thêm Địa điểm mới</h2>
            </div>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Địa điểm / Bến xe</span>
        </div>

        <div class="card-box">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <strong>Lỗi nhập liệu:</strong>
                    <ul class="mb-0 mt-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.locations.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row g-4">

                    <!-- Cột chính -->
                    <div class="col-lg-8">

                        <div class="mb-4">
                            <label for="name" class="form-label">Tên địa điểm <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control form-control-custom <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('name')); ?>" placeholder="Ví dụ: Bến xe Mỹ Đình" required autofocus>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label">Địa chỉ chi tiết</label>
                            <input type="text" name="address" id="address"
                                class="form-control form-control-custom <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('address')); ?>" placeholder="Số nhà, đường, phường/xã...">
                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="city" class="form-label">Thành phố / Tỉnh</label>
                                <input type="text" name="city" id="city"
                                    class="form-control form-control-custom <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('city')); ?>" placeholder="Hà Nội, TP. Hồ Chí Minh, Đà Nẵng...">
                                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6">
                                <label for="province_code" class="form-label">Mã tỉnh (tùy chọn)</label>
                                <input type="text" name="province_code" id="province_code"
                                    class="form-control form-control-custom <?php $__errorArgs = ['province_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('province_code')); ?>" placeholder="HN, HCM, DN...">
                                <?php $__errorArgs = ['province_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="note" class="form-label">Ghi chú / Thông tin bổ sung</label>
                            <textarea name="note" id="note" rows="3"
                                class="form-control form-control-custom <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Ví dụ: Bến chính, có bãi đỗ xe lớn, gần trung tâm..."><?php echo e(old('note')); ?></textarea>
                            <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                    </div>

                    <!-- Cột phụ: Trạng thái + Nút -->
                    <div class="col-lg-4">

                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3" style="color: var(--primary-color);">
                                    <i class='bx bx-toggle-left me-2'></i>Trạng thái
                                </h5>

                                <div class="form-check form-switch form-switch-lg">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                        value="1" <?php echo e(old('is_active', 1) ? 'checked' : ''); ?>>
                                    <label class="form-check-label fw-medium" for="is_active">
                                        Hoạt động (hiển thị cho khách hàng)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class='bx bx-plus-circle me-2'></i> THÊM ĐỊA ĐIỂM
                            </button>

                            <a href="<?php echo e(route('admin.locations.index')); ?>"
                                class="btn btn-outline-secondary-custom btn-lg text-center">
                                Hủy bỏ
                            </a>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/locations/create.blade.php ENDPATH**/ ?>