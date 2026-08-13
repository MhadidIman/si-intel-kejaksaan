<!DOCTYPE html>
<html>

<head>
    <title>Disposisi Lapdu - {{ $data->nama_terlapor }}</title>
    <style>
        /* Pengaturan Standar (Margin diperkecil agar muat 1 halaman jika memungkinkan) */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.3;
            color: #000;
        }

        /* --- KOP SURAT --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .logo-cell {
            width: 90px;
            vertical-align: middle;
            text-align: left;
        }

        .logo-img {
            width: 80px;
            height: auto;
        }

        .teks-cell {
            text-align: center;
            vertical-align: middle;
            padding-right: 90px;
        }

        .teks-cell h1 {
            font-size: 13pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell h2 {
            font-size: 15pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell p {
            font-size: 9pt;
            margin: 1px 0;
            line-height: 1.1;
        }

        .garis-kop-ganda {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            height: 2px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        /* --- ISI --- */
        .rahasia {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 10pt;
            margin-bottom: 5px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
            font-size: 13pt;
            text-transform: uppercase;
        }

        /* TABEL DATA */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .table-data td {
            padding: 4px;
            vertical-align: top;
            border: 1px solid #000;
        }

        .label {
            width: 170px;
            font-weight: bold;
            background-color: #f2f2f2;
        }

        /* BOX URAIAN & DISPOSISI */
        .box-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 3px;
            font-size: 11pt;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .box-uraian {
            border: 1px solid #000;
            padding: 8px;
            min-height: 60px;
            text-align: justify;
            margin-bottom: 10px;
        }

        .box-disposisi {
            border: 2px solid #000;
            padding: 10px;
            min-height: 100px;
            margin-bottom: 10px;
        }

        /* FOTO BUKTI (JIKA ADA) - DIBUAT FLEXIBEL */
        .evidence-container {
            margin-top: 10px;
            text-align: center;
            border: 1px dashed #999;
            padding: 5px;
            page-break-inside: avoid;
            /* Foto jangan terpotong */
        }

        .evidence-img {
            max-width: 95%;
            max-height: 200px;
            /* Batasi tinggi agar hemat ruang */
            border: 1px solid #000;
            margin-top: 5px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* TANDA TANGAN (WRAPPER AGAR TIDAK PECAH) */
        .ttd-wrapper {
            width: 100%;
            margin-top: 25px;
            page-break-inside: avoid;
            /* Mencegah ttd terpotong ke halaman baru sendirian */
        }

        .ttd-container {
            float: right;
            width: 250px;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="rahasia">RAHASIA</div>

    @if($type === 'sprintug')
    {{-- ================================================================ --}}
    {{-- LAYOUT SURAT PERINTAH TUGAS (SPRINTUG) --}}
    {{-- ================================================================ --}}
    
    {{-- KOP SURAT SPRINTUG --}}
    <table class="kop-table">
        <tr>
            <td class="logo-cell">
                @php
                    $logoPath = public_path('img/logo-kejaksaan.png');
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoBase64 = 'data:image/png;base64,' . $logoData;
                @endphp
                <img src="{{ $logoBase64 }}" class="logo-img">
            </td>
            <td class="teks-cell">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop-ganda"></div>

    <div class="judul" style="margin-bottom: 2px;">SURAT PERINTAH TUGAS</div>
    <div style="text-align: center; font-weight: bold; margin-bottom: 30px; font-size: 11pt;">NOMOR: {{ $data->nomor_sprintug ?? 'PRINT-..../..../..../....' }}</div>

    <table style="width: 100%; border:none; margin-bottom: 20px;">
        <tr>
            <td style="width: 15%; vertical-align: top; font-weight: bold; padding-bottom: 15px;">DASAR</td>
            <td style="width: 3%; vertical-align: top; padding-bottom: 15px;">:</td>
            <td style="width: 82%; text-align: justify; padding-bottom: 15px;">
                Laporan Pengaduan dari Masyarakat an. <strong>{{ $data->nama_pelapor ?? 'Anonim' }}</strong> tanggal {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') : '-' }} perihal dugaan indikasi {{ str_replace('_', ' ', $data->kategori_laporan) }} terkait perkara: <em>"{{ $data->judul_laporan }}"</em>.
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center; font-weight: bold; padding: 20px 0 15px 0; font-size: 12pt; text-decoration: underline;">MEMERINTAHKAN:</td>
        </tr>
        <tr>
            <td style="vertical-align: top; font-weight: bold; padding-bottom: 15px;">KEPADA</td>
            <td style="vertical-align: top; padding-bottom: 15px;">:</td>
            <td style="padding-bottom: 15px;">
                <ol style="margin: 0; padding-left: 15px;">
                    <li style="margin-bottom: 8px;">
                        Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Tim Satuan Intelijen Kejaksaan<br>
                        Pangkat &nbsp;: -<br>
                        Jabatan &nbsp;&nbsp;: Penyelidik / Petugas Lapangan
                    </li>
                </ol>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; font-weight: bold; padding-bottom: 15px;">UNTUK</td>
            <td style="vertical-align: top; padding-bottom: 15px;">:</td>
            <td style="text-align: justify;">
                <ol style="margin: 0; padding-left: 15px;">
                    <li style="margin-bottom: 5px;">Melakukan Operasi Intelijen (Pengumpulan Data dan Pengumpulan Keterangan / Pulbaket) terhadap Pihak Terlapor atas nama <strong>{{ $data->nama_terlapor }}</strong> ({{ $data->jabatan_terlapor ?? '-' }}) terkait Laporan Pengaduan tersebut di atas.</li>
                    <li style="margin-bottom: 5px;">Melaporkan hasil pelaksanaannya kepada Kepala Kejaksaan Negeri Banjarmasin secara berjenjang melalui Kepala Seksi Intelijen segera setelah tugas selesai dilaksanakan.</li>
                    <li style="margin-bottom: 5px;">Melaksanakan perintah ini dengan seksama dan penuh rasa tanggung jawab.</li>
                </ol>
            </td>
        </tr>
    </table>

    <div class="ttd-wrapper" style="margin-top: 40px;">
        <div class="ttd-container">
            <p style="margin: 0;">Dikeluarkan di : Banjarmasin</p>
            <p style="margin: 0; border-bottom: 1px solid #000; padding-bottom: 5px; display: inline-block;">Pada Tanggal &nbsp;&nbsp;: {{ $data->tanggal_sprintug ? \Carbon\Carbon::parse($data->tanggal_sprintug)->translatedFormat('d F Y') : '-' }}</p>
            <p style="margin-top: 10px; font-weight: bold; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'lapdu', 'id' => $data->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(95)->generate($qrContent)) !!} " alt="QR Code Validasi">
            </div>

            <!-- Identitas Penandatangan -->
            <p style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 10pt;">Raya Bimanta S.H., M.H</p>
            <p style="margin: 2px 0 0 0; font-size: 10pt;">Jaksa Utama Muda (IV/c)</p>
            <p style="margin: 0; font-size: 10pt;">NIP. 199001012020011001</p>
        </div>
        <div class="clear"></div>
    </div>

    @else
    {{-- ================================================================ --}}
    {{-- LAYOUT TANDA TERIMA / KARTU PENERUS DISPOSISI (EXISTING) --}}
    {{-- ================================================================ --}}

    {{-- KOP SURAT --}}
    <table class="kop-table">
        <tr>
            <td class="logo-cell">
                @php
                    $logoPath = public_path('img/logo-kejaksaan.png');
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoBase64 = 'data:image/png;base64,' . $logoData;
                @endphp
                <img src="{{ $logoBase64 }}" class="logo-img">
            </td>
            <td class="teks-cell">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop-ganda"></div>

    <div class="judul">KARTU PENERUS DISPOSISI PENGADUAN</div>

    <table class="table-data">
        <tr>
            <td class="label">Tanggal Terima</td>
            <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Identitas Pelapor</td>
            <td>
                <strong>{{ $data->nama_pelapor ?? 'ANONIM' }}</strong><br>
                <span style="font-size: 10pt;">NIK: {{ $data->nik ?? '-' }} / HP: {{ $data->no_hp ?? '-' }}</span>
            </td>
        </tr>
        <tr>
            <td class="label">Pihak Terlapor</td>
            <td><strong>{{ strtoupper($data->nama_terlapor ?? 'TIDAK DIKETAHUI') }}</strong></td>
        </tr>
        <tr>
            <td class="label">Kategori Laporan</td>
            <td>{{ $data->kategori_laporan }}</td>
        </tr>
        <tr>
            <td class="label">Status Saat Ini</td>
            <td>
                @php
                $statusLabel = [
                'selesai' => 'SELESAI',
                'proses' => 'SEDANG DIPROSES',
                'tindak_lanjut' => 'DITINDAK LANJUTI',
                'arsip' => 'DIARSIPKAN'
                ];
                @endphp
                <strong style="text-transform: uppercase;">{{ $statusLabel[$data->status_laporan] ?? 'MENUNGGU DISPOSISI' }}</strong>
            </td>
        </tr>
    </table>

    <div class="box-title">URAIAN SINGKAT PENGADUAN:</div>
    <div class="box-uraian">
        {{ $data->uraian_pengaduan }}

        {{-- CEK APAKAH ADA BUKTI GAMBAR --}}
        @if($data->bukti_foto && file_exists(public_path('storage/' . $data->bukti_foto)))
        <div class="evidence-container">
            <div style="font-size: 9pt; font-weight: bold; margin-bottom: 2px;">LAMPIRAN BUKTI:</div>
            <img src="{{ public_path('storage/' . $data->bukti_foto) }}" class="evidence-img">
        </div>
        @endif
    </div>

    <div class="box-title">DISPOSISI / PETUNJUK PIMPINAN:</div>
    <div class="box-disposisi">
        <span style="text-decoration: underline; font-style: italic; font-weight: bold;">Catatan:</span>
        <br><br>
        <p style="line-height: 1.4; margin: 0;">
            {{ $data->keterangan_tindak_lanjut ?? 'Belum ada catatan tindak lanjut.' }}
        </p>
    </div>

    {{-- TANDA TANGAN WRAPPER --}}
    <div class="ttd-wrapper">
        <div class="ttd-container">
            <p>Banjarmasin, {{ now()->translatedFormat('d F Y') }}</p>
            <p>Petugas Penerima,</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold; margin-bottom: 0;">{{ auth()->user()->name }}</p>
            <p style="margin-top: 2px;">NIP. {{ auth()->user()->nip ?? '-' }}</p>
        </div>
        <div class="clear"></div>
    </div>

    @endif

</body>

</html>