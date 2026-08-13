<?php

namespace App\Livewire\Lapdu;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Lapdu;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LapduIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $filterStatus = '';

    public $selectedLapduId = null;
    public $showDetailModal = false;

    public $nomor_sprintug = '';
    public $tanggal_sprintug = '';

    // PROPERTI FORM INPUT
    public $showForm = false;
    public $nama_pelapor, $is_anonim = false, $nik, $email_pelapor, $tempat_lahir, $tanggal_lahir;
    public $jenis_kelamin, $pekerjaan, $foto_ktp, $alamat_pelapor, $no_hp_pelapor;
    public $nama_terlapor, $jabatan_terlapor, $alamat_terlapor, $kontak_terlapor;
    public $kategori_laporan, $judul_laporan, $waktu_kejadian, $tempat_kejadian, $uraian_pengaduan;
    public $bukti_dukung;

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

        if (empty($lapdu->nomor_sprintug)) {
            $bulanRomawi = ['01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV', '05' => 'V', '06' => 'VI', '07' => 'VII', '08' => 'VIII', '09' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'];
            $this->nomor_sprintug = "PRINT-" . str_pad($lapdu->id, 3, '0', STR_PAD_LEFT) . "/M.3.10/Dek.1/" . $bulanRomawi[date('m')] . "/" . date('Y');
            $this->tanggal_sprintug = date('Y-m-d');
        } else {
            $this->nomor_sprintug = $lapdu->nomor_sprintug;
            $this->tanggal_sprintug = $lapdu->tanggal_sprintug;
        }

        $this->showDetailModal = true;
    }

    public function tutupDetail()
    {
        $this->showDetailModal = false;
        $this->selectedLapduId = null;
    }

    public function create()
    {
        $this->clearForm();
        $this->showForm = true;
    }

    public function clearForm()
    {
        $this->reset([
            'nama_pelapor', 'is_anonim', 'nik', 'email_pelapor', 'tempat_lahir', 'tanggal_lahir',
            'jenis_kelamin', 'pekerjaan', 'foto_ktp', 'alamat_pelapor', 'no_hp_pelapor',
            'nama_terlapor', 'jabatan_terlapor', 'alamat_terlapor', 'kontak_terlapor',
            'kategori_laporan', 'judul_laporan', 'waktu_kejadian', 'tempat_kejadian', 
            'uraian_pengaduan', 'bukti_dukung'
        ]);
        $this->is_anonim = false;
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->clearForm();
    }

    public function store()
    {
        $this->validate([
            'nama_pelapor' => 'required',
            'no_hp_pelapor' => 'required',
            'nama_terlapor' => 'required',
            'kategori_laporan' => 'required',
            'judul_laporan' => 'required',
            'waktu_kejadian' => 'required',
            'tempat_kejadian' => 'required',
            'uraian_pengaduan' => 'required',
        ]);

        $fotoKtpPath = null;
        if ($this->foto_ktp) {
            $fotoKtpPath = $this->foto_ktp->store('lapdu/ktp', 'public');
        }

        $buktiDukungPath = null;
        if ($this->bukti_dukung) {
            $buktiDukungPath = $this->bukti_dukung->store('lapdu/bukti', 'public');
        }

        // Generate Nomor Tiket
        $nomorTiket = 'LAPDU-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        Lapdu::create([
            'nomor_tiket' => $nomorTiket,
            'nama_pelapor' => $this->is_anonim ? 'Anonim' : $this->nama_pelapor,
            'is_anonim' => $this->is_anonim,
            'nik' => $this->is_anonim ? null : $this->nik,
            'email_pelapor' => $this->email_pelapor,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'pekerjaan' => $this->pekerjaan,
            'foto_ktp' => $fotoKtpPath,
            'alamat_pelapor' => $this->alamat_pelapor,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'nama_terlapor' => $this->nama_terlapor,
            'jabatan_terlapor' => $this->jabatan_terlapor,
            'alamat_terlapor' => $this->alamat_terlapor,
            'kontak_terlapor' => $this->kontak_terlapor,
            'kategori_laporan' => $this->kategori_laporan,
            'judul_laporan' => $this->judul_laporan,
            'waktu_kejadian' => $this->waktu_kejadian,
            'tempat_kejadian' => $this->tempat_kejadian,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'bukti_dukung' => $buktiDukungPath,
            'status_laporan' => 'menunggu',
        ]);

        session()->flash('message', 'Pengaduan manual berhasil ditambahkan dengan Tiket: ' . $nomorTiket);
        $this->closeModal();
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

    
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteOpen = true;
    }

    public function eliminasiLapdu()
    {
        $id = $this->deleteId;
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
        $this->isDeleteOpen = false;
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
