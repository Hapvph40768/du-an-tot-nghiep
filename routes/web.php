<?php

use App\Http\Controllers\Admin\SupportTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportMessageController;

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

Route::middleware(['auth'])->group(function () {

    // Gửi message trong ticket
    Route::post(
        'support_tickets/{support_ticket}/messages',
        [SupportMessageController::class, 'store']
    )->name('support_messages.store');
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
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        //location
        Route::resource('locations', LocationController::class);

        // Quản lý support tickets

        Route::get('/tickets', [SupportTicketController::class, 'index'])
            ->name('tickets');

        Route::get('/tickets/{id}', [SupportTicketController::class, 'show'])
            ->name('tickets.show');

        Route::post('/tickets/{id}/reply', [SupportTicketController::class, 'reply'])
            ->name('tickets.reply');
    });
