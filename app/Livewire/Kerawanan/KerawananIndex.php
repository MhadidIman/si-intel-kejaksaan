<?php

namespace App\Livewire\Kerawanan;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Kerawanan;

class KerawananIndex extends Component
{
    use WithPagination;

    // Form Variables
    public $kecamatan, $desa, $jenis_ancaman, $tokoh_kunci, $deskripsi_singkat, $tingkat_rawan = 'rendah';
    public $kerawanan_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'kecamatan' => 'required',
        'desa' => 'required',
        'jenis_ancaman' => 'required',
        'tingkat_rawan' => 'required',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        // Urutkan berdasarkan tingkat kerawanan (Tinggi duluan biar warning)
        return view('livewire.kerawanan.kerawanan-index', [
            'data_peta' => Kerawanan::where('kecamatan', 'like', '%' . $this->search . '%')
                ->orWhere('desa', 'like', '%' . $this->search . '%')
                ->orWhere('jenis_ancaman', 'like', '%' . $this->search . '%')
                ->orderByRaw("FIELD(tingkat_rawan, 'tinggi', 'sedang', 'rendah')")
                ->paginate(12) // Grid layout butuh banyak item
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

        Kerawanan::create([
            'kecamatan' => $this->kecamatan,
            'desa' => $this->desa,
            'jenis_ancaman' => $this->jenis_ancaman,
            'tokoh_kunci' => $this->tokoh_kunci,
            'deskripsi_singkat' => $this->deskripsi_singkat,
            'tingkat_rawan' => $this->tingkat_rawan,
        ]);

        session()->flash('message', 'Data Peta Kerawanan ditambahkan.');
        $this->closeModal();
    }

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

        $this->showForm = true;
        $this->isEditMode = true;
    }

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

        session()->flash('message', 'Data diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Kerawanan::find($id)->delete();
        session()->flash('message', 'Data dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->kecamatan = '';
        $this->desa = '';
        $this->jenis_ancaman = '';
        $this->tokoh_kunci = '';
        $this->deskripsi_singkat = '';
        $this->tingkat_rawan = 'rendah';
    }
}
