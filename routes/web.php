<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('message');
})->name('root');

Route::resource('/message', MessageController::class);
Route::resource('/user' , UserController::class);
