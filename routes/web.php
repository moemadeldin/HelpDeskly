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
    Route::get('register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'loginForm'])->name('login.get');
    Route::post('login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:4,1');

    Route::get('/forgot-password', [PasswordRecoveryController::class, 'forgotPasswordForm'])->name('forgot-password.get');
    Route::post('/forgot-password', [PasswordRecoveryController::class, 'forgotPassword'])->name('forgot-password.post');
    Route::get('/reset-password', [PasswordRecoveryController::class, 'resetPasswordForm'])->name('reset-password.get');
    Route::post('/reset-password', [PasswordRecoveryController::class, 'resetPassword'])->name('reset-password.post');

});

Route::get('/home', function (): View {
    return view('pages.home');
})->name('home');
