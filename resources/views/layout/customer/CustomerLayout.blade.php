<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="view-transition" content="same-origin">
    <title>{{ $title ?? 'Nhà xe Mạnh Hùng - Trải nghiệm dịch vụ 5 sao' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('layout.partials.translator')
    
    @livewireStyles
    @stack('styles')
</head>

<body class="bg-[#0a0a0a] text-white font-sans antialiased overflow-x-hidden min-h-screen flex flex-col" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    
    <!-- Atmosphere Background -->
    <div class="fixed inset-0 -z-10 pointer-events-none bg-[#0a0a0a]">
        <div class="absolute top-[10%] left-[5%] w-[40%] h-[40%] rounded-full bg-[#ff5b24]/10 blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[10%] right-[5%] w-[30%] h-[30%] rounded-full bg-[#ffb800]/5 blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <!-- Header -->
    @include('layout.customer.blocks.header')

    <!-- Main Content -->
    <main class="flex-grow relative z-10 w-full">
        @yield('content-main')
    </main>

    <!-- Footer -->
    @include('layout.customer.blocks.footer')

    @livewire('chatbox')
    @livewireScripts
    
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
