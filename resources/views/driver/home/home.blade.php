@extends('layout.driver.DriverLayout')

@section('page-title', 'Trang chủ')

@section('content-main')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Chuyến xe hôm nay</h2>
                <a href="#" class="text-amber-600 hover:text-amber-700 font-medium flex items-center gap-2">
                    Xem tất cả chuyến <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($todayTrips as $trip)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all">
                    <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                    {{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500">Xe: </span>
                                <span class="font-semibold">{{ $trip->vehicle->license_plate ?? 'Chưa gán' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mb-5">
                            <div class="flex-1">
                                <p class="font-bold text-lg">{{ $trip->route->departureLocation->name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">Điểm đi</p>
                            </div>
                            <div class="text-amber-500">
                                <i class='bx bx-transfer-alt text-3xl'></i>
                            </div>
                            <div class="flex-1 text-right">
                                <p class="font-bold text-lg">{{ $trip->route->destinationLocation->name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">Điểm đến</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600 font-medium">{{ $trip->tickets->count() }}/{{ $trip->vehicle->total_seats ?? '?' }}</span>
                                <span class="text-gray-400">ghế</span>
                            </div>
                            <a href="{{ route('driver.trips.show', $trip) }}" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl transition-all active:scale-95 inline-block">
                                {{ $trip->status === 'running' ? 'Đang chạy' : 'Bắt đầu chuyến' }}
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <i class='bx bx-calendar-x text-6xl text-gray-200 mb-4'></i>
                    <p class="text-gray-500 text-lg">Bạn không có chuyến xe nào được phân công trong ngày hôm nay.</p>
                </div>
                @endforelse

            </div>
        </div>
    </div>
@endsection
