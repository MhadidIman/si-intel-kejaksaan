<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Actions\Logout;

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    // Rute Login Masyarakat (Public)
    Volt::route('login', 'pages.auth.login')
        ->name('login');

    // Rute Login Petugas (Internal)
    Volt::route('petugas/login', 'pages.auth.login-petugas')
        ->name('petugas.login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');

    // =========================================================
    // RUTE LOGOUT (Ini yang menyelesaikan Error Anda)
    // =========================================================
    Route::post('logout', function (Logout $logout) {
        $logout();
        return redirect('/'); // Setelah logout, kembalikan ke halaman utama
    })->name('logout');
});
