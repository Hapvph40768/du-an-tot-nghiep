<?php

use App\Http\Controllers\Admin\SupportTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USERS (ALL ROLES)
|--------------------------------------------------------------------------
*/
<<<<<<< HEAD

Route::middleware(['auth'])->group(function () {

    // Gửi message trong ticket
    Route::post(
        'support_tickets/{support_ticket}/messages',
        [SupportMessageController::class, 'store']
    )->name('support_messages.store');
=======
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::post('/process', [PaymentController::class, 'process'])->name('process');
    Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
    Route::get('/bank-transfer/{order}', [PaymentController::class, 'bankTransfer'])->name('bank_transfer');
    Route::post('/bank-transfer/{id}/upload', [PaymentController::class, 'uploadBankTransfer'])->name('bank_transfer.upload');
    Route::get('/result', [PaymentController::class, 'result'])->name('result');
>>>>>>> 6e485c7 (Initial commit: Hoàn thiện chức năng quản lý tài xế và thanh toán)
});


/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        Route::get('/home', function () {
            return view('customer.home');
        })->name('home');

        //support

         Route::get('/support', [SupportController::class,'index'])
            ->name('support.index');

        Route::post('/support', [SupportController::class,'store'])
            ->name('support.store');

        Route::get('/support/{id}', [SupportController::class,'show'])
            ->name('support.show');

        Route::post('/support/{id}/send', [SupportController::class,'sendMessage'])
            ->name('support.send');

    });


/*
|--------------------------------------------------------------------------
<<<<<<< HEAD
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

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
