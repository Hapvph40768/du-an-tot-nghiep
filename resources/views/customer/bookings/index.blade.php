@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Lịch sử đặt vé</h2>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            @if($bookings->isEmpty())
                <div class="p-12 text-center text-gray-500">
                    <p class="mb-4 text-lg">Bạn chưa có đơn đặt vé nào.</p>
                    <a href="{{ route('customer.home') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-medium py-2 px-6 rounded-lg transition-colors">Đặt vé ngay</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 uppercase text-xs font-semibold text-gray-600 border-b">
                                <th class="p-4">Mã ĐH</th>
                                <th class="p-4">Tuyến đường</th>
                                <th class="p-4">Khởi hành</th>
                                <th class="p-4 text-right">Tổng tiền</th>
                                <th class="p-4 text-center">Trạng thái</th>
                                <th class="p-4 text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 font-bold text-gray-800">#{{ $booking->id }}</td>
                                    <td class="p-4 text-gray-700">
                                        {{ $booking->trip->route->departureLocation->name ?? '...' }} 
                                        <span class="text-gray-400 mx-1">→</span> 
                                        {{ $booking->trip->route->destinationLocation->name ?? '...' }}
                                    </td>
                                    <td class="p-4 text-gray-700">
                                        {{ \Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y') }} 
                                        <br>
                                        <span class="font-medium text-amber-600">{{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i') }}</span>
                                    </td>
                                    <td class="p-4 text-amber-600 font-bold text-right">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</td>
                                    <td class="p-4 text-center">
                                        @if($booking->status == 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold inline-block">Đang chờ</span>
                                        @elseif($booking->status == 'paid')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold inline-block">Đã thanh toán</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold inline-block">Đã hủy</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-bold inline-block">{{ $booking->status }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('customer.bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-800 font-medium hover:underline inline-block">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
