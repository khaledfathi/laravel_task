<?php

use App\Models\MessageModel;
use App\Models\User;
use App\repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return response(User::all());
});

Route::get('/message', function (Request $request) {
    return response((new MessageRepository())->all());
});
