<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Hub - {{ config('app.name') }}</title>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @livewireStyles
    @stack('styles')
</head>
<body class="bg-[#0b0f11] text-white font-sans antialiased overflow-x-hidden min-h-screen flex" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <aside 
        :class="sidebarOpen ? 'w-80' : 'w-24'"
        class="sticky top-0 h-screen glass-dark border-r border-white/5 transition-all duration-500 ease-apple flex flex-col z-50 overflow-hidden"
    >
        <!-- Logo -->
        <div class="p-8 flex items-center justify-between gap-4 h-24 shrink-0">
            <div class="flex items-center gap-3" x-show="sidebarOpen" x-transition:enter="delay-200 opacity-0" x-transition:enter-end="opacity-100">
                <div class="w-10 h-10 rounded-xl liquid-gradient flex items-center justify-center">
                    <i data-lucide="shield" class="w-6 h-6"></i>
                </div>
                <span class="font-heading font-black tracking-tighter text-xl">COMMAND <span class="text-brand-accent">HUB</span></span>
            </div>
            <button @click="sidebarOpen = !sidebarOpen" class="w-10 h-10 rounded-xl glass hover:bg-white/10 transition-all flex items-center justify-center">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
            <div x-show="sidebarOpen" class="text-[10px] font-black uppercase tracking-widest text-white/20 px-4 mb-4">{{ __('operation_hub') }}</div>
            
            <a href="{{ route('admin.dashboard.index') }}" class="group flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-white/5 transition-all {{ request()->routeIs('admin.dashboard.*') ? 'liquid-gradient' : '' }}">
                <i data-lucide="layout-grid" class="w-5 h-5 {{ request()->routeIs('admin.dashboard.*') ? 'text-white' : 'text-white/40 group-hover:text-brand-accent' }}"></i>
                <span x-show="sidebarOpen" class="font-bold text-sm">Dashboard</span>
            </a>

            <div x-show="sidebarOpen" class="text-[10px] font-black uppercase tracking-widest text-white/20 px-4 mt-8 mb-4">{{ __('transport_fleet') }}</div>
            
            <a href="{{ route('admin.trips.index') }}" class="group flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-white/5 transition-all {{ request()->is('admin/trips*') ? 'bg-white/10 text-brand-accent' : '' }}">
                <i data-lucide="bus" class="w-5 h-5 text-white/40 group-hover:text-brand-accent"></i>
                <span x-show="sidebarOpen" class="font-bold text-sm">{{ __('trips') }}</span>
            </a>

            <a href="{{ route('admin.vehicles.index') }}" class="group flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-white/5 transition-all">
                <i data-lucide="car-front" class="w-5 h-5 text-white/40 group-hover:text-brand-accent"></i>
                <span x-show="sidebarOpen" class="font-bold text-sm">{{ __('vehicles') }}</span>
            </a>

            <div x-show="sidebarOpen" class="text-[10px] font-black uppercase tracking-widest text-white/20 px-4 mt-8 mb-4">{{ __('personnel_customers') }}</div>

            <a href="{{ route('admin.drivers.index') }}" class="group flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-white/5 transition-all {{ request()->is('admin/drivers*') ? 'bg-white/10 text-brand-accent' : '' }}">
                <i data-lucide="user-square-2" class="w-5 h-5 text-white/40 group-hover:text-brand-accent"></i>
                <span x-show="sidebarOpen" class="font-bold text-sm">{{ __('drivers') }}</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-white/5 transition-all {{ request()->is('admin/users*') ? 'bg-white/10 text-brand-accent' : '' }}">
                <i data-lucide="users" class="w-5 h-5 text-white/40 group-hover:text-brand-accent"></i>
                <span x-show="sidebarOpen" class="font-bold text-sm">Hành khách / Staff</span>
            </a>
        </nav>

        <!-- Profile -->
        <div class="p-6 border-t border-white/5">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl glass flex items-center justify-center shrink-0">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <div x-show="sidebarOpen" class="flex-1 overflow-hidden">
                    <p class="text-xs font-black truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-white/30 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" x-show="sidebarOpen">
                    @csrf
                    <button type="submit" class="p-2 hover:bg-red-500/10 rounded-xl transition-colors text-red-500">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- Header -->
        <header class="h-24 px-12 flex items-center justify-between shrink-0 sticky top-0 bg-[#0b0f11]/80 backdrop-blur-md z-40 border-b border-white/5">
            <div class="flex flex-col">
                <h1 class="font-heading font-black text-2xl tracking-tight italic uppercase">@yield('header-title', 'Overview')</h1>
                <p class="text-xs text-white/30 font-bold uppercase tracking-widest">@yield('header-subtitle', 'System Metrics')</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden md:flex glass px-6 py-2.5 rounded-2xl items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-[10px] font-black uppercase tracking-tighter">System Live</span>
                    </div>
                    <div class="h-4 w-px bg-white/10"></div>
                    <p class="text-[10px] font-bold text-white/40">{{ date('d M Y') }}</p>
                </div>
                
                <button class="w-12 h-12 rounded-2xl glass flex items-center justify-center relative hover:bg-white/5 transition-all">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <div class="absolute top-3 right-3 w-2 h-2 rounded-full bg-brand-accent"></div>
                </button>
            </div>
        </header>

        <section class="p-12">
            @yield('content-main')
        </section>
    </main>

    @livewireScripts
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Responsive Sidebar
        window.addEventListener('resize', () => {
            if (window.innerWidth < 1024) sidebarOpen = false;
        });
    </script>
    @stack('scripts')
</body>
</html>