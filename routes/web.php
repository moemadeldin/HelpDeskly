<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordRecoveryController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

foreach (['admin', 'agent', 'auth', 'customer'] as $file) {
    require __DIR__."/{$file}.php";
}
Route::middleware('guest')->group(function (): void {

    Route::controller(AuthController::class)->group(function (): void {
        Route::get('register', 'registerForm')->name('register');
        Route::post('register', 'register');
        Route::get('login', 'loginForm')->name('login.get');
        Route::post('login', 'login')->name('login.post')->middleware('throttle:4,1');
    });
    Route::controller(PasswordRecoveryController::class)->group(function (): void {
        Route::get('/forgot-password', 'forgotPasswordForm')->name('forgot-password.get');
        Route::post('/forgot-password', 'forgotPassword')->name('forgot-password.post');
        Route::get('/reset-password', 'resetPasswordForm')->name('reset-password.get');
        Route::post('/reset-password', 'resetPassword')->name('reset-password.post');
    });

});

Route::get('/home', function (): View {
    return view('pages.home');
})->name('home');
