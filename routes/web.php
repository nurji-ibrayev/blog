<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AuthController;

Route::get('/', 'App\Http\Controllers\NavigationController@home');

Route::get('/reviews', 'App\Http\Controllers\NavigationController@reviews');
Route::post('/reviews/review_check', 'App\Http\Controllers\NavigationController@review_check');

Route::get('/about', 'App\Http\Controllers\NavigationController@about');
Route::get('/contact', 'App\Http\Controllers\NavigationController@contact');

Route::middleware('guest')->group(function()
{
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [AuthController::class, 'login'])->name('login_process');

    Route::get('/forgot', [AuthController::class, 'showForgotForm'])->name('forgot');
    Route::post('/forgot_process', [AuthController::class, 'forgot'])->name('forgot_process');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [AuthController::class, 'register'])->name('register_process');
});

Route::middleware('auth')->group(function()
{
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
