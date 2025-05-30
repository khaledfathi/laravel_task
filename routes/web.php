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
Route::resource('/user', UserController::class)
    ->except(['index','create','store'])
    ->middleware('auth');
/* ---------- */


/* User Profile */
route::get('/user-profile', [UserController::class, 'userProfile'])->name('user.profile');
route::get('/user-profile/edit', [UserController::class, 'userEditProfile'])->name('user.edit-profile');

/* Auth Routes */
Route::middleware(['guest'])->group(function (){
    Route::get ('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get ('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth.auth');
    Route::post('/store-new-user', [AuthController::class, 'storeNewUser'])->name('auth.new-user');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
/* ---------- */

/* Admin Panal */
Route::get('/admin-panel', [UserController::class, 'adminPanel'])
    ->middleware('auth')
    ->name('admin-panel');
