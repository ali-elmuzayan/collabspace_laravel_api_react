<?php

use App\Http\Controllers\Api\V1\Auth\AuthenticatedUserController;
use App\Http\Controllers\Api\V1\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/**
 * Authentication Routes
 */
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('/login', [AuthenticatedUserController::class, 'store'])->name('login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/user', [AuthenticatedUserController::class, 'show'])->name('user.show');
        Route::post('/logout', [AuthenticatedUserController::class, 'destroy'])->name('logout');
    });
});
