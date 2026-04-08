<!DOCTYPE html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Portal - Mạnh Hùng</title>

    <!-- Vite Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .gradient-hero-driver {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        }

        #toast {
            transition: all 0.4s ease;
        }
    </style>
</head>

<body class="h-full bg-gray-50 font-sans">

    <div class="flex h-screen overflow-hidden">

        <!-- ==================== SIDEBAR ==================== -->
        <div class="w-72 bg-white border-r border-gray-200 flex flex-col shadow-xl z-50">

            <!-- Logo -->
            <div class="px-6 py-8 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-amber-500 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-2xl text-gray-800">Mạnh Hùng</span>
                        <p class="text-xs text-amber-600 font-medium -mt-1">DRIVER PORTAL</p>
                    </div>
                </div>
            </div>

            <!-- Driver Info -->
            <div class="px-6 py-5 border-b border-gray-100 bg-amber-50">
                <div class="flex items-center gap-4">
                    @if(Auth::user()->avatar)
                        <img src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->avatar : Storage::url(Auth::user()->avatar) }}" class="w-12 h-12 rounded-2xl object-cover" alt="Avatar">
                    @else
                        <div class="w-12 h-12 bg-amber-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name ?? 'D', 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800 truncate">{{ Auth::user()->name ?? 'Tài xế' }}</p>
                        <p class="text-sm flex items-center gap-2 font-medium text-gray-600">
                            <span class="w-2.5 h-2.5 rounded-full animate-pulse 
                                {{ in_array(Auth::user()->driver?->status, ['active', 'ready', 'available'])
                                    ? 'bg-emerald-500'
                                    : (Auth::user()->driver?->status === 'inactive'
                                        ? 'bg-amber-500'
                                        : 'bg-emerald-500') }}">
                            </span>
                            {{ in_array(Auth::user()->driver?->status, ['inactive']) ? 'Offline' : 'Online' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <nav class="flex-1 px-3 py-6 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('driver.trips.index') }}" onclick="window.location.href='{{ route('driver.trips.index') }}'; return false;"
                            class="{{ request()->routeIs('driver.trips.index', 'driver.trips.show') ? 'bg-amber-50 text-amber-700 border-l-4 border-amber-500' : 'text-gray-600 hover:bg-gray-50' }} 
                                    flex items-center gap-3 px-5 py-4 rounded-2xl font-medium transition-all cursor-pointer">
                            <i class='bx bx-bus text-2xl'></i>
                            <span>Chuyến xe của tôi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('driver.trips.history') }}" onclick="window.location.href='{{ route('driver.trips.history') }}'; return false;"
                            class="{{ request()->routeIs('driver.trips.history') ? 'bg-amber-50 text-amber-700 border-l-4 border-amber-500' : 'text-gray-600 hover:bg-gray-50' }} 
                           flex items-center gap-3 px-5 py-4 rounded-2xl font-medium transition-all cursor-pointer">
                            <i class='bx bx-history text-2xl'></i>
                            <span>Lịch sử chuyến</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('driver.revenue.index') }}" onclick="window.location.href='{{ route('driver.revenue.index') }}'; return false;"
                            class="{{ request()->routeIs('driver.revenue.*') ? 'bg-amber-50 text-amber-700 border-l-4 border-amber-500' : 'text-gray-600 hover:bg-gray-50' }} 
                           flex items-center gap-3 px-5 py-4 rounded-2xl font-medium transition-all cursor-pointer">
                            <i class='bx bx-wallet text-2xl'></i>
                            <span>Doanh thu</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-3 bg-red-50 hover:bg-red-100 text-red-600 font-medium py-4 rounded-2xl transition-all">
                        <i class='bx bx-log-out text-xl'></i>
                        <span>Đăng xuất</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- ==================== MAIN CONTENT ==================== -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Header -->
            <header
                class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between shadow-sm z-40">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()"
                        class="lg:hidden w-10 h-10 flex items-center justify-center text-2xl text-gray-600 hover:bg-gray-100 rounded-xl">
                        <i class='bx bx-menu'></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Driver Portal')</h1>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-auto bg-gray-50 p-6 md:p-8">
                @yield('content-main')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-8 text-center text-xs text-gray-400">
                © 2026 Nhà xe Mạnh Hùng - Driver Portal • Phiên bản 1.0
            </footer>
        </div>
    </div>

    <!-- ==================== TOAST NOTIFICATION ==================== -->
    <div id="toast"
        class="hidden fixed bottom-6 right-6 bg-emerald-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 max-w-sm z-[100]">
        <i class='bx bx-check-circle text-2xl'></i>
        <span id="toast-message" class="font-medium text-sm"></span>
    </div>

    <script>
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            const icon = toast.querySelector('i');

            if (type === 'error') {
                toast.classList.remove('bg-emerald-600');
                toast.classList.add('bg-red-600');
                icon.className = 'bx bx-error-circle text-2xl';
            } else {
                toast.classList.remove('bg-red-600');
                toast.classList.add('bg-emerald-600');
                icon.className = 'bx bx-check-circle text-2xl';
            }

            toastMessage.textContent = message;
            toast.classList.remove('hidden');
            toast.style.transform = 'translateY(0)';

            setTimeout(() => {
                toast.style.transform = 'translateY(100px)';
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 400);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif
            @if (session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
        });

        function toggleSidebar() {
            alert("Chức năng sidebar trên mobile đang được phát triển.");
        }
    </script>

    @livewireScripts
    @stack('scripts')
</body>

</html>
