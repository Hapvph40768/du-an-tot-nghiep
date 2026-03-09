<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// Login/Register forms
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

// Authentication processing
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
| AUTHENTICATED USERS (ALL ROLES)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Any authenticated user routes can go here
});

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', function () {
        return view('customer.home');
    })->name('customer.home');
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin resources
    Route::resource('reviews', ReviewController::class);
    Route::resource('routes', RouteController::class);
});

/*
|--------------------------------------------------------------------------
| PUBLIC/CUSTOMER REVIEW ROUTES
|--------------------------------------------------------------------------
*/

// Redirect reviews based on user role
Route::get('/reviews', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.reviews.index');
    }
    if (Auth::check() && Auth::user()->role === 'customer') {
        return redirect('/home');
    }
    return redirect()->route('login');
})->name('reviews.redirect');

// Customers can submit reviews
Route::middleware(['auth', 'role:customer'])->post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
