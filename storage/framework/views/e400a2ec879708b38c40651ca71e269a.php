<?php $__env->startSection('content-main'); ?>
    <section id="search" class="gradient-hero bus-pattern text-white py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-8 slide-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-3">Đặt vé xe khách trực tuyến</h2>
                <p class="text-lg text-blue-200">Hơn 500+ chuyến xe mỗi ngày trên toàn quốc</p>
            </div>

            <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl p-4 mb-8 max-w-2xl mx-auto shadow-md">
                <div class="flex items-center justify-center gap-3 text-white">
                    <span class="text-2xl">🎉</span>
                    <p id="promo-text" class="font-semibold">Giảm 20% cho khách hàng mới - Nhập mã: MANHHUNG20</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl card-shadow p-8 max-w-4xl mx-auto">
                <form id="search-form" action="<?php echo e(route('customer.trips.search')); ?>" method="GET">
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-bold text-sm ml-1">Điểm đi</label>
                            <div class="relative group">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-amber-500 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                    </svg>
                                </div>
                                <select id="from-city" name="start_location_id" required
                                    class="w-full pl-12 pr-10 py-4 bg-gray-50 border-2 border-gray-100 rounded-xl focus:border-amber-500 focus:bg-white focus:outline-none transition-all appearance-none text-gray-700 font-medium">
                                    <option value="">Chọn điểm đi</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-gray-700 font-bold text-sm ml-1">Điểm đến</label>
                            <div class="relative group">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-amber-500 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                    </svg>
                                </div>
                                <select id="to-city" name="end_location_id" required
                                    class="w-full pl-12 pr-10 py-4 bg-gray-50 border-2 border-gray-100 rounded-xl focus:border-amber-500 focus:bg-white focus:outline-none transition-all appearance-none text-gray-700 font-medium">
                                    <option value="">Chọn điểm đến</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-full md:w-1/2 bg-orange-500 hover:bg-orange-600 text-white font-extrabold py-4 px-8 rounded-xl flex items-center justify-center gap-3 shadow-lg shadow-orange-200 transition-transform active:scale-95">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                            </svg>
                            Tìm chuyến xe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Popular Routes Section -->
    <section id="routes" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Tuyến đường phổ biến</h2>
                <div class="w-16 h-1 bg-amber-500 mx-auto rounded-full"></div>
            </div>

            <?php
                $hanoiId = $locations->firstWhere('name', 'Hà Nội')?->id ?? 1;
                $danangId = $locations->firstWhere('name', 'Đà Nẵng')?->id ?? 3;
                $hcmId = $locations->firstWhere('name', 'TP. Hồ Chí Minh')?->id ?? 2;
                $dalatId = $locations->firstWhere('name', 'Đà Lạt')?->id ?? 7;
                $nhatrangId = $locations->firstWhere('name', 'Nha Trang')?->id ?? 6;
                $sapaId = $locations->firstWhere('name', 'Sapa')?->id ?? 1; // Sapa isn't seeded but as fallback
            ?>
            <div class="grid md:grid-cols-4 gap-6">
                <!-- Route Card -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <img src="./images/hanoi-17486566616582033334984.jpg" alt="Hà Nội"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-bold text-lg">Hà Nội</span>
                            <i class='bx bx-transfer-alt text-amber-500'></i>
                            <span class="font-bold text-lg">Đà Nẵng</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">Từ 350.000đ • 14 chuyến/ngày</p>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hanoiId, 'end_location_id' => $danangId, 'trip_date' => date('Y-m-d')])); ?>"
                            class="text-amber-600 font-medium hover:text-amber-700 flex items-center gap-1">
                            Đặt ngay <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>

                <!-- Route Card -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <img src="./images/39-4595-6687.jpg" alt="Đà Lạt"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-bold text-lg">Hồ Chí Minh</span>
                            <i class='bx bx-transfer-alt text-amber-500'></i>
                            <span class="font-bold text-lg">Đà Lạt</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">Từ 250.000đ • 20 chuyến/ngày</p>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hcmId, 'end_location_id' => $dalatId, 'trip_date' => date('Y-m-d')])); ?>"
                            class="text-amber-600 font-medium hover:text-amber-700 flex items-center gap-1">
                            Đặt ngay <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>

                <!-- Route Card -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <img src="./images/du-lich-sapa.jpg" alt="Sapa"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-bold text-lg">Hà Nội</span>
                            <i class='bx bx-transfer-alt text-amber-500'></i>
                            <span class="font-bold text-lg">Sapa</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">Từ 300.000đ • 10 chuyến/ngày</p>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hanoiId, 'end_location_id' => $sapaId, 'trip_date' => date('Y-m-d')])); ?>"
                            class="text-amber-600 font-medium hover:text-amber-700 flex items-center gap-1">
                            Đặt ngay <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>

                <!-- Route Card -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <img src="./images/z6223362576777_15a21ef00a73b25851a3972d86795475_20250113104122.jpg" alt="Nha Trang"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-bold text-lg">Hồ Chí Minh</span>
                            <i class='bx bx-transfer-alt text-amber-500'></i>
                            <span class="font-bold text-lg">Nha Trang</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">Từ 280.000đ • 15 chuyến/ngày</p>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hcmId, 'end_location_id' => $nhatrangId, 'trip_date' => date('Y-m-d')])); ?>"
                            class="text-amber-600 font-medium hover:text-amber-700 flex items-center gap-1">
                            Đặt ngay <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="#search"
                    class="inline-block border-2 border-amber-500 text-amber-600 hover:bg-amber-500 hover:text-white font-medium px-8 py-3 rounded-xl transition-colors">
                    Xem tất cả tuyến đường
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Dịch vụ chất lượng cao</h2>
                <div class="w-16 h-1 bg-amber-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm text-center transform hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Đặt vé siêu tốc</h3>
                    <p class="text-gray-600">Ứng dụng công nghệ hàng đầu, quá trình tìm chuyến và thanh toán chỉ mất 1
                        phút.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm text-center transform hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Chắc chắn có ghế</h3>
                    <p class="text-gray-600">Hỗ trợ giữ chỗ thanh toán trong 15 phút, yên tâm 100% khi mua vé các dịp lễ
                        Tết.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm text-center transform hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Đúng giờ xuất bến</h3>
                    <p class="text-gray-600">Cam kết lịch trình chặt chẽ, khởi hành đúng khung giờ như trên vé bạn chọn.
                    </p>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/customer/home/index.blade.php ENDPATH**/ ?>