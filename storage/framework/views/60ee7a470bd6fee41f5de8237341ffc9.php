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
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span>Tổng quan</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.drivers.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.drivers.*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-car"></i>
                    <span>Tài xế</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.locations.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.locations.*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Địa điểm</span>
                </a>
            </li>

            

            
            

            

            <!-- Các mục đang phát triển hoặc chưa hoàn thiện có thể để tạm comment -->
            <!--
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class='bx bx-bus'></i>
                    <span>Quản lý xe</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class='bx bx-money'></i>
                    <span>Quản lý giao dịch</span>
                </a>
            </li>
            -->

            

            <li class="menu-item">
                <a href="<?php echo e(route('admin.support-tickets.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.support-tickets.*') ? 'active' : ''); ?>">
                    <i class='bx bx-support'></i>
                    <span>Support / Ticket</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo e(route('admin.users.index')); ?>"
                    class="menu-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                    <i class='bx bx-user'></i>
                    <span>Quản lý người dùng</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="user-avatar">
            <span>A</span>
        </div>
        <div class="user-info">
            <h4>Admin</h4>
            <span>Quản trị viên</span>
        </div>
    </div>
</aside>
<?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/layout/admin/blocks/aside.blade.php ENDPATH**/ ?>