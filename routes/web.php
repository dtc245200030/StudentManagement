<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;

// Mặc định truy cập trang chủ sẽ vào phần Quản lý Lớp học
Route::get('/', [ClassController::class, 'index']);

// Routes cho Quản lý Lớp
Route::resource('classes', ClassController::class);

// Routes cho Quản lý Sinh viên
Route::resource('students', StudentController::class);

// Routes cho Quản lý Điểm số
Route::resource('grades', GradeController::class);
