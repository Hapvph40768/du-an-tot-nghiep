<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportMessageController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminOrderController;


use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\VehiclesController;

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

    // gửi message trong ticket
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

        // Support tickets
        Route::get('/support', [SupportController::class, 'index'])
            ->name('support.index');

        Route::post('/support', [SupportController::class, 'store'])
            ->name('support.store');

        Route::get('/support/{id}', [SupportController::class, 'show'])
            ->name('support.show');

        Route::post('/support/{id}/send', [SupportController::class, 'sendMessage'])
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

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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

        //Tài xế
        Route::resource('drivers', DriverController::class);

        //Địa điểm
        Route::resource('locations', LocationController::class);

        //Phương tiện
        Route::resource('vehicles', VehiclesController::class);
    });

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/




Route::post('/lien-he', [ContactController::class, 'store'])
    ->name('contact.store');

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
