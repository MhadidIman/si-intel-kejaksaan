<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Ormas - {{ $item->nama_organisasi }}</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            /* Disesuaikan agar proporsional */
            line-height: 1.5;
            color: #000;
            -webkit-print-color-adjust: exact;
            /* Wajib agar background warna status tercetak */
        }

        /* --- KOP SURAT 3 KOLOM --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px solid black;
        }

        .kop-table td {
            vertical-align: middle;
            padding-bottom: 5px;
        }

        .teks-center {
            text-align: center;
        }

        .teks-center h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
        }

        .teks-center h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
        }

        .teks-center p {
            font-size: 9pt;
            margin: 2px 0 0 0;
            line-height: 1.2;
        }

        .garis-tipis {
            border-top: 1px solid black;
            margin-top: 2px;
            margin-bottom: 20px;
        }

        /* --- STYLING ISI DOKUMEN --- */
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 13pt;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            margin-bottom: 10px;
            text-decoration: underline;
            font-size: 11pt;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table td {
            vertical-align: top;
            padding: 5px 0;
            font-size: 11pt;
        }

        .label {
            width: 180px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
            font-weight: bold;
        }

        /* --- STAMPEL STATUS --- */
        .status-box {
            margin-top: 30px;
            padding: 15px;
            border: 3px double;
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            text-transform: uppercase;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .dilarang {
            border-color: #dc2626;
            color: #dc2626;
            background-color: #fef2f2;
        }

        .diawasi {
            border-color: #d97706;
            color: #d97706;
            background-color: #fffbeb;
        }

        .aktif {
            border-color: #16a34a;
            color: #16a34a;
            background-color: #f0fdf4;
        }

        .vakum {
            border-color: #4b5563;
            color: #4b5563;
            background-color: #f9fafb;
        }

        /* --- TANDA TANGAN --- */
        .ttd-container {
            width: 100%;
            margin-top: 40px;
        }

        .ttd-box {
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

    <!-- KOP SURAT 3 KOLOM AGAR PRESISI DI TENGAH -->
    <table class="kop-table">
        <tr>
            <td style="width: 15%; text-align: center;">
                <img src="{{ asset('img/logo-kejaksaan.png') }}" style="width: 75px; height: auto;">
            </td>
            <td class="teks-center" style="width: 70%;">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <div class="garis-tipis"></div>

    <div class="judul">LEMBAR DATA ORGANISASI KEMASYARAKATAN</div>

    <div class="section-title">I. Identitas Organisasi</div>
    <table class="data-table">
        <tr>
            <td class="label">Nama Organisasi</td>
            <td class="sep">:</td>
            <td><strong>{{ strtoupper($item->nama_organisasi) }}</strong></td>
        </tr>
        <tr>
            <td class="label">Bentuk Organisasi</td>
            <td class="sep">:</td>
            <td>{{ $item->bentuk_organisasi }}</td>
        </tr>
        <tr>
            <td class="label">Nama Ketua / Pimpinan</td>
            <td class="sep">:</td>
            <td>{{ $item->ketua }}</td>
        </tr>
        <tr>
            <td class="label">Alamat Sekretariat</td>
            <td class="sep">:</td>
            <td>{{ $item->alamat_sekretariat }}</td>
        </tr>
    </table>

    <div class="section-title">II. Legalitas & Aktivitas</div>
    <table class="data-table">
        <tr>
            <td class="label">Nomor Legalitas</td>
            <td class="sep">:</td>
            <td>{{ $item->nomor_legalitas ?? 'Tidak Ada / Belum Terdata' }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Anggota</td>
            <td class="sep">:</td>
            <td>± {{ $item->jumlah_anggota }} Orang</td>
        </tr>
        <tr>
            <td class="label">Kegiatan Terakhir</td>
            <td class="sep">:</td>
            <td>{{ $item->kegiatan_terakhir ?? '-' }}</td>
        </tr>
    </table>

    @if($item->status == 'dilarang')
    <div class="status-box dilarang">
        STATUS: ORGANISASI DILARANG
        <div style="font-size: 10pt; margin-top: 5px; color: black; font-weight: normal; text-transform: none;">
            Organisasi ini telah dibubarkan atau dilarang oleh Pemerintah.
        </div>
    </div>
    @elseif($item->status == 'diawasi')
    <div class="status-box diawasi">
        STATUS: DALAM PENGAWASAN INTENSIF
    </div>
    @elseif($item->status == 'vakum')
    <div class="status-box vakum">
        STATUS: VAKUM / TIDAK AKTIF
    </div>
    @else
    <div class="status-box aktif">
        STATUS: AKTIF TERDAFTAR
    </div>
    @endif

    <!-- TANDA TANGAN -->
    <div class="ttd-container">
        <div class="ttd-box">
            <p style="margin: 0;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold;">Mengetahui,</p>
            <p style="margin: 0; font-weight: bold;">Kepala Seksi Intelijen</p>

            <div style="margin: 10px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'ormas', 'id' => $item->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(90)->generate($qrContent)) !!} ">
            </div>

            <p style="margin: 0; font-weight: bold; text-decoration: underline;">NAMA KEPALA SEKSI INTELIJEN</p>
            <p style="margin: 0;">Jaksa Madya / NIP. 198XXXXXXXXXXXXXX</p>
        </div>
        <div class="clear"></div>
    </div>

</body>

</html>