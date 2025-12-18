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
use App\Http\Controllers\ReportController;


Route::view('/', 'welcome');

// Route Profile Bawaan Breeze
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Group Route yang butuh Login
Route::middleware(['auth', 'verified'])->group(function () {

    // --- DASHBOARD BARU (Livewire) ---
    // Menggunakan component DashboardIndex agar bisa menampilkan statistik real-time
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // --- MANAJEMEN USER ---
    Route::get('/users', UserIndex::class)->name('users.index');

    // --- MODUL BANK DATA INTELIJEN ---

    // 1. Laporan Informasi Harian
    Route::get('/lapinhar', LapinharIndex::class)->name('lapinhar.index');

    // 2. Data DPO / Buronan
    Route::get('/dpo', DpoIndex::class)->name('dpo.index');

    // 3. Pengawasan Orang Asing (WNA)
    Route::get('/wna', WnaIndex::class)->name('wna.index');

    // 4. Data Ormas & PAKEM
    Route::get('/ormas', OrmasIndex::class)->name('ormas.index');

    // 5. PAM SDO (Pengamanan Internal)
    Route::get('/pam-sdo', PamSdoIndex::class)->name('pam-sdo.index');

    // 6. Jaksa Masuk Sekolah (JMS)
    Route::get('/jms', JmsIndex::class)->name('jms.index');

    // 7. Peta Kerawanan
    Route::get('/kerawanan', KerawananIndex::class)->name('kerawanan.index');

    // 8. Pengaduan Masyarakat (LAPDU)
    Route::get('/lapdu', LapduIndex::class)->name('lapdu.index');

    Route::middleware(['auth'])->group(function () {
        // ... route profile dll ...

        // Route untuk Cetak Report
        Route::get('/cetak-dpo', [ReportController::class, 'cetakDpo'])->name('cetak.dpo');

        // Cetak Lapinhar Rekap (Tabel Semua Data)
        Route::get('/cetak-lapinhar', [ReportController::class, 'cetakLapinhar'])->name('cetak.lapinhar');

        // Cetak Lapinhar Satuan (Format Surat Per Item)
        Route::get('/cetak-lapinhar/{id}', [ReportController::class, 'cetakLapinharSatuan'])->name('cetak.lapinhar.satuan');
    });
});

require __DIR__ . '/auth.php';
