<?php

namespace App\Livewire\Lapdu;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Lapdu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LapduIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Properti Data
    public $nomor_surat, $tanggal_terima, $nama_pelapor, $nik, $no_hp_pelapor, $nama_terlapor, $kategori_laporan, $uraian_pengaduan, $keterangan_tindak_lanjut;

    // Status
    public $status_laporan = 'menunggu';
    public $status_verifikasi = 'pending';

    public $bukti_dukung, $bukti_lama;
    public $lapdu_id;

    // UI
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Modal Status Admin
    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'nama_pelapor' => 'required',
        'uraian_pengaduan' => 'required',
        'kategori_laporan' => 'required',
        'status_laporan' => 'required',
        'tanggal_terima' => 'nullable|date', // Tambahkan validasi tanggal
        'bukti_dukung' => 'nullable|file|max:10240', // Max 10MB
    ];

    // --- LOGIKA VERIFIKASI ADMIN ---
    public function openStatusModal($id)
    {
        $this->targetId = $id;
        $this->showStatusModal = true;
    }

    public function closeStatusModal()
    {
        $this->showStatusModal = false;
        $this->targetId = null;
    }

    public function updateStatus($newStatus)
    {
        if (Auth::user()->isAdmin() && $this->targetId) {
            Lapdu::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status Verifikasi berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $data = Lapdu::where(function ($query) {
            $query->where('nama_pelapor', 'like', '%' . $this->search . '%')
                ->orWhere('uraian_pengaduan', 'like', '%' . $this->search . '%')
                ->orWhere('nama_terlapor', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.lapdu.lapdu-index', [
            'lapdus' => $data
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate();

        $path = null;
        if ($this->bukti_dukung) {
            $path = $this->bukti_dukung->store('lapdu-files', 'public');
        }

        // PERBAIKAN: Gunakan operator ?: null untuk menangani string kosong
        Lapdu::create([
            'user_id' => Auth::id(),
            'nomor_surat' => $this->nomor_surat ?: null,
            'tanggal_terima' => $this->tanggal_terima ?: null, // <-- Solusi Error Date
            'nama_pelapor' => $this->nama_pelapor,
            'nik' => $this->nik ?: null,
            'no_hp_pelapor' => $this->no_hp_pelapor ?: null,
            'nama_terlapor' => $this->nama_terlapor ?: null,
            'kategori_laporan' => $this->kategori_laporan,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'status_laporan' => $this->status_laporan,
            'keterangan_tindak_lanjut' => $this->keterangan_tindak_lanjut ?: null,
            'bukti_dukung' => $path,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Laporan Pengaduan berhasil diterima.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Lapdu::findOrFail($id);

        if ($data->status_verifikasi === 'disetujui' && !Auth::user()->isAdmin()) {
            session()->flash('message', 'Laporan yang sudah disetujui tidak dapat diubah.');
            return;
        }

        $this->lapdu_id = $id;
        $this->nomor_surat = $data->nomor_surat;
        $this->tanggal_terima = $data->tanggal_terima ? $data->tanggal_terima->format('Y-m-d') : null;
        $this->nama_pelapor = $data->nama_pelapor;
        $this->nik = $data->nik;
        $this->no_hp_pelapor = $data->no_hp_pelapor;
        $this->nama_terlapor = $data->nama_terlapor;
        $this->kategori_laporan = $data->kategori_laporan;
        $this->uraian_pengaduan = $data->uraian_pengaduan;
        $this->status_laporan = $data->status_laporan;
        $this->keterangan_tindak_lanjut = $data->keterangan_tindak_lanjut;
        $this->bukti_lama = $data->bukti_dukung;
        $this->status_verifikasi = $data->status_verifikasi;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $data = Lapdu::findOrFail($this->lapdu_id);

        $path = $data->bukti_dukung;
        if ($this->bukti_dukung) {
            if ($data->bukti_dukung && Storage::disk('public')->exists($data->bukti_dukung)) {
                Storage::disk('public')->delete($data->bukti_dukung);
            }
            $path = $this->bukti_dukung->store('lapdu-files', 'public');
        }

        // PERBAIKAN: Gunakan operator ?: null disini juga
        $data->update([
            'nomor_surat' => $this->nomor_surat ?: null,
            'tanggal_terima' => $this->tanggal_terima ?: null, // <-- Solusi Error Date
            'nama_pelapor' => $this->nama_pelapor,
            'nik' => $this->nik ?: null,
            'no_hp_pelapor' => $this->no_hp_pelapor ?: null,
            'nama_terlapor' => $this->nama_terlapor ?: null,
            'kategori_laporan' => $this->kategori_laporan,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'status_laporan' => $this->status_laporan,
            'keterangan_tindak_lanjut' => $this->keterangan_tindak_lanjut ?: null,
            'bukti_dukung' => $path,
            'status_verifikasi' => Auth::user()->isAdmin() ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data Pengaduan diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $data = Lapdu::findOrFail($id);
        if ($data->bukti_dukung && Storage::disk('public')->exists($data->bukti_dukung)) {
            Storage::disk('public')->delete($data->bukti_dukung);
        }
        $data->delete();
        session()->flash('message', 'Data dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nomor_surat = '';
        $this->tanggal_terima = '';
        $this->nama_pelapor = '';
        $this->nik = '';
        $this->no_hp_pelapor = '';
        $this->nama_terlapor = '';
        $this->kategori_laporan = '';
        $this->uraian_pengaduan = '';
        $this->status_laporan = 'menunggu';
        $this->keterangan_tindak_lanjut = '';
        $this->bukti_dukung = null;
        $this->bukti_lama = null;
        $this->status_verifikasi = 'pending';
    }
}
