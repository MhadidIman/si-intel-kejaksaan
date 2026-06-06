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
use App\Models\Ormas;
use App\Models\PamSdo;
use App\Models\JmsActivity;
use Carbon\Carbon;

class DashboardIndex extends Component
{
    // Variabel Ringkasan Data
    public $total_lapinhar = 0;
    public $total_dpo_buron = 0;
    public $total_wna_overstay = 0;
    public $total_lapdu_masuk = 0;
    public $total_rawan_tinggi = 0;

    // Variabel Grafik (Statistik Tren)
    public $chartLabels = [];
    public $chartLapinhar = [];
    public $chartLapdu = [];
    public $chartDpo = [];

    // Array untuk menampung Notifikasi Sistem Cerdas
    public $system_alerts = [];

    public function mount()
    {
        $this->loadSummaryData();
        $this->generateChartData();
        $this->generateSystemAlerts(); 
    }

    private function loadSummaryData()
    {
        $this->total_lapinhar = Lapinhar::count();
        $this->total_dpo_buron = Dpo::where('status_pencarian', 'buron')->count();
        $this->total_wna_overstay = Wna::whereDate('masa_berlaku_izin_tinggal', '<', now())->count();
        $this->total_lapdu_masuk = Lapdu::where('status_laporan', 'menunggu')->count();
        $this->total_rawan_tinggi = Kerawanan::where('tingkat_rawan', 'tinggi')->count();
    }

    private function generateChartData()
    {
        // Mengambil data tren 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            // Gunakan startOfMonth() dan subMonthsNoOverflow() agar aman dari bug tanggal 31
            $date = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i);
            
            // Format label menjadi "Bulan Tahun" (Contoh: "Januari 2026")
            $this->chartLabels[] = $date->isoFormat('MMMM YYYY');

            $this->chartLapinhar[] = Lapinhar::whereMonth('tanggal_surat', $date->month)
                ->whereYear('tanggal_surat', $date->year)->count();

            $this->chartLapdu[] = Lapdu::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)->count();
                
            $this->chartDpo[] = Dpo::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)->count();
        }
    }

    // --- LOGIKA NOTIFIKASI SISTEM (CATATAN PANELIS NO. 4) ---
    private function generateSystemAlerts()
    {
        // 1. Notifikasi WNA Overstay
        if ($this->total_wna_overstay > 0) {
            $this->system_alerts[] = [
                'type' => 'danger',
                'icon' => 'fa-passport',
                'title' => 'WNA OVERSTAY TERDETEKSI',
                'message' => 'Terdapat ' . $this->total_wna_overstay . ' Warga Negara Asing yang masa berlaku izin tinggalnya telah habis. Segera lakukan koordinasi dengan Timpora.'
            ];
        }

        // 2. Notifikasi Ormas Status "Diawasi"
        $ormas_diawasi = Ormas::where('status', 'diawasi')->count();
        if ($ormas_diawasi > 0) {
            $this->system_alerts[] = [
                'type' => 'warning',
                'icon' => 'fa-users-slash',
                'title' => 'ORMAS DALAM PENGAWASAN',
                'message' => 'Terdapat ' . $ormas_diawasi . ' Organisasi Masyarakat dengan status "Diawasi". Tingkatkan eskalasi pemantauan kegiatan PAM SDO.'
            ];
        }

        // 3. Notifikasi Lonjakan Laporan (Lapdu)
        $lapduBulanIni = Lapdu::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)->count();
        $lapduBulanLalu = Lapdu::whereMonth('created_at', now()->subMonthNoOverflow()->month)
                             ->whereYear('created_at', now()->subMonthNoOverflow()->year)->count();

        // Asumsi: Lonjakan terjadi jika laporan bulan ini meningkat lebih dari 50% dari bulan lalu DAN minimal ada 5 laporan.
        if ($lapduBulanLalu > 0 && $lapduBulanIni >= 5) {
            $persentaseKenaikan = (($lapduBulanIni - $lapduBulanLalu) / $lapduBulanLalu) * 100;
            if ($persentaseKenaikan >= 50) {
                $this->system_alerts[] = [
                    'type' => 'info',
                    'icon' => 'fa-chart-line',
                    'title' => 'LONJAKAN PENGADUAN',
                    'message' => 'Terjadi lonjakan pengaduan sebesar ' . number_format($persentaseKenaikan, 0) . '% dibandingkan bulan lalu. Diperlukan analisa tren potensi ancaman.'
                ];
            }
        } elseif ($lapduBulanLalu == 0 && $lapduBulanIni >= 5) {
            $this->system_alerts[] = [
                'type' => 'info',
                'icon' => 'fa-chart-line',
                'title' => 'INTENSITAS PENGADUAN TINGGI',
                'message' => 'Terdapat ' . $lapduBulanIni . ' pengaduan masuk bulan ini (meningkat drastis dari bulan sebelumnya).'
            ];
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $recent_lapinhars = Lapinhar::latest('tanggal_surat')->take(5)->get();
        $recent_lapdus = Lapdu::latest('created_at')->take(5)->get();

        $peta_kerawanan = Kerawanan::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'kecamatan', 'potensi_ancaman', 'tingkat_rawan', 'skor_spk', 'latitude', 'longitude']);

        return view('livewire.dashboard.dashboard-index', [
            'recent_lapinhars' => $recent_lapinhars,
            'recent_lapdus' => $recent_lapdus,
            'peta_kerawanan' => $peta_kerawanan
        ]);
    }
}