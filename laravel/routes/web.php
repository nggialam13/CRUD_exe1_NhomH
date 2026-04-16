<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Các route công khai
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('user.authUser');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
// 
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

// Nhóm route chỉ dành cho admin (role = 1)
Route::middleware(['auth', 'role:1'])->group(function () {
    
    
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
});

// Route xem chi tiết user có thể cho phép cả user đăng nhập xem (không bắt buộc admin)
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware('auth');
