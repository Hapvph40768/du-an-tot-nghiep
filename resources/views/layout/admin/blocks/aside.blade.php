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

            {{-- Tổng quan --}}<li class="menu-item">
                <a href="{{ route('admin.dashboard.index') }}"
                    class="menu-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                    <i class='bx bx-grid-alt'></i>
                    <span>{{ __('overview') }}</span>
                </a>
            </li>

            {{-- Vận hành chính --}}<li class="menu-item">
                <a href="{{ route('admin.trips.index') }}"
                    class="menu-link {{ request()->routeIs('admin.trips.*') ? 'active' : '' }}">
                    <i class='bx bx-git-repo-forked'></i>
                    <span>Chuyến đi</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.bookings.index') }}"
                    class="menu-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <i class='bx bx-ticket'></i>
                    <span>{{ __('bookings') }}</span>
                </a>
            </li>

            {{-- Quản lý tài nguyên --}}<li class="menu-item">
                <a href="{{ route('admin.vehicles.index') }}"
                    class="menu-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bus"></i>
                    <span>{{ __('vehicles') }}</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.drivers.index') }}"
                    class="menu-link {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
                    <i class='bx bx-user-pin'></i>
                    <span>{{ __('drivers') }}</span>
                </a>
            </li>

            {{-- Quản lý Tuyến & Điểm dừng --}}<li class="menu-item">
                <a href="{{ route('admin.routes.index') }}"
                    class="menu-link {{ request()->routeIs('admin.routes.*') ? 'active' : '' }}">
                    <i class='bx bx-map-alt'></i>
                    <span>{{ __('routes') }}</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.pickup-points.index') }}"
                    class="menu-link {{ request()->routeIs('admin.pickup-points.*') ? 'active' : '' }}">
                    <i class='bx bx-map-pin'></i>
                    <span>Danh mục Điểm đón</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.locations.index') }}"
                    class="menu-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>{{ __('locations') }}</span>
                </a>
            </li>

            {{-- Hệ thống --}}<li class="menu-item">
                <a href="{{ route('admin.support_tickets.index') }}"
                    class="menu-link {{ request()->routeIs('admin.support_tickets.*') ? 'active' : '' }}">
                    <i class='bx bx-support'></i>
                    <span>{{ __('support') }} khách hàng</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.users.index') }}"
                    class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class='bx bx-user'></i>
                    <span>{{ __('users') }}</span>
                </a>
            </li>

            {{-- ===== CÁC MODULE MỚI ===== --}}<li class="menu-item" style="margin-top:10px;">
                <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;">
                    Kinh doanh & Marketing
                </span>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.promotions.index') }}"
                    class="menu-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                    <i class='bx bx-purchase-tag-alt'></i>
                    <span>{{ __('promotions') }}</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.price_rules.index') }}"
                    class="menu-link {{ request()->routeIs('admin.price_rules.*') ? 'active' : '' }}">
                    <i class='bx bx-slider-alt'></i>
                    <span>{{ __('price_rules') }} vé</span>
                </a>
            </li>

            <li class="menu-item" style="margin-top:10px;">
                <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;">
                    Vận hành
                </span>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.schedules.index') }}"
                    class="menu-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                    <i class='bx bx-time-five'></i>
                    <span>{{ __('schedules') }} xe chạy</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.parcels.index') }}"
                    class="menu-link {{ request()->routeIs('admin.parcels.*') ? 'active' : '' }}">
                    <i class='bx bx-package'></i>
                    <span>{{ __('parcels') }} hàng hoá</span>
                </a>
            </li>

            <li class="menu-item" style="margin-top:10px;">
                <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;">
                    Giám sát & Thống kê
                </span>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.daily_reports.index') }}"
                    class="menu-link {{ request()->routeIs('admin.daily_reports.*') ? 'active' : '' }}">
                    <i class='bx bx-bar-chart-alt-2'></i>
                    <span>Báo cáo doanh thu</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.activity_logs.index') }}"
                    class="menu-link {{ request()->routeIs('admin.activity_logs.*') ? 'active' : '' }}">
                    <i class='bx bx-list-check'></i>
                    <span>Lịch sử hành động</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.notifications.index') }}"
                    class="menu-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                    <i class='bx bx-bell'></i>
                    <span>{{ __('notifications') }} hệ thống</span>
                </a>
            </li>

        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="user-avatar">
            <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
        </div>
        <div class="user-info">
            <h4>{{ Auth::user()->name }}</h4>
            <span>{{ ucfirst(Auth::user()->role) }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="margin-left: auto;">
            @csrf
            <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer;"
                title="="{{ __('logout') }}">
                <i class='bx bx-log-out fs-4'></i>
            </button>
        </form>
    </div>
</aside>
