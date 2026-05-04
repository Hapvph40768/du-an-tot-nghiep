<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nhân Viên - {{ config('app.name') }}}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}}<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col p-6 lg:p-8">
    <header class="w-full lg:max-w-6xl mx-auto text-sm mb-6 pb-4 border-b border-[#e3e3e0] dark:border-[#262626]">
        <nav class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-6">
                <div class="font-bold text-lg text-blue-600 dark:text-blue-400">STAFF PORTAL</div>
                <div class="hidden lg:flex gap-4">
                    <a href="{{ route('staff.dashboard') }}" class="hover:text-blue-600 transition-colors {{ request()->routeIs('staff.dashboard') ? 'font-semibold border-b-2 border-blue-600' : '' }}">{{{ __('overview') }}</a>
                    <a href="{{ route('staff.bookings.index') }}" class="hover:text-blue-600 transition-colors {{ request()->routeIs('staff.bookings.*') ? 'font-semibold border-b-2 border-blue-600' : '' }}">{{{ __('bookings') }}</a>
                    <a href="{{ route('staff.trips.index') }}" class="hover:text-blue-600 transition-colors {{ request()->routeIs('staff.trips.*') ? 'font-semibold border-b-2 border-blue-600' : '' }}">{{{ __('trips') }}</a>
                    <a href="{{ route('staff.checkin.index') }}" class="hover:text-blue-600 transition-colors {{ request()->routeIs('staff.checkin.index') ? 'font-semibold border-b-2 border-blue-600' : '' }}">Check-in</a>
                    <a href="{{ route('staff.parking.index') }}" class="hover:text-blue-600 transition-colors {{ request()->routeIs('staff.parking.*') ? 'font-semibold border-b-2 border-blue-600' : '' }}">Bãi xe</a>
                </div>
            </div>
            <div class="flex items-center gap-4 text-right">
                <a href="{{ route('staff.profile.index') }}" class="flex flex-col group">
                    <span class="text-[10px] opacity-40 font-bold uppercase leading-none group-hover:text-blue-600 transition-all">Nhân viên trực ca</span>
                    <span class="text-xs font-bold group-hover:text-blue-600 transition-all border-b border-transparent group-hover:border-blue-600">{{ Auth::user()->name }}}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="text-red-500 hover:text-red-600 text-xs font-medium">{{{ __('logout') }}</button>
                </form>
            </div>
        </nav>
    </header>

    @if (session('success'))
        <div class="lg:max-w-6xl mx-auto w-full mb-4 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
            {{ session('success') }}}</div>
    @endif
    @if (session('error'))
        <div class="lg:max-w-6xl mx-auto w-full mb-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
            {{ session('error') }}}</div>
    @endif

    <main class="w-full lg:max-w-6xl mx-auto grow">
        @yield('content')
    </main>

    <footer class="w-full lg:max-w-6xl mx-auto text-center py-8 text-xs opacity-40">
        &copy; {{ date('Y') }}} {{ config('app.name') }}} - Staff Operations System
    </footer>
</body>
</html>
