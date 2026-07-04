<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class VerifikasiDokumen extends Component
{
    public $tipe;
    public $dokumenId;
    public $dokumen;

    public function mount($tipe, $id)
    {
        $this->tipe = $tipe;
        $this->dokumenId = $id;

        // Daftar mapping: 'nama_di_url' => 'Namespace\Model'
        $map = [
            'lapdu'     => \App\Models\Lapdu::class,
            'lapinhar'  => \App\Models\Lapinhar::class,
            'dpo'       => \App\Models\Dpo::class,
            'wna'       => \App\Models\Wna::class,
            'ormas'     => \App\Models\Ormas::class,
            'pam-sdo'   => \App\Models\PamSdo::class,
            'jms'       => \App\Models\JmsActivity::class,
            'kerawanan' => \App\Models\Kerawanan::class,
            'lapsus'    => \App\Models\Lapsus::class,
        ];

        // Cari model berdasarkan tipe
        if (array_key_exists($this->tipe, $map)) {
            $modelClass = $map[$this->tipe];
            $this->dokumen = $modelClass::find($id);
        }

        if (!$this->dokumen) {
            abort(404, 'Dokumen Tidak Ditemukan.');
        }
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.verifikasi-dokumen');
    }
}
