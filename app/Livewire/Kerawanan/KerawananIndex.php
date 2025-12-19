<?php

namespace App\Livewire\Kerawanan;

use Livewire\Component;
use App\Models\Kerawanan;
use Livewire\WithPagination;

class KerawananIndex extends Component
{
    use WithPagination;

    // Properti (Variabel)
    public $kecamatan, $desa, $jenis_ancaman, $tokoh_kunci, $deskripsi_singkat, $tingkat_rawan;
    public $kerawanan_id;
    public $search = '';
    public $isEditMode = false;
    public $showForm = false;

    // Aturan Validasi
    protected $rules = [
        'kecamatan' => 'required',
        'desa' => 'required',
        'jenis_ancaman' => 'required',
        'deskripsi_singkat' => 'required',
        'tingkat_rawan' => 'required|in:rendah,sedang,tinggi',
    ];

    // Reset pagination saat mencari
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Kerawanan::where('kecamatan', 'like', '%' . $this->search . '%')
            ->orWhere('desa', 'like', '%' . $this->search . '%')
            ->orWhere('jenis_ancaman', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.kerawanan.kerawanan-index', [
            'kerawanans' => $data
        ])->layout('layouts.app');
    }

    // --- METHOD UNTUK MEMBUKA FORM (INI YANG ERROR TADI) ---
    public function create()
    {
        $this->resetInput();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    // --- METHOD UNTUK SIMPAN DATA BARU ---
    public function store()
    {
        $this->validate();

        Kerawanan::create([
            'kecamatan' => $this->kecamatan,
            'desa' => $this->desa,
            'jenis_ancaman' => $this->jenis_ancaman,
            'tokoh_kunci' => $this->tokoh_kunci,
            'deskripsi_singkat' => $this->deskripsi_singkat,
            'tingkat_rawan' => $this->tingkat_rawan,
        ]);

        session()->flash('message', 'Data titik rawan berhasil disimpan!');
        $this->closeModal();
    }

    // --- METHOD UNTUK EDIT ---
    public function edit($id)
    {
        $data = Kerawanan::findOrFail($id);
        $this->kerawanan_id = $id;
        $this->kecamatan = $data->kecamatan;
        $this->desa = $data->desa;
        $this->jenis_ancaman = $data->jenis_ancaman;
        $this->tokoh_kunci = $data->tokoh_kunci;
        $this->deskripsi_singkat = $data->deskripsi_singkat;
        $this->tingkat_rawan = $data->tingkat_rawan;

        $this->isEditMode = true;
        $this->showForm = true;
    }

    // --- METHOD UNTUK UPDATE ---
    public function update()
    {
        $this->validate();

        $data = Kerawanan::find($this->kerawanan_id);
        $data->update([
            'kecamatan' => $this->kecamatan,
            'desa' => $this->desa,
            'jenis_ancaman' => $this->jenis_ancaman,
            'tokoh_kunci' => $this->tokoh_kunci,
            'deskripsi_singkat' => $this->deskripsi_singkat,
            'tingkat_rawan' => $this->tingkat_rawan,
        ]);

        session()->flash('message', 'Data berhasil diperbarui!');
        $this->closeModal();
    }

    // --- METHOD UNTUK DELETE ---
    public function delete($id)
    {
        Kerawanan::find($id)->delete();
        session()->flash('message', 'Data berhasil dihapus!');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->kecamatan = '';
        $this->desa = '';
        $this->jenis_ancaman = '';
        $this->tokoh_kunci = '';
        $this->deskripsi_singkat = '';
        $this->tingkat_rawan = '';
    }
}
