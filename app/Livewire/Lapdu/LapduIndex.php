<?php

namespace App\Livewire\Lapdu;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lapdu;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LapduIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    public $selectedLapduId = null;
    public $showDetailModal = false;

    public $nomor_sprintug = '';
    public $tanggal_sprintug = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function bukaDetail($id)
    {
        $this->selectedLapduId = $id;
        $lapdu = Lapdu::findOrFail($id);

        $this->nomor_sprintug = $lapdu->nomor_sprintug ?? '';
        $this->tanggal_sprintug = $lapdu->tanggal_sprintug ?? '';

        $this->showDetailModal = true;
    }

    public function tutupDetail()
    {
        $this->showDetailModal = false;
        $this->selectedLapduId = null;
    }

    // Fungsi Notifikasi Email HTML
    private function kirimNotifikasi($lapdu, $status)
    {
        $teksStatus = strtoupper($status);

        $pesanWa = "🚨 *SI-INTEL KEJAKSAAN* 🚨\n\n"
            . "Yth. Saudara/i *{$lapdu->nama_pelapor}*,\n"
            . "Status laporan Anda (Tiket: *{$lapdu->nomor_tiket}*) diperbarui menjadi: *{$teksStatus}*.\n\n"
            . "Cek portal resmi SI-INTEL untuk detailnya.";

        /*
        if (!empty($lapdu->no_hp_pelapor)) {
            try {
                Http::timeout(5)->post('http://localhost:3000/send-message', [
                    'number' => $lapdu->no_hp_pelapor,
                    'message' => $pesanWa
                ]);
            } catch (\Exception $e) {
                Log::error('Notifikasi WA Gagal: ' . $e->getMessage());
            }
        }
        */

        $htmlEmail = "
        <div style='font-family: Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);'>
            <div style='background-color: #047857; padding: 25px; text-align: center; color: white;'>
                <h2 style='margin: 0; font-size: 22px; font-weight: bold; letter-spacing: 1px;'>SI-INTEL KEJAKSAAN</h2>
                <p style='margin: 5px 0 0; font-size: 14px; opacity: 0.9;'>Kejaksaan Negeri Banjarmasin</p>
            </div>
            <div style='padding: 30px; background-color: #ffffff; color: #334155; line-height: 1.6;'>
                <p style='margin-top: 0;'>Yth. Saudara/i <strong>{$lapdu->nama_pelapor}</strong>,</p>
                <p>Bersama email ini, kami menginformasikan bahwa terdapat pembaruan status pada Laporan Pengaduan Masyarakat yang Anda sampaikan kepada Kejaksaan Negeri Banjarmasin.</p>
                
                <div style='background-color: #f8fafc; border-left: 4px solid #047857; padding: 15px; margin: 25px 0; border-radius: 0 8px 8px 0;'>
                    <p style='margin: 0 0 10px; font-size: 14px;'><strong>Nomor Tiket:</strong> <span style='font-family: monospace; color: #047857; font-size: 16px;'>{$lapdu->nomor_tiket}</span></p>
                    <p style='margin: 0; font-size: 14px;'><strong>Status Terkini:</strong> <span style='background-color: #10b981; color: white; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 12px;'>{$teksStatus}</span></p>
                </div>
                
                <p>Anda dapat memantau detail perkembangan tindak lanjut laporan ini secara langsung melalui Portal Publik SI-INTEL menggunakan Nomor Tiket di atas.</p>
                <p style='font-size: 13px; color: #64748b; font-style: italic; margin-top: 25px;'>Sesuai dengan Undang-Undang Perlindungan Saksi dan Korban, identitas dan data pribadi Anda dijamin kerahasiaannya oleh sistem keamanan Intelijen kami.</p>
                
                <p style='margin-top: 30px; margin-bottom: 0;'>Hormat kami,<br><strong style='color: #0f172a;'>Seksi Intelijen Kejaksaan Negeri Banjarmasin</strong></p>
            </div>
            <div style='background-color: #f1f5f9; padding: 15px; text-align: center; font-size: 11px; color: #64748b; border-top: 1px solid #e2e8f0;'>
                <p style='margin: 0;'>Email ini dihasilkan secara otomatis oleh sistem SI-INTEL. Mohon tidak membalas email ini.</p>
            </div>
        </div>";

        $user = User::where('nik', $lapdu->nik)->first();
        if ($user && !empty($user->email)) {
            try {
                Mail::html($htmlEmail, function ($message) use ($user, $lapdu) {
                    $message->to($user->email)
                        ->subject('Pemberitahuan Resmi SI-INTEL: Update Laporan ' . $lapdu->nomor_tiket);
                });
            } catch (\Exception $e) {
                Log::error('Notifikasi Email Gagal: ' . $e->getMessage());
            }
        }
    }

    public function simpanSprintug()
    {
        $lapdu = Lapdu::findOrFail($this->selectedLapduId);
        $statusBaru = 'diproses';

        $lapdu->update([
            'nomor_sprintug' => $this->nomor_sprintug,
            'tanggal_sprintug' => $this->tanggal_sprintug,
            'status_laporan' => $statusBaru
        ]);

        $this->kirimNotifikasi($lapdu, $statusBaru);

        session()->flash('message', 'Sprintug diterbitkan. Status naik menjadi "Diproses" dan notifikasi telah terkirim ke Pelapor.');
    }

    public function perbaruiStatus($id, $statusBaru)
    {
        $lapdu = Lapdu::findOrFail($id);
        $lapdu->update([
            'status_laporan' => $statusBaru
        ]);

        $this->kirimNotifikasi($lapdu, $statusBaru);

        session()->flash('message', 'Status berhasil diperbarui dan notifikasi dikirim ke Pelapor.');
    }

    public function eliminasiLapdu($id)
    {
        if (!auth()->user()->isAdmin()) {
            session()->flash('error', 'Otorisasi ditolak. Anda tidak memiliki akses menghapus data arsip.');
            return;
        }

        $lapdu = Lapdu::findOrFail($id);

        if ($lapdu->bukti_dukung) {
            Storage::disk('public')->delete($lapdu->bukti_dukung);
        }

        $lapdu->delete();
        $this->tutupDetail();

        session()->flash('message', 'Dokumen pengaduan berhasil dieliminasi dari database sistem keamanan.');
    }

    public function render()
    {
        $query = Lapdu::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nomor_tiket', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_terlapor', 'like', '%' . $this->search . '%')
                    ->orWhere('judul_laporan', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_pelapor', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->filterStatus)) {
            $query->where('status_laporan', $this->filterStatus);
        }

        $lapdus = $query->orderBy('created_at', 'desc')->paginate(10);
        $selectedLapdu = $this->selectedLapduId ? Lapdu::find($this->selectedLapduId) : null;

        return view('livewire.lapdu.lapdu-index', [
            'lapdus' => $lapdus,
            'selectedLapdu' => $selectedLapdu
        ])->layout('layouts.app');
    }
}
