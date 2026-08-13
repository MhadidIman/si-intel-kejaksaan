<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Lapinhar;
use App\Models\Dpo;
use App\Models\Wna;
use App\Models\Lapdu;
use App\Models\Kerawanan;
use App\Models\Ormas;
use App\Models\PamSdo;
use App\Models\Lapsus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardAdmin extends Component
{
    // Variabel Ringkasan Data
    public $total_lapinhar = 0;
    public $total_dpo_buron = 0;
    public $total_wna_overstay = 0;
    public $total_lapdu_masuk = 0;
    public $total_rawan_tinggi = 0;
    public $total_lapsus = 0;
    public $total_ormas_diawasi = 0;

    // Variabel untuk pengecekan Notifikasi Real-time
    public $last_lapdu_count = 0;

    // Variabel Grafik
    public $chartLabels = [];
    public $chartLapinhar = [];
    public $chartLapdu = [];
    public $chartLapsus = [];
    public $kategoriList = [];

    // Array untuk menampung Notifikasi Sistem Cerdas
    public $system_alerts = [];

    public function mount()
    {
        $this->loadSummaryData();
        $this->generateChartData();
        $this->generateKategoriKriminal();
        $this->generateSystemAlerts();

        $this->last_lapdu_count = Lapdu::count();
    }

    private function loadSummaryData()
    {
        $this->total_lapinhar = Lapinhar::count();
        $this->total_dpo_buron = Dpo::where('status_pencarian', 'buron')->count();
        $this->total_wna_overstay = Wna::whereDate('masa_berlaku_izin_tinggal', '<', now())->count();
        $this->total_lapdu_masuk = Lapdu::where('status_laporan', 'menunggu')->count();
        $this->total_rawan_tinggi = Kerawanan::where('tingkat_rawan', 'tinggi')->count();
        $this->total_lapsus = Lapsus::count();
        $this->total_ormas_diawasi = Ormas::where('status', 'diawasi')->count();
    }

    public function checkNewLapdu()
    {
        $current_count = Lapdu::count();

        if ($current_count > $this->last_lapdu_count) {
            $new_lapdu = Lapdu::latest()->first();

            $this->dispatch(
                'lapdu-masuk',
                title: 'LAPDU BAHARU MASUK!',
                message: 'Terlapor: ' . ($new_lapdu->nama_terlapor ?? 'TIDAK DIKETAHUI')
            );

            $this->last_lapdu_count = $current_count;
            $this->loadSummaryData();
            $this->generateKategoriKriminal(); 
            $this->generateSystemAlerts();
        }
    }

    private function generateChartData()
    {
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i);
            $this->chartLabels[] = $date->isoFormat('MMMM YYYY');
            $this->chartLapinhar[] = Lapinhar::whereMonth('tanggal_surat', $date->month)
                ->whereYear('tanggal_surat', $date->year)->count();
            $this->chartLapdu[] = Lapdu::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)->count();
            $this->chartLapsus[] = Lapsus::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)->count();
        }
    }

    private function generateKategoriKriminal()
    {
        $chartData = Lapdu::select('kategori_laporan', DB::raw('count(*) as total'))
            ->groupBy('kategori_laporan')
            ->get()
            ->pluck('total', 'kategori_laporan')
            ->toArray();

        $this->kategoriList = [
            'tipikor' => $chartData['tipikor'] ?? 0,
            'pungli_gratifikasi' => $chartData['pungli_gratifikasi'] ?? 0,
            'mafia_tanah' => $chartData['mafia_tanah'] ?? 0,
            'aliran_sesat' => $chartData['aliran_sesat'] ?? 0,
            'ancaman_ideologi' => $chartData['ancaman_ideologi'] ?? 0,
            'pelanggaran_hukum_lain' => $chartData['pelanggaran_hukum_lain'] ?? 0,
        ];
    }

    private function generateSystemAlerts()
    {
        $this->system_alerts = [];

        if ($this->total_wna_overstay > 0) {
            $this->system_alerts[] = [
                'type' => 'danger',
                'icon' => 'fa-passport',
                'title' => 'WNA OVERSTAY TERDETEKSI',
                'message' => 'Terdapat ' . $this->total_wna_overstay . ' Warga Negara Asing yang masa berlaku izin tinggalnya telah habis. Segera lakukan koordinasi dengan Timpora.'
            ];
        }

        if ($this->total_ormas_diawasi > 0) {
            $this->system_alerts[] = [
                'type' => 'warning',
                'icon' => 'fa-users-slash',
                'title' => 'ORMAS DALAM PENGAWASAN',
                'message' => 'Terdapat ' . $this->total_ormas_diawasi . ' Organisasi Masyarakat dengan status "Diawasi". Tingkatkan eskalasi pemantauan kegiatan PAM SDO.'
            ];
        }

        if ($this->total_lapdu_masuk > 0) {
            $this->system_alerts[] = [
                'type' => 'info',
                'icon' => 'fa-envelope-open-text',
                'title' => 'LAPDU MENUNGGU DIPROSES',
                'message' => 'Terdapat ' . $this->total_lapdu_masuk . ' Laporan Pengaduan (Lapdu) baru yang masuk dan belum diproses. Segera lakukan peninjauan.'
            ];
        }

        $pending_approvals_count = Lapinhar::where('status_verifikasi', 'pending')->count() + PamSdo::where('status_verifikasi', 'pending')->count();
        if ($pending_approvals_count > 0) {
            $this->system_alerts[] = [
                'type' => 'warning',
                'icon' => 'fa-clipboard-check',
                'title' => 'TUGAS APPROVAL MENUNGGU',
                'message' => 'Terdapat ' . $pending_approvals_count . ' laporan dari Staf yang membutuhkan persetujuan (Approval) Anda segera.'
            ];
        }
    }

    public function render()
    {
        // 1. Data Peta Kerawanan
        $peta_kerawanan = Kerawanan::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'kecamatan', 'potensi_ancaman', 'tingkat_rawan', 'skor_spk', 'latitude', 'longitude']);

        // 2. Data Pending Approvals (Approval Center)
        $pending_lapinhars = Lapinhar::with('user')->where('status_verifikasi', 'pending')->latest()->take(5)->get();
        $pending_pamsdos = PamSdo::with('user')->where('status_verifikasi', 'pending')->latest()->take(5)->get();

        // Gabungkan semua pending approvals dan urutkan berdasarkan created_at
        $pending_approvals = collect();
        foreach ($pending_lapinhars as $lap) {
            $pending_approvals->push((object)[
                'id' => $lap->id,
                'type' => 'Lapinhar',
                'user_name' => $lap->user->name ?? 'Unknown',
                'title' => $lap->nomor_surat,
                'created_at' => $lap->created_at,
                'route' => route('lapinhar.index') // Asumsi admin memproses dari menu utamanya
            ]);
        }
        foreach ($pending_pamsdos as $pam) {
            $pending_approvals->push((object)[
                'id' => $pam->id,
                'type' => 'PAM SDO',
                'user_name' => $pam->user->name ?? 'Unknown',
                'title' => $pam->nama_pegawai,
                'created_at' => $pam->created_at,
                'route' => route('pam-sdo.index')
            ]);
        }
        $pending_approvals = $pending_approvals->sortByDesc('created_at')->take(5);

        // 3. Leaderboard Kinerja Staff
        // Hitung total laporan (Lapinhar + Lapsus + PamSdo + JMS) per user di bulan ini
        $staff_performance = User::where('role', 'staff')
            ->withCount([
                'lapinhars' => function ($query) {
                    $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                },
                'lapsuses' => function ($query) {
                    $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                }
            ])
            ->get()
            ->map(function ($user) {
                $user->total_reports = $user->lapinhars_count + $user->lapsuses_count;
                return $user;
            })
            ->sortByDesc('total_reports')
            ->take(5);

        // 4. Lapdu Terbaru
        $recent_lapdus = Lapdu::latest('created_at')->take(5)->get();

        return view('livewire.dashboard.dashboard-admin', [
            'peta_kerawanan' => $peta_kerawanan,
            'pending_approvals' => $pending_approvals,
            'staff_performance' => $staff_performance,
            'recent_lapdus' => $recent_lapdus
        ]);
    }
}
