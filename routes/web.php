<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;

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
    
    // 1. Hiển thị form chọn phương thức thanh toán
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    
    // 2. Xử lý tạo đơn và chuyển hướng thanh toán
    Route::post('/process', [PaymentController::class, 'process'])->name('process');
    
    // 3. Callback VNPAY
    Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
    
    // 4. Các route phụ trợ cho Bank Transfer 
    Route::get('/bank-transfer/{order}', [PaymentController::class, 'bankTransfer'])->name('bank_transfer');
    Route::post('/bank-transfer/{id}/upload', [PaymentController::class, 'uploadBankTransfer'])->name('bank_transfer.upload');
    
    // 5. Route dự phòng hiển thị kết quả chung
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
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
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
| ORDER MANAGEMENT ROUTES
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});