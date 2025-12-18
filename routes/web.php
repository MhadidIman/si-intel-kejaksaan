<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Users\UserIndex;
// Import semua component baru
use App\Livewire\Lapinhar\LapinharIndex;
use App\Livewire\Dpo\DpoIndex;
use App\Livewire\Wna\WnaIndex;
use App\Livewire\Ormas\OrmasIndex;
use App\Livewire\PamSdo\PamSdoIndex;
use App\Livewire\Jms\JmsIndex;
use App\Livewire\Kerawanan\KerawananIndex;
use App\Livewire\Lapdu\LapduIndex;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    // Menu Admin
    Route::get('/users', UserIndex::class)->name('users.index');

    // Menu Bank Data Intelijen
    Route::get('/lapinhar', LapinharIndex::class)->name('lapinhar.index');
    Route::get('/dpo', DpoIndex::class)->name('dpo.index');
    Route::get('/wna', WnaIndex::class)->name('wna.index');
    Route::get('/ormas', OrmasIndex::class)->name('ormas.index');
    Route::get('/pam-sdo', PamSdoIndex::class)->name('pam-sdo.index');
    Route::get('/jms', JmsIndex::class)->name('jms.index');
    Route::get('/kerawanan', KerawananIndex::class)->name('kerawanan.index');
    Route::get('/lapdu', LapduIndex::class)->name('lapdu.index');
});

require __DIR__ . '/auth.php';
