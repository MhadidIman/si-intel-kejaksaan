<?php

namespace App\Livewire\Wna;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Wna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class WnaIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination, WithFileUploads;

    // VARIABEL DISESUAIKAN DENGAN DATABASE
    public $nama_lengkap, $nomor_paspor, $kebangsaan, $tanggal_tiba, $masa_berlaku_izin_tinggal, $tujuan_kunjungan, $sponsor, $alamat_menginap;
    public $foto_dokumen, $foto_dokumen_lama;
    public $wna_id;

    public $status_verifikasi = 'pending';
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'nama_lengkap' => 'required',
        'nomor_paspor' => 'required',
        'kebangsaan' => 'required',
        'masa_berlaku_izin_tinggal' => 'required|date',
        'tujuan_kunjungan' => 'required',
        'alamat_menginap' => 'required',
        'foto_dokumen' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
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
            Wna::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status Verifikasi WNA berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $wnas = Wna::with('user')
            ->where(function ($query) {
                // PENCARIAN DISESUAIKAN DENGAN NAMA KOLOM DATABASE
                $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                    ->orWhere('kebangsaan', 'like', '%' . $this->search . '%')
                    ->orWhere('nomor_paspor', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('livewire.wna.wna-index', [
            'wnas' => $wnas
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

        $path_dokumen = null;
        if ($this->foto_dokumen) {
            $path_dokumen = $this->foto_dokumen->store('wna-dokumen', 'public');
        }

        Wna::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_paspor' => $this->nomor_paspor,
            'kebangsaan' => $this->kebangsaan,
            'tanggal_tiba' => $this->tanggal_tiba ?: null,
            'masa_berlaku_izin_tinggal' => $this->masa_berlaku_izin_tinggal,
            'tujuan_kunjungan' => $this->tujuan_kunjungan,
            'sponsor' => $this->sponsor,
            'alamat_menginap' => $this->alamat_menginap,
            'foto_dokumen' => $path_dokumen,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Data WNA berhasil ditambahkan & menunggu verifikasi.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $wna = Wna::findOrFail($id);

        if ($wna->status_verifikasi === 'disetujui' && Auth::user()->role !== 'admin') {
            session()->flash('message', 'Data WNA yang sudah divalidasi tidak dapat diubah.');
            return;
        }

        $this->wna_id = $id;
        $this->nama_lengkap = $wna->nama_lengkap;
        $this->nomor_paspor = $wna->nomor_paspor;
        $this->kebangsaan = $wna->kebangsaan;
        $this->tanggal_tiba = $wna->tanggal_tiba ? Carbon::parse($wna->tanggal_tiba)->format('Y-m-d') : null;
        $this->masa_berlaku_izin_tinggal = $wna->masa_berlaku_izin_tinggal ? Carbon::parse($wna->masa_berlaku_izin_tinggal)->format('Y-m-d') : null;
        $this->tujuan_kunjungan = $wna->tujuan_kunjungan;
        $this->sponsor = $wna->sponsor;
        $this->alamat_menginap = $wna->alamat_menginap;
        $this->foto_dokumen_lama = $wna->foto_dokumen;
        $this->status_verifikasi = $wna->status_verifikasi;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $wna = Wna::find($this->wna_id);

        $path_dokumen = $wna->foto_dokumen;
        if ($this->foto_dokumen) {
            if ($wna->foto_dokumen && Storage::disk('public')->exists($wna->foto_dokumen)) {
                Storage::disk('public')->delete($wna->foto_dokumen);
            }
            $path_dokumen = $this->foto_dokumen->store('wna-dokumen', 'public');
        }

        $wna->update([
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_paspor' => $this->nomor_paspor,
            'kebangsaan' => $this->kebangsaan,
            'tanggal_tiba' => $this->tanggal_tiba ?: null,
            'masa_berlaku_izin_tinggal' => $this->masa_berlaku_izin_tinggal,
            'tujuan_kunjungan' => $this->tujuan_kunjungan,
            'sponsor' => $this->sponsor,
            'alamat_menginap' => $this->alamat_menginap,
            'foto_dokumen' => $path_dokumen,
            'status_verifikasi' => Auth::user()->role === 'admin' ? $wna->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data Pengawasan WNA berhasil diperbarui.');
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
        if (Auth::user()->role !== 'admin') {
            session()->flash('message', 'Akses Ditolak! Hanya Admin yang berhak menghapus data.');
        $this->isDeleteOpen = false;
            return;
        }

        $wna = Wna::find($id);
        if ($wna->foto_dokumen && Storage::disk('public')->exists($wna->foto_dokumen)) {
            Storage::disk('public')->delete($wna->foto_dokumen);
        }
        $wna->delete();
        session()->flash('message', 'Data WNA dihapus.');
        $this->isDeleteOpen = false;
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nama_lengkap = '';
        $this->nomor_paspor = '';
        $this->kebangsaan = '';
        $this->tanggal_tiba = '';
        $this->masa_berlaku_izin_tinggal = '';
        $this->tujuan_kunjungan = '';
        $this->sponsor = '';
        $this->alamat_menginap = '';
        $this->foto_dokumen = null;
        $this->foto_dokumen_lama = null;
        $this->status_verifikasi = 'pending';
    }
}
