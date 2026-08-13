<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Lapinhar;
use App\Models\Kerawanan;
use App\Models\Lapsus;
use App\Models\JmsActivity;
use App\Models\PamSdo;
use App\Models\ActivityLog;

class DashboardStaff extends Component
{
    // Variabel Ringkasan Data Staff
    public $staff_total_lapinhar = 0;
    public $staff_total_lapsus = 0;
    public $staff_total_jms = 0;
    public $staff_total_pam = 0;
    
    public $isDeleteOpen = false;

    public function confirmClear()
    {
        $this->isDeleteOpen = true;
    }

    public function clearActivityLog()
    {
        ActivityLog::where('user_id', auth()->id())->delete();
        $this->isDeleteOpen = false;
    }

    public function mount()
    {
        $this->loadSummaryData();
    }

    private function loadSummaryData()
    {
        $this->staff_total_lapinhar = Lapinhar::where('user_id', auth()->id())->count();
        $this->staff_total_lapsus = Lapsus::where('user_id', auth()->id())->count();
        $this->staff_total_jms = JmsActivity::where('user_id', auth()->id())->count();
        $this->staff_total_pam = PamSdo::where('user_id', auth()->id())->count();
    }

    public function render()
    {
        // 1. Data Peta Kerawanan
        $peta_kerawanan = Kerawanan::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'kecamatan', 'potensi_ancaman', 'tingkat_rawan', 'skor_spk', 'latitude', 'longitude']);

        // 2. Data Action Required (Laporan Ditolak / Perlu Revisi)
        $rejected_lapinhars = Lapinhar::where('user_id', auth()->id())->where('status_verifikasi', 'ditolak')->latest()->take(3)->get();
        $rejected_pamsdos = PamSdo::where('user_id', auth()->id())->where('status_verifikasi', 'ditolak')->latest()->take(3)->get();
        $rejected_jms = JmsActivity::where('user_id', auth()->id())->where('status_verifikasi', 'ditolak')->latest()->take(3)->get();

        $action_required = collect();
        foreach ($rejected_lapinhars as $lap) {
            $action_required->push((object)[
                'id' => $lap->id,
                'type' => 'Lapinhar',
                'title' => $lap->nomor_surat,
                'created_at' => $lap->created_at,
                'route' => route('lapinhar.index') // Arahkan ke edit/index
            ]);
        }
        foreach ($rejected_pamsdos as $pam) {
            $action_required->push((object)[
                'id' => $pam->id,
                'type' => 'PAM SDO',
                'title' => $pam->nama_pegawai,
                'created_at' => $pam->created_at,
                'route' => route('pam-sdo.index')
            ]);
        }
        foreach ($rejected_jms as $jms) {
            $action_required->push((object)[
                'id' => $jms->id,
                'type' => 'JMS',
                'title' => $jms->nama_sekolah,
                'created_at' => $jms->created_at,
                'route' => route('jms.index')
            ]);
        }
        $action_required = $action_required->sortByDesc('created_at')->take(4);

        // 3. Activity Log Pribadi
        $my_activities = ActivityLog::where('user_id', auth()->id())
            ->latest('created_at')
            ->take(8)
            ->get();

        return view('livewire.dashboard.dashboard-staff', [
            'peta_kerawanan' => $peta_kerawanan,
            'action_required' => $action_required,
            'my_activities' => $my_activities
        ]);
    }
}
