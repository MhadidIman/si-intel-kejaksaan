<?php

namespace App\Livewire\PamSdo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\PamSdo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PamSdoIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination, WithFileUploads;

    // Form Variables
    public $nama_pegawai, $nip_nrp, $pangkat_jabatan, $satuan_kerja, $permasalahan, $keterangan, $status_pam = 'diawasi';
    public $foto, $foto_lama;
    public $status_verifikasi = 'pending';
    public $pam_sdo_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Modal Status
    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'nama_pegawai' => 'required',
        'pangkat_jabatan' => 'required',
        'permasalahan' => 'required',
        'status_pam' => 'required',
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
        // Pengecekan Manual Role Admin
        if (Auth::user()->role === 'admin' && $this->targetId) {
            PamSdo::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status PAM SDO berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }
    // -------------------------

    #[Layout('layouts.app')]
    public function render()
    {
        // TAMBAHKAN ::with('user') UNTUK MENGAMBIL NAMA PENGINPUT
        return view('livewire.pam-sdo.pam-sdo-index', [
            'pamsdos' => PamSdo::with('user')
                ->where(function ($query) {
                    $query->where('nama_pegawai', 'like', '%' . $this->search . '%')
                        ->orWhere('nip_nrp', 'like', '%' . $this->search . '%');
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

        $path = null;
        if ($this->foto) {
            $path = $this->foto->store('pamsdo-photos', 'public');
        }

        PamSdo::create([
            'user_id' => Auth::id(), // <--- WAJIB: ID Penginput
            'nama_pegawai' => $this->nama_pegawai,
            'nip_nrp' => $this->nip_nrp,
            'pangkat_jabatan' => $this->pangkat_jabatan,
            'satuan_kerja' => $this->satuan_kerja,
            'permasalahan' => $this->permasalahan,
            'keterangan' => $this->keterangan,
            'status_pam' => $this->status_pam,
            'foto' => $path,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Data PAM SDO berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = PamSdo::findOrFail($id);

        // Cek Role Admin Manual
        if ($data->status_verifikasi === 'disetujui' && Auth::user()->role !== 'admin') {
            session()->flash('message', 'Data yang sudah divalidasi tidak dapat diubah.');
            return;
        }

        $this->pam_sdo_id = $id;
        $this->nama_pegawai = $data->nama_pegawai;
        $this->nip_nrp = $data->nip_nrp;
        $this->pangkat_jabatan = $data->pangkat_jabatan;
        $this->satuan_kerja = $data->satuan_kerja;
        $this->permasalahan = $data->permasalahan;
        $this->keterangan = $data->keterangan;
        $this->status_pam = $data->status_pam;
        $this->foto_lama = $data->foto;
        $this->status_verifikasi = $data->status_verifikasi;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $data = PamSdo::findOrFail($this->pam_sdo_id);

        $path = $data->foto;
        if ($this->foto) {
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }
            $path = $this->foto->store('pamsdo-photos', 'public');
        }

        $data->update([
            'nama_pegawai' => $this->nama_pegawai,
            'nip_nrp' => $this->nip_nrp,
            'pangkat_jabatan' => $this->pangkat_jabatan,
            'satuan_kerja' => $this->satuan_kerja,
            'permasalahan' => $this->permasalahan,
            'keterangan' => $this->keterangan,
            'status_pam' => $this->status_pam,
            'foto' => $path,
            // Reset ke pending jika diedit staff
            'status_verifikasi' => Auth::user()->role === 'admin' ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data PAM SDO diperbarui.');
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

        $data = PamSdo::findOrFail($id);
        if ($data->foto && Storage::disk('public')->exists($data->foto)) {
            Storage::disk('public')->delete($data->foto);
        }
        $data->delete();
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
        $this->nama_pegawai = '';
        $this->nip_nrp = '';
        $this->pangkat_jabatan = '';
        $this->satuan_kerja = '';
        $this->permasalahan = '';
        $this->keterangan = '';
        $this->status_pam = 'diawasi';
        $this->foto = null;
        $this->foto_lama = null;
        $this->status_verifikasi = 'pending';
    }
}
