<?php

namespace App\Livewire\Lapdu;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Lapdu;
use Illuminate\Support\Facades\Storage;

class LapduIndex extends Component
{
    use WithPagination, WithFileUploads;

    public $nomor_surat, $tanggal_terima, $nama_pelapor, $no_hp_pelapor, $terlapor, $uraian_pengaduan, $disposisi_pimpinan, $status = 'masuk';
    public $bukti_pendukung, $bukti_lama;
    public $lapdu_id;

    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'tanggal_terima' => 'required|date',
        'terlapor' => 'required',
        'uraian_pengaduan' => 'required',
        'bukti_pendukung' => 'nullable|file|max:10240',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.lapdu.lapdu-index', [
            'lapdus' => Lapdu::where('terlapor', 'like', '%' . $this->search . '%') // <-- Nama variabel harus 'lapdus'
                ->orderBy('tanggal_terima', 'desc')
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
        if ($this->bukti_pendukung) {
            $path = $this->bukti_pendukung->store('lapdu-files', 'public');
        }
        Lapdu::create([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'nama_pelapor' => $this->nama_pelapor ?? 'NN (Anonim)',
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'terlapor' => $this->terlapor,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'bukti_pendukung' => $path,
            'disposisi_pimpinan' => $this->disposisi_pimpinan,
            'status' => $this->status,
        ]);
        session()->flash('message', 'Pengaduan berhasil dicatat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Lapdu::findOrFail($id);
        $this->lapdu_id = $id;
        $this->nomor_surat = $data->nomor_surat;
        $this->tanggal_terima = $data->tanggal_terima->format('Y-m-d');
        $this->nama_pelapor = $data->nama_pelapor;
        $this->no_hp_pelapor = $data->no_hp_pelapor;
        $this->terlapor = $data->terlapor;
        $this->uraian_pengaduan = $data->uraian_pengaduan;
        $this->disposisi_pimpinan = $data->disposisi_pimpinan;
        $this->status = $data->status;
        $this->bukti_lama = $data->bukti_pendukung;
        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $data = Lapdu::find($this->lapdu_id);
        $path = $data->bukti_pendukung;
        if ($this->bukti_pendukung) {
            if ($data->bukti_pendukung && Storage::disk('public')->exists($data->bukti_pendukung)) {
                Storage::disk('public')->delete($data->bukti_pendukung);
            }
            $path = $this->bukti_pendukung->store('lapdu-files', 'public');
        }
        $data->update([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'nama_pelapor' => $this->nama_pelapor,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'terlapor' => $this->terlapor,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'bukti_pendukung' => $path,
            'disposisi_pimpinan' => $this->disposisi_pimpinan,
            'status' => $this->status,
        ]);
        session()->flash('message', 'Data pengaduan diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $data = Lapdu::find($id);
        if ($data->bukti_pendukung && Storage::disk('public')->exists($data->bukti_pendukung)) {
            Storage::disk('public')->delete($data->bukti_pendukung);
        }
        $data->delete();
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
        $this->tanggal_terima = '';
        $this->nama_pelapor = '';
        $this->no_hp_pelapor = '';
        $this->terlapor = '';
        $this->uraian_pengaduan = '';
        $this->disposisi_pimpinan = '';
        $this->status = 'masuk';
        $this->bukti_pendukung = null;
        $this->bukti_lama = null;
    }
}
