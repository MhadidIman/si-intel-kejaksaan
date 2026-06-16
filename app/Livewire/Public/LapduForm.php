<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Lapdu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LapduForm extends Component
{
    use WithFileUploads;

    // 1. Identitas Pelapor
    public $is_anonim = false; // Fitur opsi anonimitas intelijen
    public $nik, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $pekerjaan, $alamat_pelapor, $no_hp_pelapor;

    // 2. Identitas Terlapor
    public $nama_terlapor, $jabatan_terlapor, $alamat_terlapor, $kontak_terlapor;

    // 3. Detail Pengaduan (Substansi Masalah 5W + 1H)
    public $kategori_laporan, $judul_laporan, $waktu_kejadian, $tempat_kejadian, $uraian_pengaduan;

    // 4. Bukti Pendukung & Keamanan
    public $bukti_dukung;
    public $disclaimer = false; // Checkbox pernyataan tanggung jawab hukum

    public $nomorTiket = null;

    public function mount()
    {
        // Satpam Proteksi: Jika petugas internal yang buka, alihkan ke dashboard internal
        if (Auth::check() && Auth::user()->role !== 'masyarakat') {
            $this->redirectRoute('dashboard', navigate: true);
            return;
        }

        // Auto-fill nomor HP pelapor dari data user jika sudah ada
        $this->no_hp_pelapor = Auth::user()->no_hp ?? '';
    }

    protected function rules()
    {
        return [
            // Validasi Identitas Pelapor (NIK tetap wajib demi validitas sistem/anti-bot)
            'nik' => 'required|numeric|digits:16',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'pekerjaan' => 'nullable|string|max:100',
            'alamat_pelapor' => 'required|string|min:10',
            'no_hp_pelapor' => 'required|string|max:20',

            // Validasi Terlapor
            'nama_terlapor' => 'required|string|max:255',
            'jabatan_terlapor' => 'required|string|max:255',
            'alamat_terlapor' => 'nullable|string',
            'kontak_terlapor' => 'nullable|string|max:50',

            // Validasi Substansi Kasus
            'kategori_laporan' => 'required|string',
            'judul_laporan' => 'required|string|max:255|min:10',
            'waktu_kejadian' => 'required|date',
            'tempat_kejadian' => 'required|string|max:255',
            'uraian_pengaduan' => 'required|string|min:25',

            // Bukti & Disclaimer
            'bukti_dukung' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,mp3|max:10240', // Maksimal 10MB sesuai saran
            'disclaimer' => 'accepted', // Harus dicentang (true)
        ];
    }

    protected $messages = [
        'disclaimer.accepted' => 'Anda wajib menyetujui pernyataan tanggung jawab hukum untuk mengirim laporan.',
        'bukti_dukung.max' => 'Ukuran berkas bukti pendukung tidak boleh melebihi 10MB.',
    ];

    public function kirimLaporan()
    {
        $this->validate();

        // Proses Penyimpanan Bukti Dokumen/Media
        $path = $this->bukti_dukung->store('lapdu_bukti', 'public');

        // Generasi Kode Tiket Unik Intelijen
        $kodeAcak = strtoupper(Str::random(5));
        $tiketBaru = 'LAPDU-' . date('Ym') . '-' . $kodeAcak;

        // Catatan Intelijen: Identitas asli tetap disimpan di database untuk verifikasi, 
        // namun flag 'is_anonim' akan menentukan apakah nama pelapor disamarkan di dashboard petugas/output fisik.
        Lapdu::create([
            'nomor_tiket' => $tiketBaru,
            'nama_pelapor' => Auth::user()->name,
            'is_anonim' => $this->is_anonim,
            'nik' => $this->nik,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'pekerjaan' => $this->pekerjaan,
            'alamat_pelapor' => $this->alamat_pelapor,
            'no_hp_pelapor' => $this->no_hp_pelapor,

            'nama_terlapor' => $this->nama_terlapor,
            'jabatan_terlapor' => $this->jabatan_terlapor,
            'alamat_terlapor' => $this->alamat_terlapor,
            'kontak_terlapor' => $this->kontak_terlapor,

            'kategori_laporan' => $this->kategori_laporan,
            'judul_laporan' => $this->judul_laporan,
            'waktu_kejadian' => $this->waktu_kejadian,
            'tempat_kejadian' => $this->tempat_kejadian,
            'uraian_pengaduan' => $this->uraian_pengaduan,

            'bukti_dukung' => $path,
            'status_laporan' => 'menunggu',
        ]);

        $this->nomorTiket = $tiketBaru;

        // Reset form setelah sukses kirim laporan
        $this->reset(['nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'pekerjaan', 'alamat_pelapor', 'nama_terlapor', 'jabatan_terlapor', 'alamat_terlapor', 'kontak_terlapor', 'kategori_laporan', 'judul_laporan', 'waktu_kejadian', 'tempat_kejadian', 'uraian_pengaduan', 'bukti_dukung', 'disclaimer']);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.lapdu-form');
    }
}
