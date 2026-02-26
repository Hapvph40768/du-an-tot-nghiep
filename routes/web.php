<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ReviewController;

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

Route::middleware(['auth','role:customer'])->get('/home', function () {
    return view('customer.home'); 
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

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
//middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn () => view('admin.dashboard'));
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', fn () => view('staff.dashboard'));
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', fn () => view('customer.home'));
});

Route::resource('routes', RouteController::class);

// Admin routes (prefix and name)
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    Route::resource('reviews', ReviewController::class);
});

// Public/customer routes for reviews
// GET /reviews - redirect based on user role so a GET doesn't return 405
Route::get('/reviews', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.reviews.index');
    }
    if (auth()->check() && auth()->user()->role === 'customer') {
        return redirect('/home');
    }

    return redirect()->route('login');
})->name('reviews.redirect');

// POST /reviews - customers can submit reviews
Route::middleware(['auth','role:customer'])->post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
