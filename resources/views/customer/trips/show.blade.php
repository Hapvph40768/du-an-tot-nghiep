@extends('layout.customer.CustomerLayout')

@section('content-main')
    <section class="py-12 bg-gray-50 border-t">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">Chi tiết chuyến xe và Chọn chỗ</h2>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('customer.bookings.store') }}" method="POST" id="booking-form">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Left: Trip info & Contact -->
                    <div class="md:col-span-2 space-y-6">
                        
                        <!-- 1. Trip Summary -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold border-b pb-3 mb-4">Thông tin chuyến</h3>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Tuyến đường</span>
                                <span class="text-gray-900">{{ $trip->route->departureLocation->name ?? '...' }} → {{ $trip->route->destinationLocation->name ?? '...' }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Khởi hành</span>
                                <span class="text-gray-900">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Dự kiến đến</span>
                                <span class="text-gray-900">{{ \Carbon\Carbon::parse($trip->arrival_time)->format('H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Giá vé</span>
                                <span class="text-amber-600 font-bold" id="ticket-price" data-price="{{ $trip->price }}">{{ number_format($trip->price, 0, ',', '.') }} đ</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Tên tài xế</span>
                                <span class="text-gray-900">{{ $trip->driver->name ?? 'Đang cập nhật' }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Loại xe</span>
                                <span class="text-gray-900">{{ $trip->vehicle->type ?? 'Seat/Bed' }} ({{ $trip->vehicle->license_plate ?? 'CX-00000' }})</span>
                            </div>
                            <div class="flex justify-between items-center mb-4 border-t pt-2 mt-2 border-dashed">
                                <span class="font-semibold text-gray-700">SĐT Nhà xe (Hỗ trợ)</span>
                                <span class="text-amber-600 font-bold text-lg">
                                    <i class="fas fa-phone-alt text-sm mr-1"></i> {{ $trip->vehicle->phone_vehicles ?? 'Đang cập nhật' }}
                                </span>
                            </div>
                            
                            <hr class="mb-4">
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Chọn ngày đi <span class="text-red-500">*</span></label>
                                <input type="date" name="selected_departure_date" value="{{ $trip->trip_date }}" class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-500">
                            </div>
                            
                            <div class="mb-2">
                                <label class="block text-gray-700 font-medium mb-2">Điểm lên xe <span class="text-red-500">*</span></label>
                                <select name="pickup_point_id" id="pickup_point_select" required
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-amber-500 transition-colors text-gray-900 bg-white">
                                    <option value="" class="text-gray-500" data-address="{{ $trip->route->departureLocation->name ?? 'Bến xe' }}">-- Chọn điểm đón --</option>
                                    @foreach($trip->pickupPoints as $point)
                                        <option value="{{ $point->id }}" class="text-gray-900"
                                            data-address="{{ $point->address ? $point->address . ', ' . $point->name : $point->name }}"
                                            {{ old('pickup_point_id') == $point->id ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::parse($point->pivot->pickup_time ?? $trip->departure_time)->format('H:i') }} - {{ $point->name }}
                                            @if($point->address) ({{ $point->address }}) @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Bản đồ bến xe / điểm đón -->
                            <div class="mt-4 rounded-lg overflow-hidden border border-gray-200 shadow-sm relative h-56 bg-gray-100">
                                <div id="map-loading" class="absolute inset-0 flex items-center justify-center bg-gray-50 z-0">
                                    <span class="text-gray-500 text-sm flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> 
                                        Đang tải bản đồ bến xe...
                                    </span>
                                </div>
                                <iframe id="station-map" class="absolute inset-0 w-full h-full z-10 opacity-0 transition-opacity duration-500" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>

                            <!-- Điểm trả khách -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-medium mb-2">Điểm trả khách <span class="text-gray-400 text-sm font-normal">(tuỳ chọn)</span></label>
                                <select name="dropoff_point_id" id="dropoff_point_select"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-amber-500 transition-colors text-gray-900 bg-white">
                                    <option value="" class="text-gray-500">-- Trả tại điểm cuối tuyến (mặc định) --</option>
                                    @forelse($trip->dropoffPoints as $point)
                                        <option value="{{ $point->id }}" class="text-gray-900"
                                            {{ old('dropoff_point_id') == $point->id ? 'selected' : '' }}>
                                            {{ $point->name }}{{ $point->address ? ' (' . $point->address . ')' : '' }}
                                        </option>
                                    @empty
                                        <option disabled class="text-gray-400">Chưa có điểm trả được cấu hình</option>
                                    @endforelse
                                </select>
                                <p class="text-xs text-gray-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Chọn điểm trả nếu bạn muốn xuống xe trước điểm cuối.</p>
                            </div>
                        </div>

                        <!-- 2. Pickup & Contact Info -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold border-b pb-3 mb-4">Thông tin hành khách</h3>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Họ tên người đi <span class="text-red-500">*</span></label>
                                <input type="text" name="contact_name" required value="{{ old('contact_name', Auth::user()->name ?? '') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-400 transition-colors"
                                    placeholder="Nhập họ tên đầy đủ">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Số điện thoại <span class="text-red-500">*</span></label>
                                <input type="text" name="contact_phone" required value="{{ old('contact_phone', Auth::user()->phone ?? '') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-400 transition-colors"
                                    placeholder="Nhập số điện thoại">
                            </div>

                            <div class="mb-2">
                                <!-- Điểm đón đã được dịch chuyển -->
                            </div>
                            <!-- Lưu ý: Nếu user chưa đăng nhập, web sẽ chặn khi submit do có auth middleware, đây là flow chuẩn -->
                            @guest
                                <p class="text-sm text-amber-600 mt-2"><i>Lưu ý: Bạn sẽ được yêu cầu Đăng nhập hệ thống trước lưu đơn.</i></p>
                            @endguest
                        </div>
                    </div>

                    <!-- Right: Ticket Quantity & Summary -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 self-start sticky top-6">
                        <h3 class="text-xl font-bold text-gray-800 border-b border-gray-200 pb-3 mb-5">🎫 Mua vé</h3>

                        {{-- Số lượng vé --}}
                        <div class="mb-5">
                            <label class="block text-gray-700 font-semibold mb-2 text-sm">Số lượng vé muốn mua <span class="text-gray-400 font-normal">(Tối đa 4)</span></label>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="changeQty(-1)"
                                    class="w-10 h-10 flex items-center justify-center rounded-lg border-2 border-gray-300 text-gray-600 font-bold text-lg hover:border-amber-500 hover:text-amber-600 transition-colors select-none">−</button>
                                <input type="number" name="ticket_quantity" id="ticket-qty-input"
                                    min="1" max="{{ min(4, $availableSeats) }}" value="1"
                                    class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg bg-white text-gray-900 font-bold text-xl text-center focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-colors"
                                    oninput="updateSummary()">
                                <button type="button" onclick="changeQty(1)"
                                    class="w-10 h-10 flex items-center justify-center rounded-lg border-2 border-gray-300 text-gray-600 font-bold text-lg hover:border-amber-500 hover:text-amber-600 transition-colors select-none">+</button>
                            </div>
                            <p class="text-sm text-gray-500 mt-2 text-center">Còn lại <span class="font-bold text-amber-600">{{ $availableSeats }}</span> chỗ trống trên chuyến này.</p>
                        </div>

                        <div class="border-t border-gray-200 pt-4">

                            {{-- Mã giảm giá --}}
                            @auth
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold text-sm mb-2">Mã giảm giá</label>
                                <div class="flex gap-2">
                                    <input type="text" id="coupon-input" name="coupon_code"
                                        placeholder="Nhập mã (nếu có)"
                                        class="flex-1 px-3 py-2 border-2 border-gray-300 rounded-lg text-sm text-gray-900 bg-white placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-colors uppercase"
                                        autocomplete="off" oninput="this.value=this.value.toUpperCase()">
                                    <button type="button" id="coupon-btn"
                                        class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-lg transition-colors whitespace-nowrap shadow-sm">
                                        Áp dụng
                                    </button>
                                </div>
                                <div id="coupon-msg" class="text-xs mt-1 hidden"></div>
                            </div>
                            @endauth

                            <div id="price-breakdown" class="hidden mb-3 bg-gray-50 rounded-lg p-3 text-sm border border-gray-100">
                                <div class="flex justify-between text-gray-600 mb-1">
                                    <span>Giá gốc:</span>
                                    <span id="base-price-display" class="font-medium text-gray-800">0 đ</span>
                                </div>
                                <div class="flex justify-between text-green-600">
                                    <span id="discount-label">Giảm giá:</span>
                                    <span id="discount-display" class="font-medium">-0 đ</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-5 bg-amber-50 rounded-lg px-4 py-3 border border-amber-100">
                                <span class="text-gray-700 font-semibold">Tổng tiền:</span>
                                <span id="total-price-display" class="text-2xl font-bold text-amber-600">0 đ</span>
                            </div>

                            <input type="hidden" name="applied_promo_id" id="applied-promo-id" value="">

                            @guest
                                <a href="{{ route('login') }}" class="block text-center w-full py-3 rounded-lg font-bold text-white bg-amber-500 hover:bg-amber-600 transition-colors shadow-sm">
                                    Đăng nhập để đặt vé
                                </a>
                            @else
                                <button type="submit" id="submit-btn" disabled class="w-full py-3 rounded-lg font-bold text-white bg-gray-300 text-gray-500 cursor-not-allowed transition-all shadow-sm">
                                    Tiếp tục
                                </button>
                            @endguest
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- JS Logic cho chọn số lượng + mã giảm giá -->
    <script>
        function changeQty(delta) {
            const input = document.getElementById('ticket-qty-input');
            if (!input) return;
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || 4;
            let val = parseInt(input.value) || 1;
            val = Math.min(max, Math.max(min, val + delta));
            input.value = val;
            updateSummary();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const qtyInput      = document.getElementById('ticket-qty-input');
            const totalDisplay  = document.getElementById('total-price-display');
            const basePriceDisplay = document.getElementById('base-price-display');
            const discountDisplay  = document.getElementById('discount-display');
            const discountLabel    = document.getElementById('discount-label');
            const priceBreakdown   = document.getElementById('price-breakdown');
            const submitBtn     = document.getElementById('submit-btn');
            const pricePerSeat  = parseInt(document.getElementById('ticket-price').getAttribute('data-price')) || 0;

            let currentDiscount  = 0;
            let currentBaseTotal = 0;
            let appliedPromoId   = '';

            const fmt = n => new Intl.NumberFormat('vi-VN').format(n) + ' đ';

            window.updateSummary = function() {
                let count = parseInt(qtyInput ? qtyInput.value : 1) || 0;
                let maxQty = qtyInput ? parseInt(qtyInput.getAttribute('max')) || 1 : 1;

                if (count < 1) { count = 1; if(qtyInput) qtyInput.value = 1; }
                if (count > maxQty) { count = maxQty; if(qtyInput) qtyInput.value = maxQty; }

                currentBaseTotal = count * pricePerSeat;

                if (count > 0) {
                    const finalTotal = Math.max(0, currentBaseTotal - currentDiscount);
                    totalDisplay.innerText = fmt(finalTotal);

                    if (currentDiscount > 0) {
                        priceBreakdown && priceBreakdown.classList.remove('hidden');
                        basePriceDisplay && (basePriceDisplay.innerText = fmt(currentBaseTotal));
                        discountDisplay  && (discountDisplay.innerText  = '-' + fmt(currentDiscount));
                    } else {
                        priceBreakdown && priceBreakdown.classList.add('hidden');
                    }

                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        submitBtn.classList.add('bg-amber-500', 'hover:bg-amber-600');
                    }
                } else {
                    totalDisplay.innerText    = '0 đ';
                    priceBreakdown && priceBreakdown.classList.add('hidden');
                    currentDiscount = 0;
                    appliedPromoId  = '';
                    resetCouponUI && resetCouponUI();

                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                        submitBtn.classList.remove('bg-amber-500', 'hover:bg-amber-600');
                    }
                }
            }

            // Gọi update 1 lần lúc vào trang
            updateSummary();

            // ===== COUPON LOGIC =====
            const couponBtn   = document.getElementById('coupon-btn');
            const couponInput = document.getElementById('coupon-input');
            const couponMsg   = document.getElementById('coupon-msg');
            const promoIdField = document.getElementById('applied-promo-id');

            function resetCouponUI() {
                if (couponInput) couponInput.value = '';
                if (couponMsg)   { couponMsg.className = 'text-xs mt-1 hidden'; couponMsg.innerText = ''; }
                if (promoIdField) promoIdField.value = '';
                priceBreakdown && priceBreakdown.classList.add('hidden');
            }

            function showCouponMsg(msg, ok) {
                if (!couponMsg) return;
                couponMsg.innerText    = msg;
                couponMsg.className    = 'text-xs mt-1 ' + (ok ? 'text-green-600 font-semibold' : 'text-red-500');
                couponMsg.classList.remove('hidden');
            }

            if (couponBtn) {
                couponBtn.addEventListener('click', function() {
                    const code = couponInput ? couponInput.value.trim() : '';
                    if (!code) { showCouponMsg('Vui lòng nhập mã giảm giá.', false); return; }
                    if (currentBaseTotal <= 0) { showCouponMsg('Vui lòng chọn ghế trước.', false); return; }

                    couponBtn.disabled   = true;
                    couponBtn.innerText  = '...';

                    fetch('{{ route("customer.bookings.checkCoupon") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ code: code, base_amount: currentBaseTotal })
                    })
                    .then(r => r.json())
                    .then(data => {
                        couponBtn.disabled  = false;
                        couponBtn.innerText = 'Áp dụng';

                        if (data.valid) {
                            currentDiscount = data.discount;
                            appliedPromoId  = data.promo_id;
                            if (promoIdField) promoIdField.value = appliedPromoId;

                            showCouponMsg('✅ ' + data.message, true);

                            // Cập nhật breakdown
                            if (priceBreakdown) priceBreakdown.classList.remove('hidden');
                            if (basePriceDisplay) basePriceDisplay.innerText = fmt(currentBaseTotal);
                            if (discountDisplay)  discountDisplay.innerText  = '-' + fmt(currentDiscount);
                            if (discountLabel)    discountLabel.innerText    = data.promo_label + ':';
                            totalDisplay.innerText = fmt(Math.max(0, currentBaseTotal - currentDiscount));

                            // Đổi nút thành Xoá
                            couponBtn.innerText  = 'Xoá';
                            couponBtn.className  = 'px-3 py-2 bg-red-400 hover:bg-red-500 text-white text-sm font-bold rounded-lg transition-colors whitespace-nowrap';
                            couponBtn.onclick = function() {
                                currentDiscount = 0;
                                appliedPromoId  = '';
                                resetCouponUI();
                                updateSummary();
                                couponBtn.innerText = 'Áp dụng';
                                couponBtn.className = 'px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-lg transition-colors whitespace-nowrap';
                                couponBtn.onclick   = null;
                                couponBtn.addEventListener('click', arguments.callee); // re-attach? better just reload logic
                                location.reload(); // simplest reset - but let's not do this
                            };
                        } else {
                            currentDiscount = 0;
                            if (promoIdField) promoIdField.value = '';
                            showCouponMsg('❌ ' + data.message, false);
                        }
                    })
                    .catch(() => {
                        couponBtn.disabled  = false;
                        couponBtn.innerText = 'Áp dụng';
                        showCouponMsg('Lỗi kết nối, vui lòng thử lại.', false);
                    });
                });
            }

            // ===== MAP LOGIC =====
            const pickupSelect = document.getElementById('pickup_point_select');
            const stationMap   = document.getElementById('station-map');

            function updateMap() {
                if (!pickupSelect || !stationMap) return;
                const address = pickupSelect.options[pickupSelect.selectedIndex].getAttribute('data-address');
                if (address) {
                    stationMap.classList.replace('opacity-100', 'opacity-0');
                    setTimeout(() => {
                        stationMap.src = `https://www.google.com/maps?q=${encodeURIComponent(address)}&output=embed`;
                        stationMap.onload = () => stationMap.classList.replace('opacity-0', 'opacity-100');
                    }, 300);
                }
            }

            if (pickupSelect) {
                pickupSelect.addEventListener('change', updateMap);
                updateMap();
            }
        });
    </script>
@endsection
