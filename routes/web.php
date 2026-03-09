<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'registerForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| PAYMENT SYSTEM (Strictly Mapped)
|--------------------------------------------------------------------------
*/
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::post('/process', [PaymentController::class, 'process'])->name('process');
    Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
    Route::get('/bank-transfer/{order}', [PaymentController::class, 'bankTransfer'])->name('bank_transfer');
    Route::post('/bank-transfer/{id}/upload', [PaymentController::class, 'uploadBankTransfer'])->name('bank_transfer.upload');
    Route::get('/result', [PaymentController::class, 'result'])->name('result');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', function () {
        return view('customer.home');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gọi thẳng vào DashboardController chúng ta đã viết trước đó
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Hoặc nếu bạn muốn link ngắn gọn /admin cũng chạy dashboard:
    Route::get('/', [DashboardController::class, 'index']);

    // ROUTE QUẢN LÝ ĐƠN HÀNG CỦA ADMIN 
    // Resource tự động bao hàm đủ index, create, store, show, edit, update, destroy
    Route::resource('orders', AdminOrderController::class);
    
    // Quản lý Chuyến xe (Đưa Trip vào nhóm Admin để bảo mật)
    Route::resource('trips', TripController::class);
});

/*
|--------------------------------------------------------------------------
| DRIVER ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/tai-xe', [DriverController::class, 'index']);
Route::resource('drivers', DriverController::class);

/*
|--------------------------------------------------------------------------
| ORDER MANAGEMENT ROUTES (Frontend cho khách hàng)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});