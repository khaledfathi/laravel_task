<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('message');
})->name('root');

Route::resource('/message', MessageController::class);
