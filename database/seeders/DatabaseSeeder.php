<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // ==========================================
        // 1. DATA LAPINHAR (Laporan Informasi Harian)
        // ==========================================
        $lapinhars = [
            [
                'user_id' => 2, // Menggunakan ID Staff yang sudah ada
                'nomor_surat' => 'R-01/INTEL/06/2026',
                'tanggal_surat' => $now->copy()->subDays(1),
                'sumber_informasi' => 'Informan Masyarakat',
                'bidang' => 'Ekonomi & Keuangan',
                'peristiwa' => 'Kenaikan harga Bapokting (Bahan Pokok dan Penting) khususnya bawang merah di Pasar Antasari mencapai 15%.',
                'pendapat' => 'Perlu dilakukan koordinasi dengan Dinas Perdagangan untuk operasi pasar guna menekan inflasi.',
                'status' => 'biasa',
                'status_verifikasi' => 'disetujui',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'nomor_surat' => 'R-02/INTEL/06/2026',
                'tanggal_surat' => $now->copy()->subDays(3),
                'sumber_informasi' => 'Pemantauan Lapangan (Pulbaket)',
                'bidang' => 'Sosial Budaya',
                'peristiwa' => 'Aksi unjuk rasa mahasiswa di depan Gedung DPRD Provinsi Kalsel berjalan damai. Estimasi massa 200 orang.',
                'pendapat' => 'Kondisi Kamtibmas kondusif, aparat kepolisian telah melakukan pengamanan sesuai SOP.',
                'status' => 'biasa',
                'status_verifikasi' => 'disetujui',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'nomor_surat' => 'R-03/INTEL/06/2026',
                'tanggal_surat' => $now->copy()->subDays(5),
                'sumber_informasi' => 'Tim Siber Kejaksaan',
                'bidang' => 'Politik',
                'peristiwa' => 'Terpantau adanya kampanye hitam (black campaign) di media sosial menjelang Pilkada.',
                'pendapat' => 'Bekerjasama dengan Bawaslu untuk melacak akun penyebar hoax tersebut.',
                'status' => 'rahasia',
                'status_verifikasi' => 'pending',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];
        DB::table('lapinhars')->insert($lapinhars);

        // ==========================================
        // 2. DATA LAPSUS (Laporan Khusus)
        // ==========================================
        $lapsus = [
            [
                'user_id' => 2,
                'tanggal_laporan' => $now->copy()->subDays(2),
                'tingkat_kerahasiaan' => 'Rahasia',
                'siapa' => 'Kepala Desa X dan Bendahara Desa',
                'apa' => 'Dugaan tindak pidana korupsi Dana Desa Tahun 2025',
                'kapan' => 'Sepanjang Tahun Anggaran 2025',
                'dimana' => 'Desa X, Kecamatan Y, Banjarmasin',
                'mengapa' => 'Adanya laporan fiktif pembangunan jalan titian kayu',
                'bagaimana' => 'Memalsukan stempel dan nota toko material bangunan serta memanipulasi absensi tukang.',
                'analisa' => 'Indikasi kuat adanya kerugian negara berdasarkan pemeriksaan fisik awal oleh tim intelijen.',
                'saran' => 'Penerbitan Surat Perintah Tugas (Sprintug) Operasi Intelijen lanjutan untuk mengumpulkan bukti dokumen.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'tanggal_laporan' => $now->copy()->subDays(7),
                'tingkat_kerahasiaan' => 'Penting',
                'siapa' => 'Panitia Lelang Dinas Z',
                'apa' => 'Indikasi pengaturan pemenang tender (Persekongkolan)',
                'kapan' => 'Maret - Mei 2026',
                'dimana' => 'Kantor Dinas Z Banjarmasin',
                'mengapa' => 'Pemenang lelang didominasi oleh perusahaan dengan alamat fiktif yang terafiliasi dengan satu orang.',
                'bagaimana' => 'Mengunci spesifikasi teknis (Spektek) yang hanya bisa dipenuhi oleh perusahaan tertentu.',
                'analisa' => 'Terdapat pelanggaran UU LPBJ (Lembaga Pengadaan Barang/Jasa).',
                'saran' => 'Dilakukan pemanggilan untuk klarifikasi pihak-pihak terkait.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];
        DB::table('lapsus')->insert($lapsus);

        // ==========================================
        // 3. DATA DPO (Daftar Pencarian Orang)
        // ==========================================
        $dpos = [
            [
                'user_id' => 1,
                'nama_lengkap' => 'Budi Santoso bin Harjo',
                'tempat_lahir' => 'Banjarmasin',
                'tanggal_lahir' => '1985-05-10',
                'kasus' => 'Korupsi Pembangunan Jembatan',
                'status_hukum' => 'Terpidana (Inkracht)',
                'ciri_fisik' => 'Tinggi 165cm, kulit sawo matang, bekas luka di pipi kiri.',
                'status_pencarian' => 'buron',
                'status_verifikasi' => 'disetujui',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'nama_lengkap' => 'Siti Aisyah',
                'tempat_lahir' => 'Martapura',
                'tanggal_lahir' => '1990-12-01',
                'kasus' => 'Penggelapan Dana Nasabah Bank',
                'status_hukum' => 'Tersangka',
                'ciri_fisik' => 'Tinggi 155cm, kulit putih, tahi lalat di dagu.',
                'status_pencarian' => 'tertangkap',
                'status_verifikasi' => 'disetujui',
                'created_at' => $now->copy()->subMonths(1),
                'updated_at' => $now,
            ]
        ];
        DB::table('dpos')->insert($dpos);

        // ==========================================
        // 4. DATA WNA (Warga Negara Asing)
        // ==========================================
        $wnas = [
            [
                'user_id' => 2,
                'status_verifikasi' => 'disetujui',
                'nama_lengkap' => 'Chen Wei',
                'nomor_paspor' => 'CH1234567',
                'kebangsaan' => 'Tiongkok',
                'tanggal_tiba' => '2026-01-15',
                'masa_berlaku_izin_tinggal' => '2026-12-15',
                'tujuan_kunjungan' => 'Tenaga Kerja Asing (TKA) Sektor Tambang',
                'sponsor' => 'PT. Batu Bara Makmur',
                'alamat_menginap' => 'Mess Perusahaan di Banjarmasin Utara',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'status_verifikasi' => 'pending',
                'nama_lengkap' => 'Michael Smith',
                'nomor_paspor' => 'US9876543',
                'kebangsaan' => 'Amerika Serikat',
                'tanggal_tiba' => '2026-06-01',
                'masa_berlaku_izin_tinggal' => '2026-07-01',
                'tujuan_kunjungan' => 'Peneliti Flora & Fauna (Wisata)',
                'sponsor' => 'Universitas Lambung Mangkurat',
                'alamat_menginap' => 'Hotel di area Banjarmasin Tengah',
                'created_at' => $now->copy()->subDays(10),
                'updated_at' => $now->copy()->subDays(10),
            ]
        ];
        DB::table('wnas')->insert($wnas);

        // ==========================================
        // 5. DATA ORMAS
        // ==========================================
        $ormas = [
            [
                'user_id' => 2,
                'status_verifikasi' => 'disetujui',
                'nama_organisasi' => 'LSM Peduli Lingkungan Banua',
                'ketua' => 'H. Syamsudin',
                'alamat_sekretariat' => 'Jl. Sultan Adam Raya, Banjarmasin Utara',
                'bentuk_organisasi' => 'Lembaga Swadaya Masyarakat',
                'nomor_legalitas' => 'SK. Kemenkumham No. 123/2020',
                'jumlah_anggota' => 150,
                'kegiatan_terakhir' => 'Aksi tanam pohon dan penyuluhan bank sampah.',
                'status' => 'aktif',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'status_verifikasi' => 'disetujui',
                'nama_organisasi' => 'Paguyuban Warga Ekstrim',
                'ketua' => 'Sulaiman',
                'alamat_sekretariat' => 'Jl. Kelayan B, Banjarmasin Selatan',
                'bentuk_organisasi' => 'Ormas Keagamaan',
                'nomor_legalitas' => null,
                'jumlah_anggota' => 45,
                'kegiatan_terakhir' => 'Perkumpulan tertutup mengajarkan paham radikal.',
                'status' => 'diawasi',
                'created_at' => $now->copy()->subMonths(3),
                'updated_at' => $now,
            ]
        ];
        DB::table('ormas')->insert($ormas);

        // ==========================================
        // 6. DATA PAM SDO (Pengamanan SDM/Pegawai)
        // ==========================================
        $pam_sdos = [
            [
                'user_id' => 1,
                'status_verifikasi' => 'disetujui',
                'nama_pegawai' => 'Joko Susilo',
                'nip_nrp' => '198801012010011001',
                'pangkat_jabatan' => 'Penata Muda / Staff',
                'satuan_kerja' => 'Kejaksaan Negeri Banjarmasin',
                'permasalahan' => 'Terindikasi sering mangkir kerja dan dilaporkan berada di tempat hiburan malam saat jam kantor.',
                'keterangan' => 'Dalam proses pemantauan melekat (Waskat) oleh bidang Intelijen.',
                'status_pam' => 'diawasi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'status_verifikasi' => 'disetujui',
                'nama_pegawai' => 'Rina Mulyani',
                'nip_nrp' => '199203032015022002',
                'pangkat_jabatan' => 'Pengatur / Bendahara Pengeluaran',
                'satuan_kerja' => 'Kejaksaan Negeri Banjarmasin',
                'permasalahan' => 'Adanya selisih laporan kas yang belum bisa dipertanggungjawabkan.',
                'keterangan' => 'Telah dilakukan pemeriksaan internal dan uang pengganti telah dikembalikan.',
                'status_pam' => 'clear',
                'created_at' => $now->copy()->subMonths(2),
                'updated_at' => $now->copy()->subDays(5),
            ]
        ];
        DB::table('pam_sdos')->insert($pam_sdos);

        // ==========================================
        // 7. DATA JMS (Jaksa Masuk Sekolah)
        // ==========================================
        $jms = [
            [
                'user_id' => 2,
                'status_verifikasi' => 'disetujui',
                'nama_sekolah' => 'SMA Negeri 1 Banjarmasin',
                'tanggal_kegiatan' => $now->copy()->subDays(10),
                'materi' => 'Kenali Hukum, Jauhi Hukuman: Bahaya Narkoba di Kalangan Pelajar',
                'jumlah_siswa' => 150,
                'nama_jaksa' => 'Jaksa Fulan, S.H.',
                'keterangan' => 'Berjalan interaktif, siswa antusias berdiskusi mengenai ancaman hukum.',
                'created_at' => $now->copy()->subDays(10),
                'updated_at' => $now->copy()->subDays(10),
            ],
            [
                'user_id' => 2,
                'status_verifikasi' => 'disetujui',
                'nama_sekolah' => 'SMP Negeri 2 Banjarmasin',
                'tanggal_kegiatan' => $now->copy()->subMonths(1),
                'materi' => 'Stop Bullying dan Cyberbullying',
                'jumlah_siswa' => 120,
                'nama_jaksa' => 'Andi Pratama, S.H.',
                'keterangan' => 'Dihadiri juga oleh Kepala Sekolah dan Dewan Guru.',
                'created_at' => $now->copy()->subMonths(1),
                'updated_at' => $now->copy()->subMonths(1),
            ]
        ];
        DB::table('jms_activities')->insert($jms);

        // ==========================================
        // 8. DATA KERAWANAN (Pemetaan SPK GIS)
        // ==========================================
        $kerawanans = [
            [
                'user_id' => 1,
                'status_verifikasi' => 'disetujui',
                'kecamatan' => 'Banjarmasin Selatan',
                'bidang' => 'Ipoleksosbudhankam (Sosial)',
                'potensi_ancaman' => 'Konflik horizontal antar kelompok pemuda pasca Pemilu.',
                'sumber_informasi' => 'Pemantauan Wilayah Teritorial',
                'latitude' => '-3.3486',
                'longitude' => '114.6067',
                'kriteria_dampak' => 4,
                'kriteria_probabilitas' => 3,
                'kriteria_eskalasi' => 5,
                'skor_spk' => 85.50,
                'tingkat_rawan' => 'tinggi',
                'upaya_pencegahan' => 'Patroli gabungan dan pendekatan tokoh masyarakat.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'status_verifikasi' => 'disetujui',
                'kecamatan' => 'Banjarmasin Barat',
                'bidang' => 'Ekonomi',
                'potensi_ancaman' => 'Penimbunan BBM Bersubsidi di Pelabuhan Trisakti',
                'sumber_informasi' => 'Laporan Intelijen Pelindo',
                'latitude' => '-3.3194',
                'longitude' => '114.5765',
                'kriteria_dampak' => 3,
                'kriteria_probabilitas' => 4,
                'kriteria_eskalasi' => 3,
                'skor_spk' => 60.00,
                'tingkat_rawan' => 'sedang',
                'upaya_pencegahan' => 'Koordinasi pengawasan dengan pihak kepolisian pelabuhan KPL.',
                'created_at' => $now->copy()->subDays(5),
                'updated_at' => $now->copy()->subDays(5),
            ]
        ];
        DB::table('kerawanans')->insert($kerawanans);

        // ==========================================
        // 9. DATA LAPDU (Laporan Pengaduan Masyarakat)
        // ==========================================
        $lapdus = [
            [
                'nomor_tiket' => 'TKT-20260616-001',
                'nama_pelapor' => 'Ahmad Warga',
                'is_anonim' => false,
                'nik' => '6371012345678901',
                'tempat_lahir' => 'Banjarmasin',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'pekerjaan' => 'Wiraswasta',
                'alamat_pelapor' => 'Jl. Veteran, Banjarmasin Timur',
                'no_hp_pelapor' => '085311223344',
                'nama_terlapor' => 'Oknum Pegawai Kelurahan Manggis',
                'jabatan_terlapor' => 'Staf Administrasi',
                'alamat_terlapor' => 'Kantor Kelurahan',
                'kontak_terlapor' => '-',
                'kategori_laporan' => 'Pungli',
                'judul_laporan' => 'Dugaan Pungli Pembuatan Sertifikat Tanah',
                'waktu_kejadian' => $now->copy()->subDays(5),
                'tempat_kejadian' => 'Kantor Kelurahan Manggis',
                'uraian_pengaduan' => 'Diminta biaya sebesar 5 juta rupiah yang tidak sesuai aturan resmi dalam pengurusan prona sertifikat tanah.',
                'bukti_dukung' => 'foto_kwitansi.jpg',
                'status_laporan' => 'menunggu',
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(2),
            ],
            [
                'nomor_tiket' => 'TKT-20260616-002',
                'nama_pelapor' => 'Anonim',
                'is_anonim' => true,
                'nik' => '0000000000000000',
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'jenis_kelamin' => null,
                'pekerjaan' => null,
                'alamat_pelapor' => 'Dirahasiakan',
                'no_hp_pelapor' => '081100000000',
                'nama_terlapor' => 'PT. Konstruksi Maju',
                'jabatan_terlapor' => 'Kontraktor Pelaksana',
                'alamat_terlapor' => 'Jl. Hasan Basri',
                'kontak_terlapor' => '0511-123456',
                'kategori_laporan' => 'Tindak Pidana Korupsi',
                'judul_laporan' => 'Indikasi Korupsi Perbaikan Drainase',
                'waktu_kejadian' => $now->copy()->subMonths(1),
                'tempat_kejadian' => 'Sepanjang Jl. Kayutangi',
                'uraian_pengaduan' => 'Spesifikasi material drainase tidak sesuai dengan RAB yang tertera di plang proyek. Terjadi pengurangan volume semen.',
                'bukti_dukung' => 'video_material.mp4',
                'status_laporan' => 'diproses',
                'created_at' => $now->copy()->subDays(15),
                'updated_at' => $now->copy()->subDays(10),
            ]
        ];
        DB::table('lapdus')->insert($lapdus);
    }
}
