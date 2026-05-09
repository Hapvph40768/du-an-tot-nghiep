@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 lg:py-20 relative min-h-[80vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                <i data-lucide="refresh-cw" class="w-8 h-8 text-brand-primary"></i> Đổi Chuyến / Ngày đi
            </h2>
            <a href="{{ route('customer.bookings.show', $booking->id) }}" class="px-4 py-2 bg-white/10 text-white border border-white/20 rounded-xl font-medium text-sm hover:bg-white/20 transition-colors flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
            </a>
        </div>

        @if (session('error'))
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-8 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-brand-primary/10 rounded-full blur-[60px] pointer-events-none"></div>
            
            <h3 class="font-bold text-xl text-white mb-6 flex items-center gap-2">
                <i data-lucide="info" class="w-5 h-5 text-brand-primary"></i> Thông tin đổi vé (Mã vé: #{{ $booking->id }})
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm bg-black/20 p-6 rounded-2xl border border-white/5">
                <div>
                    <p class="text-white/50 mb-1">Tiền vé cũ đã thanh toán:</p>
                    <p class="font-bold text-white text-xl">{{ number_format($booking->total_amount) }} đ</p>
                </div>
                <div>
                    <p class="text-red-400/80 mb-1">Phí đổi vé (10%):</p>
                    <p class="font-bold text-red-400 text-xl">-{{ number_format($penaltyFee) }} đ</p>
                </div>
                <div class="col-span-1 md:col-span-2 pt-4 border-t border-white/10">
                    <p class="text-white/50 mb-1">Giá trị vé cũ được bảo lưu (để trừ vào vé mới):</p>
                    <p class="font-black text-brand-primary text-3xl">{{ number_format($creditAmount) }} đ</p>
                </div>
            </div>
        </div>

        <form action="{{ route('customer.bookings.processChangeDate', $booking->id) }}" method="POST" id="changeDateForm">
            @csrf
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 mb-8">
                <h3 class="font-bold text-xl text-white mb-6 flex items-center gap-2">
                    <i data-lucide="bus" class="w-5 h-5 text-brand-accent"></i> Chọn chuyến xe mới
                </h3>
                
                @if($availableTrips->isEmpty())
                    <div class="text-center py-12 text-white/50 bg-black/20 rounded-2xl border border-white/5">
                        <i data-lucide="calendar-x" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                        Không có chuyến xe nào khả dụng trên tuyến này trong tương lai.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($availableTrips as $trip)
                            <label class="block relative border border-white/10 bg-black/20 rounded-2xl p-5 cursor-pointer hover:border-brand-primary/50 transition-all group has-[:checked]:border-brand-primary has-[:checked]:bg-brand-primary/10">
                                <div class="flex items-start gap-4">
                                    <div class="mt-1 flex-shrink-0">
                                        <div class="w-5 h-5 rounded-full border border-white/30 flex items-center justify-center group-has-[:checked]:border-brand-primary group-has-[:checked]:bg-brand-primary">
                                            <i data-lucide="check" class="w-3 h-3 text-white opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></i>
                                        </div>
                                        <input type="radio" name="new_trip_id" value="{{ $trip->id }}" class="hidden trip-radio" required data-price="{{ $trip->price }}" data-trip-id="{{ $trip->id }}">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                            <p class="font-bold text-white text-lg">Khởi hành: {{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }} lúc <span class="text-brand-primary">{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}</span></p>
                                            <span class="font-black text-brand-primary text-xl">{{ number_format($trip->price) }}đ<span class="text-sm font-normal text-white/50">/ghế</span></span>
                                        </div>
                                        <p class="text-sm text-white/50">Nhà xe: <span class="text-white">{{ $trip->vehicle->license_plate ?? 'Chưa xác định' }}</span></p>
                                        
                                        <!-- Hiển thị lượng vé mua trong form -->
                                        <div class="mt-4 pt-4 border-t border-white/10 hidden quantity-container" id="qty-{{ $trip->id }}">
                                            <div class="flex items-center gap-4 bg-black/30 p-4 rounded-xl border border-white/5">
                                                <label class="font-medium text-sm text-white/70">Số lượng vé muốn đổi lấy:</label>
                                                <div class="flex items-center gap-3">
                                                    <input type="number" name="ticket_quantity" class="qty-input w-20 px-3 py-2 bg-white/5 border border-white/10 text-white rounded-lg focus:border-brand-primary focus:outline-none focus:ring-1 focus:ring-brand-primary transition-all text-center" min="1" max="4" value="{{ min(4, $booking->tickets->count()) }}" disabled>
                                                    <span class="text-xs text-white/40">(Tối đa 4 vé)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(!$availableTrips->isEmpty())
                <div class="text-center sticky bottom-8 z-10">
                    <button type="submit" class="w-full sm:w-auto liquid-gradient text-white font-bold py-4 px-10 rounded-xl shadow-[0_10px_40px_-10px_rgba(255,91,36,0.6)] hover:scale-105 transition-transform text-lg flex items-center justify-center gap-2 mx-auto" onclick="return confirm('Bạn có chắc chắn xác nhận đổi sang vé mới? Nếu phải thanh toán bù, bạn sẽ được chuyển đến trang thanh toán.')">
                        <i data-lucide="check-circle" class="w-5 h-5"></i> Xác nhận Đổi Vé
                    </button>
                </div>
            @endif
        </form>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tripRadios = document.querySelectorAll('.trip-radio');
        
        tripRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Ẩn tất cả input qty
                document.querySelectorAll('.quantity-container').forEach(el => {
                    el.classList.add('hidden');
                    el.querySelectorAll('.qty-input').forEach(inp => inp.disabled = true);
                });

                // Hiển thị input của chuyến được chọn
                if(this.checked) {
                    const targetId = 'qty-' + this.dataset.tripId;
                    const container = document.getElementById(targetId);
                    if(container) {
                        container.classList.remove('hidden');
                        container.querySelectorAll('.qty-input').forEach(inp => inp.disabled = false);
                    }
                }
            });
        });
    });
</script>
@endpush
@endsection
