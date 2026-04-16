<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;




//gialam-feature/user-crud

// LIST
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// CREATE (ĐẶT TRÊN)
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');


// EDIT
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');


// UPDATE
Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');

// DELETE
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

// SOFT DELETE
Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');



// VIEW DETAIL (ĐẶT DƯỚI)
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/', function () {
    return view('welcome');
});

// Điều hướng login
Route::get('login', [UserController::class, 'login'])->name('login');
// Xử lý đăng nhập (Trỏ về AuthController theo đúng hàm bạn gửi)
Route::post('login', [AuthController::class, 'login'])->name('user.authUser');

// Xử lý đăng ký (Trỏ về AuthController hàm register)
Route::post('register', [AuthController::class, 'register'])->name('register');

// Đăng xuất (Lưu ý: Bạn cần thêm hàm logout vào AuthController để không bị lỗi)
Route::post('/logout', [UserController::class, 'logout'])->name('logout');