<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dpo;
use App\Models\Wna;
use App\Models\Lapinhar;
use App\Models\Ormas;
use App\Models\PamSdo;
use App\Models\JmsActivity;
use App\Models\Kerawanan;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // ==========================================================
    // 1. MODUL DPO (BURONAN)
    // ==========================================================
    public function cetakDpo()
    {
        $data = Dpo::orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('reports.dpo-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan-Data-DPO.pdf');
    }

    public function cetakDpoSatuan($id)
    {
        $data = Dpo::findOrFail($id);
        $namaFile = str_replace([' ', '/', '\\'], '-', $data->nama_lengkap);
        $pdf = Pdf::loadView('reports.dpo-satuan-pdf', ['item' => $data]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Biodata-DPO-' . $namaFile . '.pdf');
    }

    // ==========================================================
    // 2. MODUL WNA (PENGAWASAN ORANG ASING)
    // ==========================================================
    public function cetakWna()
    {
        $data = Wna::orderBy('masa_berlaku_izin_tinggal', 'asc')->get();
        $pdf = Pdf::loadView('reports.wna-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan-Pengawasan-WNA.pdf');
    }

    public function cetakWnaSatuan($id)
    {
        $data = Wna::findOrFail($id);
        $namaFile = str_replace([' ', '/', '\\'], '-', $data->nama_lengkap);
        $pdf = Pdf::loadView('reports.wna-satuan-pdf', ['item' => $data]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Biodata-WNA-' . $namaFile . '.pdf');
    }

    // ==========================================================
    // 3. MODUL LAPINHAR (LAPORAN INFORMASI)
    // ==========================================================
    public function cetakLapinhar()
    {
        $data = Lapinhar::orderBy('tanggal_surat', 'desc')->get();
        $pdf = Pdf::loadView('reports.lapinhar-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan-Informasi-Harian.pdf');
    }

    public function cetakLapinharSatuan($id)
    {
        $data = Lapinhar::findOrFail($id);
        $nomorSurat = $data->nomor_surat ?? 'Tanpa-Nomor';
        $namaFileAman = str_replace(['/', '\\'], '-', $nomorSurat);

        $pdf = Pdf::loadView('reports.lapinhar-satuan-pdf', ['item' => $data]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('LI-No-' . $namaFileAman . '.pdf');
    }

    // ==========================================================
    // 4. MODUL ORMAS (ORGANISASI KEMASYARAKATAN)
    // ==========================================================
    public function cetakOrmas()
    {
        $data = Ormas::orderBy('nama_organisasi', 'asc')->get();
        $pdf = Pdf::loadView('reports.ormas-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan-Data-Ormas.pdf');
    }

    public function cetakOrmasSatuan($id)
    {
        $data = Ormas::findOrFail($id);
        $namaFile = str_replace([' ', '/', '\\'], '-', $data->nama_organisasi);
        $pdf = Pdf::loadView('reports.ormas-satuan-pdf', ['item' => $data]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Data-Ormas-' . $namaFile . '.pdf');
    }

    // ==========================================================
    // 5. MODUL PAM SDO (PENGAMANAN)
    // ==========================================================
    public function cetakPamSdo()
    {
        $data = PamSdo::orderBy('tanggal_laporan', 'desc')->get();
        $pdf = Pdf::loadView('reports.pam-sdo-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan-PAM-SDO.pdf');
    }

    public function cetakPamSdoSatuan($id)
    {
        $data = PamSdo::findOrFail($id);
        $namaFile = str_replace([' ', '/', '\\'], '-', $data->target);
        $pdf = Pdf::loadView('reports.pam-sdo-satuan-pdf', ['item' => $data]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan-Pengamanan-' . $namaFile . '.pdf');
    }

    // ==========================================================
    // 6. MODUL JMS (JAKSA MASUK SEKOLAH)
    // ==========================================================
    public function cetakJms()
    {
        // PERBAIKAN: Menggunakan JmsActivity
        $data = JmsActivity::orderBy('tanggal_kegiatan', 'desc')->get();

        $pdf = Pdf::loadView('reports.jms-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-JMS-Rekap.pdf');
    }

    public function cetakJmsSatuan($id)
    {
        // Ambil data menggunakan Model yang benar
        $jmsData = JmsActivity::findOrFail($id);

        $namaFile = str_replace([' ', '/', '\\'], '-', $jmsData->nama_sekolah);

        // KITA KIRIM SEBAGAI 'data' (BUKAN 'item')
        $pdf = Pdf::loadView('reports.jms-satuan-pdf', ['data' => $jmsData]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan-Kegiatan-JMS-' . $namaFile . '.pdf');
    }

    // ==========================================================
    // 7. MODUL PETA KERAWWANAN
    // ==========================================================
    public function cetakKerawanan()
    {
        // Sesuaikan nama kolom: tingkat_rawan
        // Sesuaikan value: tinggi, sedang, rendah (huruf kecil sesuai migration)
        $data = Kerawanan::orderByRaw("FIELD(tingkat_rawan, 'tinggi', 'sedang', 'rendah')")->get();

        $pdf = Pdf::loadView('reports.kerawanan-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Rekap-Peta-Kerawanan.pdf');
    }

    public function cetakKerawananSatuan($id)
    {
        $data = Kerawanan::findOrFail($id);

        $pdf = Pdf::loadView('reports.kerawanan-satuan-pdf', ['data' => $data]);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Analisa-Kerawanan-' . $data->kecamatan . '.pdf');
    }

    // ==========================================================
    // 8. MODUL PENGADUAN MASYARAKAT (LAPDU) - FIXED
    // ==========================================================

    // Cetak Rekapitulasi (Tabel Landscape)
    public function cetakLapdu()
    {
        // PERBAIKAN: Ganti 'tanggal_masuk' menjadi 'tanggal_terima'
        $data = \App\Models\Lapdu::orderBy('tanggal_terima', 'desc')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.lapdu-pdf', ['data' => $data]);

        // Set kertas landscape agar tabel muat banyak kolom
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Rekap-Pengaduan-Masyarakat.pdf');
    }

    // Cetak Lembar Disposisi (Satuan Portrait)
    public function cetakLapduSatuan($id)
    {
        $data = \App\Models\Lapdu::findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.lapdu-satuan-pdf', ['data' => $data]);

        // Set kertas portrait untuk format surat disposisi
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Lembar-Disposisi-Lapdu-' . $data->id . '.pdf');
    }
}
