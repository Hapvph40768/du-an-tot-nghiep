@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-16 md:py-24 relative min-h-[80vh]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight uppercase flex items-center justify-center md:justify-start gap-3">
                <i data-lucide="ticket" class="w-8 h-8 text-brand-primary"></i> Lịch Sử Đặt Vé
            </h2>
            <p class="text-white/50 mt-2">Quản lý và theo dõi các chuyến đi của bạn.</p>
        </div>
        
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-8 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        @endif

        @if($bookings->isEmpty())
            <div class="bg-white/5 border border-white/10 rounded-3xl p-12 text-center flex flex-col items-center justify-center">
                <div class="w-24 h-24 rounded-full bg-white/5 flex items-center justify-center mb-6">
                    <i data-lucide="bus" class="w-10 h-10 text-white/30"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Chưa có chuyến đi nào</h3>
                <p class="text-white/50 mb-8 max-w-sm">Bạn chưa thực hiện bất kỳ đặt vé nào trên hệ thống. Hãy bắt đầu hành trình ngay hôm nay!</p>
                <a href="{{ url('/#search') }}" class="liquid-gradient hover:scale-105 transition-transform text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-brand-primary/20 flex items-center gap-2">
                    <i data-lucide="search" class="w-5 h-5"></i> Tìm chuyến xe
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:bg-white/10 transition-colors group">
                        <div class="p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6 relative">
                            
                            <!-- Decor: Status indicator line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 
                                {{ $booking->status == 'pending' ? 'bg-amber-500' : '' }}
                                {{ $booking->status == 'paid' ? 'bg-green-500' : '' }}
                                {{ $booking->status == 'cancelled' ? 'bg-red-500' : '' }}">
                            </div>

                            <!-- Left: Info -->
                            <div class="flex-1 w-full md:w-auto">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="px-3 py-1 bg-white/10 rounded-md text-xs font-mono text-white/70">#{{ $booking->id }}</span>
                                    
                                    @if($booking->status == 'pending')
                                        <span class="px-3 py-1 bg-amber-500/20 text-amber-400 border border-amber-500/20 rounded-full text-xs font-bold flex items-center gap-1.5">
                                            <i data-lucide="clock" class="w-3 h-3"></i> Đang chờ thanh toán
                                        </span>
                                    @elseif($booking->status == 'paid')
                                        <span class="px-3 py-1 bg-green-500/20 text-green-400 border border-green-500/20 rounded-full text-xs font-bold flex items-center gap-1.5">
                                            <i data-lucide="check-circle" class="w-3 h-3"></i> Đã thanh toán
                                        </span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="px-3 py-1 bg-red-500/20 text-red-400 border border-red-500/20 rounded-full text-xs font-bold flex items-center gap-1.5">
                                            <i data-lucide="x-circle" class="w-3 h-3"></i> Đã hủy
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-white/10 text-white border border-white/20 rounded-full text-xs font-bold">{{ $booking->status }}</span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4 text-xl md:text-2xl font-bold text-white mb-2">
                                    <span>{{ $booking->trip->route->departureLocation->name ?? '...' }}</span>
                                    <i data-lucide="arrow-right" class="text-brand-accent w-5 h-5"></i>
                                    <span>{{ $booking->trip->route->destinationLocation->name ?? '...' }}</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-white/60">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                        <span>{{ \Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="clock" class="w-4 h-4"></i>
                                        <span class="text-brand-primary font-bold">{{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Price & Action -->
                            <div class="w-full md:w-auto flex flex-row md:flex-col items-center justify-between md:items-end md:justify-center gap-4 md:pl-6 md:border-l md:border-white/10">
                                <div class="text-left md:text-right">
                                    <p class="text-xs text-white/50 mb-1 uppercase tracking-wider">Tổng tiền</p>
                                    <p class="text-2xl font-black text-white">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</p>
                                </div>
                                <a href="{{ route('customer.bookings.show', $booking->id) }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-white text-brand-dark hover:bg-gray-200 transition-colors rounded-xl font-bold text-sm">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
