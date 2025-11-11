<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function (): View {
    return view('welcome');
});
Route::middleware('guest')->group(function (): void {
    Route::get('register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('login', [AuthController::class, 'loginForm'])->name('login.get');
    Route::post('login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:4,1');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/home', function (): View {
    return view('pages.home');
})->name('home');

Route::prefix('me')
    ->middleware('auth')
    ->controller(ProfileController::class)->group(function (): void {
        Route::get('', 'index')->name('profile.index');
        Route::put('', 'update')->name('profile.update');
        Route::delete('', 'destroy')->name('profile.destroy');
    });
