<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthenticatedUserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/auth')->name('auth.')->group(function () {

    Route::post('/login', [AuthenticatedUserController::class, 'login']);
    Route::post('/logout', [AuthenticatedUserController::class, 'logout']);
    Route::get('/user', [AuthenticatedUserController::class, 'user']);
});