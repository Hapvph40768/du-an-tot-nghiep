
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
                <a href="{{ route('admin.dashboard') }}"
                   class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class='bx bx-grid-alt'></i>
                    <span>Tổng quan</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.vehicles.index') }}"
                   class="menu-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bus"></i>
                    <span>Phương tiện</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#"
                   class="menu-link {{ request()->routeIs('admin.routes.*') ? 'active' : '' }}">
                    <i class='bx bx-map-alt'></i>
                    <span>Tuyến đường</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.drivers.index') }}"
                   class="menu-link {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
                    <i class='bx bx-user-pin'></i>
                    <span>Tài xế</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#"
                   class="menu-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <i class='bx bx-ticket'></i>
                    <span>Đặt vé</span>
                </a>
            </li> 

            <li class="menu-item">
                <a href="{{ route('admin.locations.index') }}"
                   class="menu-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Địa điểm</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.support.index') }}"
                   class="menu-link {{ request()->routeIs('admin.support-tickets.*') ? 'active' : '' }}">
                    <i class='bx bx-support'></i>
                    <span>Hỗ trợ khách hàng</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.users.index') }}"
                   class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class='bx bx-user'></i>
                    <span>Người dùng</span>
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
