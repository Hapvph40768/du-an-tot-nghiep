<!DOCTYPE html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xe Khách Mạnh Hùng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/_sdk/element_sdk.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
</head>

<body class="h-full bg-gray-50">
    <div id="app-wrapper" class="w-full h-full overflow-auto">

        <!-- Header + search -->
        @include('layout.customer.blocks.header')
        <!-- Hero Section with Search -->

        {{-- content --}}
        @yield('content-main')
        <!-- Contact Section -->
        <section id="contact" class="py-12 gradient-hero bus-pattern text-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-10">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-6">Liên hệ với chúng tôi</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-blue-200">Hotline 24/7</p>
                                    <p class="font-bold text-lg">1900 6868</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-blue-200">Email</p>
                                    <p class="font-bold">contact@manhhung.vn</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-blue-200">Văn phòng</p>
                                    <p class="font-bold">123 Đường Láng, Đống Đa, Hà Nội</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-6">
                            <a href="#"
                                class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-6">
                        <h4 class="font-bold text-xl mb-4">Gửi yêu cầu hỗ trợ</h4>
                        <form id="contact-form" class="space-y-4">
                            <input type="text" placeholder="Họ và tên"
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-amber-400 placeholder-white/60">
                            <input type="tel" placeholder="Số điện thoại"
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-amber-400 placeholder-white/60">
                            <textarea placeholder="Nội dung cần hỗ trợ" rows="3"
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-amber-400 placeholder-white/60 resize-none"></textarea>
                            <button type="submit" class="w-full btn-primary text-white font-bold py-3 rounded-xl">
                                Gửi yêu cầu
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include('layout.customer.blocks.footer')

        <!-- Booking Modal -->
        <div id="booking-modal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full max-h-[90%] overflow-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Xác nhận đặt vé</h3><button id="close-modal"
                            class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                viewbox="0 0 24 24">
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
                        <div><label class="block text-gray-700 font-medium mb-2 text-sm">Email</label> <input
                                type="email" id="passenger-email"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:outline-none"
                                placeholder="Nhập email">
                        </div>
                    </div><button id="confirm-booking"
                        class="w-full btn-primary text-white font-bold py-3 rounded-xl mt-6"> Xác nhận đặt vé </button>
                </div>
            </div>
        </div>
        <!-- Success Toast -->
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

    <link rel="stylesheet" href="{{ asset('js/customer.js') }}">

</body>

</html>
