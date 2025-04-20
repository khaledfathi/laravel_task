<?php

use App\Models\MessageModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return response(User::all());
});

Route::get('/message', function (Request $request) {
    return response(MessageModel::all());
});
