<?php

namespace App\Livewire\Ormas;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Ormas;

class OrmasIndex extends Component
{
    use WithPagination;

    // Form Variables
    public $nama_organisasi, $ketua, $alamat_sekretariat, $bentuk_organisasi, $nomor_legalitas, $jumlah_anggota, $kegiatan_terakhir, $status = 'aktif';
    public $ormas_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'nama_organisasi' => 'required',
        'ketua' => 'required',
        'bentuk_organisasi' => 'required',
        'status' => 'required',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.ormas.ormas-index', [
            'ormas' => Ormas::where('nama_organisasi', 'like', '%' . $this->search . '%') // <-- Nama variabel harus 'ormas'
                ->orWhere('ketua', 'like', '%' . $this->search . '%')
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
            'nama_organisasi' => $this->nama_organisasi,
            'ketua' => $this->ketua,
            'alamat_sekretariat' => $this->alamat_sekretariat,
            'bentuk_organisasi' => $this->bentuk_organisasi,
            'nomor_legalitas' => $this->nomor_legalitas,
            'jumlah_anggota' => $this->jumlah_anggota,
            'kegiatan_terakhir' => $this->kegiatan_terakhir,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data Organisasi berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Ormas::findOrFail($id);
        $this->ormas_id = $id;
        $this->nama_organisasi = $data->nama_organisasi;
        $this->ketua = $data->ketua;
        $this->alamat_sekretariat = $data->alamat_sekretariat;
        $this->bentuk_organisasi = $data->bentuk_organisasi;
        $this->nomor_legalitas = $data->nomor_legalitas;
        $this->jumlah_anggota = $data->jumlah_anggota;
        $this->kegiatan_terakhir = $data->kegiatan_terakhir;
        $this->status = $data->status;

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
        ]);

        session()->flash('message', 'Data Organisasi diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Ormas::find($id)->delete();
        session()->flash('message', 'Data dihapus.');
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
    }
}
