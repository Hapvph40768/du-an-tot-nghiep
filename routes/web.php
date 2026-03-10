<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\VehicleController;
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




/*
|--------------------------------------------------------------------------
| SEATS
|--------------------------------------------------------------------------
*/
// Nhóm các Route yêu cầu phải Đăng nhập và có quyền truy cập Session
Route::middleware(['web', 'auth'])->prefix('admin')->name('admin.')->group(function () {

    // 1. Quản lý Xe (Resource chuẩn)
    Route::resource('vehicles', VehicleController::class);

    // 2. Quản lý Sơ đồ ghế (Đi theo từng xe cụ thể)
    Route::prefix('vehicles/{vehicle}')->name('vehicles.')->group(function () {

        // Hiển thị sơ đồ ghế
        Route::get('/seats', [SeatController::class, 'index'])->name('seats.index');

        // Khởi tạo tự động số lượng ghế theo loại xe
        Route::post('/generate-seats', [SeatController::class, 'generate'])->name('seats.generate');

        // Xóa sạch sơ đồ ghế để làm lại từ đầu
        Route::delete('/delete-all-seats', [SeatController::class, 'deleteAll'])->name('seats.deleteAll');

        // Thêm lẻ 1 ghế thủ công
        Route::post('/seats/store', [SeatController::class, 'store'])->name('seats.store');
    });

    // 3. Các thao tác trực tiếp trên từng Ghế (Dùng ID của Ghế)

    // LOGIC QUAN TRỌNG: Khóa ghế (Seat Lock)
    // URL sẽ là: /admin/seats/{id}/select
    Route::post('/seats/{seat}/select', [SeatController::class, 'selectSeat'])->name('seats.select');
    // Route để hủy ghế
    Route::post('/seats/{seat}/unlock', [SeatController::class, 'unlockSeat'])->name('admin.seats.unlock');
    // Xóa lẻ 1 ghế
    Route::delete('/seats/{seat}', [SeatController::class, 'destroy'])->name('seats.destroy');
});
Route::get('/', function () {
    return view('welcome');
});
