@extends('layout.assistant.AssistantLayout')

@section('page-title', 'Doanh thu')

@section('content-main')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-500 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-blue-100 font-medium mb-1">Tổng doanh thu</p>
                    <h3 class="text-4xl font-bold">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</h3>
                </div>
                <i class='bx bx-coin-stack absolute -right-4 -bottom-4 text-8xl text-white opacity-20'></i>
            </div>
            
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm relative overflow-hidden flex items-center">
                <div>
                    <p class="text-gray-500 font-medium mb-1">Tổng chuyến hoàn thành</p>
                    <h3 class="text-4xl font-bold text-gray-800">{{ $trips->total() }}</h3>
                </div>
                <i class='bx bx-bus absolute -right-4 -bottom-4 text-8xl text-gray-100'></i>
            </div>
        </div>

        @if ($trips->isEmpty())
            <div class="bg-white rounded-3xl p-16 text-center border border-gray-100 shadow-sm">
                <i class='bx bx-wallet text-7xl text-gray-200 mx-auto'></i>
                <p class="mt-6 text-xl text-gray-400">Chưa có dữ liệu doanh thu.</p>
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 sm:p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        <i class='bx bx-bar-chart-alt-2 text-blue-500'></i> Doanh thu theo chuyến
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-100 text-gray-400 text-xs uppercase tracking-wider">
                                <th class="py-4 px-6 font-semibold">Ngày khởi hành</th>
                                <th class="py-4 px-6 font-semibold">Tuyến đường</th>
                                <th class="py-4 px-6 font-semibold text-center">Số khách</th>
                                <th class="py-4 px-6 font-semibold text-right">Doanh thu (VNĐ)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($trips as $trip)
                                @php
                                    $passengerCount = $trip->tickets->where('status', '!=', 'cancelled')->count();
                                    
                                    $bookings = $trip->tickets->where('status', '!=', 'cancelled')->map(function($t) {
                                        return $t->booking;
                                    })->filter()->unique('id');
                                    
                                    $tripRevenue = $bookings->filter(function($b) {
                                        return $b->payment && $b->payment->status === 'success';
                                    })->sum(function($b) { 
                                        return $b->payment->amount; 
                                    });
                                @endphp
                                <tr class="hover:bg-blue-50/30 transition duration-150">
                                    <td class="py-5 px-6">
                                        <div class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="py-5 px-6">
                                        <p class="font-medium text-gray-800 flex items-center gap-2">
                                            {{ $trip->route->departureLocation->name ?? 'N/A' }} 
                                            <i class='bx bx-right-arrow-alt text-blue-400'></i> 
                                            {{ $trip->route->destinationLocation->name ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Biển số: {{ $trip->vehicle->license_plate ?? 'N/A' }}</p>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        <span class="inline-flex items-center justify-center bg-gray-100 text-gray-700 px-3 py-1 rounded-xl text-sm font-bold min-w-[2.5rem]">
                                            {{ $passengerCount }}
                                        </span>
                                    </td>
                                    <td class="py-5 px-6 text-right font-bold text-emerald-600 text-lg">
                                        +{{ number_format($tripRevenue, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                {{ $trips->links() }}
            </div>
        @endif
    </div>
@endsection
