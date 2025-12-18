<?php

namespace App\Livewire\Lapinhar;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Lapinhar;

class LapinharIndex extends Component
{
    use WithPagination;

    // Variables untuk Form
    public $nomor_surat, $tanggal_surat, $sumber_informasi, $bidang, $peristiwa, $pendapat, $status = 'rahasia';
    public $lapinhar_id;

    // Variables untuk UI
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Validasi
    protected $rules = [
        'nomor_surat' => 'required',
        'tanggal_surat' => 'required|date',
        'sumber_informasi' => 'required',
        'bidang' => 'required',
        'peristiwa' => 'required',
        'pendapat' => 'required',
        'status' => 'required',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        $data = Lapinhar::where('peristiwa', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_surat', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.lapinhar.lapinhar-index', [
            'lapinhars' => $data
        ]);
    }

    // Tampilkan Form Tambah
    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    // Simpan Data Baru
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

        session()->flash('message', 'Data Lapinhar berhasil ditambahkan.');
        $this->closeModal();
    }

    // Ambil Data untuk Edit
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

    // Update Data
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

        session()->flash('message', 'Data berhasil diperbarui.');
        $this->closeModal();
    }

    // Hapus Data
    public function delete($id)
    {
        Lapinhar::find($id)->delete();
        session()->flash('message', 'Data berhasil dihapus.');
    }

    // Tutup Form & Reset
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
