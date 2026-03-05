<!DOCTYPE html>
<html lang="vi">
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js']);
</head>
<body>
...
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        @include('layout.admin.blocks.aside')
        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Header -->
            @include('layout.admin.blocks.header')
            <!-- Page Content -->
            <div class="content-body">
                @yield('content-main')
            </div>
        </main>
    </div>
</body>
</html>
