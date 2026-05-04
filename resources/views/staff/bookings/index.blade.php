@extends('layout.staff')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Danh sách Đặt vé</h1>
    <div class="flex flex-col md:flex-row gap-4">
        <a href="{{ route('staff.bookings.create') }}" class="px-6 py-2 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-500/20 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/></svg>
            Tạo Đơn Offline
        </a>
        <form action="{{ route('staff.bookings.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tên khách, số điện thoại..." class="px-4 py-2 border rounded-xl dark:bg-[#111111] dark:border-[#262626]">
            <select name="status" class="px-4 py-2 border rounded-xl dark:bg-[#111111] dark:border-[#262626]">
                <option value="">Tất cả trạng thái</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700">{{{ __('filter') }}</button>
        </form>
    </div>
</div>

<div class="bg-white dark:bg-[#111111] rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 dark:bg-[#1a1a1a] text-xs uppercase opacity-40 font-bold">
            <tr>
                <th class="px-6 py-4 text-center">ID</th>
                <th class="px-6 py-4">Khách hàng</th>
                <th class="px-6 py-4">{{{ __('trips') }}</th>
                <th class="px-6 py-4 text-right">{{{ __('total') }} tiền</th>
                <th class="px-6 py-4 text-center">{{{ __('status') }}</th>
                <th class="px-6 py-4 text-center">Hành động</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#262626]">
            @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50 dark:hover:bg-[#161616] transition-colors">
                    <td class="px-6 py-4 text-center font-medium opacity-60">#{{ $booking->id }}}</td>
                    <td class="px-6 py-4">
                        <div class="font-bold">{{ $booking->contact_name }}}</div>
                        <div class="text-xs opacity-60 mb-1">{{ $booking->contact_phone }}}</div>
                        @if($booking->tickets->count() > 0)
                            <div class="flex flex-wrap gap-1 mt-1">
                                @foreach($booking->tickets as $ticket)
                                    <span class="px-1.5 py-0.5 bg-gray-100 dark:bg-[#222] border border-gray-200 dark:border-[#333] text-[10px] font-bold rounded">{{ $ticket->seat->seat_number ?? '?' }}}</span>
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-sm">{{ $booking->trip->route->startLocation->name }}} &rarr; {{ $booking->trip->route->endLocation->name }}}</div>
                        <div class="text-xs opacity-60">{{ $booking->trip->trip_date }}} | {{ $booking->trip->departure_time }}}</div>
                    </td>
                    <td class="px-6 py-4 text-right font-bold text-blue-600">
                        {{ number_format($booking->total_amount) }}đ
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($booking->status == 'pending')
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-bold">Chờ thanh toán</span>
                        @elseif($booking->status == 'paid')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Đã thanh toán</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-bold">Đã hủy</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('staff.bookings.show', $booking) }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg text-blue-500" title="Xem chi tiết">
                                Xem
                            </a>
                            @if($booking->status == 'pending')
                                <form action="{{ route('staff.bookings.confirm', $booking) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Xác định đã thu tiền mặt của khách?')" class="px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg text-sm font-bold transition-colors" title="Thu Tiền Mặt">
                                        Thu tiền
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center opacity-40 italic">Không có dữ liệu đặt vé phù hợp.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-6 border-t border-[#e3e3e0] dark:border-[#262626]">
        {{ $bookings->links() }}}</div>
</div>
@endsection
