    <header class="gradient-hero bus-pattern text-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z" />
                        </svg>
                    </div>
                    <div>
                        <h1 id="brand-name" class="text-xl font-bold">Mạnh Hùng</h1>
                        <p id="slogan" class="text-xs text-amber-300">An toàn - Chất lượng - Đúng giờ</p>
                    </div>
                </div>

                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a href="#search" class="hover:text-amber-300 transition-colors">Đặt vé</a>
                    <a href="#routes" class="hover:text-amber-300 transition-colors">Tuyến đường</a>
                    <a href="#features" class="hover:text-amber-300 transition-colors">Dịch vụ</a>
                    <a href="#contact" class="hover:text-amber-300 transition-colors">Liên hệ</a>
                </nav>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 bg-white/10 px-3 py-2 rounded-lg">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        <span id="hotline" class="font-semibold text-amber-300">1900 6868</span>
                    </div>
                    <!-- Logout -->
                    <?php if(auth()->guard()->check()): ?>
                        <form action="<?php echo e(route('logout')); ?>" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn đăng xuất?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="logout-btn">
                                <i class='bx bx-log-out'></i>
                                Đăng xuất
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
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
<?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/layout/customer/blocks/header.blade.php ENDPATH**/ ?>