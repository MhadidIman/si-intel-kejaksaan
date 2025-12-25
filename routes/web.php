<?php

use Illuminate\Support\Facades\Route;

// 1. Import Component Dashboard Baru
use App\Livewire\Dashboard\DashboardIndex;

// 2. Import Component Lainnya
use App\Livewire\Users\UserIndex;
use App\Livewire\Lapinhar\LapinharIndex;
use App\Livewire\Dpo\DpoIndex;
use App\Livewire\Wna\WnaIndex;
use App\Livewire\Ormas\OrmasIndex;
use App\Livewire\PamSdo\PamSdoIndex;
use App\Livewire\Jms\JmsIndex;
use App\Livewire\Kerawanan\KerawananIndex;
use App\Livewire\Lapdu\LapduIndex;
// Import Penkum dihapus
use App\Http\Controllers\ReportController;

// Mengarahkan halaman utama langsung ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Profile Bawaan Breeze
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Group Route yang butuh Login
Route::middleware(['auth', 'verified'])->group(function () {

    // --- DASHBOARD BARU (Livewire) ---
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // --- MANAJEMEN USER ---
    Route::get('/users', UserIndex::class)->name('users.index');

    // --- MODUL BANK DATA INTELIJEN ---
    // Bidang Operasional
    Route::get('/lapinhar', LapinharIndex::class)->name('lapinhar.index');
    Route::get('/dpo', DpoIndex::class)->name('dpo.index');
    Route::get('/wna', WnaIndex::class)->name('wna.index');
    Route::get('/ormas', OrmasIndex::class)->name('ormas.index');
    Route::get('/pam-sdo', PamSdoIndex::class)->name('pam-sdo.index');

    // Giat & Pelayanan
    Route::get('/jms', JmsIndex::class)->name('jms.index');
    // Route Penkum dihapus
    Route::get('/kerawanan', KerawananIndex::class)->name('kerawanan.index');
    Route::get('/lapdu', LapduIndex::class)->name('lapdu.index');

    // --- ROUTE CETAK LAPORAN ---
    Route::controller(ReportController::class)->group(function () {
        // DPO
        Route::get('/cetak-dpo', 'cetakDpo')->name('cetak.dpo');
        Route::get('/cetak-dpo/{id}', 'cetakDpoSatuan')->name('cetak.dpo.satuan');

        // Lapinhar
        Route::get('/cetak-lapinhar', 'cetakLapinhar')->name('cetak.lapinhar');
        Route::get('/cetak-lapinhar/{id}', 'cetakLapinharSatuan')->name('cetak.lapinhar.satuan');

        // WNA
        Route::get('/cetak-wna', 'cetakWna')->name('cetak.wna');
        Route::get('/cetak-wna/{id}', 'cetakWnaSatuan')->name('cetak.wna.satuan');

        // ORMAS
        Route::get('/cetak-ormas', 'cetakOrmas')->name('cetak.ormas');
        Route::get('/cetak-ormas/{id}', 'cetakOrmasSatuan')->name('cetak.ormas.satuan');

        // PAM SDO
        Route::get('/cetak-pam-sdo', 'cetakPamSdo')->name('cetak.pam-sdo');
        Route::get('/cetak-pam-sdo/{id}', 'cetakPamSdoSatuan')->name('cetak.pam-sdo.satuan');

        // JMS
        Route::get('/cetak-jms', 'cetakJms')->name('cetak.jms');
        Route::get('/cetak-jms/{id}', 'cetakJmsSatuan')->name('cetak.jms.satuan');

        // PETA KERAWANAN
        Route::get('/cetak-kerawanan', 'cetakKerawanan')->name('cetak.kerawanan');
        Route::get('/cetak-kerawanan/{id}', 'cetakKerawananSatuan')->name('cetak.kerawanan.satuan');

        // LAPDU
        Route::get('/cetak-lapdu', 'cetakLapdu')->name('cetak.lapdu');
        Route::get('/cetak-lapdu/{id}', 'cetakLapduSatuan')->name('cetak.lapdu.satuan');

        // Route cetak penkum dihapus
    });
});

require __DIR__ . '/auth.php';
