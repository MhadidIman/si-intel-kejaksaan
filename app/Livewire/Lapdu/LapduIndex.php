<?php

namespace App\Livewire\Lapdu;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lapdu;
use Illuminate\Support\Facades\Storage;

class LapduIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    // Properti untuk manajemen modal detail
    public $selectedLapduId = null;
    public $showDetailModal = false;

    // Properti untuk Sprintug
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

        // Tarik data sprintug jika sudah pernah diisi
        $this->nomor_sprintug = $lapdu->nomor_sprintug ?? '';
        $this->tanggal_sprintug = $lapdu->tanggal_sprintug ?? '';

        $this->showDetailModal = true;
    }

    public function tutupDetail()
    {
        $this->showDetailModal = false;
        $this->selectedLapduId = null;
    }

    // Fungsi Baru: Menyimpan Sprintug sekaligus ubah status
    public function simpanSprintug()
    {
        $lapdu = Lapdu::findOrFail($this->selectedLapduId);

        $lapdu->update([
            'nomor_sprintug' => $this->nomor_sprintug,
            'tanggal_sprintug' => $this->tanggal_sprintug,
            'status_laporan' => 'diproses' // Otomatis naik status
        ]);

        session()->flash('message', 'Surat Perintah Tugas (Sprintug) berhasil diterbitkan. Status laporan naik menjadi "Proses Telaah".');
    }

    public function perbaruiStatus($id, $statusBaru)
    {
        $lapdu = Lapdu::findOrFail($id);
        $lapdu->update([
            'status_laporan' => $statusBaru
        ]);

        session()->flash('message', 'Status rincian laporan ' . $lapdu->nomor_tiket . ' berhasil diperbarui.');
    }

    public function eliminasiLapdu($id)
    {
        // Proteksi Otoritas: Hanya Admin yang diizinkan menghapus dokumen rahasia negara
        if (!auth()->user()->isAdmin()) {
            session()->flash('error', 'Otorisasi ditolak. Anda tidak memiliki akses menghapus data arsip.');
            return;
        }

        $lapdu = Lapdu::findOrFail($id);

        // Hapus file lampiran dari storage publik jika ada
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

        // Fitur Pencarian Cerdas Multi-Kolom
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nomor_tiket', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_terlapor', 'like', '%' . $this->search . '%')
                    ->orWhere('judul_laporan', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_pelapor', 'like', '%' . $this->search . '%');
            });
        }

        // Fitur Filter Status Operasional
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
