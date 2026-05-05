<?php $__env->startSection('content'); ?>
    <div class="px-6 lg:px-12 py-12 max-w-7xl mx-auto" 
         x-data="{ 
            selectedSeats: [], 
            pricePerSeat: <?php echo e($trip->price); ?>,
            discount: 0,
            couponCode: '',
            couponValid: false,
            couponMessage: '',
            pickupPoint: '',
            pickupPointId: '',
            pickupAddress: '<?php echo e($trip->route->departureLocation->name); ?>',
            dropoffPoint: '',
            dropoffPointId: '',
            dropoffAddress: '<?php echo e($trip->route->destinationLocation->name); ?>',
            tab: 'lower',
            get subtotal() { return this.selectedSeats.length * this.pricePerSeat },
            get total() { return Math.max(0, this.subtotal - this.discount) },
            toggleSeat(id, number) {
                if (this.selectedSeats.find(s => s.id === id)) {
                    this.selectedSeats = this.selectedSeats.filter(s => s.id !== id);
                }} else {
                    if (this.selectedSeats.length >= 5) {
                        alert('Bạn chỉ có thể chọn tối đa 5 ghế.');
                        return;
                    }} this.selectedSeats.push({ id, number });
                }} this.$nextTick(() => lucide.createIcons());
            },
            async checkCoupon() {
                if (!this.couponCode) return;
                try {
                    const response = await fetch('<?php echo e(route('customer.bookings.checkCoupon')); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({ code: this.couponCode, base_amount: this.subtotal })
                    });
                    const data = await response.json();
                    this.couponValid = data.valid;
                    this.couponMessage = data.message;
                    if (data.valid) {
                        this.discount = data.discount;
                    }} else {
                        this.discount = 0;
                    }}} catch (e) {
                    this.couponMessage = 'Lỗi kiểm tra mã.';
                }}} }"
         x-init="lucide.createIcons()">
        
        <!-- Navigation Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 mb-12">
            <div>
                <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $trip->route->start_location_id, 'end_location_id' => $trip->route->end_location_id])); ?>" 
                   class="inline-flex items-center gap-2 text-white/40 hover:text-brand-accent transition-all group mb-4">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest">Thay đổi hành trình</span>
                </a>
                <h1 class="text-4xl md:text-6xl font-black italic tracking-tighter">ĐẶT VÉ TRỰC TUYẾN</h1>
                <p class="text-white/40 text-sm font-bold uppercase tracking-[0.2em] mt-2">
                    <span class="text-brand-accent"><?php echo e($trip->route->departureLocation->name); ?></span> 
                    <i data-lucide="arrow-right" class="inline w-3 h-3 mx-2 opacity-50"></i> 
                    <span class="text-brand-accent"><?php echo e($trip->route->destinationLocation->name); ?></span>
                </p>
            </div>
            
            <!-- Quick Stats -->
            <div class="flex gap-4">
                <div class="glass p-4 rounded-3xl border-none ring-1 ring-white/10 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-2xl liquid-gradient flex items-center justify-center shadow-lg shadow-brand-accent/20">
                        <i data-lucide="calendar" class="w-5 h-5 text-brand-dark"></i>
                    </div>
                    <div>
                        <p class="text-[8px] font-black uppercase text-white/30 tracking-widest"><?php echo e(__('date')); ?> đi</p>
                        <p class="text-sm font-black"><?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?></p>
                    </div>
                </div>
                <div class="glass p-4 rounded-3xl border-none ring-1 ring-white/10 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                        <i data-lucide="clock" class="w-5 h-5 text-brand-accent"></i>
                    </div>
                    <div>
                        <p class="text-[8px] font-black uppercase text-white/30 tracking-widest"><?php echo e(__('time')); ?> khởi hành</p>
                        <p class="text-sm font-black"><?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <form action="<?php echo e(route('customer.bookings.store')); ?>" method="POST" id="booking-form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="trip_id" value="<?php echo e($trip->id); ?>">
            <template x-for="seat in selectedSeats" :key="seat.id">
                <input type="hidden" name="seat_ids[]" :value="seat.id">
            </template>
            <input type="hidden" name="coupon_code" :value="couponCode">
            <input type="hidden" name="pickup_point_id" :value="pickupPointId">
            <input type="hidden" name="dropoff_point_id" :value="dropoffPointId">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Main Selection Flow -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- STEP 1: Seat Selection -->
                    <div class="liquid-card p-8 md:p-12">
                        <div class="flex justify-between items-center mb-12">
                            <div class="flex items-center gap-4">
                                <span class="flex-none w-10 h-10 rounded-full liquid-gradient flex items-center justify-center font-black text-brand-dark shadow-lg shadow-brand-accent/20">1</span>
                                <h3 class="text-2xl font-black italic tracking-tighter">CHỌN CHỖ NGỒI</h3>
                            </div>
                            <!-- Deck Toggle -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->vehicle->total_seats > 22): ?>
                            <div class="flex bg-white/5 p-1.5 rounded-2xl border border-white/5">
                                <button type="button" @click="tab = 'lower'" 
                                        :class="tab === 'lower' ? 'bg-white text-brand-dark shadow-lg' : 'text-white/40 hover:text-white'"
                                        class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Tầng dưới</button>
                                <button type="button" @click="tab = 'upper'" 
                                        :class="tab === 'upper' ? 'bg-white text-brand-dark shadow-lg' : 'text-white/40 hover:text-white'"
                                        class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Tầng trên</button>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <!-- Legend -->
                        <div class="flex gap-8 mb-12 p-6 glass rounded-[2rem] border-brand-accent/5 max-w-fit mx-auto">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-md bg-white/5 border border-white/10"></div>
                                <span class="text-[9px] font-bold text-white/40 whitespace-nowrap uppercase tracking-widest">Trống</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-md liquid-gradient shadow-lg shadow-brand-accent/20"></div>
                                <span class="text-[9px] font-bold text-white/40 whitespace-nowrap uppercase tracking-widest">Đang chọn</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-md bg-red-500/20 border border-red-500/20"></div>
                                <span class="text-[9px] font-bold text-white/40 whitespace-nowrap uppercase tracking-widest">Đã đặt</span>
                            </div>
                        </div>

                        <!-- Seat Map Grid -->
                        <div class="grid grid-cols-3 md:grid-cols-3 gap-6 md:gap-10 justify-items-center max-w-lg mx-auto relative py-12">
                            <div class="absolute inset-0 bg-brand-primary/5 blur-[100px] -z-10 rounded-full"></div>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trip->vehicle->seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $isBooked = in_array($seat->id, $bookedSeatIds);
                                    $isUpper = str_contains($seat->seat_number, 'B') || (int)filter_var($seat->seat_number, FILTER_SANITIZE_NUMBER_INT) > 20;
                                ?>
                                <div 
                                    <?php if($trip->vehicle->total_seats > 22): ?>
                                        x-show="tab === '<?php echo e($isUpper ? 'upper' : 'lower'); ?>'"
                                        x-transition:enter="transition ease-out duration-300 transform"
                                        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    <?php endif; ?>
                                >
                                    <div 
                                        @click="<?php echo e(!$isBooked ? "toggleSeat($seat->id, '$seat->seat_number')" : ""); ?>"
                                        :class="selectedSeats.find(s => s.id === <?php echo e($seat->id); ?>) ? 'selected' : '<?php echo e($isBooked ? 'booked' : 'available'); ?>'"
                                        class="seat-v2 w-20 h-24 flex flex-col items-center justify-center gap-2 group"
                                    >
                                        <i data-lucide="armchair" 
                                           :class="selectedSeats.find(s => s.id === <?php echo e($seat->id); ?>) ? 'text-brand-dark' : 'text-white/20 group-hover:text-brand-accent'" 
                                           class="w-8 h-8 transition-colors duration-300"></i>
                                        <span class="text-[10px] font-black tracking-[0.2em]"
                                              :class="selectedSeats.find(s => s.id === <?php echo e($seat->id); ?>) ? 'text-brand-dark' : 'text-white/20'"><?php echo e($seat->seat_number); ?></span>
                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isBooked): ?>
                                        <div class="absolute bottom-1 left-2 right-2 h-0.5 bg-brand-accent/0 group-hover:bg-brand-accent/20 rounded-full transition-all"
                                             :class="selectedSeats.find(s => s.id === <?php echo e($seat->id); ?>) ? 'hidden' : ''"></div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    <!-- STEP 2: Points Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Pickup -->
                        <div class="liquid-card p-10">
                            <div class="flex items-center gap-4 mb-8">
                                <span class="flex-none w-8 h-8 rounded-full border border-brand-accent/30 flex items-center justify-center font-black text-xs text-brand-accent">2</span>
                                <h3 class="text-xl font-black italic uppercase tracking-tighter"><?php echo e(__('ignition_pt')); ?></h3>
                            </div>
                            
                            <div class="space-y-4 max-h-[400px] overflow-y-auto pr-4 custom-scrollbar">
                                <?php $pickupPoints = $trip->pickupPoints->where('location_id', $trip->route->start_location_id); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <label class="block cursor-pointer group">
                                    <input type="radio" name="_pickup_point" value="<?php echo e($point->id); ?>" class="hidden" 
                                           @change="pickupAddress = '<?php echo e($point->address ?: $point->name); ?>'; pickupPoint = '<?php echo e($point->name); ?>'; pickupPointId = '<?php echo e($point->id); ?>'" required>
                                    <div class="timeline-node" :class="pickupPointId == '<?php echo e($point->id); ?>' ? 'active' : ''">
                                        <div class="timeline-dot transition-all duration-500">
                                            <i data-lucide="map-pin" 
                                               :class="pickupPointId == '<?php echo e($point->id); ?>' ? 'text-brand-dark w-3 h-3' : 'text-white/20 w-2 h-2'"></i>
                                        </div>
                                        <div class="glass p-6 rounded-3xl border-white/5 group-hover:border-white/20 transition-all"
                                             :class="pickupPointId == '<?php echo e($point->id); ?>' ? 'bg-brand-accent/5 ring-1 ring-brand-accent/20 border-transparent shadow-[0_0_20px_rgba(34,211,238,0.05)]' : ''">
                                            <div class="flex justify-between items-start mb-1">
                                                <p class="text-lg font-black group-hover:text-brand-accent transition-colors"
                                                   :class="pickupPointId == '<?php echo e($point->id); ?>' ? 'text-brand-accent' : ''"><?php echo e($point->name); ?></p>
                                                <span class="text-[10px] font-black text-white/30"><?php echo e(\Carbon\Carbon::parse($point->pivot->pickup_time ?? $trip->departure_time)->format('H:i')); ?></span>
                                            </div>
                                            <p class="text-[11px] text-white/40 leading-relaxed"><?php echo e($point->address); ?></p>
                                        </div>
                                    </div>
                                </label>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>

                        <!-- Dropoff -->
                        <div class="liquid-card p-10">
                            <div class="flex items-center gap-4 mb-8">
                                <span class="flex-none w-8 h-8 rounded-full border border-red-500/30 flex items-center justify-center font-black text-xs text-red-400">3</span>
                                <h3 class="text-xl font-black italic uppercase tracking-tighter"><?php echo e(__('terminal_pt')); ?></h3>
                            </div>
                            
                            <div class="space-y-4 max-h-[400px] overflow-y-auto pr-4 custom-scrollbar text-red-400">
                                <?php $dropoffPoints = $trip->pickupPoints->where('location_id', $trip->route->end_location_id); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $dropoffPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <label class="block cursor-pointer group">
                                    <input type="radio" name="_dropoff_point" value="<?php echo e($point->id); ?>" class="hidden" 
                                           @change="dropoffAddress = '<?php echo e($point->address ?: $point->name); ?>'; dropoffPoint = '<?php echo e($point->name); ?>'; dropoffPointId = '<?php echo e($point->id); ?>'" required>
                                    <div class="timeline-node" :class="dropoffPointId == '<?php echo e($point->id); ?>' ? 'active' : ''">
                                        <div class="timeline-dot transition-all duration-500" 
                                             :class="dropoffPointId == '<?php echo e($point->id); ?>' ? 'bg-red-500 border-red-500 shadow-[0_0_15px_rgba(239,68,68,0.5)]' : ''">
                                            <i data-lucide="flag" 
                                               :class="dropoffPointId == '<?php echo e($point->id); ?>' ? 'text-white w-3 h-3' : 'text-red-500/20 w-2 h-2'"></i>
                                        </div>
                                        <div class="glass p-6 rounded-3xl border-white/5 group-hover:border-white/20 transition-all text-white"
                                             :class="dropoffPointId == '<?php echo e($point->id); ?>' ? 'bg-red-500/5 ring-1 ring-red-500/20 border-transparent' : ''">
                                            <div class="flex justify-between items-start mb-1">
                                                <p class="text-lg font-black group-hover:text-red-400 transition-colors"
                                                   :class="dropoffPointId == '<?php echo e($point->id); ?>' ? 'text-red-400' : ''"><?php echo e($point->name); ?></p>
                                                <span class="text-[10px] font-black text-white/30 italic">Kết thúc</span>
                                            </div>
                                            <p class="text-[11px] text-white/40 leading-relaxed"><?php echo e($point->address); ?></p>
                                        </div>
                                    </div>
                                </label>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Checkout Details -->
                <div class="lg:col-span-4">
                    <div class="sticky top-28 space-y-8">
                        
                        <!-- Main Summary Card -->
                        <div class="liquid-card p-10 overflow-hidden relative">
                            <div class="absolute -top-12 -right-12 w-32 h-32 bg-brand-accent/10 blur-[60px] rounded-full"></div>
                            
                            <h4 class="text-xs font-black uppercase tracking-[0.3em] text-white/30 mb-8 pb-4 border-b border-white/5">Thông tin vé</h4>
                            
                            <div class="space-y-8">
                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-brand-accent mb-1"><?php echo e(__('seats')); ?> đã chọn</p>
                                        <p class="text-4xl font-black italic tracking-tighter" x-text="selectedSeats.length > 0 ? selectedSeats.map(s => s.number).join(', ') : '---'"></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-white/30 mb-1">Tầng</p>
                                        <p class="text-xl font-black italic" x-text="tab === 'lower' ? 'DƯỚI' : 'TRÊN'"></p>
                                    </div>
                                </div>

                                <!-- Points Preview -->
                                <div class="space-y-4 p-6 bg-white/5 rounded-3xl border border-white/5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-2 h-2 rounded-full bg-brand-accent shadow-[0_0_8px_#22d3ee]"></div>
                                        <div class="flex-1">
                                            <p class="text-[10px] font-black uppercase text-white/30 tracking-widest">Đón: <span class="text-white/60" x-text="pickupPoint || 'Chưa chọn'"></span></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="w-2 h-2 rounded-full bg-red-400 shadow-[0_0_8px_#f87171]"></div>
                                        <div class="flex-1">
                                            <p class="text-[10px] font-black uppercase text-white/30 tracking-widest">Trả: <span class="text-white/60" x-text="dropoffPoint || 'Chưa chọn'"></span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Coupon -->
                                <div class="space-y-3">
                                    <div class="relative">
                                        <input type="text" x-model="couponCode" placeholder="Mã giảm giá"
                                               class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold tracking-widest uppercase focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent/20 transition-all placeholder:text-white/10">
                                        <button type="button" @click="checkCoupon()" 
                                                class="absolute right-2 top-2 bottom-2 px-6 rounded-xl glass hover:bg-white hover:text-brand-dark font-black text-[10px] uppercase tracking-widest transition-all">Áp dụng</button>
                                    </div>
                                    <p x-show="couponMessage" :class="couponValid ? 'text-green-400' : 'text-red-400'" class="text-[10px] font-black tracking-widest px-2" x-text="couponMessage"></p>
                                </div>

                                <!-- Total -->
                                <div class="pt-8 border-t border-white/5">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-[10px] font-black uppercase text-white/30 tracking-widest">Tạm tính</span>
                                        <span class="font-black" x-text="new Intl.NumberFormat('vi-VN').format(subtotal) + 'đ'"></span>
                                    </div>
                                    <div class="flex justify-between items-center mb-6 text-green-400" x-show="discount > 0">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-green-400/50">Giảm giá</span>
                                        <span class="font-black" x-text="'-' + new Intl.NumberFormat('vi-VN').format(discount) + 'đ'"></span>
                                    </div>
                                    <div class="flex justify-between items-end">
                                        <span class="text-2xl font-black italic tracking-tighter">TỔNG CỘNG</span>
                                        <span class="text-4xl font-black liquid-text italic tracking-tighter tabular-nums" x-text="new Intl.NumberFormat('vi-VN').format(total) + 'đ'"></span>
                                    </div>
                                </div>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                                    <a href="<?php echo e(route('login')); ?>" class="w-full py-6 rounded-3xl bg-white text-brand-dark text-center font-black italic block hover:bg-brand-accent hover:text-white transition-all transform hover:-translate-y-1 shadow-xl uppercase tracking-widest text-xs">
                                        Đăng nhập để đặt vé
                                    </a>
                                <?php else: ?>
                                    <button type="submit" 
                                            :disabled="selectedSeats.length === 0 || !pickupPointId || !dropoffPointId" 
                                            :class="selectedSeats.length === 0 || !pickupPointId || !dropoffPointId ? 'opacity-20 cursor-not-allowed grayscale' : ''"
                                            class="w-full py-6 rounded-3xl liquid-gradient text-brand-dark font-black text-xl italic transition-all hover:scale-[1.02] active:scale-95 shadow-[0_20px_40px_-10px_rgba(34,211,238,0.3)] flex items-center justify-center gap-4 group">
                                        <span x-text="selectedSeats.length === 0 ? 'HÃY CHỌN GHẾ' : (!pickupPointId || !dropoffPointId ? 'CHỌN ĐIỂM DỪNG' : 'TIẾP TỤC')"></span>
                                        <i data-lucide="chevron-right" class="w-6 h-6 group-hover:translate-x-1 transition-transform"></i>
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <!-- Trust Badges -->
                        <div class="flex items-center justify-center gap-6 opacity-20 hover:opacity-100 transition-opacity duration-500">
                            <div class="flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-4 h-4 text-brand-accent"></i>
                                <span class="text-[8px] font-black tracking-widest uppercase">Safe & Secure</span>
                            </div>
                            <div class="w-1 h-1 rounded-full bg-white/20"></div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="credit-card" class="w-4 h-4 text-brand-accent"></i>
                                <span class="text-[8px] font-black tracking-widest uppercase">Fast Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }} .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); border-radius: 10px; }} .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(34, 211, 238, 0.2); border-radius: 10px; }} .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(34, 211, 238, 0.4); }}</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Lucide initialization is handled by Alpine x-init and individual component calls
    document.addEventListener('alpine:init', () => {
        lucide.createIcons();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\code\laragon\www\du-an-tot-nghiep\resources\views/customer/trips/show.blade.php ENDPATH**/ ?>