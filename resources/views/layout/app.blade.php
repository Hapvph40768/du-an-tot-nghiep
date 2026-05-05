<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="view-transition" content="same-origin">
    <title>{{ $title ?? 'Nhà xe Mạnh Hùng - Đặt vé xe nhanh 30s' }}</title>
    
    <!-- Alpine.js -->

    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @livewireStyles
    @stack('styles')
</head>
<body class="bg-brand-dark text-white font-sans antialiased selection:bg-brand-primary/30" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Atmosphere Background -->
    <div class="fixed inset-0 -z-10 bg-brand-dark">
        <div class="absolute top-[10%] left-[5%] w-[40%] h-[40%] rounded-full bg-brand-primary/20 blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[10%] right-[5%] w-[30%] h-[30%] rounded-full bg-brand-accent/10 blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <!-- Navigation -->
    <nav 
        :class="scrolled ? 'glass-dark py-3' : 'bg-transparent py-6'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-apple px-6 lg:px-12"
    >
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl liquid-gradient flex items-center justify-center shadow-lg shadow-brand-primary/20">
                    <i data-lucide="bus" class="text-white w-6 h-6"></i>
                </div>
                <span class="font-heading text-xl font-bold tracking-tight">NHÀ XE <span class="text-brand-accent">MẠNH HÙNG</span></span>
            </a>

            <div class="hidden md:flex items-center gap-8 font-medium text-sm tracking-wide text-white/70">
                <a href="/" class="hover:text-brand-accent transition-colors">Trang chủ</a>
                <a href="#routes" class="hover:text-brand-accent transition-colors">Lịch trình</a>
                <a href="{{ route('customer.bookings.index') }}" class="hover:text-brand-accent transition-colors">Tra cứu vé</a>
                <a href="#contact" class="hover:text-brand-accent transition-colors">Liên hệ</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="#booking" class="hidden sm:inline-flex items-center px-6 py-2.5 rounded-full bg-white text-brand-dark font-semibold text-sm hover:bg-brand-accent hover:text-white transition-all duration-300 shadow-xl shadow-white/5">
                    Đặt vé ngay
                </a>

                @guest
                    <a href="{{ route('login') }}" class="hidden lg:inline-flex items-center px-5 py-2.5 rounded-full glass text-white font-semibold text-sm hover:bg-white/20 transition-all">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="hidden lg:inline-flex items-center px-5 py-2.5 rounded-full liquid-gradient text-white font-semibold text-sm hover:scale-105 transition-all shadow-lg shadow-brand-primary/20">
                        Đăng ký
                    </a>
                @endguest

                @auth
                    <div class="flex items-center gap-3">
                        <a href="{{ route('customer.profile.edit') }}" class="hidden lg:inline-flex items-center gap-2 px-4 py-2 rounded-full glass text-white/90 hover:text-white transition-all text-sm font-medium">
                            <i data-lucide="user" class="w-4 h-4 text-brand-accent"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2.5 rounded-full glass text-white/70 hover:text-red-400 hover:bg-red-400/10 transition-all" title="Đăng xuất">
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                @endauth

                <button class="md:hidden text-white">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative pt-24 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-24 border-t border-white/5 bg-black/20 backdrop-blur-md py-16 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-lg liquid-gradient flex items-center justify-center">
                        <i data-lucide="bus" class="text-white w-5 h-5"></i>
                    </div>
                    <span class="font-heading text-lg font-bold tracking-tight">MẠNH HÙNG</span>
                </div>
                <p class="text-white/50 text-sm leading-relaxed">
                    Dịch vụ vận tải hành khách cao cấp, mang lại trải nghiệm an toàn và thoải mái nhất trên mọi cung đường.
                </p>
            </div>
            
            <div>
                <h4 class="font-heading text-white font-semibold mb-6">Liên kết</h4>
                <ul class="space-y-4 text-white/50 text-sm">
                    <li><a href="#" class="hover:text-brand-accent transition-colors">Về chúng tôi</a></li>
                    <li><a href="#" class="hover:text-brand-accent transition-colors">Chính sách bảo mật</a></li>
                    <li><a href="#" class="hover:text-brand-accent transition-colors">Điều khoản dịch vụ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-heading text-white font-semibold mb-6">Hỗ trợ</h4>
                <ul class="space-y-4 text-white/50 text-sm">
                    <li><a href="#" class="hover:text-brand-accent transition-colors">Trung tâm hỗ trợ</a></li>
                    <li><a href="#" class="hover:text-brand-accent transition-colors">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="hover:text-brand-accent transition-colors">Liên hệ hỗ trợ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-heading text-white font-semibold mb-6">Kết nối</h4>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full glass flex items-center justify-center hover:bg-brand-primary transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full glass flex items-center justify-center hover:bg-brand-primary transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full glass flex items-center justify-center hover:bg-brand-primary transition-colors">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto mt-16 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-white/30 text-xs text-center md:text-left">
                &copy; 2026 Nhà xe Mạnh Hùng. All rights reserved. Designed for Luxury.
            </p>
            <div class="flex gap-6 grayscale opacity-30 hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                <!-- Payment Icons could go here -->
                <span class="text-xs font-bold tracking-widest">VNPAY SECURED</span>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>