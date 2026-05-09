@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 lg:py-20 relative min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                <i data-lucide="ticket" class="w-8 h-8 text-brand-primary"></i> Chi Tiết Đơn Vé
            </h2>
            <span class="px-4 py-1.5 bg-white/10 text-white border border-white/20 rounded-full font-mono text-sm">#{{ $booking->id }}</span>
        </div>

        @if (session('success'))
            <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <!-- Chuyến Đi -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative overflow-hidden group hover:border-brand-primary/50 transition-colors">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-primary/10 rounded-full blur-[50px] pointer-events-none group-hover:bg-brand-primary/20 transition-colors"></div>
                
                <h3 class="font-bold text-lg text-white border-b border-white/10 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-5 h-5 text-brand-accent"></i> Thông tin chuyến đi
                </h3>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-start">
                        <span class="text-white/50">Tuyến:</span> 
                        <span class="font-bold text-white text-right max-w-[60%]">
                            {{ $booking->trip->route->departureLocation->name ?? '...' }} → {{ $booking->trip->route->destinationLocation->name ?? '...' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white/50">Khởi hành:</span> 
                        <span class="font-medium text-brand-primary">
                            {{ \Carbon\Carbon::parse($booking->trip->datex)->format('d/m/Y') }} lúc {{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white/50">Số điện thoại xe:</span> 
                        <a href="tel:{{ $booking->trip->vehicle->phone_vehicles ?? '' }}" class="font-medium text-white hover:text-brand-primary transition-colors">
                            {{ $booking->trip->vehicle->phone_vehicles ?? 'Chưa có' }}
                        </a>
                    </div>
                    
                    <div class="pt-4 mt-4 border-t border-white/5 space-y-4">
                        <div>
                            <span class="block text-white/50 mb-1">Điểm đón:</span> 
                            <span class="font-bold text-white block">{{ $booking->pickupPoint->name ?? 'Không có thông tin' }}</span>
                            @if($booking->pickupPoint?->address)
                                <span class="text-xs text-white/40">{{ $booking->pickupPoint->address }}</span>
                            @endif
                        </div>
                        <div>
                            <span class="block text-white/50 mb-1">Điểm trả khách:</span> 
                            @if($booking->dropoffPoint)
                                <span class="font-bold text-brand-accent block">{{ $booking->dropoffPoint->name }}</span>
                                @if($booking->dropoffPoint?->address)
                                    <span class="text-xs text-white/40">{{ $booking->dropoffPoint->address }}</span>
                                @endif
                            @else
                                <span class="text-white/40 italic">Điểm cuối tuyến</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Khách hàng & Thanh toán -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative overflow-hidden group hover:border-brand-primary/50 transition-colors flex flex-col">
                <div class="absolute top-0 left-0 w-32 h-32 bg-blue-500/10 rounded-full blur-[50px] pointer-events-none group-hover:bg-blue-500/20 transition-colors"></div>
                
                <h3 class="font-bold text-lg text-white border-b border-white/10 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="user" class="w-5 h-5 text-blue-400"></i> Khách hàng & Thanh toán
                </h3>
                <div class="space-y-4 text-sm flex-1">
                    <div class="flex justify-between">
                        <span class="text-white/50">Người đặt:</span> 
                        <span class="font-medium text-white">{{ $booking->contact_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white/50">Điện thoại:</span> 
                        <span class="font-medium text-white">{{ $booking->contact_phone }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white/50">Trạng thái:</span>
                        @if ($booking->status == 'pending')
                            <span class="bg-amber-500/20 border border-amber-500/20 text-amber-400 px-3 py-1 rounded-full text-xs font-bold">Chờ thanh toán</span>
                        @elseif($booking->status == 'paid')
                            <span class="bg-green-500/20 border border-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-bold">Đã thanh toán</span>
                        @else
                            <span class="bg-white/10 border border-white/20 text-white px-3 py-1 rounded-full text-xs font-bold">{{ $booking->status }}</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center pt-4 mt-4 border-t border-white/5">
                        <span class="text-white/50">Tổng tiền:</span>
                        <span class="font-black text-brand-primary text-2xl">{{ number_format($booking->total_amount, 0, ',', '.') }} đ</span>
                    </div>
                </div>

                <div class="mt-6 pt-4">
                    @if ($booking->status == 'pending')
                        <a href="{{ route('customer.payment.checkout', $booking->id) }}" class="w-full liquid-gradient text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/20 hover:scale-[1.02] transition-transform">
                            <i data-lucide="credit-card" class="w-5 h-5"></i> Thanh toán ngay
                        </a>
                    @elseif ($booking->status == 'paid')
                        <div class="flex gap-3">
                            <a href="{{ route('customer.bookings.changeDate', $booking->id) }}" class="flex-1 bg-white/10 hover:bg-white/20 text-white font-bold py-3 rounded-xl border border-white/10 flex items-center justify-center gap-2 transition-colors text-sm">
                                <i data-lucide="refresh-cw" class="w-4 h-4"></i> Đổi vé
                            </a>
                            <form action="{{ route('customer.bookings.cancel', $booking->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Bạn có chắc chắn muốn hủy vé?\nNếu hủy sau 30 phút từ khi đặt sẽ chịu phí 10%.');">
                                @csrf
                                <button type="submit" class="w-full bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 font-bold py-3 rounded-xl flex items-center justify-center gap-2 transition-colors text-sm">
                                    <i data-lucide="x" class="w-4 h-4"></i> Hủy vé
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Lưu ý -->
        <div class="bg-blue-500/10 border border-blue-500/20 rounded-2xl p-6 mb-6 flex gap-4 items-start">
            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400">
                <i data-lucide="info" class="w-6 h-6"></i>
            </div>
            <div class="flex-1">
                <h4 class="font-bold text-blue-400 mb-3 text-lg">Lưu ý check-in tại quầy</h4>
                
                @if($booking->status == 'pending')
                    <div class="bg-amber-500/10 border border-amber-500/20 text-amber-400 rounded-xl px-4 py-3 mb-4 text-sm flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-5 h-5 flex-shrink-0"></i>
                        <p>Đơn hàng <strong>chưa thanh toán</strong>. Vui lòng hoàn tất để nhận mã vé.</p>
                    </div>
                @endif
                
                <ul class="text-sm text-white/70 space-y-3">
                    <li class="flex items-start gap-3">
                        <i data-lucide="clock" class="w-5 h-5 text-blue-400/50 flex-shrink-0"></i>
                        <span>Có mặt tại quầy <strong>trước 30 phút</strong> so với giờ khởi hành.</span>
                    </li>
                    @if($booking->tickets->isNotEmpty())
                    <li class="flex items-start gap-3">
                        <i data-lucide="ticket" class="w-5 h-5 text-blue-400/50 flex-shrink-0"></i>
                        <span>Xuất trình <strong>mã vé điện tử</strong> hoặc giấy tờ tùy thân.</span>
                    </li>
                    @endif
                    <li class="flex items-start gap-3">
                        <i data-lucide="map-pin" class="w-5 h-5 text-blue-400/50 flex-shrink-0"></i>
                        <span>Điểm đón: <strong>{{ $booking->pickupPoint->name ?? 'Chưa xác định' }}</strong></span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="phone" class="w-5 h-5 text-blue-400/50 flex-shrink-0"></i>
                        <span>Hotline: <a href="tel:{{ $booking->trip->vehicle->phone_vehicles ?? '' }}" class="text-blue-400 font-bold hover:underline">{{ $booking->trip->vehicle->phone_vehicles ?? 'Xem trên vé' }}</a></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Danh sách vé -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6">
            <h3 class="font-bold text-lg text-white border-b border-white/10 pb-3 mb-6 flex items-center gap-2">
                <i data-lucide="qr-code" class="w-5 h-5 text-brand-primary"></i> Vé điện tử
            </h3>
            
            @if ($booking->tickets->isEmpty())
                <div class="text-center py-10 bg-black/20 rounded-xl border border-white/5">
                    <i data-lucide="ticket" class="w-12 h-12 text-white/20 mx-auto mb-4"></i>
                    <p class="text-white/50 mb-4">Chưa có vé điện tử được xuất (Đơn hàng chờ thanh toán).</p>
                    @if ($booking->status == 'pending')
                        <a href="{{ route('customer.payment.checkout', $booking->id) }}" class="inline-flex items-center justify-center gap-2 bg-brand-primary hover:bg-brand-primary/90 text-white px-6 py-2.5 rounded-xl font-bold transition-colors">
                            Thanh toán ngay
                        </a>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($booking->tickets as $ticket)
                        <div class="bg-gradient-to-br from-white/10 to-white/5 border border-white/10 rounded-xl p-5 relative overflow-hidden group">
                            <div class="absolute -right-6 -top-6 w-24 h-24 bg-brand-primary/20 rounded-full blur-2xl group-hover:bg-brand-primary/40 transition-colors pointer-events-none"></div>
                            
                            <div class="absolute top-0 right-0 bg-green-500/20 text-green-400 text-[10px] uppercase tracking-widest px-3 py-1 rounded-bl-xl font-bold border-b border-l border-green-500/20">
                                Xác nhận
                            </div>
                            
                            <p class="text-xs text-white/40 mb-1 uppercase tracking-wider">Mã vé điện tử</p>
                            <p class="font-mono font-black text-xl text-white mb-4 tracking-widest">{{ $ticket->ticket_code }}</p>
                            
                            <div class="flex items-end justify-between border-t border-white/10 pt-3 mt-3">
                                <span class="text-xs text-white/50">Ghế ngồi</span>
                                <span class="font-black text-3xl text-brand-primary">{{ $ticket->seat->seat_number }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Bãi đỗ xe (Parking Map) -->
        @php
            $vehicle = $booking->trip->vehicle ?? null;
            $currentSlot = $vehicle ? $vehicle->parkingSlot : null;
            $parking = $currentSlot ? $currentSlot->parking : null;
        @endphp

        @if ($parking && $parking->slots && $parking->slots->count() > 0)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6">
                <h3 class="font-bold text-lg text-white border-b border-white/10 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="navigation" class="w-5 h-5 text-purple-400"></i> Sơ đồ bãi đỗ xe: {{ $parking->name }}
                </h3>
                <p class="text-sm text-white/50 mb-6 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-brand-primary flex-shrink-0"></i>
                    {{ $parking->location ?? '' }} - {{ $parking->description ?? '' }}
                </p>

                <!-- Map Legend -->
                <div class="flex flex-wrap items-center gap-4 mb-8 text-xs bg-black/20 p-4 rounded-xl border border-white/5">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-white/5 border border-white/20 rounded"></div> 
                        <span class="text-white/70">Trống</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-red-500/20 border border-red-500/40 rounded"></div> 
                        <span class="text-white/70">Đang đỗ</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-amber-500/20 border border-amber-500/40 rounded"></div> 
                        <span class="text-white/70">Đã đặt</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-brand-primary/20 border border-brand-primary rounded relative flex items-center justify-center">
                            <i data-lucide="bus" class="w-3 h-3 text-brand-primary"></i>
                        </div> 
                        <span class="font-bold text-white">Vị trí xe của bạn</span>
                    </div>
                </div>

                @php
                    $zones = $parking->slots->groupBy(function ($slot) {
                        return $slot->zone ? 'Khu vực ' . $slot->zone : 'Khu vực chung';
                    });
                @endphp

                @foreach ($zones as $zoneName => $zoneSlots)
                    <div class="mb-8 last:mb-0">
                        <h4 class="font-bold text-sm mb-4 text-purple-400 bg-purple-500/10 border border-purple-500/20 inline-block px-4 py-1.5 rounded-full">
                            {{ $zoneName }}
                        </h4>

                        <div class="overflow-x-auto pb-4 custom-scrollbar">
                            @php
                                $zoneMinRow = $zoneSlots->min('row');
                                $zoneMaxRow = $zoneSlots->max('row');
                                $zoneMinCol = $zoneSlots->min('column');
                                $zoneMaxCol = $zoneSlots->max('column');

                                $grid = [];
                                foreach ($zoneSlots as $slot) {
                                    $grid[$slot->row][$slot->column] = $slot;
                                }
                            @endphp

                            <table class="border-collapse border-spacing-2 mx-auto">
                                @for ($r = $zoneMinRow; $r <= $zoneMaxRow; $r++)
                                    <tr>
                                        @for ($c = $zoneMinCol; $c <= $zoneMaxCol; $c++)
                                            <td class="p-1">
                                                @if (isset($grid[$r][$c]))
                                                    @php
                                                        $slot = $grid[$r][$c];
                                                        $isMyCar = $vehicle && $slot->vehicle_id == $vehicle->id;

                                                        $bgColor = 'bg-white/5 border-white/10 text-white/50 hover:bg-white/10';
                                                        if ($isMyCar) {
                                                            $bgColor = 'bg-brand-primary/20 text-brand-primary border-brand-primary font-bold shadow-[0_0_15px_rgba(var(--brand-primary-rgb),0.3)] transform scale-105 z-10 relative';
                                                        } else {
                                                            if ($slot->status == 'occupied') {
                                                                $bgColor = 'bg-red-500/10 border-red-500/20 text-red-400/50';
                                                            } elseif ($slot->status == 'reserved') {
                                                                $bgColor = 'bg-amber-500/10 border-amber-500/20 text-amber-400/50';
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="w-16 h-16 sm:w-20 sm:h-20 flex flex-col items-center justify-center border rounded-xl {{ $bgColor }} transition-all cursor-default group"
                                                        title="Vị trí: {{ $slot->slot_code }} - Trạng thái: {{ ucfirst($slot->status) }}">
                                                        <span class="text-[9px] sm:text-[10px] block mb-0.5 uppercase opacity-50">{{ $slot->slot_type }}</span>
                                                        <span class="font-mono text-sm sm:text-base tracking-wider">{{ $slot->slot_code }}</span>
                                                        @if ($isMyCar)
                                                            <i data-lucide="bus" class="w-4 h-4 mt-1"></i>
                                                        @endif
                                                    </div>
                                                @else
                                                    <!-- Empty space -->
                                                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-transparent"></div>
                                                @endif
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-8 flex justify-center">
            <a href="{{ route('customer.bookings.index') }}" class="inline-flex items-center gap-2 text-white/50 hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại Lịch sử đặt vé
            </a>
        </div>

    </div>
</section>
@endsection
