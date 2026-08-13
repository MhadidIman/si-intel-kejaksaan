<?php

namespace App\Livewire\Lapinhar;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Lapinhar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LapinharIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination;

    // Properti Data
    public $nomor_surat, $tanggal_surat, $sumber_informasi, $bidang, $peristiwa, $pendapat;
    public $status = 'rahasia';
    public $status_verifikasi = 'pending';
    public $lapinhar_id;

    // State UI
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Mengontrol munculnya modal
    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'nomor_surat' => 'required',
        'tanggal_surat' => 'required|date',
        'sumber_informasi' => 'required',
        'bidang' => 'required',
        'peristiwa' => 'required',
        'pendapat' => 'required',
        'status' => 'required|in:rahasia,biasa',
    ];

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
        if (Auth::user()->role === 'admin' && $this->targetId) {
            Lapinhar::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status laporan berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        // REVISI: Tambahkan with('user') agar nama penginput bisa ditarik
        $lapinhars = Lapinhar::with('user')
            ->where(function ($query) {
                $query->where('peristiwa', 'like', '%' . $this->search . '%')
                    ->orWhere('bidang', 'like', '%' . $this->search . '%')
                    ->orWhere('nomor_surat', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.lapinhar.lapinhar-index', [
            'lapinhars' => $lapinhars
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

        Lapinhar::create([
            'user_id' => Auth::id(),
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'sumber_informasi' => $this->sumber_informasi,
            'bidang' => $this->bidang,
            'peristiwa' => $this->peristiwa,
            'pendapat' => $this->pendapat,
            'status' => $this->status,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Laporan berhasil disimpan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Lapinhar::findOrFail($id);

        if ($data->status_verifikasi === 'disetujui' && Auth::user()->role !== 'admin') {
            session()->flash('message', 'Laporan yang sudah disetujui tidak dapat diedit.');
            return;
        }

        $this->lapinhar_id = $id;
        $this->nomor_surat = $data->nomor_surat;
        $this->tanggal_surat = Carbon::parse($data->tanggal_surat)->format('Y-m-d');
        $this->sumber_informasi = $data->sumber_informasi;
        $this->bidang = $data->bidang;
        $this->peristiwa = $data->peristiwa;
        $this->pendapat = $data->pendapat;
        $this->status = $data->status;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $data = Lapinhar::findOrFail($this->lapinhar_id);

        $data->update([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'sumber_informasi' => $this->sumber_informasi,
            'bidang' => $this->bidang,
            'peristiwa' => $this->peristiwa,
            'pendapat' => $this->pendapat,
            'status' => $this->status,
            'status_verifikasi' => Auth::user()->role === 'admin' ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Laporan berhasil diperbarui.');
        $this->closeModal();
    }

    
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteOpen = true;
    }

    public function delete()
    {
        $id = $this->deleteId;
        // REVISI KEAMANAN: Pastikan hanya admin yang bisa hapus dari backend
        if (Auth::user()->role !== 'admin') {
            session()->flash('error', 'Akses Ditolak! Anda bukan admin.');
            return;
        }

        Lapinhar::findOrFail($id)->delete();
        session()->flash('message', 'Data dihapus.');
        $this->isDeleteOpen = false;
        $this->isDeleteOpen = false;
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nomor_surat = '';
        $this->tanggal_surat = date('Y-m-d');
        $this->sumber_informasi = '';
        $this->bidang = '';
        $this->peristiwa = '';
        $this->pendapat = '';
        $this->status = 'rahasia';
        $this->lapinhar_id = null;
    }
}
