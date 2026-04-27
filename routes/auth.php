<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    // SADE LOGIN
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {

    // SADE LOGOUT
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});