<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthenticatedUserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





/**
 * 
 */



/**
 * Authentication Routes 
 */
Route::prefix('v1/auth')->name('auth.')->group(function () {

    Route::post('/login', [AuthenticatedUserController::class, 'store'])->name('login');
    Route::post('/logout', [AuthenticatedUserController::class, 'destroy'])->name('logout');
    Route::get('/user', [AuthenticatedUserController::class, 'show'])->name('user');
});