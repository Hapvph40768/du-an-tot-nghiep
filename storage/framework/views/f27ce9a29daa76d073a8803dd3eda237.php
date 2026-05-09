<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class='bx bx-transfer-alt'></i>
        </div>
        <div class="logo-text">
            <h2>Mạnh Hùng</h2>
            <span>Hệ thống quản trị</span>
        </div>
    </div>

    <nav class="sidebar-menu">
        <ul class="menu-list">

            <li class="menu-item">
                <a href="<?php echo e(route('admin.dashboard.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.dashboard.*') ? 'active' : ''); ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span><?php echo e(__('overview')); ?></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.trips.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.trips.*') ? 'active' : ''); ?>">
                    <i class='bx bx-git-repo-forked'></i>
                    <span>Chuyến đi</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.bookings.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.bookings.*') ? 'active' : ''); ?>">
                    <i class='bx bx-ticket'></i>
                    <span><?php echo e(__('bookings')); ?></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.vehicles.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.vehicles.*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-bus"></i>
                    <span><?php echo e(__('vehicles')); ?></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.drivers.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.drivers.*') ? 'active' : ''); ?>">
                    <i class='bx bx-user-pin'></i>
                    <span><?php echo e(__('drivers')); ?></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.routes.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.routes.*') ? 'active' : ''); ?>">
                    <i class='bx bx-map-alt'></i>
                    <span><?php echo e(__('routes')); ?></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.pickup-points.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.pickup-points.*') ? 'active' : ''); ?>">
                    <i class='bx bx-map-pin'></i>
                    <span>Danh mục Điểm đón</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.dropoff-points.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.dropoff-points.*') ? 'active' : ''); ?>">
                    <i class='bx bx-map-pin'></i>
                    <span>Danh mục Điểm trả</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.locations.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.locations.*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-location-dot"></i>
                    <span><?php echo e(__('locations')); ?></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.support_tickets.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.support_tickets.*') ? 'active' : ''); ?>">
                    <i class='bx bx-support'></i>
                    <span><?php echo e(__('support')); ?> khách hàng</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.users.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                    <i class='bx bx-user'></i>
                    <span><?php echo e(__('users')); ?></span>
                </a>
            </li>

            <li class="menu-item" style="margin-top:10px;">
                <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;">
                    Kinh doanh & Marketing
                </span>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.promotions.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.promotions.*') ? 'active' : ''); ?>">
                    <i class='bx bx-purchase-tag-alt'></i>
                    <span><?php echo e(__('promotions')); ?></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.price_rules.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.price_rules.*') ? 'active' : ''); ?>">
                    <i class='bx bx-slider-alt'></i>
                    <span><?php echo e(__('price_rules')); ?> vé</span>
                </a>
            </li>

            <li class="menu-item" style="margin-top:10px;">
                <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;">
                    Vận hành
                </span>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.schedules.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.schedules.*') ? 'active' : ''); ?>">
                    <i class='bx bx-time-five'></i>
                    <span><?php echo e(__('schedules')); ?> xe chạy</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.parcels.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.parcels.*') ? 'active' : ''); ?>">
                    <i class='bx bx-package'></i>
                    <span><?php echo e(__('parcels')); ?> hàng hoá</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.parcel_prices.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.parcel_prices.*') ? 'active' : ''); ?>">
                    <i class='bx bx-money'></i>
                    <span>Bảng giá ký gửi</span>
                </a>
            </li>

            <li class="menu-item" style="margin-top:10px;">
                <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;">
                    Giám sát & Thống kê
                </span>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.statistics.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.statistics.*') ? 'active' : ''); ?>">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span>Thống kê chi tiết</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.daily_reports.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.daily_reports.*') ? 'active' : ''); ?>">
                    <i class='bx bx-bar-chart-alt-2'></i>
                    <span>Báo cáo doanh thu</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.activity_logs.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.activity_logs.*') ? 'active' : ''); ?>">
                    <i class='bx bx-list-check'></i>
                    <span>Lịch sử hành động</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.notifications.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.notifications.*') ? 'active' : ''); ?>">
                    <i class='bx bx-bell'></i>
                    <span><?php echo e(__('notifications')); ?> hệ thống</span>
                </a>
            </li>

        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="user-avatar">
            <span><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
        </div>
        <div class="user-info">
            <h4><?php echo e(Auth::user()->name); ?></h4>
            <span><?php echo e(ucfirst(Auth::user()->role)); ?></span>
        </div>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin-left: auto;">
            <?php echo csrf_field(); ?>
            <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer;"
                title="="<?php echo e(__('logout')); ?>">
                <i class='bx bx-log-out fs-4'></i>
            </button>
        </form>
    </div>
</aside>
<?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/layout/admin/blocks/aside.blade.php ENDPATH**/ ?>