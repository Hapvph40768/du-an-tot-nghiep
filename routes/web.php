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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

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
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // vehicles
        Route::resource('vehicles', VehicleController::class);

        // drivers
        Route::resource('drivers', DriverController::class);

        // locations
        Route::resource('locations', LocationController::class);

        // trips
        Route::resource('trips', TripController::class);

        // bookings
        Route::resource('bookings', BookingController::class)->only([
            'index',
            'store',
            'destroy'
        ]);

        // admin orders
        Route::resource('orders', AdminOrderController::class);

        // support tickets
        Route::prefix('support-tickets')->name('support-tickets.')->group(function () {

            Route::get('/', [SupportTicketController::class, 'index'])
                ->name('index');

            Route::get('/{supportTicket}', [SupportTicketController::class, 'show'])
                ->name('show');

            Route::post('/{supportTicket}/reply', [SupportTicketController::class, 'reply'])
                ->name('reply');

            Route::patch('/{supportTicket}/status', [SupportTicketController::class, 'updateStatus'])
                ->name('update-status');
        });

        // users
        Route::prefix('users')->name('users.')->group(function () {

            Route::get('/', [UserController::class, 'index'])
                ->name('index');

            Route::get('/{user}', [UserController::class, 'show'])
                ->name('show');

            Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])
                ->name('toggle-status');
        });
    });

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::post('/lien-he', [ContactController::class, 'store'])
    ->name('contact.store');