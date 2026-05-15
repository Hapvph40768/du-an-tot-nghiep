<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hệ thống Quản trị') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/premium-admin.css') }}">

    @livewireStyles
    @stack('styles')
</head>

<body>

    <div class="admin-wrapper">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-icon">
                    <i class='bx bx-shield-quarter'></i>
                </div>
                <div class="logo-text">
                    <h2>QUẢN TRỊ</h2>
                    <span>Hệ thống điều hành</span>
                </div>
            </div>

            <nav class="sidebar-menu">
                <ul class="menu-list">

                    {{-- Tổng quan --}}
                    <li class="menu-item" style="margin-top:5px;">
                        <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;background:none!important;">
                            Tổng quan
                        </span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="menu-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                            <i class='bx bx-grid-alt'></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- Đội xe & Hành trình --}}
                    <li class="menu-item" style="margin-top:15px;">
                        <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;background:none!important;">
                            Đội xe & Hành trình
                        </span>
                    </li>
                    <li class="menu-item">
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
                            <span>Đặt vé</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.vehicles.index') }}"
                            class="menu-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-bus" style="font-size: 16px;"></i>
                            <span>Phương tiện</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.drivers.index') }}"
                            class="menu-link {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
                            <i class='bx bx-user-pin'></i>
                            <span>Tài xế</span>
                        </a>
                    </li>

                    {{-- Tuyến & Điểm Dừng --}}
                    <li class="menu-item" style="margin-top:15px;">
                        <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;background:none!important;">
                            Tuyến & Điểm Dừng
                        </span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.routes.index') }}"
                            class="menu-link {{ request()->routeIs('admin.routes.*') ? 'active' : '' }}">
                            <i class='bx bx-map-alt'></i>
                            <span>Tuyến đường</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.pickup-points.index') }}"
                            class="menu-link {{ request()->routeIs('admin.pickup-points.*') ? 'active' : '' }}">
                            <i class='bx bx-map-pin'></i>
                            <span>Điểm đón</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.dropoff-points.index') }}"
                            class="menu-link {{ request()->routeIs('admin.dropoff-points.*') ? 'active' : '' }}">
                            <i class='bx bx-map-pin' style="color: #ff5b24;"></i>
                            <span>Điểm trả</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.locations.index') }}"
                            class="menu-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-location-dot" style="font-size: 16px;"></i>
                            <span>Địa điểm</span>
                        </a>
                    </li>

                    {{-- Kinh Doanh & Marketing --}}
                    <li class="menu-item" style="margin-top:15px;">
                        <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;background:none!important;">
                            Kinh Doanh & Marketing
                        </span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.promotions.index') }}"
                            class="menu-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                            <i class='bx bx-purchase-tag-alt'></i>
                            <span>Khuyến mãi</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.price_rules.index') }}"
                            class="menu-link {{ request()->routeIs('admin.price_rules.*') ? 'active' : '' }}">
                            <i class='bx bx-slider-alt'></i>
                            <span>Quy tắc giá</span>
                        </a>
                    </li>

                    {{-- Vận hành Hàng Hoá --}}
                    <li class="menu-item" style="margin-top:15px;">
                        <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;background:none!important;">
                            Vận hành & Hàng Hoá
                        </span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.schedules.index') }}"
                            class="menu-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                            <i class='bx bx-time-five'></i>
                            <span>Lịch trình</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.parcels.index') }}"
                            class="menu-link {{ request()->routeIs('admin.parcels.*') ? 'active' : '' }}">
                            <i class='bx bx-package'></i>
                            <span>Hàng hoá</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.parcel_prices.index') }}"
                            class="menu-link {{ request()->routeIs('admin.parcel_prices.*') ? 'active' : '' }}">
                            <i class='bx bx-money'></i>
                            <span>Bảng giá ký gửi</span>
                        </a>
                    </li>

                    {{-- Giám sát & Thống kê --}}
                    <li class="menu-item" style="margin-top:15px;">
                        <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;background:none!important;">
                            Giám sát & Thống kê
                        </span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.statistics.index') }}"
                            class="menu-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                            <i class='bx bx-pie-chart-alt-2'></i>
                            <span>Thống kê chi tiết</span>
                        </a>
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

                    {{-- Hệ thống & Người dùng --}}
                    <li class="menu-item" style="margin-top:15px;">
                        <span class="menu-link" style="font-size:10px;text-transform:uppercase;color:#aaa;pointer-events:none;padding-bottom:2px;background:none!important;">
                            Hệ thống & Người dùng
                        </span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.support_tickets.index') }}"
                            class="menu-link {{ request()->routeIs('admin.support_tickets.*') ? 'active' : '' }}">
                            <i class='bx bx-support'></i>
                            <span>Hỗ trợ khách hàng</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class='bx bx-user'></i>
                            <span>Người dùng / Staff</span>
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="sidebar-footer">
                <div class="user-avatar">
                    <span>{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                </div>
                <div class="user-info">
                    <h4>{{ Auth::user()->name ?? 'Admin' }}</h4>
                    <span>{{ ucfirst(Auth::user()->role ?? 'Quản trị viên') }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin-left: auto;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer;" title="Đăng xuất">
                        <i class='bx bx-log-out fs-4'></i>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Header -->
            <header class="top-header">
                <div class="header-title">
                    <h1>@yield('header-title', 'Tổng Quan Hệ Thống')</h1>
                    <p>@yield('header-subtitle', 'Theo dõi và quản lý các hoạt động')</p>
                </div>

                <div class="header-actions">
                    <div class="search-box d-none d-md-block">
                        <i class='bx bx-search'></i>
                        <input type="text" placeholder="Tìm kiếm...">
                    </div>

                    @php
                        $unreadCount = Auth::user()->unreadNotifications->count();
                        $latestNotifs = Auth::user()->notifications()->latest()->take(5)->get();
                    @endphp
                    <div class="dropdown notif-dropdown">
                        <button class="notif-btn position-relative" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background:none;border:none;cursor:pointer;">
                            <i class='bx bx-bell'></i>
                            @if($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;margin-top:5px;margin-left:-5px;">
                                    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                                </span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-0" style="min-width:340px;max-width:380px;" aria-labelledby="notifDropdown">
                            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
                                <span class="fw-bold" style="font-size:14px;"><i class='bx bx-bell me-1' style="color:#6366f1;"></i>Thông báo</span>
                                @if($unreadCount > 0)
                                <form method="POST" action="{{ route('admin.notifications.readAll') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-primary" style="font-size:12px;">Đọc hết</button>
                                </form>
                                @endif
                            </div>
                            <div style="max-height:360px;overflow-y:auto;">
                                @forelse($latestNotifs as $notif)
                                    @php
                                        $ndata = $notif->data;
                                        $nIcon = $ndata['icon'] ?? 'bx bx-bell';
                                        $nTitle = $ndata['title'] ?? 'Thông báo';
                                        $nMsg = $ndata['message'] ?? '';
                                        $nUrl = $ndata['url'] ?? route('admin.notifications.index');
                                        $nUnread = is_null($notif->read_at);
                                        if (str_contains($notif->type, 'SupportTicket')) $nColor = '#10b981';
                                        elseif (str_contains($notif->type, 'Parcel')) $nColor = '#3b82f6';
                                        else $nColor = '#6366f1';
                                    @endphp
                                    <a href="{{ $nUrl }}" class="d-flex align-items-start gap-3 px-3 py-3 text-decoration-none text-dark {{ $nUnread ? 'notif-dd-unread' : '' }}"
                                       onclick="markRead('{{ $notif->id }}')">
                                        <div style="width:36px;height:36px;background:{{ $nColor }};border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="{{ $nIcon }} text-white" style="font-size:16px;"></i>
                                        </div>
                                        <div class="flex-grow-1" style="min-width:0;">
                                            <div class="fw-semibold" style="font-size:13px;">
                                                {{ $nTitle }}
                                                @if($nUnread)<span class="badge bg-danger rounded-pill ms-1" style="font-size:8px;vertical-align:middle;">Mới</span>@endif
                                            </div>
                                            <div class="text-muted text-truncate" style="font-size:12px;">{{ $nMsg }}</div>
                                            <div class="text-muted" style="font-size:11px;">{{ $notif->created_at->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                    <hr class="m-0" style="opacity:0.07;">
                                @empty
                                    <div class="text-center py-4 text-muted" style="font-size:13px;">
                                        <i class='bx bx-bell-off d-block mb-1' style="font-size:28px;"></i>Không có thông báo nào
                                    </div>
                                @endforelse
                            </div>
                            <div class="px-3 py-2 border-top text-center">
                                <a href="{{ route('admin.notifications.index') }}" class="text-primary" style="font-size:12px;text-decoration:none;">
                                    Xem tất cả thông báo <i class='bx bx-chevron-right'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>{{-- end header-actions --}}
            </header>

            <!-- Page Content -->
            <div class="content-body">
                @yield('content-main')
            </div>

        </main>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    .notif-dd-unread { background: rgba(99,102,241,.06); }
    .notif-dd-unread:hover { background: rgba(99,102,241,.12) !important; }
    </style>

    <script>
    function markRead(id) {
        if (!id) return;
        fetch('/admin/notifications/' + id + '/read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });
    }
    </script>

    @livewireScripts
    @stack('scripts')
</body>

</html>