

<?php $__env->startSection('content-main'); ?>
    <section id="search" class="gradient-hero bus-pattern text-white py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-8 slide-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-3">Đặt vé xe khách trực tuyến</h2>
                <p class="text-lg text-blue-200">Hơn 500+ chuyến xe mỗi ngày trên toàn quốc</p>
            </div>

            <!-- Promo Banner -->
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl p-4 mb-8 max-w-2xl mx-auto">
                <div class="flex items-center justify-center gap-3">
                    <span class="text-2xl">🎉</span>
                    <p id="promo-text" class="font-semibold">Giảm 20% cho khách hàng mới - Nhập mã: MANHHUNG20</p>
                </div>
            </div>

            <!-- Search Form -->
            <div class="bg-white rounded-2xl card-shadow p-6 max-w-4xl mx-auto">
                <form id="search-form" class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 text-sm">Điểm đi</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                                <select id="from-city"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none input-search text-gray-700">
                                    <option value="">Chọn điểm đi</option>
                                    <option value="hanoi">Hà Nội</option>
                                    <option value="hochiminh">TP. Hồ Chí Minh</option>
                                    <option value="danang">Đà Nẵng</option>
                                    <option value="haiphong">Hải Phòng</option>
                                    <option value="nhatrang">Nha Trang</option>
                                    <option value="dalat">Đà Lạt</option>
                                    <option value="cantho">Cần Thơ</option>
                                    <option value="hue">Huế</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2 text-sm">Điểm đến</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                                <select id="to-city"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none input-search text-gray-700">
                                    <option value="">Chọn điểm đến</option>
                                    <option value="hanoi">Hà Nội</option>
                                    <option value="hochiminh">TP. Hồ Chí Minh</option>
                                    <option value="danang">Đà Nẵng</option>
                                    <option value="haiphong">Hải Phòng</option>
                                    <option value="nhatrang">Nha Trang</option>
                                    <option value="dalat">Đà Lạt</option>
                                    <option value="cantho">Cần Thơ</option>
                                    <option value="hue">Huế</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 text-sm">Ngày đi</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z" />
                                </svg>
                                <input type="date" id="travel-date"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none input-search text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2 text-sm">Số lượng vé</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                                </svg>
                                <select id="ticket-count"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none input-search text-gray-700">
                                    <option value="1">1 vé</option>
                                    <option value="2">2 vé</option>
                                    <option value="3">3 vé</option>
                                    <option value="4">4 vé</option>
                                    <option value="5">5 vé</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full btn-primary text-white font-bold py-3 px-6 rounded-xl flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                </svg>
                                Tìm chuyến xe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/home/index.blade.php ENDPATH**/ ?>