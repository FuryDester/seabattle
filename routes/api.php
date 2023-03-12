<?php

use Illuminate\Support\Facades\Route;
use App\Exceptions\InvalidRouteException;
use App\Http\Controllers\AuthController;

Route::fallback(static function () {
    throw new InvalidRouteException();
});

Route::prefix('auth')->group(static function () {
    Route::post('/', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/get-user-info', [AuthController::class, 'getUserInfo'])->name('auth.get-user-info');
});
