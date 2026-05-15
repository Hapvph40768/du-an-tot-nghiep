<?php $__env->startSection('content-main'); ?>
<section class="py-12 lg:py-20 relative min-h-[80vh]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-10">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                    <i data-lucide="package" class="w-8 h-8 text-brand-primary"></i> Lịch sử Ký gửi
                </h2>
                <p class="text-white/50 mt-1">Quản lý và theo dõi trạng thái các đơn hàng ký gửi của bạn.</p>
            </div>
            
            <a href="<?php echo e(route('customer.parcels.create')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 liquid-gradient text-white font-bold py-3 px-6 rounded-xl shadow-[0_10px_40px_-10px_rgba(255,91,36,0.6)] hover:scale-105 transition-transform text-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Tạo đơn ký gửi mới
            </a>
        </div>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('parcel_success')): ?>
            <div class="bg-brand-primary/10 border-2 border-brand-primary/50 text-white p-6 rounded-2xl mb-8 shadow-lg shadow-brand-primary/20 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-brand-primary/20 rounded-full blur-3xl"></div>
                <div class="flex items-start gap-4 relative z-10">
                    <div class="w-12 h-12 bg-brand-primary text-white rounded-full flex items-center justify-center flex-shrink-0 shadow-lg shadow-brand-primary/30">
                        <i data-lucide="phone-call" class="w-6 h-6 animate-pulse"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-brand-primary mb-2 uppercase tracking-wide">Đăng ký thành công!</h3>
                        <p class="text-white/80 mb-3 text-base">Hệ thống đã ghi nhận đơn ký gửi của bạn. Nhân viên nhà xe sẽ gọi điện xác nhận và hướng dẫn gửi hàng trong vòng <strong>10 phút</strong>.</p>
                        <div class="inline-flex items-center gap-3 bg-black/30 border border-white/10 px-4 py-2 rounded-xl">
                            <span class="text-sm text-white/50">Hotline hỗ trợ nhanh:</span>
                            <a href="tel:19001000" class="text-brand-primary font-black text-xl hover:text-brand-accent transition-colors">1900 1000</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif(session('success')): ?>
            <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-8 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-8 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium"><?php echo e(session('error')); ?></p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-primary/10 rounded-full blur-[80px] pointer-events-none"></div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parcels->isEmpty()): ?>
                <div class="p-16 text-center text-white/50 flex flex-col items-center">
                    <i data-lucide="package-open" class="w-16 h-16 mb-4 opacity-50"></i>
                    <p class="text-lg">Bạn chưa có đơn ký gửi nào.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-black/20 text-xs uppercase font-bold text-white/40 tracking-wider">
                                <th class="p-5 pl-6 border-b border-white/5">Mã Đơn</th>
                                <th class="p-5 border-b border-white/5">Tuyến đường</th>
                                <th class="p-5 border-b border-white/5">Thông tin gửi/nhận</th>
                                <th class="p-5 border-b border-white/5 text-center">Cân nặng</th>
                                <th class="p-5 border-b border-white/5 text-right">Tổng tiền</th>
                                <th class="p-5 border-b border-white/5 text-center">Trạng thái</th>
                                <th class="p-5 pr-6 border-b border-white/5 text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-sm">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $parcels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parcel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="p-5 pl-6 font-mono font-bold text-white/80 group-hover:text-white transition-colors">#<?php echo e($parcel->id); ?></td>
                                    <td class="p-5 text-white/70 group-hover:text-white transition-colors">
                                        <div class="flex items-center gap-2">
                                            <span><?php echo e($parcel->route->startLocation->name ?? 'N/A'); ?></span>
                                            <i data-lucide="arrow-right" class="w-3 h-3 text-brand-primary"></i>
                                            <span><?php echo e($parcel->route->endLocation->name ?? 'N/A'); ?></span>
                                        </div>
                                    </td>
                                    <td class="p-5 text-white/70">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs text-white/40 uppercase tracking-wider w-10">Gửi:</span> 
                                                <span class="font-medium text-white/80"><?php echo e($parcel->sender_name); ?></span> 
                                                <span class="text-xs">(<?php echo e($parcel->sender_phone); ?>)</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs text-brand-accent uppercase tracking-wider w-10">Nhận:</span> 
                                                <span class="font-medium text-white/80"><?php echo e($parcel->receiver_name); ?></span> 
                                                <span class="text-xs">(<?php echo e($parcel->receiver_phone); ?>)</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-5 text-center text-white/70 font-medium">
                                        <?php echo e($parcel->weight); ?> kg
                                    </td>
                                    <td class="p-5 font-black text-brand-primary text-right text-base">
                                        <?php echo e(number_format($parcel->price, 0, ',', '.')); ?>đ
                                    </td>
                                    <td class="p-5 pr-6 text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parcel->status == 'pending'): ?>
                                            <span class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-bold">
                                                <i data-lucide="clock" class="w-3 h-3"></i> Chờ xử lý
                                            </span>
                                        <?php elseif($parcel->status == 'shipping'): ?>
                                            <span class="inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full text-xs font-bold">
                                                <i data-lucide="truck" class="w-3 h-3"></i> Đang giao
                                            </span>
                                        <?php elseif($parcel->status == 'completed'): ?>
                                            <span class="inline-flex items-center gap-1.5 bg-green-500/10 text-green-400 border border-green-500/20 px-3 py-1 rounded-full text-xs font-bold">
                                                <i data-lucide="check-circle" class="w-3 h-3"></i> Đã nhận
                                            </span>
                                        <?php elseif($parcel->status == 'cancelled'): ?>
                                            <span class="inline-flex items-center gap-1.5 bg-red-500/10 text-red-400 border border-red-500/20 px-3 py-1 rounded-full text-xs font-bold">
                                                <i data-lucide="x-circle" class="w-3 h-3"></i> Đã hủy
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1.5 bg-white/10 text-white/70 border border-white/20 px-3 py-1 rounded-full text-xs font-bold">
                                                <?php echo e($parcel->status); ?>

                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="p-5 pr-6 text-right">
                                        <a href="<?php echo e(route('customer.parcels.show', $parcel->id)); ?>" class="inline-flex items-center justify-center gap-2 bg-white/5 hover:bg-white/10 text-white/70 hover:text-white border border-white/10 px-4 py-2 rounded-lg text-xs font-bold transition-colors">
                                            <i data-lucide="eye" class="w-3 h-3"></i> Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/parcels/index.blade.php ENDPATH**/ ?>