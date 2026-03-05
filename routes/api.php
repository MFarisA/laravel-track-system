<?php

use App\Http\Controllers\api\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes (no auth required)
Route::post('/loginApi', [AuthApiController::class, 'loginApi']);

// Protected routes (requires Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logoutApi']);

    Route::get('/user', function (Request $request) {
        return $request->user()->load('roles');
    });
});
