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
        $this->showDetailModal = true;
    }

    public function tutupDetail()
    {
        $this->showDetailModal = false;
        $this->selectedLapduId = null;
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
