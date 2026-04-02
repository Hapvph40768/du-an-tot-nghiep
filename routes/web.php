<?php

use Illuminate\Support\Facades\Route;

// MIDDLEWARES
use App\Http\Middleware\CheckCustomerRole;
use App\Http\Middleware\CheckAdminRole;

// AUTH CONTROLLER
use App\Http\Controllers\AuthController;

// CUSTOMER & PUBLIC CONTROLLERS
use App\Http\Controllers\Customer\HomeController as CustomerHomeController;
use App\Http\Controllers\Customer\TripController as CustomerTripController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\ReviewController as CustomerReviewController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\PickupPointController;
use App\Http\Controllers\Admin\TripController as AdminTripController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\SeatLockController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\SupportTicketController as AdminSupportController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\TripPickupPointController;
use App\Http\Controllers\Customer\SupportTicketController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [CustomerHomeController::class, 'index'])->name('customer.home');
Route::get('/trips/search', [CustomerTripController::class, 'search'])->name('customer.trips.search');
Route::get('/trips/{trip}', [CustomerTripController::class, 'show'])->name('customer.trips.show');

/*
|--------------------------------------------------------------------------
| 2. AUTH ROUTES (Đăng ký, Đăng nhập, Đăng xuất)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| 3. CUSTOMER ROUTES (Auth & Role Customer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckCustomerRole::class])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [CustomerProfileController::class, 'edit'])->name('customer.profile.edit');
        Route::put('/', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
    });

    Route::prefix('bookings')->group(function () {
        Route::get('/', [CustomerBookingController::class, 'index'])->name('customer.bookings.index');
        Route::post('/', [CustomerBookingController::class, 'store'])->name('customer.bookings.store');
        Route::get('/{booking}', [CustomerBookingController::class, 'show'])->name('customer.bookings.show');
    });

    Route::prefix('payment')->group(function () {
        Route::get('/checkout/{booking}', [CustomerPaymentController::class, 'checkout'])->name('customer.payment.checkout');
        Route::post('/process/{booking}', [CustomerPaymentController::class, 'process'])->name('customer.payment.process');
        Route::get('/vnpay/return', [CustomerPaymentController::class, 'vnpayReturn'])->name('customer.payment.vnpayReturn');
        Route::get('/momo/return', [CustomerPaymentController::class, 'momoReturn'])->name('customer.payment.momoReturn');
    });

    Route::post('/reviews/{booking}', [CustomerReviewController::class, 'store'])->name('customer.reviews.store');

    Route::prefix('support')->group(function () {
        Route::get('/', [SupportTicketController::class, 'index'])->name('customer.support.index');
        Route::get('/create', [SupportTicketController::class, 'create'])->name('customer.support.create');
        Route::post('/', [SupportTicketController::class, 'store'])->name('customer.support.store');
        Route::get('/{supportTicket}', [SupportTicketController::class, 'show'])->name('customer.support.show');
    });
});

/*
|--------------------------------------------------------------------------
| 4. ADMIN ROUTES (Auth & Role Admin/Staff)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', CheckAdminRole::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // --- QUẢN LÝ DANH MỤC GỐC (KHO DỮ LIỆU) ---
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('seats', SeatController::class);
    
    // Quản lý tổng kho các bến xe/điểm dừng
    Route::resource('pickup-points', PickupPointController::class);

    // --- VẬN HÀNH CHUYẾN XE (TRIPS) ---
    // Đặt Resource lên trước để tránh xung đột prefix
    Route::resource('trips', AdminTripController::class);

    // Group quản lý điểm đón RIÊNG cho từng chuyến
    Route::prefix('trips/{trip}/pickup-points')->name('trips.pickup_points.')->group(function () {
        Route::get('/', [TripPickupPointController::class, 'index'])->name('index');         // Trang tích chọn (Sync)
        Route::get('/create', [TripPickupPointController::class, 'create'])->name('create');   // Trang tạo mới nhanh
        Route::post('/store-new', [TripPickupPointController::class, 'storeNew'])->name('store_new'); // Xử lý tạo mới
        Route::post('/sync', [TripPickupPointController::class, 'store'])->name('store');     // Xử lý lưu checkbox
        Route::delete('/{pickup_point}', [TripPickupPointController::class, 'destroy'])->name('destroy'); // Gỡ điểm khỏi chuyến
    });

    // --- ĐẶT VÉ & KHÁCH HÀNG ---
    Route::resource('bookings', AdminBookingController::class);
    Route::resource('tickets', TicketController::class);
    
    // Khóa ghế
    Route::post('seat-locks/clear-expired', [SeatLockController::class, 'clearExpired'])->name('seat_locks.clearExpired');
    Route::resource('seat-locks', SeatLockController::class);

    // --- TÀI CHÍNH ---
    Route::resource('payments', AdminPaymentController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [TransactionController::class, 'showTransaction'])->name('transactions.show');
    Route::get('orders', [TransactionController::class, 'orders'])->name('orders.index');
    Route::put('orders/{order}/status', [TransactionController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    // --- CSKH & SUPPORT ---
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);
    
    // Quản lý Support Ticket
    Route::prefix('support-tickets')->name('support_tickets.')->group(function () {
        Route::get('/', [AdminSupportController::class, 'index'])->name('index');
        Route::get('/{supportTicket}', [AdminSupportController::class, 'show'])->name('show');
        Route::post('/{supportTicket}/reply', [AdminSupportController::class, 'reply'])->name('reply');
        Route::patch('/{supportTicket}/close', [AdminSupportController::class, 'close'])->name('close');
    });
});

/*
|--------------------------------------------------------------------------
| 5. STAFF ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;
use App\Http\Controllers\Staff\BookingController as StaffBooking;
use App\Http\Controllers\Staff\TripController as StaffTrip;
use App\Http\Controllers\Staff\CheckInController as StaffCheckIn;
use App\Http\Controllers\Staff\ParkingController as StaffParking;
use App\Http\Middleware\CheckStaffRole;

Route::prefix('staff')->name('staff.')->middleware(['auth', CheckStaffRole::class])->group(function () {
    Route::get('/', [StaffDashboard::class, 'index'])->name('dashboard');

    // Quản lý Booking
    Route::get('/bookings', [StaffBooking::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [StaffBooking::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [StaffBooking::class, 'store'])->name('bookings.store');
    Route::get('/api/trips/{trip}/data', [StaffBooking::class, 'getTripData'])->name('api.trips.data');
    Route::get('/bookings/{booking}', [StaffBooking::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/confirm', [StaffBooking::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/cancel', [StaffBooking::class, 'cancel'])->name('bookings.cancel');

    // Chuyến xe & Sơ đồ ghế
    Route::get('/trips', [StaffTrip::class, 'index'])->name('trips.index');
    Route::get('/trips/{trip}', [StaffTrip::class, 'show'])->name('trips.show');

    // Check-in hành khách
    Route::get('/checkin', [StaffCheckIn::class, 'index'])->name('checkin.index');
    Route::post('/checkin/{ticket}', [StaffCheckIn::class, 'process'])->name('checkin.process');
    Route::post('/checkin/{ticket}/noshow', [StaffCheckIn::class, 'noShow'])->name('checkin.noshow');
    Route::post('/checkin/{ticket}/reset', [StaffCheckIn::class, 'resetStatus'])->name('checkin.reset');

    // Hồ sơ cá nhân
    Route::get('/profile', [\App\Http\Controllers\Staff\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\Staff\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\Staff\ProfileController::class, 'updatePassword'])->name('profile.password');

    // Quản lý bãi xe
    Route::get('/parking', [StaffParking::class, 'index'])->name('parking.index');
    Route::post('/parking/slots/{slot}/check-in', [StaffParking::class, 'checkIn'])->name('parking.checkin');
    Route::post('/parking/slots/{slot}/check-out', [StaffParking::class, 'checkOut'])->name('parking.checkout');
});

Route::get('/fix-staff', function() {
    $user = \App\Models\User::where('name', 'nhanvienA')->first() ?? \App\Models\User::first();
    if ($user) {
        $user->role = 'staff';
        $user->save();
        return "User '{$user->name}' updated to staff! Please refresh and look for 'Trang nhân viên' button.";
    }
    return "No users found.";
});