<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get(
        '/listUsers',
        [UserController::class, 'getAllUsers']
    )->name('getAllUsers');
});

Route::group(['middleware' => ['single.session']], function() {
    Route::post(
        '/login',
        [AuthController::class, 'login_user']
    )->name('login');    
});

