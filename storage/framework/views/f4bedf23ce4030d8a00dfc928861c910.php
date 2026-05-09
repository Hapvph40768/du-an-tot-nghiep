<footer class="bg-[#050505] border-t border-white/5 pt-16 pb-8 relative overflow-hidden">
    <!-- Glow Effect -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-1 bg-gradient-to-r from-transparent via-brand-primary/50 to-transparent blur-sm"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Info -->
            <div class="space-y-6">
                <a href="<?php echo e(route('customer.home')); ?>" class="flex items-center gap-3 group inline-flex">
                    <div class="w-10 h-10 rounded-xl liquid-gradient flex items-center justify-center shadow-lg shadow-brand-primary/20 group-hover:scale-105 transition-transform">
                        <i data-lucide="bus" class="text-white w-5 h-5"></i>
                    </div>
                    <span class="text-xl font-black tracking-tight uppercase group-hover:text-brand-primary transition-colors">Mạnh Hùng</span>
                </a>
                <p class="text-sm text-white/50 leading-relaxed">
                    Trải nghiệm dịch vụ xe khách 5 sao hàng đầu Việt Nam. An toàn, tiện lợi và luôn đúng giờ.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/70 hover:bg-brand-primary hover:text-white hover:border-brand-primary transition-all">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/70 hover:bg-brand-primary hover:text-white hover:border-brand-primary transition-all">
                        <i data-lucide="youtube" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/70 hover:bg-brand-primary hover:text-white hover:border-brand-primary transition-all">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-white font-bold mb-6 flex items-center gap-2">
                    <i data-lucide="compass" class="w-4 h-4 text-brand-primary"></i> Dịch vụ
                </h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="<?php echo e(url('/#search')); ?>" class="text-white/50 hover:text-white hover:pl-2 transition-all block">Đặt vé trực tuyến</a></li>
                    <li><a href="<?php echo e(route('customer.parcels.create')); ?>" class="text-white/50 hover:text-white hover:pl-2 transition-all block">Ký gửi hàng hóa</a></li>
                    <li><a href="#" class="text-white/50 hover:text-white hover:pl-2 transition-all block">Thuê xe hợp đồng</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-white font-bold mb-6 flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-4 h-4 text-brand-primary"></i> Hỗ trợ
                </h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="text-white/50 hover:text-white hover:pl-2 transition-all block">Hướng dẫn đặt vé</a></li>
                    <li><a href="#" class="text-white/50 hover:text-white hover:pl-2 transition-all block">Chính sách hủy/đổi vé</a></li>
                    <li><a href="#" class="text-white/50 hover:text-white hover:pl-2 transition-all block">Quy định hành lý</a></li>
                    <li><a href="#" class="text-white/50 hover:text-white hover:pl-2 transition-all block">Câu hỏi thường gặp</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-white font-bold mb-6 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-brand-primary"></i> Liên hệ
                </h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3 text-white/50">
                        <i data-lucide="phone-call" class="w-5 h-5 text-brand-accent flex-shrink-0 mt-0.5"></i>
                        <div>
                            <p class="font-medium text-white">Hotline 24/7</p>
                            <p class="text-lg font-bold text-brand-primary mt-1">1900 6868</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3 text-white/50">
                        <i data-lucide="mail" class="w-5 h-5 text-brand-accent flex-shrink-0 mt-0.5"></i>
                        <span>cskh@manhhung.vn</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-white/40">
            <p>&copy; 2026 Hệ thống đặt vé xe Mạnh Hùng. Đã đăng ký bản quyền.</p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-white transition-colors">Điều khoản sử dụng</a>
                <a href="#" class="hover:text-white transition-colors">Chính sách bảo mật</a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/layout/customer/blocks/footer.blade.php ENDPATH**/ ?>