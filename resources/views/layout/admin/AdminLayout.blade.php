<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    @stack('styles')
</head>

<body>

    <div class="admin-wrapper">

        @include('layout.admin.blocks.aside')

        <main class="main-content">

            @include('layout.admin.blocks.header')

            <div class="content-body">
                @if (session('success') || session('error'))
                    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050; width: 350px;">
                        @if (session('success'))
                            <div id="success-toast" class="toast align-items-center text-bg-success border-0 shadow-lg"
                                role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body d-flex align-items-center gap-2">
                                        <i class="bx bx-check-circle fs-4"></i>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div id="error-toast" class="toast align-items-center text-bg-danger border-0 shadow-lg"
                                role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body d-flex align-items-center gap-2">
                                        <i class="bx bx-error-circle fs-4"></i>
                                        <span>{{ session('error') }}</span>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                @yield('content-main')
            </div>

        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successToastEl = document.getElementById('success-toast');
            if (successToastEl) {
                const successToast = new bootstrap.Toast(successToastEl, {
                    autohide: true,
                    delay: 3000 
                });
                successToast.show();
            }

            const errorToastEl = document.getElementById('error-toast');
            if (errorToastEl) {
                const errorToast = new bootstrap.Toast(errorToastEl, {
                    autohide: true,
                    delay: 3000
                });
                errorToast.show();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
