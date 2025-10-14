<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController; 

// -----------------------------
// Public Routes (No login required)
// -----------------------------
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login.post', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -----------------------------
// Protected Routes (Require Authentication)
// -----------------------------
Route::middleware(['auth'])->group(function () {

    // Admin routes
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students');
        Route::post('/admin/students', [StudentController::class, 'store'])->name('admin.students.store');
        Route::put('/admin/students/{id}', [StudentController::class, 'update'])->name('admin.students.update');
        Route::delete('/admin/students/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');

        // Removed ClassesController routes because the controller does not exist
        // You can add them later when you create ClassesController
    });

    // Teacher routes
    Route::middleware(['role:Teacher'])->group(function () {
        Route::get('/teacher/dashboard', [DashboardController::class, 'teacherDashboard'])->name('teacher.dashboard');
        Route::get('/teacher/attendance', [AttendanceController::class, 'index'])->name('teacher.attendance');
        Route::post('/teacher/attendance', [AttendanceController::class, 'store'])->name('teacher.attendance.store');
        Route::get('/teacher/attendance/view', [AttendanceController::class, 'view'])->name('teacher.attendance.view');
    });

    // Student routes
    Route::middleware(['role:Student'])->group(function () {
        Route::get('/student/dashboard', [DashboardController::class, 'studentDashboard'])->name('student.dashboard');
        Route::get('/student/my-attendance', [AttendanceController::class, 'myAttendance'])->name('student.attendance');
        Route::get('/student/attendance', [StudentController::class, 'viewAttendance'])->name('student.viewAttendance');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
