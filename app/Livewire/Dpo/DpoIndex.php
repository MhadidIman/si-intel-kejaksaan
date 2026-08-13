<?php

namespace App\Livewire\Dpo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Dpo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DpoIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination, WithFileUploads;

    // Variables Form
    public $nama_lengkap, $tempat_lahir, $tanggal_lahir, $kasus, $status_hukum, $ciri_fisik, $status_pencarian = 'buron';
    public $foto;
    public $foto_lama;
    public $dpo_id;

    // Status Verifikasi
    public $status_verifikasi = 'pending';

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // MODAL STATUS VARIABLES
    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'nama_lengkap' => 'required',
        'kasus' => 'required',
        'status_hukum' => 'required',
        'foto' => 'nullable|image|max:2048',
    ];

    // --- LOGIKA VERIFIKASI ---
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
            Dpo::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status DPO berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }
    // ------------------------------------------------

    #[Layout('layouts.app')]
    public function render()
    {
        // TAMBAHKAN ::with('user') UNTUK MEMANGGIL NAMA PENGINPUT
        $dpos = Dpo::with('user')
            ->where(function ($query) {
                $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                    ->orWhere('kasus', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('livewire.dpo.dpo-index', [
            'dpos' => $dpos
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

        $path_foto = null;
        if ($this->foto) {
            $path_foto = $this->foto->store('dpo-photos', 'public');
        }

        Dpo::create([
            'user_id' => Auth::id(), // ID Penginput
            'nama_lengkap' => $this->nama_lengkap,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir ?: null,
            'kasus' => $this->kasus,
            'status_hukum' => $this->status_hukum,
            'ciri_fisik' => $this->ciri_fisik,
            'status_pencarian' => $this->status_pencarian,
            'foto' => $path_foto,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Data DPO berhasil ditambahkan & menunggu verifikasi.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $dpo = Dpo::findOrFail($id);

        if ($dpo->status_verifikasi === 'disetujui' && Auth::user()->role !== 'admin') {
            session()->flash('message', 'Data DPO yang sudah divalidasi tidak dapat diubah.');
            return;
        }

        $this->dpo_id = $id;
        $this->nama_lengkap = $dpo->nama_lengkap;
        $this->tempat_lahir = $dpo->tempat_lahir;
        $this->tanggal_lahir = $dpo->tanggal_lahir ? Carbon::parse($dpo->tanggal_lahir)->format('Y-m-d') : null;
        $this->kasus = $dpo->kasus;
        $this->status_hukum = $dpo->status_hukum;
        $this->ciri_fisik = $dpo->ciri_fisik;
        $this->status_pencarian = $dpo->status_pencarian;
        $this->foto_lama = $dpo->foto;
        $this->status_verifikasi = $dpo->status_verifikasi;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $dpo = Dpo::find($this->dpo_id);

        $path_foto = $dpo->foto;

        if ($this->foto) {
            if ($dpo->foto && Storage::disk('public')->exists($dpo->foto)) {
                Storage::disk('public')->delete($dpo->foto);
            }
            $path_foto = $this->foto->store('dpo-photos', 'public');
        }

        $dpo->update([
            'nama_lengkap' => $this->nama_lengkap,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir ?: null,
            'kasus' => $this->kasus,
            'status_hukum' => $this->status_hukum,
            'ciri_fisik' => $this->ciri_fisik,
            'status_pencarian' => $this->status_pencarian,
            'foto' => $path_foto,
            'status_verifikasi' => Auth::user()->role === 'admin' ? $dpo->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data DPO berhasil diperbarui.');
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
        // KODE KEAMANAN: HANYA ADMIN YANG BISA MENGHAPUS
        if (Auth::user()->role !== 'admin') {
            session()->flash('message', 'Akses Ditolak! Hanya Admin yang berhak menghapus data.');
        $this->isDeleteOpen = false;
            return;
        }

        $dpo = Dpo::find($id);
        if ($dpo->foto && Storage::disk('public')->exists($dpo->foto)) {
            Storage::disk('public')->delete($dpo->foto);
        }
        $dpo->delete();
        session()->flash('message', 'Data DPO dihapus.');
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
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->kasus = '';
        $this->status_hukum = '';
        $this->ciri_fisik = '';
        $this->foto = null;
        $this->foto_lama = null;
        $this->status_pencarian = 'buron';
        $this->status_verifikasi = 'pending';
    }
}
