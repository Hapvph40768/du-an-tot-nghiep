@extends('layout.customer.CustomerLayout')

@section('content-main')
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Kết quả tìm kiếm chuyến xe</h2>
            
            <div id="results" class="max-w-4xl mx-auto space-y-4">
                @if($trips->isEmpty())
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
                        <p class="text-amber-700 font-medium">Không tìm thấy chuyến xe phù hợp. Vui lòng chọn tuyến đường / thời gian khác.</p>
                        <a href="{{ route('customer.home') }}" class="inline-block mt-4 text-amber-600 font-medium hover:underline">Quay lại trang chủ</a>
                    </div>
                @else
                    @foreach($trips as $trip)
                        <div class="bg-white rounded-xl card-shadow p-5 hover:shadow-lg transition-shadow">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-6">
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}</p>
                                        <p class="text-sm text-gray-500 font-medium mb-1">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $trip->route->departureLocation->name }}</p>
                                    </div>
                                    <div class="flex flex-col items-center justify-center gap-1">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                                        <div class="w-20 h-0.5 bg-gradient-to-r from-amber-500 to-blue-500"></div>
                                        <div class="text-xs text-gray-400 font-medium whitespace-nowrap px-2">{{ $trip->route->estimated_time ? $trip->route->estimated_time . ' giờ' : '...' }}</div>
                                        <div class="w-20 h-0.5 bg-gradient-to-r from-blue-500 to-green-500"></div>
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($trip->arrival_time)->format('H:i') }}</p>
                                        <p class="text-sm text-gray-500">{{ $trip->route->destinationLocation->name }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <div class="text-right">
                                        <p class="text-xl font-bold text-amber-600">{{ number_format($trip->price, 0, ',', '.') }}đ</p>
                                    </div>
                                    <a href="{{ route('customer.trips.show', $trip->id) }}" class="btn-primary text-white font-medium px-6 py-3 rounded-xl inline-block" style="text-decoration: none;">
                                        Chọn chuyến
                                    </a>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap gap-2 mt-4">
                                <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">{{ $trip->vehicle->type ?? 'Seat/Bed' }}</span>
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Biển số: {{ $trip->vehicle->license_plate }}</span>
                                <span class="bg-amber-100 text-amber-700 text-xs px-3 py-1 rounded-full">Ghế trống: {{ max(0, ($trip->vehicle->total_seats ?? 0) - ($trip->seat_locks_count ?? 0)) }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
