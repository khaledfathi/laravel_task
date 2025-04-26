<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* root  */

Route::get('/', fn() => redirect('message'))->name('root');
/* ---------- */

/* Resource Route */
Route::resource('/message', MessageController::class);
Route::resource('/user', UserController::class);
/* ---------- */

/* Auth Routes */
Route::get ('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get ('/login', [AuthController::class, 'login'])->name('auth.login');
