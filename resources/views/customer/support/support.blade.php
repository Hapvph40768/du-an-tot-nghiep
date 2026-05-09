@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 lg:py-20 relative min-h-[80vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight uppercase flex items-center justify-center md:justify-start gap-3">
                <i data-lucide="help-circle" class="w-8 h-8 text-brand-primary"></i> Gửi yêu cầu hỗ trợ
            </h2>
            <p class="text-white/50 mt-2">Chúng tôi luôn sẵn sàng lắng nghe và giải quyết vấn đề của bạn.</p>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-primary/10 rounded-full blur-[80px] pointer-events-none"></div>
            
            <form action="{{ route('customer.support.store') }}" method="POST">
                @csrf
                
                <!-- Loại hỗ trợ -->
                <div class="mb-8">
                    <label class="block text-white font-bold mb-4">Vui lòng chọn danh mục hỗ trợ <span class="text-red-400">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Thanh toán -->
                        <label class="block relative group cursor-pointer">
                            <input type="radio" name="type" value="payment" required class="peer hidden" onclick="updateDesc('Thanh toán')">
                            <div class="h-full bg-black/20 border border-white/10 rounded-2xl p-6 flex flex-col items-center text-center gap-3 transition-all peer-checked:border-brand-primary peer-checked:bg-brand-primary/10 peer-checked:shadow-[0_0_20px_rgba(255,91,36,0.15)] group-hover:border-white/30">
                                <i data-lucide="credit-card" class="w-8 h-8 text-white/50 peer-checked:text-brand-primary group-hover:text-white transition-colors"></i>
                                <span class="font-bold text-white/70 peer-checked:text-white group-hover:text-white transition-colors">Thanh toán</span>
                                <div class="absolute top-3 right-3 w-4 h-4 rounded-full border border-white/30 flex items-center justify-center peer-checked:border-brand-primary peer-checked:bg-brand-primary">
                                    <i data-lucide="check" class="w-2.5 h-2.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                </div>
                            </div>
                        </label>

                        <!-- Đổi/Hủy vé -->
                        <label class="block relative group cursor-pointer">
                            <input type="radio" name="type" value="ticket" class="peer hidden" onclick="updateDesc('Vé xe')">
                            <div class="h-full bg-black/20 border border-white/10 rounded-2xl p-6 flex flex-col items-center text-center gap-3 transition-all peer-checked:border-brand-primary peer-checked:bg-brand-primary/10 peer-checked:shadow-[0_0_20px_rgba(255,91,36,0.15)] group-hover:border-white/30">
                                <i data-lucide="ticket" class="w-8 h-8 text-white/50 peer-checked:text-brand-primary group-hover:text-white transition-colors"></i>
                                <span class="font-bold text-white/70 peer-checked:text-white group-hover:text-white transition-colors">Đổi/Hủy vé</span>
                                <div class="absolute top-3 right-3 w-4 h-4 rounded-full border border-white/30 flex items-center justify-center peer-checked:border-brand-primary peer-checked:bg-brand-primary">
                                    <i data-lucide="check" class="w-2.5 h-2.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                </div>
                            </div>
                        </label>

                        <!-- Khiếu nại -->
                        <label class="block relative group cursor-pointer">
                            <input type="radio" name="type" value="complaint" class="peer hidden" onclick="updateDesc('Khiếu nại')">
                            <div class="h-full bg-black/20 border border-white/10 rounded-2xl p-6 flex flex-col items-center text-center gap-3 transition-all peer-checked:border-brand-primary peer-checked:bg-brand-primary/10 peer-checked:shadow-[0_0_20px_rgba(255,91,36,0.15)] group-hover:border-white/30">
                                <i data-lucide="alert-triangle" class="w-8 h-8 text-white/50 peer-checked:text-brand-primary group-hover:text-white transition-colors"></i>
                                <span class="font-bold text-white/70 peer-checked:text-white group-hover:text-white transition-colors">Khiếu nại</span>
                                <div class="absolute top-3 right-3 w-4 h-4 rounded-full border border-white/30 flex items-center justify-center peer-checked:border-brand-primary peer-checked:bg-brand-primary">
                                    <i data-lucide="check" class="w-2.5 h-2.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Chuyến đi liên quan -->
                <div class="mb-6">
                    <label class="block text-white font-bold mb-2">Chuyến đi liên quan <span class="text-white/40 font-normal">(Không bắt buộc)</span></label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                            <i data-lucide="bus" class="w-5 h-5"></i>
                        </div>
                        <select name="booking_id" class="w-full px-4 py-3.5 pl-11 bg-black/30 border border-white/10 rounded-xl text-white appearance-none focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors">
                            <option value="" class="bg-gray-900 text-white/50">-- Chọn chuyến đi --</option>
                            @isset($bookings)
                                @foreach($bookings as $booking)
                                    <option value="{{ $booking->id }}" class="bg-gray-900">Mã #{{ $booking->id }} - {{ $booking->trip->route->departureLocation->name ?? 'N/A' }} đi {{ $booking->trip->route->destinationLocation->name ?? 'N/A' }}</option>
                                @endforeach
                            @endisset
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-white/40">
                            <i data-lucide="chevron-down" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>

                <!-- Mô tả chi tiết -->
                <div class="mb-8">
                    <label class="block text-white font-bold mb-2">Mô tả chi tiết vấn đề <span class="text-red-400">*</span></label>
                    <textarea name="description" id="description" rows="5" placeholder="Hãy mô tả vấn đề của bạn tại đây..." required
                        class="w-full px-4 py-3 bg-black/30 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors resize-y placeholder-white/20"></textarea>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-white/10">
                    <button type="submit" class="flex-1 liquid-gradient hover:scale-[1.02] transition-transform text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-brand-primary/20 flex items-center justify-center gap-2">
                        Gửi yêu cầu ngay <i data-lucide="send" class="w-4 h-4"></i>
                    </button>
                    <a href="{{ route('customer.support.index') }}" class="sm:w-1/3 bg-white/5 hover:bg-white/10 text-white font-bold py-4 px-6 rounded-xl border border-white/10 flex items-center justify-center transition-colors">
                        Hủy bỏ
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function updateDesc(type) {
        let desc = document.getElementById('description');
        if(type === 'Thanh toán') {
            desc.value = "Tôi gặp vấn đề khi thanh toán cho đơn hàng. Tiền đã bị trừ nhưng vé chưa xác nhận...";
        } else if(type === 'Vé xe') {
            desc.value = "Tôi muốn đổi ngày đi hoặc hủy vé cho chuyến xe sắp tới. Lý do là...";
        } else if(type === 'Khiếu nại') {
            desc.value = "Tôi không hài lòng về chất lượng phục vụ/thái độ nhân viên tại nhà xe...";
        }
        desc.focus();
    }
</script>
@endpush
@endsection
