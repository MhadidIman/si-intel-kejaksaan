<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Import Component Livewire Internal (Dashboard & Modul)
use App\Livewire\Dashboard\DashboardIndex;
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

// Import Component Livewire Publik (Portal Pengaduan Masyarakat)
use App\Livewire\Public\LapduForm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================================================================
// 1. HALAMAN DEPAN (WELCOME & LOGIN MASYARAKAT)
// ========================================================================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/publik', function () {
    return view('welcome');
});
Route::get('/petugas', function () {
    return view('welcome-internal');
})->name('welcome.internal');

// Rute Login Khusus Masyarakat
Volt::route('/masyarakat/login', 'public.login')->middleware('guest')->name('publik.login');


// ========================================================================
// 2. GROUP ROUTE YANG BUTUH LOGIN (MASYARAKAT & PETUGAS)
// ========================================================================
Route::middleware(['auth', 'verified'])->group(function () {

    // --- RUTE KHUSUS MASYARAKAT (Dashboard, Lapor, Riwayat) ---
    // --- RUTE KHUSUS MASYARAKAT (Dashboard, Lapor, Riwayat) ---
    Route::prefix('masyarakat')->group(function () {

        // Gunakan Volt::route agar logika PHP-nya dieksekusi
        Volt::route('/dashboard', 'public.dashboard')->name('publik.dashboard');

        // Form Pengaduan
        Route::get('/lapor', LapduForm::class)->name('publik.lapor');

        // Riwayat & Proses Pengaduan
        Volt::route('/riwayat', 'public.riwayat')->name('publik.riwayat');
    });

    // --- RUTE UMUM (PROFILE) ---
    Route::view('profile', 'profile')->name('profile');


    // --- RUTE KHUSUS PETUGAS / ADMIN INTELIJEN ---
    // Dashboard Utama Internal
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // --- MODUL MANAJEMEN PERSONIL ---
    Route::get('/users', UserIndex::class)->name('users.index');

    // --- MODUL OPERASIONAL ---
    Route::get('/lapinhar', LapinharIndex::class)->name('lapinhar.index');
    Route::get('/dpo', DpoIndex::class)->name('dpo.index');
    Route::get('/wna', WnaIndex::class)->name('wna.index');
    Route::get('/ormas', OrmasIndex::class)->name('ormas.index');
    Route::get('/pam-sdo', PamSdoIndex::class)->name('pam-sdo.index');

    // --- MODUL GIAT & PELAYANAN ---
    Route::get('/jms', JmsIndex::class)->name('jms.index');
    Route::get('/kerawanan', KerawananIndex::class)->name('kerawanan.index');
    Route::get('/lapdu', LapduIndex::class)->name('lapdu.index');

    // --- MODUL CETAK LAPORAN (PDF) ---
    Route::controller(ReportController::class)->group(function () {
        Route::get('/cetak-dpo', 'cetakDpo')->name('cetak.dpo');
        Route::get('/cetak-dpo/{id}', 'cetakDpoSatuan')->name('cetak.dpo.satuan');
        Route::get('/cetak-lapinhar', 'cetakLapinhar')->name('cetak.lapinhar');
        Route::get('/cetak-lapinhar/{id}', 'cetakLapinharSatuan')->name('cetak.lapinhar.satuan');
        Route::get('/cetak-wna', 'cetakWna')->name('cetak.wna');
        Route::get('/cetak-wna/{id}', 'cetakWnaSatuan')->name('cetak.wna.satuan');
        Route::get('/cetak-ormas', 'cetakOrmas')->name('cetak.ormas');
        Route::get('/cetak-ormas/{id}', 'cetakOrmasSatuan')->name('cetak.ormas.satuan');
        Route::get('/cetak-pam-sdo', 'cetakPamSdo')->name('cetak.pam-sdo');
        Route::get('/cetak-pam-sdo/{id}', 'cetakPamSdoSatuan')->name('cetak.pam-sdo.satuan');
        Route::get('/cetak-jms', 'cetakJms')->name('cetak.jms');
        Route::get('/cetak-jms/{id}', 'cetakJmsSatuan')->name('cetak.jms.satuan');
        Route::get('/cetak-kerawanan', 'cetakKerawanan')->name('cetak.kerawanan');
        Route::get('/cetak-kerawanan/{id}', 'cetakKerawananSatuan')->name('cetak.kerawanan.satuan');
        Route::get('/cetak-lapdu', 'cetakLapdu')->name('cetak.lapdu');
        Route::get('/cetak-lapdu/{id}', 'cetakLapduSatuan')->name('cetak.lapdu.satuan');
        Route::get('/cetak-statistik-staff', 'cetakUserStats')->name('cetak.user-stats');
    });
});

require __DIR__ . '/auth.php';
