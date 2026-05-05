<!DOCTYPE html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xe Khách Mạnh Hùng</title>
    <!-- Vite Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    @include('layout.partials.translator')
</head>

<body class="h-full bg-gray-50">
    <div id="app-wrapper" class="w-full h-full overflow-auto">

        <!-- Header + search -->
        @include('layout.customer.blocks.header')
        <!-- Hero Section with Search -->

        {{ -- content -- }}
        @yield('content-main')
        <!-- Contact Section -->

        <!-- Footer -->
        @include('layout.customer.blocks.footer')

    </div>

    <link rel="stylesheet" href="{{ asset('js/customer.js') }}">
    @livewire('chatbox')
    @livewireScripts
</body>
</html>
