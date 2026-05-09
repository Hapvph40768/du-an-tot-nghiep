

<?php $__env->startSection('header-title', 'Overview'); ?>
<?php $__env->startSection('header-subtitle', 'Báo cáo hiệu suất hệ thống'); ?>

<?php $__env->startSection('content-main'); ?>
<div class="space-y-12">
    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
            $stats = [
                ['title' => 'Tổng tài xế', 'value' => $totalDrivers, 'icon' => 'user-square-2', 'color' => 'brand-accent', 'desc' => 'Tài xế đang hoạt động'],
                ['title' => 'Chuyến xe', 'value' => $totalTrips, 'icon' => 'bus', 'color' => 'brand-primary', 'desc' => 'Tổng số chuyến đã tạo'],
                ['title' => 'Số vé đặt', 'value' => $totalTickets, 'icon' => 'ticket', 'color' => 'emerald-400', 'desc' => 'Số lượng vé đã bán'],
                ['title' => 'Doanh thu', 'value' => number_format($totalRevenue, 0, ',', '.') . 'đ', 'icon' => 'banknote', 'color' => 'brand-accent', 'desc' => 'Tổng tiền thành công'],
            ];
        ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <div class="glass-dark p-8 rounded-4xl border-none ring-1 ring-white/5 space-y-6 group hover:ring-white/20 transition-all duration-500">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center group-hover:bg-<?php echo e($s['color']); ?>/20 transition-all">
                    <i data-lucide="<?php echo e($s['icon']); ?>" class="w-6 h-6 text-<?php echo e($s['color']); ?>"></i>
                </div>
                <div class="flex items-center gap-1 text-emerald-400">
                    <i data-lucide="trending-up" class="w-4 h-4 text-emerald-400"></i>
                    <span class="text-[10px] font-black italic">Active</span>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-[10px] font-black uppercase tracking-widest text-white/30"><?php echo e($s['title']); ?></p>
                <h3 class="text-4xl font-black italic tracking-tighter"><?php echo e($s['value']); ?></h3>
            </div>
            <p class="text-[10px] font-bold text-white/20 uppercase tracking-tight"><?php echo e($s['desc']); ?></p>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Revenue Chart -->
        <div class="lg:col-span-8 glass-dark rounded-4xl p-10 border-none ring-1 ring-white/5 space-y-8">
            <div class="flex justify-between items-end">
                <div class="space-y-2">
                    <h4 class="text-xl font-black italic uppercase tracking-tight">Doanh thu & Số vé</h4>
                    <p class="text-xs text-white/30 font-bold uppercase tracking-widest leading-none">Phân tích 7 ngày vừa qua</p>
                </div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-brand-primary"></div>
                        <span class="text-[10px] font-black uppercase text-white/40">Doanh thu</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-brand-accent"></div>
                        <span class="text-[10px] font-black uppercase text-white/40"><?php echo e(__('tickets')); ?> đặt</span>
                    </div>
                </div>
            </div>
            <div class="h-80">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="lg:col-span-4 glass-dark rounded-4xl p-10 border-none ring-1 ring-white/5 flex flex-col justify-between">
            <div class="space-y-2">
                <h4 class="text-xl font-black italic uppercase tracking-tight"><?php echo e(__('status')); ?></h4>
                <p class="text-xs text-white/30 font-bold uppercase tracking-widest leading-none">Phân bổ chuyến xe</p>
            </div>
            <div class="py-8">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="space-y-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tripStatusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="flex justify-between items-center text-xs">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full" style="background-color: <?php echo e(['#22d3ee', '#006992', '#ef4444'][$index]); ?>"></div>
                        <span class="text-white/40 font-bold"><?php echo e($label); ?></span>
                    </div>
                    <span class="font-black"><?php echo e($tripStatusData[$index]); ?></span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Shared config
        Chart.defaults.color = 'rgba(255, 255, 255, 0.3)';
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.font.weight = '700';

        // Revenue & Tickets Chart
        const ctxRev = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRev, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
                datasets: [
                    {
                        label: 'Doanh thu',
                        data: <?php echo json_encode($revenueData, 15, 512) ?>,
                        backgroundColor: '#006992',
                        borderRadius: 12,
                        barThickness: 32,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Vé đặt',
                        data: <?php echo json_encode($ticketData, 15, 512) ?>,
                        type: 'line',
                        borderColor: '#22d3ee',
                        borderWidth: 4,
                        pointBackgroundColor: '#22d3ee',
                        pointHoverRadius: 8,
                        tension: 0.4,
                        yAxisID: 'y1'
                    }} ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }},
                scales: {
                    x: { grid: { display: false }, border: { display: false }},
                    y: { 
                        position: 'left',
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        border: { display: false },
                        ticks: {
                            callback: value => value > 0 ? (value / 1000000) + 'M' : 0
                        }},
                    y1: {
                        position: 'right',
                        grid: { display: false },
                        border: { display: false }}} }}} });

        // Status Chart
        const ctxStat = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStat, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($tripStatusLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($tripStatusData, 15, 512) ?>,
                    backgroundColor: ['#22d3ee', '#006992', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: {
                cutout: '80%',
                responsive: true,
                plugins: { legend: { display: false }}} }});
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>