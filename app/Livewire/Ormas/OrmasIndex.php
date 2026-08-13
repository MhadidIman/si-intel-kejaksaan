<?php

namespace App\Livewire\Ormas;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Ormas;
use Illuminate\Support\Facades\Auth;

class OrmasIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination;

    // Form Variables
    public $nama_organisasi, $ketua, $alamat_sekretariat, $bentuk_organisasi, $nomor_legalitas, $jumlah_anggota, $kegiatan_terakhir;
    public $status = 'aktif'; // Status Aktivitas
    public $status_verifikasi = 'pending'; // Status Verifikasi
    public $ormas_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Modal Status
    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'nama_organisasi' => 'required',
        'ketua' => 'required',
        'bentuk_organisasi' => 'required',
        'status' => 'required',
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
        // Pastikan User model punya fungsi isAdmin() atau cek role manual
        if (Auth::user()->role === 'admin' && $this->targetId) {
            Ormas::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status verifikasi berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }
    // -------------------------

    #[Layout('layouts.app')]
    public function render()
    {
        // TAMBAHKAN ::with('user') UNTUK MEMANGGIL NAMA PENGINPUT
        return view('livewire.ormas.ormas-index', [
            'ormas' => Ormas::with('user')
                ->where(function ($query) {
                    $query->where('nama_organisasi', 'like', '%' . $this->search . '%')
                        ->orWhere('ketua', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
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

        Ormas::create([
            'user_id' => Auth::id(), // ID Penginput
            'nama_organisasi' => $this->nama_organisasi,
            'ketua' => $this->ketua,
            'alamat_sekretariat' => $this->alamat_sekretariat,
            'bentuk_organisasi' => $this->bentuk_organisasi,
            'nomor_legalitas' => $this->nomor_legalitas,
            'jumlah_anggota' => $this->jumlah_anggota,
            'kegiatan_terakhir' => $this->kegiatan_terakhir,
            'status' => $this->status,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Data Organisasi berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Ormas::findOrFail($id);

        // Cek Role Admin Manual agar tidak error method isAdmin()
        if ($data->status_verifikasi === 'disetujui' && Auth::user()->role !== 'admin') {
            session()->flash('message', 'Data yang sudah divalidasi tidak dapat diubah.');
            return;
        }

        $this->ormas_id = $id;
        $this->nama_organisasi = $data->nama_organisasi;
        $this->ketua = $data->ketua;
        $this->alamat_sekretariat = $data->alamat_sekretariat;
        $this->bentuk_organisasi = $data->bentuk_organisasi;
        $this->nomor_legalitas = $data->nomor_legalitas;
        $this->jumlah_anggota = $data->jumlah_anggota;
        $this->kegiatan_terakhir = $data->kegiatan_terakhir;
        $this->status = $data->status;
        $this->status_verifikasi = $data->status_verifikasi;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();

        $data = Ormas::find($this->ormas_id);

        $data->update([
            'nama_organisasi' => $this->nama_organisasi,
            'ketua' => $this->ketua,
            'alamat_sekretariat' => $this->alamat_sekretariat,
            'bentuk_organisasi' => $this->bentuk_organisasi,
            'nomor_legalitas' => $this->nomor_legalitas,
            'jumlah_anggota' => $this->jumlah_anggota,
            'kegiatan_terakhir' => $this->kegiatan_terakhir,
            'status' => $this->status,
            // Cek role admin manual
            'status_verifikasi' => Auth::user()->role === 'admin' ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data Organisasi diperbarui.');
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

        Ormas::find($id)->delete();
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
        $this->nama_organisasi = '';
        $this->ketua = '';
        $this->alamat_sekretariat = '';
        $this->bentuk_organisasi = '';
        $this->nomor_legalitas = '';
        $this->jumlah_anggota = 0;
        $this->kegiatan_terakhir = '';
        $this->status = 'aktif';
        $this->status_verifikasi = 'pending';
    }
}
