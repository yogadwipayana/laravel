<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/test', [UserController::class, 'test']);

// Route::get('/register', [UserController::class, 'index']);
// Route::post('/register', [UserController::class, 'create']);

// Route::get('/users/{id}', [UserController::class, 'index'])->name('users.form');
// Route::post('/users/{id}', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Route::get('/dashboard', [UserController::class, 'show']);

// Route::get('/guest', [GuestController::class, 'index']);
// Route::post('/guest', [GuestController::class, 'create']);
// Route::get('/guest/list', [GuestController::class, 'show']);

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/create', [ProdukController::class, 'create']);
Route::post('/produk/store', [ProdukController::class, 'store']);
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
Route::put('/produk/update/{id}', [ProdukController::class, 'updateProduk']);
Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy']);