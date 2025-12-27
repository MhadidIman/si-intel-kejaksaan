<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Lapinhar;
use App\Models\Dpo;
use App\Models\Wna;
use App\Models\Kerawanan;
use App\Models\Lapdu;

class DashboardIndex extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.dashboard-index', [
            // Hitung Statistik
            'total_lapinhar' => Lapinhar::count(),

            'total_dpo_buron' => Dpo::where('status_pencarian', 'buron')->count(),

            // WNA Overstay dihitung dari logika Model (Attribute)
            'total_wna_overstay' => Wna::get()->filter(fn($w) => $w->is_overstay)->count(),

            'total_rawan_tinggi' => Kerawanan::where('tingkat_rawan', 'tinggi')->count(),

            // PERBAIKAN DISINI: Ganti 'status' -> 'status_laporan' dan 'masuk' -> 'menunggu'
            'total_lapdu_masuk' => Lapdu::where('status_laporan', 'menunggu')->count(),

            // Data Terbaru untuk Tabel Mini
            'recent_lapinhars' => Lapinhar::latest()->take(5)->get(),
            'recent_lapdus' => Lapdu::latest()->take(5)->get(),
        ]);
    }
}
