<!DOCTYPE html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xe Khách Mạnh Hùng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/_sdk/element_sdk.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxchat.css') }}">
</head>

<a href="{{ route('customer.support.index') }}" class="support-float">
    
    <svg xmlns="http://www.w3.org/2000/svg"
         width="28"
         height="28"
         fill="white"
         viewBox="0 0 16 16">

        <path d="M8 0C3.58 0 0 3.134 0 7c0 2.084 1.06 3.954 2.75 5.239
        L2 16l3.101-1.588A8.9 8.9 0 0 0 8 15c4.42 0 8-3.134
        8-7s-3.58-8-8-8z"/>

    </svg>

</a>

<body class="h-full bg-gray-50">
    <div id="app-wrapper" class="w-full h-full overflow-auto">

        <!-- Header + search -->
        @include('layout.customer.blocks.header')
        <!-- Hero Section with Search -->

        {{-- content --}}
        @yield('content-main')
        <!-- Contact Section -->

        <!-- Footer -->
        @include('layout.customer.blocks.footer')

    </div>

    <link rel="stylesheet" href="{{ asset('js/customer.js') }}">

</body>

</html>
