<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\TripPickupPointController;
use App\Http\Controllers\Admin\PickupPointController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('pickup-points', PickupPointController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('trips', TripController::class);

    Route::post(
        'trips/{trip}/pickup-points',
        [TripPickupPointController::class, 'store']
    )->name('trips.pickup-points.store');
});
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
