<?php

use App\Http\Controllers\SupportTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// form
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

// xử lý
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->get('/home', function () {
    return view('customer.home');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

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

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
    });

    Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.store');
});




/*
|--------------------------------------------------------------------------
| STAFF
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth','role:staff'])->group(function () {

//     Route::get('/staff', function () {
//         // return view('staff.dashboard');
//     });

// });


/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});
