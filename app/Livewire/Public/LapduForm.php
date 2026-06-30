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
    public $is_anonim = false;
    public $nik, $email_pelapor, $foto_ktp, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $pekerjaan, $alamat_pelapor, $no_hp_pelapor;

    // 2. Identitas Terlapor
    public $nama_terlapor, $jabatan_terlapor, $alamat_terlapor, $kontak_terlapor;

    // 3. Detail Pengaduan (Substansi Masalah 5W + 1H)
    public $kategori_laporan, $judul_laporan, $waktu_kejadian, $tempat_kejadian, $uraian_pengaduan;

    // 4. Bukti Pendukung & Keamanan
    public $bukti_dukung;
    public $disclaimer = false;

    public $nomorTiket = null;

    public function mount()
    {
        if (Auth::check() && Auth::user()->role !== 'masyarakat') {
            $this->redirectRoute('dashboard', navigate: true);
            return;
        }

        if (Auth::check()) {
            $this->no_hp_pelapor = Auth::user()->no_hp ?? '';
            $this->nik = Auth::user()->nik ?? '';
            $this->email_pelapor = Auth::user()->email ?? '';
        }
    }

    protected function rules()
    {
        return [
            'nik' => 'required|numeric|digits:16',
            'email_pelapor' => 'required|email|max:255',
            // Jika anonim, KTP opsional. Jika tidak anonim, KTP wajib (Maks 5MB)
            'foto_ktp' => $this->is_anonim ? 'nullable|image|max:5120' : 'required|image|max:5120',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'pekerjaan' => 'nullable|string|max:100',
            'alamat_pelapor' => 'required|string|min:10',
            'no_hp_pelapor' => 'required|numeric|digits_between:10,15',

            'nama_terlapor' => 'required|string|max:255',
            'jabatan_terlapor' => 'required|string|max:255',
            'alamat_terlapor' => 'nullable|string',
            'kontak_terlapor' => 'nullable|string|max:50',

            'kategori_laporan' => 'required|string',
            'judul_laporan' => 'required|string|max:255|min:10',
            'waktu_kejadian' => 'required|date',
            'tempat_kejadian' => 'required|string|max:255',
            'uraian_pengaduan' => 'required|string|min:25',

            'bukti_dukung' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,mp3|max:10240',
            'disclaimer' => 'accepted',
        ];
    }

    protected $messages = [
        'disclaimer.accepted' => 'Anda wajib menyetujui pernyataan tanggung jawab hukum untuk mengirim laporan.',
        'bukti_dukung.max' => 'Ukuran berkas bukti pendukung tidak boleh melebihi 10MB.',
        'foto_ktp.required' => 'Foto KTP wajib dilampirkan untuk verifikasi identitas (kecuali Anda lapor sebagai anonim).',
        'foto_ktp.image' => 'File KTP harus berupa gambar (JPG, PNG).',
        'foto_ktp.max' => 'Ukuran foto KTP tidak boleh melebihi 5MB.',
    ];

    public function kirimLaporan()
    {
        $this->validate();

        // Simpan file bukti dukung utama
        $pathBukti = $this->bukti_dukung->store('lapdu_bukti', 'public');

        // Simpan file KTP jika diunggah
        $pathKtp = null;
        if ($this->foto_ktp) {
            $pathKtp = $this->foto_ktp->store('lapdu_ktp', 'public');
        }

        $kodeAcak = strtoupper(Str::random(5));
        $tiketBaru = 'LAPDU-' . date('Ym') . '-' . $kodeAcak;

        Lapdu::create([
            'nomor_tiket' => $tiketBaru,
            'nama_pelapor' => Auth::user()->name,
            'is_anonim' => $this->is_anonim,
            'nik' => $this->is_anonim ? null : $this->nik,
            'email_pelapor' => $this->is_anonim ? null : $this->email_pelapor,
            'foto_ktp' => $this->is_anonim ? null : $pathKtp, // <-- Simpan KTP ke database
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

            'bukti_dukung' => $pathBukti,
            'status_laporan' => 'menunggu',
        ]);

        $this->nomorTiket = $tiketBaru;

        // Reset form
        $this->reset(['tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'pekerjaan', 'alamat_pelapor', 'nama_terlapor', 'jabatan_terlapor', 'alamat_terlapor', 'kontak_terlapor', 'kategori_laporan', 'judul_laporan', 'waktu_kejadian', 'tempat_kejadian', 'uraian_pengaduan', 'bukti_dukung', 'foto_ktp', 'disclaimer']);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.lapdu-form');
    }
}
