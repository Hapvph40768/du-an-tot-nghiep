<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <div class="flex items-center gap-4 mb-4">
        <a href="<?php echo e(route('staff.bookings.index')); ?>" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/></svg>
        </a>
        <h1 class="text-3xl font-bold">Đặt vé Offline (Hỗ trợ khách)</h1>
    </div>
    <p class="text-gray-500 italic">Dành cho nhân viên trực tổng đài hỗ trợ đặt vé qua điện thoại.</p>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl font-bold">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<form action="<?php echo e(route('staff.bookings.store')); ?>" method="POST" id="bookingForm">
    <?php echo csrf_field(); ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Cột 1: Thông tin chuyến & Khách -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-[#111] p-6 rounded-3xl border border-[#e3e3e0] dark:border-[#262626] shadow-sm">
                <h2 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    1. Chọn Chuyến & Khách
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2">Chuyến xe</label>
                        <select name="trip_id" id="tripSelect" required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#262626] rounded-xl font-bold">
                            <option value="">-- Chọn chuyến đi --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($trip->id); ?>">
                                    [<?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?>] 
                                    <?php echo e($trip->route->startLocation->name); ?> → <?php echo e($trip->route->endLocation->name); ?> 
                                    (<?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m')); ?>)
                                </option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2">Điểm đón khách</label>
                        <select name="pickup_point_id" id="pickupSelect" required disabled class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#262626] rounded-xl font-medium">
                            <option value="">Chọn điểm đón...</option>
                        </select>
                    </div>

                    <hr class="border-dashed border-gray-200 dark:border-gray-800">

                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2">Số điện thoại khách</label>
                        <input type="text" name="contact_phone" placeholder="Vd: 0912xxxxx" required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#262626] rounded-xl font-bold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2">Họ tên khách</label>
                        <input type="text" name="contact_name" placeholder="Nhập tên khách..." required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#262626] rounded-xl font-bold">
                    </div>
                </div>
            </div>

            <div class="bg-blue-600 rounded-3xl p-6 text-white shadow-lg">
                <div class="text-xs font-bold opacity-60 uppercase mb-1">TỔNG TIỀN ƯỚC TÍNH</div>
                <div class="text-3xl font-black mb-4"><span id="totalPrice">0</span>đ</div>
                <button type="submit" id="submitBtn" disabled class="w-full py-4 bg-white text-blue-600 rounded-2xl font-black shadow-xl hover:scale-[1.02] active:scale-95 transition-all opacity-50 cursor-not-allowed">
                    XÁC NHẬN ĐẶT VÉ
                </button>
            </div>
        </div>

        <!-- Cột 2 & 3: Sơ đồ ghế -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-[#111] p-8 rounded-3xl border border-[#e3e3e0] dark:border-[#262626] shadow-sm min-h-[400px]">
                <h2 class="text-lg font-bold mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    2. Sơ đồ chỗ ngồi
                </h2>

                <div id="loadingSeats" class="hidden flex flex-col items-center justify-center py-20 opacity-40">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                    <p class="font-bold">Đang tải sơ đồ ghế thực tế...</p>
                </div>

                <div id="noTripSelected" class="flex flex-col items-center justify-center py-20 opacity-40">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16" class="mb-4"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                    <p class="font-bold uppercase tracking-widest text-sm">Vui lòng chọn chuyến xe ở cột trái</p>
                </div>

                <div id="seatGrid" class="hidden grid grid-cols-4 sm:grid-cols-6 gap-3">
                    <!-- Dynamic seats here -->
                </div>

                <div id="seatLegend" class="hidden mt-8 pt-6 border-t border-dashed border-gray-200 dark:border-gray-800 flex flex-wrap gap-4 text-xs font-bold">
                    <div class="flex items-center gap-2"><div class="w-4 h-4 bg-gray-100 dark:bg-gray-800 rounded"></div> CÒN TRỐNG</div>
                    <div class="flex items-center gap-2"><div class="w-4 h-4 bg-blue-600 rounded"></div> ĐANG CHỌN</div>
                    <div class="flex items-center gap-2"><div class="w-4 h-4 bg-red-500 rounded"></div> ĐÃ CÓ KHÁCH</div>
                    <div class="flex items-center gap-2"><div class="w-4 h-4 bg-orange-400 rounded"></div> ĐANG GIỮ CHỖ</div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tripSelect = document.getElementById('tripSelect');
    const pickupSelect = document.getElementById('pickupSelect');
    const seatGrid = document.getElementById('seatGrid');
    const loadingSeats = document.getElementById('loadingSeats');
    const noTripSelected = document.getElementById('noTripSelected');
    const seatLegend = document.getElementById('seatLegend');
    const totalPriceDisplay = document.getElementById('totalPrice');
    const submitBtn = document.getElementById('submitBtn');

    let currentPrice = 0;
    let selectedSeatsCount = 0;

    tripSelect.addEventListener('change', async function() {
        const tripId = this.value;
        if (!tripId) {
            resetView();
            return;
        }

        // Show loading state
        noTripSelected.classList.add('hidden');
        seatGrid.classList.add('hidden');
        seatLegend.classList.add('hidden');
        loadingSeats.classList.remove('hidden');
        pickupSelect.disabled = true;

        try {
            const response = await fetch(`/staff/api/trips/${tripId}/data`);
            const data = await response.json();

            // Populate Pickup Points
            pickupSelect.innerHTML = '<option value="">Chọn điểm đón...</option>';
            data.pickupPoints.forEach(p => {
                pickupSelect.innerHTML += `<option value="${p.id}">${p.name} (${p.address})</option>`;
            });
            pickupSelect.disabled = false;
            pickupSelect.required = true;

            // Render Seats
            renderSeats(data);
            currentPrice = data.price;
            updateSummary();

            loadingSeats.classList.add('hidden');
            seatGrid.classList.remove('hidden');
            seatLegend.classList.remove('hidden');

        } catch (error) {
            console.error('Error fetching trip data:', error);
            alert('Không thể tải dữ liệu chuyến xe. Vui lòng thử lại.');
            resetView();
        }
    });

    function renderSeats(data) {
        seatGrid.innerHTML = '';
        selectedSeatsCount = 0;
        
        data.seats.forEach(seat => {
            const isBooked = data.bookedSeats.includes(seat.id);
            const isLocked = data.lockedSeats.includes(seat.id);
            const isDisabled = isBooked || isLocked;

            let bgColor = 'bg-gray-100 dark:bg-gray-800 text-gray-500 hover:bg-gray-200';
            if (isBooked) bgColor = 'bg-red-500 text-white cursor-not-allowed opacity-50';
            else if (isLocked) bgColor = 'bg-orange-400 text-white cursor-not-allowed opacity-50';

            const seatHtml = `
                <label class="relative cursor-pointer group">
                    <input type="checkbox" name="seats[]" value="${seat.id}" 
                           ${isDisabled ? 'disabled' : ''} 
                           class="seat-checkbox hidden">
                    <div class="seat-ui h-12 w-full flex items-center justify-center rounded-xl font-black text-sm transition-all border-b-4 border-black/10 ${bgColor}">
                        ${seat.seat_number}
                    </div>
                </label>
            `;
            seatGrid.insertAdjacentHTML('beforeend', seatHtml);
        });

        // Add event listeners to checkboxes
        document.querySelectorAll('.seat-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                const ui = this.nextElementSibling;
                if (this.checked) {
                    ui.classList.remove('bg-gray-100', 'dark:bg-gray-800', 'text-gray-500', 'hover:bg-gray-200');
                    ui.classList.add('bg-blue-600', 'text-white', 'scale-95');
                    selectedSeatsCount++;
                } else {
                    ui.classList.add('bg-gray-100', 'dark:bg-gray-800', 'text-gray-500', 'hover:bg-gray-200');
                    ui.classList.remove('bg-blue-600', 'text-white', 'scale-95');
                    selectedSeatsCount--;
                }
                updateSummary();
            });
        });
    }

    function updateSummary() {
        totalPriceDisplay.innerText = (selectedSeatsCount * currentPrice).toLocaleString();
        if (selectedSeatsCount > 0) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    function resetView() {
        noTripSelected.classList.remove('hidden');
        seatGrid.classList.add('hidden');
        seatLegend.classList.add('hidden');
        loadingSeats.classList.add('hidden');
        pickupSelect.innerHTML = '<option value="">Chọn điểm đón...</option>';
        pickupSelect.disabled = true;
        selectedSeatsCount = 0;
        updateSummary();
    }
});
</script>

<style>
    /* Subtle animations for active seat picking */
    .seat-checkbox:checked + .seat-ui {
        animation: pulseSelect 0.2s ease-out;
    }
    @keyframes pulseSelect {
        0% { transform: scale(1); }
        50% { transform: scale(0.9); }
        100% { transform: scale(1); }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\staff\bookings\create.blade.php ENDPATH**/ ?>