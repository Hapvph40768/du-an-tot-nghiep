@extends('layout.customer.CustomerLayout')

@section('content-main')
    <section class="py-12 lg:py-20 relative min-h-[80vh]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('customer.parcels.index') }}"
                    class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-white hover:bg-white/10 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-black text-white tracking-tight uppercase">Chi tiết đơn ký gửi</h2>
                    <p class="text-white/50 text-sm mt-1">Mã đơn: #{{ $parcel->id }}</p>
                </div>
            </div>

            @if(session('success'))
                <div
                    class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-8 flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div
                    class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-8 flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden relative mb-8">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-brand-primary/10 rounded-full blur-[80px] pointer-events-none">
                </div>

                <div class="p-6 sm:p-8 border-b border-white/5">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-white font-bold text-lg mb-1">Tuyến đường</h3>
                            <div class="flex items-center gap-3 text-white/70">
                                <span>{{ $parcel->route->startLocation->name ?? 'N/A' }}</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 text-brand-primary"></i>
                                <span>{{ $parcel->route->endLocation->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div>
                            @if($parcel->status == 'pending')
                                <span
                                    class="inline-flex items-center gap-2 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-4 py-2 rounded-xl font-bold">
                                    <i data-lucide="clock" class="w-4 h-4"></i> Chờ xử lý
                                </span>
                            @elseif($parcel->status == 'shipping')
                                <span
                                    class="inline-flex items-center gap-2 bg-blue-500/10 text-blue-400 border border-blue-500/20 px-4 py-2 rounded-xl font-bold">
                                    <i data-lucide="truck" class="w-4 h-4"></i> Đang giao
                                </span>
                            @elseif($parcel->status == 'completed')
                                <span
                                    class="inline-flex items-center gap-2 bg-green-500/10 text-green-400 border border-green-500/20 px-4 py-2 rounded-xl font-bold">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i> Đã nhận
                                </span>
                            @elseif($parcel->status == 'cancelled')
                                <span
                                    class="inline-flex items-center gap-2 bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-2 rounded-xl font-bold">
                                    <i data-lucide="x-circle" class="w-4 h-4"></i> Đã hủy
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Sender Info -->
                    <div>
                        <h4 class="text-xs font-bold text-white/40 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i data-lucide="user-minus" class="w-4 h-4"></i> Người gửi
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-white/50 text-sm">Họ tên</span>
                                <span class="text-white font-medium">{{ $parcel->sender_name }}</span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-white/50 text-sm">Số điện thoại</span>
                                <span class="text-white font-medium">{{ $parcel->sender_phone }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Receiver Info -->
                    <div>
                        <h4
                            class="text-xs font-bold text-brand-accent uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i data-lucide="user-plus" class="w-4 h-4"></i> Người nhận
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-white/50 text-sm">Họ tên</span>
                                <span class="text-white font-medium">{{ $parcel->receiver_name }}</span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-white/50 text-sm">Số điện thoại</span>
                                <span class="text-white font-medium">{{ $parcel->receiver_phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8 bg-black/20 border-t border-white/5">
                    <h4 class="text-xs font-bold text-white/40 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i data-lucide="box" class="w-4 h-4"></i> Chi tiết gói hàng
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-white/50 text-sm">Trọng lượng</span>
                                <span class="text-white font-medium">{{ $parcel->weight }} kg</span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-white/50 text-sm">Tổng cước phí</span>
                                <span
                                    class="text-brand-primary font-black text-lg">{{ number_format($parcel->price, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-white/50 text-sm">Thời gian tạo</span>
                                <span class="text-white/80">{{ $parcel->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 border border-white/5">
                            <span class="block text-white/50 text-xs uppercase font-bold mb-2">Mô tả hàng hóa</span>
                            <p class="text-white/80 text-sm">{{ $parcel->description ?: 'Không có mô tả' }}</p>
                        </div>
                    </div>
                </div>

                @if($parcel->trip)
                    <div class="p-6 sm:p-8 bg-brand-primary/5 border-t border-white/5">
                        <h4 class="text-xs font-bold text-brand-primary uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i data-lucide="bus" class="w-4 h-4"></i> Thông tin chuyến xe chở hàng
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-black/20 rounded-xl p-4 border border-white/5">
                                <span class="block text-white/50 text-xs mb-1">Ngày giờ chạy</span>
                                <span
                                    class="text-white font-bold">{{ \Carbon\Carbon::parse($parcel->trip->departure_time)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($parcel->trip->trip_date)->format('d/m/Y') }}</span>
                            </div>
                            <div class="bg-black/20 rounded-xl p-4 border border-white/5">
                                <span class="block text-white/50 text-xs mb-1">Biển số xe</span>
                                <span class="text-white font-bold">{{ $parcel->trip->vehicle->license_plate ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-black/20 rounded-xl p-4 border border-white/5">
                                <span class="block text-white/50 text-xs mb-1">Lái xe</span>
                                <span class="text-white font-bold">{{ $parcel->trip->driver->name ?? 'N/A' }} <br><span
                                        class="text-sm text-brand-primary">{{ $parcel->trip->driver->phone ?? '' }}</span></span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if($parcel->status == 'pending')
                <div
                    class="bg-red-500/10 border border-red-500/20 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <h4 class="text-red-400 font-bold mb-1">Bạn muốn hủy đơn ký gửi này?</h4>
                        <p class="text-red-400/60 text-sm">Chỉ có thể hủy khi đơn hàng đang ở trạng thái Chờ xử lý. Hành động
                            này không thể hoàn tác.</p>
                    </div>
                    <form action="{{ route('customer.parcels.cancel', $parcel->id) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn ký gửi này không?');">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-xl transition-colors whitespace-nowrap shadow-lg shadow-red-500/20">
                            Hủy đơn hàng
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </section>
@endsection