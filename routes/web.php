<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportMessageController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TripController;

use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminOrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // gửi message trong ticket
    Route::post(
        'support_tickets/{support_ticket}/messages',
        [SupportMessageController::class, 'store']
    )->name('support_messages.store');

    // orders frontend
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
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

        // support
        Route::get('/support', [SupportController::class, 'index'])->name('support.index');
        Route::post('/support', [SupportController::class, 'store'])->name('support.store');
        Route::get('/support/{id}', [SupportController::class, 'show'])->name('support.show');
        Route::post('/support/{id}/send', [SupportController::class, 'sendMessage'])->name('support.send');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // dashboard
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // vehicles
        Route::resource('vehicles', VehicleController::class);

        // bookings
        Route::resource('bookings', BookingController::class)->only([
            'index',
            'store',
            'destroy'
        ]);

        // locations
        Route::resource('locations', LocationController::class);

        // drivers
        Route::resource('drivers', DriverController::class);

        // trips
        Route::resource('trips', TripController::class);

        // admin orders
        Route::resource('orders', AdminOrderController::class);

        // support tickets
        Route::get('/tickets', [SupportTicketController::class, 'index'])->name('tickets');
        Route::get('/tickets/{id}', [SupportTicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{id}/reply', [SupportTicketController::class, 'reply'])->name('tickets.reply');
});