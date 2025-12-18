<?php

namespace App\Livewire\Lapinhar;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Lapinhar;

class LapinharIndex extends Component
{
    use WithPagination;

    // Sesuaikan dengan Model Lapinhar
    public $nomor_surat, $tanggal_surat, $sumber_informasi, $bidang, $peristiwa, $pendapat, $status = 'rahasia';
    public $lapinhar_id;

    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'tanggal_surat' => 'required|date',
        'bidang' => 'required',
        'peristiwa' => 'required',
        'pendapat' => 'required', // Wajib diisi sesuai model
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.lapinhar.lapinhar-index', [
            // Variabel ini harus bernama 'lapinhars' agar cocok dengan View
            'lapinhars' => Lapinhar::where('peristiwa', 'like', '%' . $this->search . '%')
                ->orWhere('bidang', 'like', '%' . $this->search . '%')
                ->orderBy('tanggal_surat', 'desc')
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

        Lapinhar::create([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'sumber_informasi' => $this->sumber_informasi,
            'bidang' => $this->bidang,
            'peristiwa' => $this->peristiwa,
            'pendapat' => $this->pendapat,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Lapinhar berhasil disimpan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Lapinhar::findOrFail($id);
        $this->lapinhar_id = $id;
        $this->nomor_surat = $data->nomor_surat;
        $this->tanggal_surat = $data->tanggal_surat->format('Y-m-d');
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

        $data = Lapinhar::find($this->lapinhar_id);
        $data->update([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'sumber_informasi' => $this->sumber_informasi,
            'bidang' => $this->bidang,
            'peristiwa' => $this->peristiwa,
            'pendapat' => $this->pendapat,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Lapinhar diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Lapinhar::find($id)->delete();
        session()->flash('message', 'Data dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nomor_surat = '';
        $this->tanggal_surat = '';
        $this->sumber_informasi = '';
        $this->bidang = '';
        $this->peristiwa = '';
        $this->pendapat = '';
        $this->status = 'rahasia';
    }
}
