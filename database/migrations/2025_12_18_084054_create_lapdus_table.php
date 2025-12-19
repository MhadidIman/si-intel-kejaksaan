<?php

namespace App\Livewire\Lapdu;

use Livewire\Component;
use App\Models\Lapdu;
use Livewire\WithPagination;

class LapduIndex extends Component
{
    use WithPagination;

    // Properti sesuai Migration Anda
    public $nomor_surat, $tanggal_terima, $nama_pelapor, $no_hp_pelapor, $terlapor, $uraian_pengaduan, $status;
    public $lapdu_id;
    public $search = '';
    public $showForm = false;
    public $isEditMode = false;

    protected $rules = [
        'tanggal_terima' => 'required|date',
        'terlapor' => 'required',
        'uraian_pengaduan' => 'required',
        'status' => 'required|in:masuk,telaah,lid,arsipkan',
    ];

    public function render()
    {
        $data = Lapdu::where('nama_pelapor', 'like', '%' . $this->search . '%')
            ->orWhere('terlapor', 'like', '%' . $this->search . '%')
            ->orWhere('uraian_pengaduan', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.lapdu.lapdu-index', ['lapdus' => $data])
            ->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInput();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate();

        Lapdu::create([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'nama_pelapor' => $this->nama_pelapor,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'terlapor' => $this->terlapor,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Pengaduan berhasil disimpan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Lapdu::findOrFail($id);
        $this->lapdu_id = $id;
        $this->nomor_surat = $data->nomor_surat;
        $this->tanggal_terima = $data->tanggal_terima;
        $this->nama_pelapor = $data->nama_pelapor;
        $this->no_hp_pelapor = $data->no_hp_pelapor;
        $this->terlapor = $data->terlapor;
        $this->uraian_pengaduan = $data->uraian_pengaduan;
        $this->status = $data->status;

        $this->isEditMode = true;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate();
        $data = Lapdu::find($this->lapdu_id);
        $data->update([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'nama_pelapor' => $this->nama_pelapor,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'terlapor' => $this->terlapor,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Lapdu::find($id)->delete();
        session()->flash('message', 'Data dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->nomor_surat = '';
        $this->tanggal_terima = '';
        $this->nama_pelapor = '';
        $this->no_hp_pelapor = '';
        $this->terlapor = '';
        $this->uraian_pengaduan = '';
        $this->status = 'masuk';
    }
}
