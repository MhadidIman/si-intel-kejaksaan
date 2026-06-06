<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads; // Penting untuk upload file
use Livewire\Attributes\Layout;
use App\Models\Lapdu;
use Illuminate\Support\Str;

class LapduForm extends Component
{
    use WithFileUploads;

    public $nama_pelapor, $nik, $no_hp_pelapor, $nama_terlapor, $kategori_laporan, $uraian_pengaduan, $bukti_dukung;
    public $nomorTiket = null;

    protected $rules = [
        'nama_pelapor' => 'nullable|string|max:255',
        'nik' => 'required|numeric|digits:16',
        'no_hp_pelapor' => 'required|string|max:20',
        'nama_terlapor' => 'required|string|max:255',
        'kategori_laporan' => 'required|string',
        'uraian_pengaduan' => 'required|string|min:15',
        'bukti_dukung' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // Maksimal 5MB
    ];

    public function kirimLaporan()
    {
        $this->validate();

        // Simpan File
        $path = $this->bukti_dukung->store('lapdu_bukti', 'public');

        $kodeAcak = strtoupper(Str::random(5));
        $tiketBaru = 'LAPDU-' . date('Ym') . '-' . $kodeAcak;

        Lapdu::create([
            'nomor_tiket' => $tiketBaru,
            'nama_pelapor' => $this->nama_pelapor ?? 'Anonim',
            'nik' => $this->nik,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'nama_terlapor' => $this->nama_terlapor,
            'kategori_laporan' => $this->kategori_laporan,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'bukti_dukung' => $path, // Simpan path file
            'status_laporan' => 'menunggu',
        ]);

        $this->nomorTiket = $tiketBaru;
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.public.lapdu-form');
    }
}