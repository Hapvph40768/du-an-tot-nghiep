@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Lịch sử Ký gửi hàng hóa</h2>
            <a href="{{ route('customer.parcels.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                + Gửi hàng mới
            </a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            @if($parcels->isEmpty())
                <div class="p-12 text-center text-gray-500">
                    <p class="mb-4 text-lg">Bạn chưa có đơn ký gửi nào.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 uppercase text-xs font-semibold text-gray-600 border-b">
                                <th class="p-4">Mã Đơn</th>
                                <th class="p-4">{{ __('routes') }}</th>
                                <th class="p-4">Thông tin gửi/nhận</th>
                                <th class="p-4">Cân nặng</th>
                                <th class="p-4 text-right">{{ __('total') }} tiền</th>
                                <th class="p-4 text-center">{{ __('status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($parcels as $parcel)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 font-bold text-gray-800">#{{ $parcel->id }}</td>
                                    <td class="p-4 text-gray-700">
                                        {{ $parcel->route->startLocation->name ?? 'N/A' }}<span class="text-gray-400 mx-1">→</span> 
                                        {{ $parcel->route->endLocation->name ?? 'N/A' }}</td>
                                    <td class="p-4 text-gray-700">
                                        <div><strong>{{ __('submit') }}:</strong> {{ $parcel->sender_name }} ({{ $parcel->sender_phone }})</div>
                                        <div><strong>Nhận:</strong> {{ $parcel->receiver_name }} ({{ $parcel->receiver_phone }})</div>
                                    </td>
                                    <td class="p-4 text-gray-700">{{ $parcel->weight }} kg</td>
                                    <td class="p-4 text-amber-600 font-bold text-right">{{ number_format($parcel->price, 0, ',', '.') }}đ</td>
                                    <td class="p-4 text-center">
                                        @if($parcel->status == 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold inline-block">Chờ xử lý</span>
                                        @elseif($parcel->status == 'shipping')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-bold inline-block">Đang giao</span>
                                        @elseif($parcel->status == 'completed')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold inline-block">Đã nhận</span>
                                        @elseif($parcel->status == 'cancelled')
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold inline-block">Đã hủy</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-bold inline-block">{{ $parcel->status }}</span>
                                        @endif
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
