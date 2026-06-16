<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wna;
use App\Models\Ormas;
use App\Models\Kerawanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==============================================================
        // DATA USER
        // ==============================================================
        $admin = User::create([
            'name' => 'Jaksa Intel',
            'nip' => '198501012010011021',
            'email' => 'admin@kejaribjm.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'pangkat' => 'Jaksa Pratama',
            'jabatan' => 'Kasubsi Ekonomi & Keuangan',
            'no_hp' => '081234567890',
        ]);

        $staff = User::create([
            'name' => 'Staff Intel',
            'nip' => '199002022015021002',
            'email' => 'staff@kejaribjm.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'pangkat' => 'Pengatur Tingkat I',
            'jabatan' => 'Staff TU',
        ]);

        // ==============================================================
        // DATA DUMMY WNA (Memancing Alert Overstay)
        // ==============================================================
        Wna::create([
            'user_id' => $admin->id,
            'status_verifikasi' => 'disetujui',
            'nama_lengkap' => 'Michael Smith',
            'nomor_paspor' => 'US12345678',
            'kebangsaan' => 'Amerika Serikat',
            'tanggal_tiba' => Carbon::now()->subMonths(2),
            // SENGAJA DIBUAT HABIS 3 HARI YANG LALU UNTUK TRIGGER ALERT
            'masa_berlaku_izin_tinggal' => Carbon::now()->subDays(3),
            'tujuan_kunjungan' => 'Wisata',
            'sponsor' => 'Mandiri',
            'alamat_menginap' => 'Hotel Swiss-Belhotel Banjarmasin',
        ]);

        Wna::create([
            'user_id' => $staff->id,
            'status_verifikasi' => 'disetujui',
            'nama_lengkap' => 'Wang Wei',
            'nomor_paspor' => 'CN87654321',
            'kebangsaan' => 'Tiongkok',
            'tanggal_tiba' => Carbon::now()->subDays(10),
            'masa_berlaku_izin_tinggal' => Carbon::now()->addMonths(1), // Masih aman
            'tujuan_kunjungan' => 'Bisnis Tambang',
            'sponsor' => 'PT. Batu Bara Kalimantan',
            'alamat_menginap' => 'Mess Perusahaan',
        ]);

        // ==============================================================
        // DATA DUMMY ORMAS (Memancing Alert Diawasi)
        // ==============================================================
        Ormas::create([
            'user_id' => $admin->id,
            'status_verifikasi' => 'disetujui',
            'nama_organisasi' => 'LSM Suara Rakyat Kritis',
            'ketua' => 'Budi Santoso',
            'alamat_sekretariat' => 'Jl. Hasan Basri No. 12, Banjarmasin Utara',
            'bentuk_organisasi' => 'Lembaga Swadaya Masyarakat',
            'nomor_legalitas' => 'AHU-123.45.67.89',
            'jumlah_anggota' => 150,
            'kegiatan_terakhir' => 'Aksi unjuk rasa penolakan RUU di depan DPRD',
            'status' => 'diawasi', // SENGAJA DIBUAT DIAWASI UNTUK TRIGGER ALERT
        ]);

        Ormas::create([
            'user_id' => $staff->id,
            'status_verifikasi' => 'disetujui',
            'nama_organisasi' => 'Yayasan Peduli Sungai Martapura',
            'ketua' => 'Hj. Siti Aminah',
            'alamat_sekretariat' => 'Jl. Veteran, Banjarmasin Timur',
            'bentuk_organisasi' => 'Yayasan Sosial',
            'nomor_legalitas' => 'AHU-987.65.43.21',
            'jumlah_anggota' => 80,
            'kegiatan_terakhir' => 'Pembersihan susur sungai dan tanam pohon',
            'status' => 'aktif',
        ]);

        // ==============================================================
        // DATA DUMMY PETA KERAWANAN (Memunculkan Heatmap & Titik GIS)
        // ==============================================================
        Kerawanan::create([
            'user_id' => $admin->id,
            'status_verifikasi' => 'disetujui',
            'kecamatan' => 'Banjarmasin Tengah',
            'bidang' => 'Politik',
            'potensi_ancaman' => 'Potensi gesekan antar pendukung paslon pasca penetapan hasil rekapitulasi KPU tingkat Kota.',
            'sumber_informasi' => 'Informan Tertutup',
            'latitude' => '-3.321852',
            'longitude' => '114.591024', // Koordinat Sekitar Sabilal Muhtadin / Pusat Kota
            'kriteria_dampak' => 8,
            'kriteria_probabilitas' => 7,
            'kriteria_eskalasi' => 8,
            'skor_spk' => 76.50, // Otomatis Tinggi (>= 75)
            'tingkat_rawan' => 'tinggi',
            'upaya_pencegahan' => 'Melakukan penggalangan terhadap tokoh kunci, koordinasi intensif dengan aparat keamanan (TNI/Polri).',
        ]);

        Kerawanan::create([
            'user_id' => $staff->id,
            'status_verifikasi' => 'disetujui',
            'kecamatan' => 'Banjarmasin Utara',
            'bidang' => 'Sosial Budaya',
            'potensi_ancaman' => 'Penolakan warga terhadap rencana pembangunan ruko komersial di area pemukiman padat.',
            'sumber_informasi' => 'Media Sosial',
            'latitude' => '-3.295286',
            'longitude' => '114.587895', // Koordinat Sekitar Kayutangi
            'kriteria_dampak' => 5,
            'kriteria_probabilitas' => 6,
            'kriteria_eskalasi' => 4,
            'skor_spk' => 51.00, // Otomatis Sedang (40 - 74)
            'tingkat_rawan' => 'sedang',
            'upaya_pencegahan' => 'Meningkatkan frekuensi pemantauan lapangan, koordinasi dengan perangkat desa/kecamatan.',
        ]);

        Kerawanan::create([
            'user_id' => $staff->id,
            'status_verifikasi' => 'disetujui',
            'kecamatan' => 'Banjarmasin Selatan',
            'bidang' => 'Ekonomi',
            'potensi_ancaman' => 'Keluhan masyarakat terkait kelangkaan gas LPG 3Kg di beberapa pangkalan.',
            'sumber_informasi' => 'Laporan Masyarakat',
            'latitude' => '-3.351084',
            'longitude' => '114.588806', // Koordinat Sekitar Kelayan
            'kriteria_dampak' => 3,
            'kriteria_probabilitas' => 4,
            'kriteria_eskalasi' => 3,
            'skor_spk' => 33.50, // Otomatis Rendah (< 40)
            'tingkat_rawan' => 'rendah',
            'upaya_pencegahan' => 'Melakukan monitoring berkala dan berkoordinasi dengan pihak agen distributor resmi.',
        ]);
    }
}
