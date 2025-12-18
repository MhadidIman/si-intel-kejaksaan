<?php

namespace App\Livewire\PamSdo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\PamSdo;

class PamSdoIndex extends Component
{
    use WithPagination;

    // Form Variables
    public $tanggal_laporan, $kategori, $target, $nip_atau_nomor, $uraian_masalah, $tindakan_pam, $keterangan, $status = 'lid';
    public $pamsdo_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'tanggal_laporan' => 'required|date',
        'kategori' => 'required',
        'target' => 'required',
        'uraian_masalah' => 'required',
        'status' => 'required',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pam-sdo.pam-sdo-index', [
            'data_pam' => PamSdo::where('target', 'like', '%' . $this->search . '%')
                ->orWhere('uraian_masalah', 'like', '%' . $this->search . '%')
                ->orderBy('tanggal_laporan', 'desc')
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

        PamSdo::create([
            'tanggal_laporan' => $this->tanggal_laporan,
            'kategori' => $this->kategori,
            'target' => $this->target,
            'nip_atau_nomor' => $this->nip_atau_nomor,
            'uraian_masalah' => $this->uraian_masalah,
            'tindakan_pam' => $this->tindakan_pam,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data PAM SDO berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = PamSdo::findOrFail($id);
        $this->pamsdo_id = $id;
        $this->tanggal_laporan = $data->tanggal_laporan->format('Y-m-d');
        $this->kategori = $data->kategori;
        $this->target = $data->target;
        $this->nip_atau_nomor = $data->nip_atau_nomor;
        $this->uraian_masalah = $data->uraian_masalah;
        $this->tindakan_pam = $data->tindakan_pam;
        $this->keterangan = $data->keterangan;
        $this->status = $data->status;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();

        $data = PamSdo::find($this->pamsdo_id);
        $data->update([
            'tanggal_laporan' => $this->tanggal_laporan,
            'kategori' => $this->kategori,
            'target' => $this->target,
            'nip_atau_nomor' => $this->nip_atau_nomor,
            'uraian_masalah' => $this->uraian_masalah,
            'tindakan_pam' => $this->tindakan_pam,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data PAM SDO diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        PamSdo::find($id)->delete();
        session()->flash('message', 'Data dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->tanggal_laporan = '';
        $this->kategori = '';
        $this->target = '';
        $this->nip_atau_nomor = '';
        $this->uraian_masalah = '';
        $this->tindakan_pam = '';
        $this->keterangan = '';
        $this->status = 'lid';
    }
}
