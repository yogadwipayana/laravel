<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wbs', function () {
    return view('wbs');
});

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout Route (Authenticated only)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes (Protected with authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/admin/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/admin/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/admin/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/admin/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/admin/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/admin/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::patch('/admin/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
});
