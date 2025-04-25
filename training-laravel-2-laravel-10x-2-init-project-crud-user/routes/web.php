<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TourController; // Đảm bảo import TourController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Các route liên quan đến xác thực (đã có ở các phản hồi trước)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authUser'])->name('authUser');
Route::get('/register', [AuthController::class, 'createUser'])->name('register');
Route::post('/register', [AuthController::class, 'postUser'])->name('postUser');
Route::get('/logout', [AuthController::class, 'signOut'])->name('logout');

// Các route được bảo vệ bởi middleware 'auth' (đã có ở các phản hồi trước)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
});

// Các route cho chức năng quản trị (yêu cầu quyền admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/tours', [AdminController::class, 'listTour'])->name('admin.tours.list');

    // Route quản lý người dùng (đã có ở các phản hồi trước)
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/read', [UserController::class, 'readUser'])->name('admin.users.read');
        Route::get('/delete', [UserController::class, 'deleteUser'])->name('admin.users.delete');
        Route::get('/update', [UserController::class, 'updateUser'])->name('admin.users.update');
        Route::post('/update', [UserController::class, 'postUpdateUser'])->name('admin.users.postUpdate');
    });
});

// Route hiển thị chi tiết tour (nếu bạn có trang chi tiết tour)
// Route::get('/tours/{tour}', [TourController::class, 'show'])->name('tours.show');

// Route mặc định để chuyển đến trang danh sách tour khi nhấn vào "Tours" ở header
Route::get('/tours', [AdminController::class, 'listTour'])->name('tours.index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
