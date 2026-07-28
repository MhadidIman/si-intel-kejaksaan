<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dpo;
use App\Models\Wna;
use App\Models\Lapinhar;
use App\Models\Lapsus;
use App\Models\Ormas;
use App\Models\PamSdo;
use App\Models\JmsActivity;
use App\Models\Kerawanan;
use App\Models\Lapdu;

class ReportController extends Controller
{
    // ==========================================================
    // 1. MODUL DPO (BURONAN)
    // ==========================================================
    public function cetakDpo()
    {
        $data = Dpo::orderBy('created_at', 'desc')->get();
        return view('reports.dpo-pdf', compact('data'));
    }

    public function cetakDpoSatuan($id)
    {
        $data = Dpo::findOrFail($id);
        return view('reports.dpo-satuan-pdf', compact('data'));
    }

    // ==========================================================
    // 2. MODUL WNA (PENGAWASAN ORANG ASING)
    // ==========================================================
    public function cetakWna()
    {
        $data = Wna::orderBy('masa_berlaku_izin_tinggal', 'asc')->get();
        return view('reports.wna-pdf', compact('data'));
    }

    public function cetakWnaSatuan($id)
    {
        $data = Wna::findOrFail($id);
        return view('reports.wna-satuan-pdf', ['item' => $data]);
    }

    // ==========================================================
    // 3. MODUL LAPINHAR (LAPORAN INFORMASI)
    // ==========================================================
    public function cetakLapinhar()
    {
        $data = Lapinhar::orderBy('tanggal_surat', 'desc')->get();
        return view('reports.lapinhar-pdf', compact('data'));
    }

    public function cetakLapinharSatuan($id)
    {
        $data = Lapinhar::findOrFail($id);
        return view('reports.lapinhar-satuan-pdf', ['item' => $data]);
    }

    // ==========================================================
    // 4. MODUL ORMAS (ORGANISASI KEMASYARAKATAN)
    // ==========================================================
    public function cetakOrmas()
    {
        $data = Ormas::orderBy('nama_organisasi', 'asc')->get();
        return view('reports.ormas-pdf', compact('data'));
    }

    public function cetakOrmasSatuan($id)
    {
        $data = Ormas::findOrFail($id);
        return view('reports.ormas-satuan-pdf', ['item' => $data]);
    }

    // ==========================================================
    // 5. MODUL PAM SDO (PENGAMANAN)
    // ==========================================================
    public function cetakPamSdo()
    {
        $data = PamSdo::orderBy('created_at', 'desc')->get();
        return view('reports.pam-sdo-pdf', compact('data'));
    }

    public function cetakPamSdoSatuan($id)
    {
        $data = PamSdo::findOrFail($id);
        return view('reports.pam-sdo-satuan-pdf', ['item' => $data]);
    }

    // ==========================================================
    // 6. MODUL JMS (JAKSA MASUK SEKOLAH)
    // ==========================================================
    public function cetakJms()
    {
        $data = JmsActivity::orderBy('tanggal_kegiatan', 'desc')->get();
        return view('reports.jms-pdf', compact('data'));
    }

    public function cetakJmsSatuan($id)
    {
        $jmsData = JmsActivity::findOrFail($id);
        return view('reports.jms-satuan-pdf', ['data' => $jmsData]);
    }

    // ==========================================================
    // 7. MODUL PETA KERAWANAN
    // ==========================================================
    public function cetakKerawanan()
    {
        $data = Kerawanan::orderByRaw("FIELD(tingkat_rawan, 'tinggi', 'sedang', 'rendah')")->get();
        return view('reports.kerawanan-pdf', compact('data'));
    }

    public function cetakKerawananSatuan($id)
    {
        $data = Kerawanan::findOrFail($id);
        return view('reports.kerawanan-satuan-pdf', compact('data'));
    }

    // ==========================================================
    // 8. MODUL PENGADUAN MASYARAKAT (LAPDU)
    // ==========================================================
    public function cetakLapdu()
    {
        $data = Lapdu::orderBy('created_at', 'desc')->get();
        return view('reports.lapdu-pdf', compact('data'));
    }

    public function cetakLapduSatuan($id)
    {
        $data = Lapdu::findOrFail($id);
        return view('reports.lapdu-satuan-pdf', compact('data'));
    }

    // ==========================================================
    // 9. Cetak Statistik Kinerja Staff
    // ==========================================================
    public function cetakUserStats()
    {
        $data = User::where('role', '!=', 'admin')
            ->withCount([
                'lapinhars',
                'dpos',
                'wnas',
                'ormas',
                'pamSdos',
                'jmsActivities',
                'kerawanans',
                'lapdus'
            ])
            ->orderBy('name', 'asc')
            ->get();

        return view('reports.user-stats-pdf', compact('data'));
    }

    // ==========================================================
    // 10. Cetak LAPORAN KHUSUS
    // ==========================================================
    public function cetakLapsus()
    {
        $lapsus = Lapsus::with('user')->latest()->get();
        return view('reports.lapsus-pdf', compact('lapsus'));
    }

    public function cetakLapsusSatuan($id)
    {
        $laporan = Lapsus::with('user')->findOrFail($id);
        return view('reports.lapsus-satuan-pdf', compact('laporan'));
    }
}
