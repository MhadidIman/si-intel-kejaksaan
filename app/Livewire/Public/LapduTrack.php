<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Lapdu;

class LapduTrack extends Component
{
    public $nomor_tiket;
    public $hasilLaporan = null;
    public $error = null;

    public function cariLaporan()
    {
        $this->validate(['nomor_tiket' => 'required']);

        $data = Lapdu::where('nomor_tiket', $this->nomor_tiket)->first();

        if ($data) {
            $this->hasilLaporan = $data;
            $this->error = null;
        } else {
            $this->hasilLaporan = null;
            $this->error = "Nomor tiket tidak ditemukan. Pastikan penulisan benar.";
        }
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.public.lapdu-track');
    }
}