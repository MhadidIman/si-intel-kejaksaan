<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads; // Penting untuk upload file
use Livewire\Attributes\Layout;
use App\Models\Lapdu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // Tambahkan untuk mengambil data user login

class LapduForm extends Component
{
    use WithFileUploads;

    // Hapus $nama_pelapor dari properti publik karena kita akan ambil otomatis dari Auth
    public $nik, $no_hp_pelapor, $nama_terlapor, $kategori_laporan, $uraian_pengaduan, $bukti_dukung;
    public $nomorTiket = null;

    // =========================================================================
    // FUNGSI MOUNT SEBAGAI "SATPAM" (GUARD)
    // =========================================================================
    public function mount()
    {
        // Jika yang akses adalah Petugas/Admin, lempar paksa ke dashboard internal
        if (Auth::check() && Auth::user()->role !== 'masyarakat') {
            return redirect()->route('dashboard');
        }
    }

    protected $rules = [
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
            // Nama pelapor otomatis ditarik dari akun yang sedang login
            'nama_pelapor' => Auth::user()->name,
            'nik' => $this->nik,
            'no_hp_pelapor' => $this->no_hp_pelapor,
            'nama_terlapor' => $this->nama_terlapor,
            'kategori_laporan' => $this->kategori_laporan,
            'uraian_pengaduan' => $this->uraian_pengaduan,
            'bukti_dukung' => $path, // Simpan path file
            'status_laporan' => 'menunggu',

            // Opsional: Jika tabel lapdus Anda punya kolom user_id, 
            // sangat disarankan untuk menyimpannya juga seperti ini:
            // 'user_id' => Auth::id(),
        ]);

        $this->nomorTiket = $tiketBaru;
    }

    // UBAH LAYOUT MENJADI layouts.app AGAR NAVBAR GLOBAL MUNCUL
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.public.lapdu-form');
    }
}
