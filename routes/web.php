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

    // CRUD Cơ bản
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('drivers', DriverController::class)->except(['show']);
    Route::resource('vehicles', VehicleController::class)->except(['show']);
    Route::resource('seats', SeatController::class)->except(['show']);
    Route::resource('pickup-points', PickupPointController::class)->except(['show']);

    // Vận hành
    Route::resource('trips', AdminTripController::class)->except(['show']);
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'update']);
    Route::resource('tickets', TicketController::class)->only(['index', 'show', 'update']);

    // Khóa ghế
    Route::post('seat-locks/clear-expired', [SeatLockController::class, 'clearExpired'])->name('seat_locks.clearExpired');
    Route::resource('seat-locks', SeatLockController::class)->only(['index', 'create', 'store', 'destroy']);

    // Tài chính
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'update']);
    Route::resource('invoices', InvoiceController::class)->except(['destroy']);
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [TransactionController::class, 'showTransaction'])->name('transactions.show');
    Route::get('orders', [TransactionController::class, 'orders'])->name('orders.index');
    Route::put('orders/{order}/status', [TransactionController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    // CSKH & Support
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);
    // Quản lý Ticket (Dùng danh sách cụ thể thay vì resource để kiểm soát tên)
    Route::get('support-tickets', [AdminSupportController::class, 'index'])->name('support_tickets.index');
    Route::get('support-tickets/{supportTicket}', [AdminSupportController::class, 'show'])->name('support_tickets.show');
    Route::post('support-tickets/{supportTicket}/reply', [AdminSupportController::class, 'reply'])->name('support_tickets.reply');
    Route::patch('support-tickets/{supportTicket}/close', [AdminSupportController::class, 'close'])->name('support_tickets.close');
});
