<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('auth/google', 'redirect');
    Route::get('auth/google/callback', 'authenticate');
});
