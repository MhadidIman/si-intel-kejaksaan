<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Lapinhar;
use App\Models\Dpo;
use App\Models\Wna;
use App\Models\Lapdu;
use App\Models\Kerawanan;
// Tambahkan Model yang sebelumnya kurang
use App\Models\Ormas;
use App\Models\PamSdo;
use App\Models\JmsActivity;
use Carbon\Carbon;

class DashboardIndex extends Component
{
    // Properti Statistik Utama (Public agar bisa diakses View)
    public $total_lapinhar;
    public $total_dpo_buron;
    public $total_wna_overstay;
    public $total_lapdu_masuk;
    public $total_rawan_tinggi;

    // Properti Chart
    public $chartLabels = [];
    public $chartLapinhar = [];
    public $chartLapdu = [];

    public function mount()
    {
        // 1. Hitung Data Statistik Ringkas
        $this->total_lapinhar = Lapinhar::count();
        $this->total_dpo_buron = Dpo::where('status_pencarian', 'buron')->count();
        $this->total_wna_overstay = Wna::whereDate('masa_berlaku_izin_tinggal', '<', now())->count();
        $this->total_lapdu_masuk = Lapdu::where('status_laporan', 'menunggu')->count();
        $this->total_rawan_tinggi = Kerawanan::where('tingkat_rawan', 'tinggi')->count();

        // 2. Siapkan Data Chart (6 Bulan Terakhir)
        $this->generateChartData();
    }

    private function generateChartData()
    {
        // Loop 5 bulan ke belakang sampai sekarang
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->isoFormat('MMMM'); // Nama Bulan (Januari, dst)
            $month = $date->month;
            $year = $date->year;

            $this->chartLabels[] = $monthName;

            // Hitung Lapinhar per bulan
            $this->chartLapinhar[] = Lapinhar::whereMonth('tanggal_surat', $month)
                ->whereYear('tanggal_surat', $year)
                ->count();

            // Hitung Lapdu per bulan
            $this->chartLapdu[] = Lapdu::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->count();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        // Data Tabel Lapinhar Terbaru
        $recent_lapinhars = Lapinhar::latest('tanggal_surat')->take(5)->get();

        // Data Signal Lapdu Terbaru
        $recent_lapdus = Lapdu::latest('created_at')->take(5)->get();

        // --- LOGIKA LEADERBOARD (Top 3 Kontributor) ---
        // Kita ambil user selain admin agar kompetisi adil antar staff
        $users = User::where('role', '!=', 'admin')
            ->withCount([
                'lapinhars',
                'dpos',
                'wnas',
                'ormas',
                'pamSdos',
                'jmsActivities',
                'kerawanans',
                'lapdus'
            ])->get();

        // Hitung Total Input & Urutkan
        $topContributors = $users->map(function ($user) {
            $user->total_input =
                $user->lapinhars_count +
                $user->dpos_count +
                $user->wnas_count +
                $user->ormas_count +
                $user->pam_sdos_count +
                $user->jms_activities_count +
                $user->kerawanans_count +
                $user->lapdus_count;
            return $user;
        })->sortByDesc('total_input')->take(3); // Ambil 3 Terbaik

        return view('livewire.dashboard.dashboard-index', [
            'recent_lapinhars' => $recent_lapinhars,
            'recent_lapdus' => $recent_lapdus,
            'topContributors' => $topContributors
        ]);
    }
}
