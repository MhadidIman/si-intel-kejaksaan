<?php

namespace App\Livewire\Dpo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Wajib untuk upload file
use Livewire\Attributes\Layout;
use App\Models\Dpo;
use Illuminate\Support\Facades\Storage;

class DpoIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Variables Form
    public $nama_lengkap, $tempat_lahir, $tanggal_lahir, $kasus, $status_hukum, $ciri_fisik, $status_pencarian = 'buron';
    public $foto; // Untuk file upload baru
    public $foto_lama; // Untuk menyimpan path foto lama saat edit
    public $dpo_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'nama_lengkap' => 'required',
        'kasus' => 'required',
        'status_hukum' => 'required',
        'foto' => 'nullable|image|max:2048', // Max 2MB, harus gambar
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dpo.dpo-index', [
            'dpos' => Dpo::where('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orWhere('kasus', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(8)
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
            // Simpan ke folder: storage/app/public/dpo-photos
            $path_foto = $this->foto->store('dpo-photos', 'public');
        }

        Dpo::create([
            'nama_lengkap' => $this->nama_lengkap,
            'tempat_lahir' => $this->tempat_lahir,
            // PERBAIKAN: Ubah string kosong jadi NULL agar tidak error di MySQL
            'tanggal_lahir' => $this->tanggal_lahir ?: null,
            'kasus' => $this->kasus,
            'status_hukum' => $this->status_hukum,
            'ciri_fisik' => $this->ciri_fisik,
            'status_pencarian' => $this->status_pencarian,
            'foto' => $path_foto,
        ]);

        session()->flash('message', 'Data DPO berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $dpo = Dpo::findOrFail($id);
        $this->dpo_id = $id;
        $this->nama_lengkap = $dpo->nama_lengkap;
        $this->tempat_lahir = $dpo->tempat_lahir;
        // Format tanggal agar bisa terbaca oleh input type="date"
        $this->tanggal_lahir = $dpo->tanggal_lahir ? $dpo->tanggal_lahir->format('Y-m-d') : null;
        $this->kasus = $dpo->kasus;
        $this->status_hukum = $dpo->status_hukum;
        $this->ciri_fisik = $dpo->ciri_fisik;
        $this->status_pencarian = $dpo->status_pencarian;
        $this->foto_lama = $dpo->foto; // Simpan path lama

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $dpo = Dpo::find($this->dpo_id);

        $path_foto = $dpo->foto; // Default pakai foto lama

        // Jika user upload foto baru
        if ($this->foto) {
            // Hapus foto lama jika ada
            if ($dpo->foto && Storage::disk('public')->exists($dpo->foto)) {
                Storage::disk('public')->delete($dpo->foto);
            }
            // Simpan foto baru
            $path_foto = $this->foto->store('dpo-photos', 'public');
        }

        $dpo->update([
            'nama_lengkap' => $this->nama_lengkap,
            'tempat_lahir' => $this->tempat_lahir,
            // PERBAIKAN: Ubah string kosong jadi NULL
            'tanggal_lahir' => $this->tanggal_lahir ?: null,
            'kasus' => $this->kasus,
            'status_hukum' => $this->status_hukum,
            'ciri_fisik' => $this->ciri_fisik,
            'status_pencarian' => $this->status_pencarian,
            'foto' => $path_foto,
        ]);

        session()->flash('message', 'Data DPO berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $dpo = Dpo::find($id);
        // Hapus file foto fisik saat data dihapus
        if ($dpo->foto && Storage::disk('public')->exists($dpo->foto)) {
            Storage::disk('public')->delete($dpo->foto);
        }
        $dpo->delete();
        session()->flash('message', 'Data DPO dihapus.');
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
    }
}
