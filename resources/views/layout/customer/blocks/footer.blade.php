    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-amber-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z" />
                            </svg>
                        </div>
                        <span id="footer-brand" class="font-bold text-lg">Mạnh Hùng</span>
                    </div>
                    <p class="text-sm text-gray-400">Nhà xe uy tín hàng đầu Việt Nam với hơn 15 năm kinh nghiệm phục vụ
                        hành khách.</p>
                </div>

                <div>
                    <h5 class="font-bold mb-4">Dịch vụ</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Đặt vé online</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Thuê xe du lịch</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Gửi hàng hóa</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Đưa đón sân bay</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-bold mb-4">Hỗ trợ</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Hướng dẫn đặt vé</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Chính sách hoàn vé</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Câu hỏi thường gặp</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Điều khoản sử dụng</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-bold mb-4">Tải ứng dụng</h5>
                    <div class="space-y-3">
                        <a href="#"
                            class="flex items-center gap-3 bg-gray-800 px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" />
                            </svg>
                            <div>
                                <p class="text-xs text-gray-400">Tải trên</p>
                                <p class="text-sm font-medium">App Store</p>
                            </div>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 bg-gray-800 px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 010 1.73l-2.808 1.626L15.206 12l2.492-2.491zM5.864 2.658L16.8 8.99l-2.302 2.302-8.634-8.634z" />
                            </svg>
                            <div>
                                <p class="text-xs text-gray-400">Tải trên</p>
                                <p class="text-sm font-medium">Google Play</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 text-center text-sm text-gray-400">
                <p>© 2026 Nhà xe Mạnh Hùng. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>
    <!-- Booking Modal -->
    <div id="booking-modal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full max-h-[90%] overflow-auto">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Xác nhận đặt vé</h3><button id="close-modal"
                        class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg></button>
                </div>
                <div id="booking-details" class="space-y-4 mb-6"></div>
                <div class="space-y-4">
                    <div><label class="block text-gray-700 font-medium mb-2 text-sm">Họ và tên</label> <input
                            type="text" id="passenger-name"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none"
                            placeholder="Nhập họ và tên">
                    </div>
                    <div><label class="block text-gray-700 font-medium mb-2 text-sm">Số điện thoại</label> <input
                            type="tel" id="passenger-phone"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none"
                            placeholder="Nhập số điện thoại">
                    </div>
                    <div><label class="block text-gray-700 font-medium mb-2 text-sm">Email</label> <input type="email"
                            id="passenger-email"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none"
                            placeholder="Nhập email">
                    </div>
                </div><button id="confirm-booking" class="w-full btn-primary text-white font-bold py-3 rounded-xl mt-6">
                    Xác nhận đặt vé </button>
            </div>
        </div>
    </div><!-- Success Toast -->
    <div id="success-toast"
        class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg transform translate-y-full opacity-0 transition-all duration-300 z-50">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="currentColor" viewbox="0 0 24 24">
                <path
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
            </svg><span id="toast-message">Đặt vé thành công!</span>
        </div>
    </div>
    </div>
