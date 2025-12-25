<?php

namespace App\Livewire\Lapdu;

use Livewire\Component;
use App\Models\Lapdu;
use Livewire\WithPagination;

class LapduIndex extends Component
{
    use WithPagination;

    // Properti sesuai Migration & Form
    public $nomor_surat, $tanggal_terima, $nama_pelapor, $no_hp_pelapor, $terlapor, $uraian_pengaduan, $disposisi_pimpinan, $status;
    public $lapdu_id;

    public $search = '';
    public $showForm = false;
    public $isEditMode = false;

    // Aturan Validasi
    protected $rules = [
        'tanggal_terima' => 'required|date',
        'terlapor' => 'required|min:3',
        'uraian_pengaduan' => 'required',
        'status' => 'required|in:masuk,telaah,lid,arsipkan',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Lapdu::where(function ($query) {
            $query->where('nama_pelapor', 'like', '%' . $this->search . '%')
                ->orWhere('terlapor', 'like', '%' . $this->search . '%')
                ->orWhere('uraian_pengaduan', 'like', '%' . $this->search . '%');
        })
            ->latest()
            ->paginate(10);

        return view('livewire.lapdu.lapdu-index', [
            'lapdus' => $data
        ])->layout('layouts.app');
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
            // KUNCI PERBAIKAN: Menyimpan ID user penginput untuk Dashboard Admin
            'user_id' => auth()->id(),

            'nomor_surat' => $this->nomor_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'nama_pelapor' => $this->nama_pelapor,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'terlapor' => $this->terlapor,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'disposisi_pimpinan' => $this->disposisi_pimpinan,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Laporan Berhasil Disimpan.');
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
        $this->disposisi_pimpinan = $data->disposisi_pimpinan;
        $this->status = $data->status;

        $this->isEditMode = true;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate();

        $data = Lapdu::find($this->lapdu_id);
        $data->update([
            // user_id tidak perlu diupdate agar record penginput awal tetap asli
            'nomor_surat' => $this->nomor_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'nama_pelapor' => $this->nama_pelapor,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'terlapor' => $this->terlapor,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'disposisi_pimpinan' => $this->disposisi_pimpinan,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data Berhasil Diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Lapdu::find($id)->delete();
        session()->flash('message', 'Data Berhasil Dihapus.');
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
        $this->disposisi_pimpinan = '';
        $this->status = 'masuk';
        $this->lapdu_id = null;
    }
}
