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
                    class="menu-link <?php echo e(request()->routeIs('admin.dashboard.index') ? 'active' : ''); ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span>Tổng quan</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.vehicles.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.vehicles.*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-bus"></i>
                    <span>Phương tiện</span>
                </a>
            </li>

            <li class="menu-item">
                
                <a href="<?php echo e(route('admin.routes.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.routes.*') ? 'active' : ''); ?>">
                    <i class='bx bx-map-alt'></i>
                    <span>Tuyến đường</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.drivers.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.drivers.*') ? 'active' : ''); ?>">
                    <i class='bx bx-user-pin'></i>
                    <span>Tài xế</span>
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
                    <span>Đặt vé</span>
                </a>
            </li> 

            <li class="menu-item">
                <a href="<?php echo e(route('admin.locations.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.locations.*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Địa điểm</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.support_tickets.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.support-tickets.*') ? 'active' : ''); ?>">
                    <i class='bx bx-support'></i>
                    <span>Hỗ trợ khách hàng</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.users.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                    <i class='bx bx-user'></i>
                    <span>Người dùng</span>
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
            <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer;">
                <i class='bx bx-log-out fs-4'></i>
            </button>
        </form>
    </div>
</aside><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/layout/admin/blocks/aside.blade.php ENDPATH**/ ?>