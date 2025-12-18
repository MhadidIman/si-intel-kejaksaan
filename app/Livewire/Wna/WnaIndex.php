<?php

namespace App\Livewire\Wna;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Wna;
use Illuminate\Support\Facades\Storage;

class WnaIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Form Variables
    public $nama_lengkap, $nomor_paspor, $kebangsaan, $tanggal_tiba, $masa_berlaku_izin_tinggal, $tujuan_kunjungan, $sponsor, $alamat_menginap;
    public $foto_dokumen, $foto_lama;
    public $wna_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'nama_lengkap' => 'required',
        'nomor_paspor' => 'required',
        'kebangsaan' => 'required',
        'masa_berlaku_izin_tinggal' => 'required|date',
        'alamat_menginap' => 'required',
        'foto_dokumen' => 'nullable|image|max:2048',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wna.wna-index', [
            'wnas' => Wna::where('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orWhere('nomor_paspor', 'like', '%' . $this->search . '%')
                ->orWhere('kebangsaan', 'like', '%' . $this->search . '%')
                ->orderBy('masa_berlaku_izin_tinggal', 'asc') // Urutkan dari yg mau expired
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
        if ($this->foto_dokumen) {
            $path = $this->foto_dokumen->store('wna-docs', 'public');
        }

        Wna::create([
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_paspor' => $this->nomor_paspor,
            'kebangsaan' => $this->kebangsaan,
            'tanggal_tiba' => $this->tanggal_tiba,
            'masa_berlaku_izin_tinggal' => $this->masa_berlaku_izin_tinggal,
            'tujuan_kunjungan' => $this->tujuan_kunjungan,
            'sponsor' => $this->sponsor,
            'alamat_menginap' => $this->alamat_menginap,
            'foto_dokumen' => $path,
        ]);

        session()->flash('message', 'Data WNA berhasil disimpan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Wna::findOrFail($id);
        $this->wna_id = $id;
        $this->nama_lengkap = $data->nama_lengkap;
        $this->nomor_paspor = $data->nomor_paspor;
        $this->kebangsaan = $data->kebangsaan;
        $this->tanggal_tiba = $data->tanggal_tiba ? $data->tanggal_tiba->format('Y-m-d') : null;
        $this->masa_berlaku_izin_tinggal = $data->masa_berlaku_izin_tinggal ? $data->masa_berlaku_izin_tinggal->format('Y-m-d') : null;
        $this->tujuan_kunjungan = $data->tujuan_kunjungan;
        $this->sponsor = $data->sponsor;
        $this->alamat_menginap = $data->alamat_menginap;
        $this->foto_lama = $data->foto_dokumen;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $data = Wna::find($this->wna_id);

        $path = $data->foto_dokumen;
        if ($this->foto_dokumen) {
            if ($data->foto_dokumen && Storage::disk('public')->exists($data->foto_dokumen)) {
                Storage::disk('public')->delete($data->foto_dokumen);
            }
            $path = $this->foto_dokumen->store('wna-docs', 'public');
        }

        $data->update([
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_paspor' => $this->nomor_paspor,
            'kebangsaan' => $this->kebangsaan,
            'tanggal_tiba' => $this->tanggal_tiba,
            'masa_berlaku_izin_tinggal' => $this->masa_berlaku_izin_tinggal,
            'tujuan_kunjungan' => $this->tujuan_kunjungan,
            'sponsor' => $this->sponsor,
            'alamat_menginap' => $this->alamat_menginap,
            'foto_dokumen' => $path,
        ]);

        session()->flash('message', 'Data WNA diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $data = Wna::find($id);
        if ($data->foto_dokumen && Storage::disk('public')->exists($data->foto_dokumen)) {
            Storage::disk('public')->delete($data->foto_dokumen);
        }
        $data->delete();
        session()->flash('message', 'Data WNA dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nama_lengkap = '';
        $this->nomor_paspor = '';
        $this->kebangsaan = '';
        $this->tanggal_tiba = '';
        $this->masa_berlaku_izin_tinggal = '';
        $this->tujuan_kunjungan = '';
        $this->sponsor = '';
        $this->alamat_menginap = '';
        $this->foto_dokumen = null;
        $this->foto_lama = null;
    }
}
