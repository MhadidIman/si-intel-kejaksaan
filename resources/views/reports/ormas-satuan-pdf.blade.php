<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Ormas - {{ $item->nama_organisasi }}</title>
    <style>
        /* Pengaturan Kertas */
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        /* --- STYLING KOP SURAT (SERAGAM) --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .logo-cell {
            width: 100px;
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
            padding-right: 80px;
        }

        .teks-cell h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell p {
            font-size: 9pt;
            margin: 1px 0;
            line-height: 1.2;
        }

        .garis-kop-ganda {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            height: 2px;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        /* --- STYLING ISI DOKUMEN --- */
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table td {
            vertical-align: top;
            padding: 5px 0;
        }

        .label {
            width: 180px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
        }

        /* Stampel Status */
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

        /* Tanda Tangan */
        .ttd-container {
            float: right;
            width: 300px;
            text-align: center;
            margin-top: 50px;
        }

        .nama-terang {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 70px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <table class="kop-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('img/logo-kejaksaan.png') }}" class="logo-img">
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

    <div style="width: 100%; margin-top: 50px;">
        <div style="float: right; width: 300px; text-align: center;">
            <p>Mengetahui,</p>
            <p><strong>Kepala Seksi Intelijen</strong></p>
            <div style="margin: 15px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'ormas', 'id' => $item->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($qrContent)) !!} ">
            </div>

            <p><u>Nama Kasi Intelijen</u></p>
            <p>NIP. 1234567890</p>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>

</html>