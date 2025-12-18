<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dpo;
use App\Models\Wna;
use App\Models\Lapinhar;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // 1. Cetak Data DPO (Rekap Tabel)
    public function cetakDpo()
    {
        $data = Dpo::orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('reports.dpo-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-Data-DPO.pdf');
    }

    // 2. Cetak Data Lapinhar (Rekap Tabel - Semua Data)
    public function cetakLapinhar()
    {
        // Variabel dikirim sebagai 'data' (untuk loop foreach)
        $data = Lapinhar::orderBy('tanggal_surat', 'desc')->get();
        $pdf = Pdf::loadView('reports.lapinhar-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-Informasi-Harian.pdf');
    }

    // 3. CETAK LAPINHAR SATUAN (Format Surat Resmi - Per Item)
    public function cetakLapinharSatuan($id)
    {
        $data = Lapinhar::findOrFail($id);

        // --- PERBAIKAN ERROR DI SINI ---
        // Kita ganti tanda '/' menjadi '-' agar nama file valid
        $nomorSurat = $data->nomor_surat ?? 'Tanpa-Nomor';
        $namaFileAman = str_replace(['/', '\\'], '-', $nomorSurat);
        // -------------------------------

        // Load view khusus surat
        $pdf = Pdf::loadView('reports.lapinhar-satuan-pdf', ['item' => $data]);

        // Kertas Portrait (Tegak)
        $pdf->setPaper('a4', 'portrait');

        // Gunakan nama file yang sudah diamankan
        return $pdf->stream('LI-No-' . $namaFileAman . '.pdf');
    }
}
