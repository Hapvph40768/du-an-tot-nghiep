@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-20 pb-32 lg:pt-32 lg:pb-40 overflow-hidden">
        <!-- Background Image/Gradient -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2069&auto=format&fit=crop" alt="Bus background" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 text-center">
            <h1 class="text-4xl md:text-6xl font-bold font-heading mb-6 tracking-tight">
                Hành trình trọn vẹn, <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text liquid-gradient">An toàn tuyệt đối</span>
            </h1>
            <p class="text-white/70 text-lg max-w-2xl mx-auto mb-12">
                Hệ thống đặt vé xe trực tuyến hàng đầu. Chọn chỗ, thanh toán nhanh chóng chỉ trong 30 giây.
            </p>

            <!-- Search Form (Glassmorphism) -->
            <div class="glass p-6 md:p-8 rounded-3xl max-w-5xl mx-auto shadow-2xl shadow-brand-primary/10 border border-white/10">
                <form action="{{ route('customer.bookings.index') ?? '#' }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    
                    <!-- Điểm đi -->
                    <div class="text-left relative">
                        <label class="block text-sm font-medium text-white/70 mb-2 ml-1">Điểm đi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="map-pin" class="w-5 h-5 text-brand-accent"></i>
                            </div>
                            <select name="origin" class="w-full bg-white/5 border border-white/10 rounded-xl py-3.5 pl-11 pr-4 text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary appearance-none transition-all">
                                <option value="" class="bg-brand-dark text-white/50">Chọn điểm đi</option>
                                <option value="Hà Nội" class="bg-brand-dark text-white">Hà Nội</option>
                                <option value="Sapa" class="bg-brand-dark text-white">Sapa</option>
                                <option value="Hải Phòng" class="bg-brand-dark text-white">Hải Phòng</option>
                                <option value="Ninh Bình" class="bg-brand-dark text-white">Ninh Bình</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-white/50"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Điểm đến -->
                    <div class="text-left relative">
                        <label class="block text-sm font-medium text-white/70 mb-2 ml-1">Điểm đến</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="map-pin" class="w-5 h-5 text-brand-primary"></i>
                            </div>
                            <select name="destination" class="w-full bg-white/5 border border-white/10 rounded-xl py-3.5 pl-11 pr-4 text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary appearance-none transition-all">
                                <option value="" class="bg-brand-dark text-white/50">Chọn điểm đến</option>
                                <option value="Hà Nội" class="bg-brand-dark text-white">Hà Nội</option>
                                <option value="Sapa" class="bg-brand-dark text-white">Sapa</option>
                                <option value="Hải Phòng" class="bg-brand-dark text-white">Hải Phòng</option>
                                <option value="Ninh Bình" class="bg-brand-dark text-white">Ninh Bình</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-white/50"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Ngày đi -->
                    <div class="text-left relative">
                        <label class="block text-sm font-medium text-white/70 mb-2 ml-1">Ngày đi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="calendar" class="w-5 h-5 text-white/50"></i>
                            </div>
                            <input type="date" name="departure_date" class="w-full bg-white/5 border border-white/10 rounded-xl py-3.5 pl-11 pr-4 text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary appearance-none transition-all [color-scheme:dark]">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] transition-all py-3.5 rounded-xl text-white font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/30">
                            <i data-lucide="search" class="w-5 h-5"></i>
                            Tìm chuyến xe
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-black/10 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 text-center">
                <div class="glass p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 rounded-full bg-brand-primary/20 flex items-center justify-center mx-auto mb-6 text-brand-primary">
                        <i data-lucide="zap" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Đặt vé siêu tốc</h3>
                    <p class="text-white/60 text-sm leading-relaxed">Chỉ với 3 bước đơn giản, bạn có thể chọn được chỗ ngồi ưng ý và thanh toán trong chưa đầy 30 giây.</p>
                </div>

                <div class="glass p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 rounded-full bg-brand-accent/20 flex items-center justify-center mx-auto mb-6 text-brand-accent">
                        <i data-lucide="shield-check" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Thanh toán an toàn</h3>
                    <p class="text-white/60 text-sm leading-relaxed">Tích hợp đa dạng cổng thanh toán, đảm bảo bảo mật thông tin tuyệt đối cho mọi giao dịch của bạn.</p>
                </div>

                <div class="glass p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 rounded-full bg-purple-500/20 flex items-center justify-center mx-auto mb-6 text-purple-400">
                        <i data-lucide="headphones" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Hỗ trợ 24/7</h3>
                    <p class="text-white/60 text-sm leading-relaxed">Đội ngũ CSKH chuyên nghiệp luôn sẵn sàng giải đáp và hỗ trợ mọi vấn đề trong suốt chuyến đi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Routes -->
    <section id="routes" class="py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <h2 class="text-3xl font-bold font-heading text-white mb-4">Tuyến Đường Phổ Biến</h2>
                    <p class="text-white/60 max-w-2xl">Những chuyến đi được khách hàng lựa chọn nhiều nhất. Trải nghiệm dịch vụ xe Limousine cao cấp với giá cả hợp lý.</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 text-brand-accent hover:text-white transition-colors font-medium">
                    Xem tất cả chuyến <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Route Card 1 -->
                <div class="group rounded-3xl bg-white/5 border border-white/10 overflow-hidden hover:bg-white/10 transition-colors">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1596423735880-5f2a689b903e?q=80&w=2070&auto=format&fit=crop" alt="Hanoi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark to-transparent"></div>
                        <div class="absolute bottom-4 left-4 flex gap-2">
                            <span class="px-3 py-1 text-xs font-semibold bg-brand-primary text-white rounded-full">Limousine</span>
                            <span class="px-3 py-1 text-xs font-semibold bg-black/50 backdrop-blur-sm text-white rounded-full">Hot</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-white">Hà Nội ↔ Sapa</h3>
                            <span class="text-brand-accent font-bold">Từ 350.000đ</span>
                        </div>
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-white/70 gap-3">
                                <i data-lucide="clock" class="w-4 h-4 text-white/50"></i> 6 tiếng (320km)
                            </div>
                            <div class="flex items-center text-sm text-white/70 gap-3">
                                <i data-lucide="calendar-days" class="w-4 h-4 text-white/50"></i> 15 chuyến/ngày
                            </div>
                        </div>
                        <button class="w-full py-2.5 rounded-xl border border-white/20 text-white font-medium hover:bg-white hover:text-brand-dark transition-colors">
                            Đặt vé tuyến này
                        </button>
                    </div>
                </div>

                <!-- Route Card 2 -->
                <div class="group rounded-3xl bg-white/5 border border-white/10 overflow-hidden hover:bg-white/10 transition-colors">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1620914949504-f5979eb46d03?q=80&w=1974&auto=format&fit=crop" alt="Hanoi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark to-transparent"></div>
                        <div class="absolute bottom-4 left-4 flex gap-2">
                            <span class="px-3 py-1 text-xs font-semibold bg-brand-primary text-white rounded-full">Giường nằm</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-white">Hà Nội ↔ Hải Phòng</h3>
                            <span class="text-brand-accent font-bold">Từ 120.000đ</span>
                        </div>
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-white/70 gap-3">
                                <i data-lucide="clock" class="w-4 h-4 text-white/50"></i> 1.5 tiếng (100km)
                            </div>
                            <div class="flex items-center text-sm text-white/70 gap-3">
                                <i data-lucide="calendar-days" class="w-4 h-4 text-white/50"></i> Liên tục mỗi 30p
                            </div>
                        </div>
                        <button class="w-full py-2.5 rounded-xl border border-white/20 text-white font-medium hover:bg-white hover:text-brand-dark transition-colors">
                            Đặt vé tuyến này
                        </button>
                    </div>
                </div>

                <!-- Route Card 3 -->
                <div class="group rounded-3xl bg-white/5 border border-white/10 overflow-hidden hover:bg-white/10 transition-colors">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?q=80&w=2105&auto=format&fit=crop" alt="Hanoi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark to-transparent"></div>
                        <div class="absolute bottom-4 left-4 flex gap-2">
                            <span class="px-3 py-1 text-xs font-semibold bg-brand-primary text-white rounded-full">Limousine VIP</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-white">Hà Nội ↔ Ninh Bình</h3>
                            <span class="text-brand-accent font-bold">Từ 180.000đ</span>
                        </div>
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-white/70 gap-3">
                                <i data-lucide="clock" class="w-4 h-4 text-white/50"></i> 2 tiếng (110km)
                            </div>
                            <div class="flex items-center text-sm text-white/70 gap-3">
                                <i data-lucide="calendar-days" class="w-4 h-4 text-white/50"></i> 10 chuyến/ngày
                            </div>
                        </div>
                        <button class="w-full py-2.5 rounded-xl border border-white/20 text-white font-medium hover:bg-white hover:text-brand-dark transition-colors">
                            Đặt vé tuyến này
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
