@extends('layout.staff')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('staff.bookings.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/></svg>
    </a>
    <h1 class="text-2xl font-bold">Chi tiết Đặt vé #{{ $booking->id }}}</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <div class="flex justify-between items-start mb-8">
                <h2 class="text-xl font-bold">Thông tin Hành trình</h2>
                <div class="text-right">
                    <div class="text-xs font-bold uppercase opacity-40 mb-1">{{{ __('status') }} thanh toán</div>
                    @if($booking->status == 'pending')
                        <span class="px-4 py-1.5 bg-orange-100 text-orange-700 rounded-full font-bold text-xs uppercase italic animate-pulse">Chờ thanh toán</span>
                    @elseif($booking->status == 'paid')
                        <span class="px-4 py-1.5 bg-green-100 text-green-700 rounded-full font-bold text-xs uppercase">Đã thanh toán</span>
                    @else
                        <span class="px-4 py-1.5 bg-gray-100 text-gray-500 rounded-full font-bold text-xs uppercase">Đã hủy</span>
                        @if($booking->cancellation_reason)
                            <div class="mt-2 text-xs text-red-500 bg-red-50 dark:bg-red-900/10 p-2 rounded-lg border border-red-100 dark:border-red-900/20 text-left">
                                <span class="font-bold opacity-60 uppercase text-[10px] block mb-0.5">Lý do hủy:</span>
                                {{ $booking->cancellation_reason }}}</div>
                        @endif
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="space-y-4">
                    <div>
                        <div class="text-xs font-bold uppercase opacity-40 mb-1">Hành trình</div>
                        <div class="text-lg font-bold">{{ $booking->trip->route->startLocation->name }}} &rarr; {{ $booking->trip->route->endLocation->name }}}</div>
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase opacity-40 mb-1">Thời gian</div>
                        <div class="font-bold">{{ $booking->trip->trip_date }}}</div>
                        <div class="text-sm opacity-60">Khởi hành: {{ $booking->trip->departure_time }}}</div>
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase opacity-40 mb-1">{{{ __('pickup_points') }} khách</div>
                        <div class="font-bold">{{ $booking->pickupPoint->name }}}</div>
                        <div class="text-sm opacity-60 italic">{{ $booking->pickupPoint->address }}}</div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <div class="text-xs font-bold uppercase opacity-40 mb-1">{{{ __('vehicles') }}</div>
                        <div class="font-bold text-blue-600">{{ $booking->trip->vehicle->license_plate ?? 'N/A' }}}</div>
                        <div class="text-sm opacity-60 italic font-medium">{{ $booking->trip->vehicle->type ?? '' }}}</div>
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase opacity-40 mb-1">Số lượng vé</div>
                        <div class="text-lg font-bold">{{ $booking->tickets->count() }}} Vé</div>
                    </div>
                </div>
            </div>

            <h3 class="text-xs font-bold uppercase opacity-40 mb-4 border-b pb-2">Danh sách Vé & Ghế</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                @foreach($booking->tickets as $ticket)
                    <div class="p-4 bg-gray-50 dark:bg-[#1a1a1a] rounded-2xl border border-dashed border-[#e3e3e0] dark:border-[#262626] text-center">
                        <div class="text-xs opacity-40 mb-1 uppercase font-black">{{{ __('seats') }}</div>
                        <div class="text-2xl font-black text-blue-600 mb-2">{{ $ticket->seat->seat_number }}}</div>
                        <div class="text-[10px] uppercase font-bold text-gray-400 break-words">{{ $ticket->ticket_code }}}</div>
                        <div class="mt-2">
                             @if($ticket->status === 'used')
                                <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-black uppercase">Đã lên xe</span>
                             @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end pt-6 border-t border-[#e3e3e0] dark:border-[#262626]">
                <div class="text-right">
                    <div class="text-xs font-bold uppercase opacity-40 mb-1">{{{ __('total') }} cộng</div>
                    <div class="text-3xl font-black text-blue-600">{{ number_format($booking->total_amount) }}đ</div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h2 class="text-xl font-bold mb-6">{{{ __('contact') }} Khách hàng</h2>
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-2xl flex items-center justify-center font-black text-xl text-blue-600">
                        {{ strtoupper(substr($booking->contact_name, 0, 1)) }}}</div>
                    <div>
                        <div class="font-bold text-lg">{{ $booking->contact_name }}}</div>
                        <div class="text-sm opacity-60">{{ $booking->contact_phone }}}</div>
                    </div>
                </div>
                <div class="pt-4 space-y-2">
                    <a href="tel:{{ $booking->contact_phone }}" class="block w-full py-3 bg-gray-100 dark:bg-gray-800 text-center rounded-2xl font-bold hover:bg-gray-200 transition-colors">
                        Gọi điện thoại
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h2 class="text-xl font-bold mb-6">{{{ __('actions') }} Nhân viên</h2>
            <div class="space-y-3">
                @if($booking->status == 'pending')
                    <form action="{{ route('staff.bookings.confirm', $booking) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Xác định khách hàng đã thanh toán bằng tiền mặt?')" class="w-full py-4 bg-green-600 text-white rounded-2xl font-bold hover:bg-green-700 shadow-lg shadow-green-500/20 transition-transform active:scale-95">
                            Xác nhận Thanh toán
                        </button>
                    </form>
                @endif
                
                @if($booking->status !== 'cancelled')
                    <button onclick="document.getElementById('cancel-form').classList.toggle('hidden')" class="w-full py-3 text-red-500 font-bold hover:bg-red-50 rounded-2xl transition-colors">
                        Yêu cầu Hủy đơn
                    </button>
                    
                    <div id="cancel-form" class="hidden mt-4 p-4 bg-red-50 dark:bg-red-900/10 rounded-2xl border border-red-100 dark:border-red-900/20">
                        <form action="{{ route('staff.bookings.cancel', $booking) }}" method="POST">
                            @csrf
                            <textarea name="cancellation_reason" placeholder="Nhập lý do hủy (bắt buộc)..." required class="w-full p-3 text-sm border rounded-xl mb-4 dark:bg-[#0a0a0a] dark:border-[#262626]"></textarea>
                            <button type="submit" class="w-full py-2 bg-red-600 text-white rounded-xl font-bold">{{{ __('confirm') }} Hủy</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
