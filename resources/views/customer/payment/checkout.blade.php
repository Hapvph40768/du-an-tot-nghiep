@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 lg:py-20 relative min-h-[80vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                    <i data-lucide="credit-card" class="w-8 h-8 text-brand-primary"></i> Thanh Toán
                </h2>
                <p class="text-white/50 mt-1">Hoàn tất thanh toán để giữ chỗ trên chuyến xe của bạn.</p>
            </div>
            <span class="inline-flex px-4 py-1.5 bg-white/5 text-white/70 border border-white/10 rounded-full font-mono text-sm shadow-inner">Đơn hàng #{{ $booking->id }}</span>
        </div>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- Cột trái: Phương thức thanh toán -->
            <div class="lg:col-span-2 order-2 lg:order-1">
                <form action="{{ route('customer.payment.process', $booking->id) }}" method="POST" id="payment-form">
                    @csrf
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-primary/10 rounded-full blur-[50px] pointer-events-none"></div>
                        
                        <h3 class="font-bold text-xl text-white mb-6 border-b border-white/10 pb-4 flex items-center gap-2">
                            <i data-lucide="wallet" class="w-5 h-5 text-brand-primary"></i> Chọn phương thức thanh toán
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- VNPay -->
                            <label class="block relative border border-white/10 bg-black/20 rounded-2xl p-4 cursor-pointer hover:border-brand-primary/50 transition-all group has-[:checked]:border-brand-primary has-[:checked]:bg-brand-primary/10">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-5 h-5 rounded-full border border-white/30 flex items-center justify-center group-has-[:checked]:border-brand-primary group-has-[:checked]:bg-brand-primary">
                                            <i data-lucide="check" class="w-3 h-3 text-white opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></i>
                                        </div>
                                        <input type="radio" name="payment_method" value="vnpay" required class="hidden">
                                    </div>
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-2 shadow-inner">
                                        <img src="https://vnpay.vn/s1/itrsp/resources/images/logo.svg" alt="VNPay" class="w-full h-auto">
                                    </div>
                                    <div class="flex-1">
                                        <span class="font-bold text-white block text-lg">VNPay</span>
                                        <span class="text-xs text-white/50 block">Thanh toán qua thẻ ATM, Internet Banking</span>
                                    </div>
                                </div>
                            </label>

                            <!-- MoMo -->
                            <label class="block relative border border-white/10 bg-black/20 rounded-2xl p-4 cursor-pointer hover:border-brand-primary/50 transition-all group has-[:checked]:border-[#a50064] has-[:checked]:bg-[#a50064]/10">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-5 h-5 rounded-full border border-white/30 flex items-center justify-center group-has-[:checked]:border-[#a50064] group-has-[:checked]:bg-[#a50064]">
                                            <i data-lucide="check" class="w-3 h-3 text-white opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></i>
                                        </div>
                                        <input type="radio" name="payment_method" value="momo" required class="hidden">
                                    </div>
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-2 shadow-inner">
                                        <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" alt="MoMo" class="w-full h-auto">
                                    </div>
                                    <div class="flex-1">
                                        <span class="font-bold text-white block text-lg">Ví MoMo</span>
                                        <span class="text-xs text-white/50 block">Quét mã QR qua ứng dụng MoMo</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Cash -->
                            <label class="block relative border border-white/10 bg-black/20 rounded-2xl p-4 cursor-pointer hover:border-brand-primary/50 transition-all group has-[:checked]:border-brand-accent has-[:checked]:bg-brand-accent/10">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-5 h-5 rounded-full border border-white/30 flex items-center justify-center group-has-[:checked]:border-brand-accent group-has-[:checked]:bg-brand-accent">
                                            <i data-lucide="check" class="w-3 h-3 text-white opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></i>
                                        </div>
                                        <input type="radio" name="payment_method" value="cash" required class="hidden">
                                    </div>
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-white shadow-inner">
                                        <i data-lucide="banknote" class="w-6 h-6"></i>
                                    </div>
                                    <div class="flex-1">
                                        <span class="font-bold text-white block text-lg">Tiền mặt</span>
                                        <span class="text-xs text-white/50 block">Thanh toán trực tiếp tại văn phòng hoặc quầy vé</span>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <button type="submit" class="w-full liquid-gradient text-white font-bold py-4 rounded-xl mt-8 text-lg hover:scale-[1.02] active:scale-[0.98] transition-transform shadow-lg shadow-brand-primary/20 flex items-center justify-center gap-2">
                            Tiến hành thanh toán <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Cột phải: Thông tin đơn hàng (Sticky) -->
            <div class="lg:col-span-1 order-1 lg:order-2">
                <div class="sticky top-28 bg-white/5 border border-white/10 rounded-3xl p-6 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand-primary/5 rounded-full blur-[40px] pointer-events-none"></div>
                    
                    <h3 class="font-bold text-lg text-white mb-6 border-b border-white/10 pb-4 flex items-center gap-2">
                        <i data-lucide="receipt" class="w-5 h-5 text-brand-primary"></i> Tóm tắt đơn hàng
                    </h3>

                    <div class="space-y-4 text-sm mb-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-white/50">Hành khách:</span> 
                            <span class="font-bold text-white text-lg">{{ $booking->contact_name }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-white/50">Số điện thoại:</span> 
                            <span class="font-bold text-white">{{ $booking->contact_phone }}</span>
                        </div>
                    </div>

                    <div class="bg-black/20 rounded-2xl p-4 border border-white/5 mb-6">
                        <div class="flex items-center justify-between text-white/70 mb-2">
                            <span>Giá vé gốc</span>
                            <span>{{ number_format($booking->total_amount, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between text-white/70 mb-4 pb-4 border-b border-white/5">
                            <span>Phí xử lý</span>
                            <span>0 đ</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-white uppercase text-sm tracking-wider">Tổng cộng</span>
                            <span class="text-2xl font-black text-brand-primary">{{ number_format($booking->total_amount, 0, ',', '.') }} đ</span>
                        </div>
                    </div>

                    <div class="bg-amber-500/10 border border-amber-500/20 text-amber-400 p-4 rounded-2xl text-xs flex items-start gap-3 leading-relaxed">
                        <i data-lucide="clock" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                        <p><strong>Lưu ý quan trọng:</strong> Vui lòng hoàn tất thanh toán trong vòng <span class="font-bold">15 phút</span> để đảm bảo giữ được chỗ ngồi của bạn.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
