<<<<<<< HEAD
<<<<<<< HEAD
        <aside class="sidebar">
=======
﻿        <aside class="sidebar">
>>>>>>> HaiPhuc2004
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
                        <a href="{{ url('/admin') }}" class="menu-link active">
                            <i class='bx bx-grid-alt'></i>
                            <span>Tổng quan</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <i class='bx bx-ticket'></i>
                            <span>Quản lý đặt vé</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <i class='bx bx-bus'></i>
                            <span>Quản lý xe</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('routes.index') }}" class="menu-link">
                            <i class='bx bx-map-alt'></i>
                            <span>Quản lý tuyến</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <i class='bx bx-user-pin'></i>
                            <span>Quản lý tài xế</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.reviews.index') }}" class="menu-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                            <i class='bx bx-comment-detail'></i>
                            <span>Quản lý đánh giá</span>
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
=======
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
                <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class='bx bx-grid-alt'></i>
                    <span>Tổng quan</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('checkout.index') }}" class="menu-link {{ request()->routeIs('checkout.*') ? 'active' : '' }}">
                    <i class='bx bx-ticket'></i>
                    <span>Quản lý đặt vé (Checkout)</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class='bx bx-bus'></i>
                    <span>Quản lý xe</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class='bx bx-map-alt'></i>
                    <span>Quản lý tuyến</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('drivers.index') }}" class="menu-link {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
                    <i class='bx bx-user-pin'></i>
                    <span>Quản lý tài xế</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('orders.index') }}" class="menu-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <i class='bx bx-cart'></i>
                    <span>Quản lý đơn hàng</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class='bx bx-money'></i>
                    <span>Quản lý giao dịch</span>
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
>>>>>>> 6e485c7 (Initial commit: Hoàn thiện chức năng quản lý tài xế và thanh toán)
