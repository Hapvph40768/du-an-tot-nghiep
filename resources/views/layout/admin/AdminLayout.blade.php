<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

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
        <style>
            .table-bordered> :not(caption)>*>* {
                border: 1px solid #000 !important;
            }
        </style>
        <style>
            /* Header gradient */
            .custom-table thead {
                background: linear-gradient(45deg, #4e73df, #1cc88a);
                color: white;
            }

            /* Viền mềm hơn */
            .custom-table td,
            .custom-table th {
                border: 1px solid #dee2e6 !important;
            }

            /* Hover đẹp */
            .custom-table tbody tr:hover {
                background-color: #f8f9fc;
                transition: 0.2s ease-in-out;
            }

            /* Badge style */
            .badge-date {
                background-color: #36b9cc;
                color: white;
            }

            .badge-time {
                background-color: #858796;
                color: white;
            }

            /* Giá tiền */
            .price-text {
                color: #1cc88a;
                font-weight: bold;
            }

            /* Card đẹp hơn */
            .card-custom {
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }
        </style>
        <style>
            /* Khung ô input đẹp hơn */
            .form-control,
            .form-select {
                border: 2px solid #ced4da !important;
                border-radius: 8px;
                padding: 8px 12px;
                transition: all 0.2s ease-in-out;
            }

            /* Khi click vào */
            .form-control:focus,
            .form-select:focus {
                border-color: #4e73df !important;
                box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15);
            }

            /* Nút đẹp hơn */
            .btn-success {
                border-radius: 8px;
                padding: 8px 18px;
            }
        </style>
    </div>
</body>

</html>