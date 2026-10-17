<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:120,1')->group(function (): void {
    // Mặc định truy cập trang chủ sẽ vào phần Quản lý Lớp học
    Route::get('/', [ClassController::class, 'index']);

    // Routes cho Quản lý Lớp
    Route::resource('classes', ClassController::class)->only(['index', 'store', 'destroy']);

    // Routes cho Quản lý Sinh viên
    Route::resource('students', StudentController::class)->only(['index', 'store', 'destroy']);

    // Routes cho Quản lý Điểm số
    Route::resource('grades', GradeController::class)->only(['index', 'store', 'destroy']);
});
