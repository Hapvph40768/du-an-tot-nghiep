<?php $__env->startSection('page-title', 'Trang chủ'); ?>

<?php $__env->startSection('content-main'); ?>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Chuyến xe hôm nay</h2>
                <a href="#" class="text-amber-600 hover:text-amber-700 font-medium flex items-center gap-2">
                    Xem tất cả chuyến <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Trip Card 1 -->
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all">
                    <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span
                                    class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                    08:00
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500">Xe: </span>
                                <span class="font-semibold">29B-123.45</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mb-5">
                            <div class="flex-1">
                                <p class="font-bold text-lg">Hà Nội</p>
                                <p class="text-xs text-gray-500">Điểm đi</p>
                            </div>
                            <div class="text-amber-500">
                                <i class='bx bx-transfer-alt text-3xl'></i>
                            </div>
                            <div class="flex-1 text-right">
                                <p class="font-bold text-lg">Đà Nẵng</p>
                                <p class="text-xs text-gray-500">Điểm đến</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-medium">28/45</span>
                                <span class="text-gray-400">ghế</span>
                            </div>
                            <button onclick="alert('Bắt đầu chuyến xe này?')"
                                class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl transition-all active:scale-95">
                                Bắt đầu chuyến
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Trip Card 2 -->
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all">
                    <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span
                                    class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                    14:30
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500">Xe: </span>
                                <span class="font-semibold">29B-567.89</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mb-5">
                            <div class="flex-1">
                                <p class="font-bold text-lg">Hà Nội</p>
                                <p class="text-xs text-gray-500">Điểm đi</p>
                            </div>
                            <div class="text-amber-500">
                                <i class='bx bx-transfer-alt text-3xl'></i>
                            </div>
                            <div class="flex-1 text-right">
                                <p class="font-bold text-lg">Sapa</p>
                                <p class="text-xs text-gray-500">Điểm đến</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-medium">12/28</span>
                                <span class="text-gray-400">ghế</span>
                            </div>
                            <button onclick="alert('Bắt đầu chuyến xe này?')"
                                class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl transition-all active:scale-95">
                                Bắt đầu chuyến
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Trip Card 3 -->
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all">
                    <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span
                                    class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                    20:15
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500">Xe: </span>
                                <span class="font-semibold">29B-999.88</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mb-5">
                            <div class="flex-1">
                                <p class="font-bold text-lg">Hà Nội</p>
                                <p class="text-xs text-gray-500">Điểm đi</p>
                            </div>
                            <div class="text-amber-500">
                                <i class='bx bx-transfer-alt text-3xl'></i>
                            </div>
                            <div class="flex-1 text-right">
                                <p class="font-bold text-lg">Nha Trang</p>
                                <p class="text-xs text-gray-500">Điểm đến</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-medium">35/45</span>
                                <span class="text-gray-400">ghế</span>
                            </div>
                            <button onclick="alert('Bắt đầu chuyến xe này?')"
                                class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl transition-all active:scale-95">
                                Bắt đầu chuyến
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.driver.DriverLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/driver/home/home.blade.php ENDPATH**/ ?>