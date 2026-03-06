<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home route - redirect to dashboard if authenticated, otherwise to login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');

// Guest routes (unauthenticated only)
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => Inertia::render('auth/Login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', fn() => Inertia::render('auth/Register'))->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// Auth routes (authenticated only)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/drivers', fn() => Inertia::render('Driver'))->name('drivers');
    Route::get('/live-maps', fn() => Inertia::render('LiveMaps'))->name('live-maps');
    Route::get('/trips', fn() => Inertia::render('Trips'))->name('trips');
    Route::get('/vehicles', fn() => Inertia::render('Vehicles'))->name('vehicles');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
