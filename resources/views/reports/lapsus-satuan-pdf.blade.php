<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Khusus - {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('Y-m-d') }}</title>
    <style>
        /* Pengaturan Kertas dan Font Standar Dinas */
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            margin: 0;
            padding: 0;
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
            /* Penyeimbang agar teks di tengah */
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

        /* --- STYLING ISI LAPORAN --- */
        .rahasia-top {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 11pt;
            margin-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 2px;
            text-transform: uppercase;
        }

        .nomor {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .meta-data {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .meta-data td {
            vertical-align: top;
            padding-bottom: 4px;
        }

        .label {
            width: 140px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        .content-text {
            text-align: justify;
            text-indent: 30px;
            margin-bottom: 10px;
            min-height: 20px;
        }

        .content-text p {
            margin: 0 0 5px 0;
            text-indent: 0;
        }

        .ttd-container {
            float: right;
            width: 300px;
            text-align: center;
            margin-top: 40px;
        }

        .nama-terang {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 70px;
        }

        .rahasia-bottom {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 11pt;
            margin-top: 30px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">
    {{-- Trik Base64 untuk Logo --}}
    @php
    $logoPath = public_path('img/logo-kejaksaan.png');
    $logoData = base64_encode(file_get_contents($logoPath));
    $logoSrc = 'data:image/png;base64,' . $logoData;
    @endphp

    <div class="rahasia-top">{{ strtoupper($laporan->tingkat_kerahasiaan) }}</div>

    <table class="kop-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ $logoSrc }}" class="logo-img">
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

    <div class="judul">NOTA DINAS / LAPORAN KHUSUS</div>
    <div class="nomor">NOMOR: R-......./......./.......</div>

    <table class="meta-data">
        <tr>
            <td class="label">Kepada Yth.</td>
            <td class="sep">:</td>
            <td>Kepala Kejaksaan Negeri Banjarmasin</td>
        </tr>
        <tr>
            <td class="label">Dari</td>
            <td class="sep">:</td>
            <td>Kepala Seksi Intelijen</td>
        </tr>
        <tr>
            <td class="label">Tanggal</td>
            <td class="sep">:</td>
            <td>{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td class="label">Sifat</td>
            <td class="sep">:</td>
            <td style="color:red; font-weight:bold;">{{ strtoupper($laporan->tingkat_kerahasiaan) }}</td>
        </tr>
        <tr>
            <td class="label">Lampiran</td>
            <td class="sep">:</td>
            <td>-</td>
        </tr>
        <tr>
            <td class="label">Perihal</td>
            <td class="sep">:</td>
            <td style="text-transform: uppercase; font-weight: bold; text-decoration: underline;">
                Laporan Khusus Terkait {{ $laporan->siapa }}
            </td>
        </tr>
    </table>

    <div style="border-bottom: 2px solid black; margin-bottom: 20px;"></div>

    <div class="section-title">I. FAKTA - FAKTA KRONOLOGIS</div>
    <div class="content-text" style="text-indent: 0;">
        <p>Bahwa pada waktu <strong>{{ $laporan->kapan }}</strong> bertempat di <strong>{{ $laporan->dimana }}</strong>, telah terjadi suatu peristiwa yang melibatkan <strong>{{ $laporan->siapa }}</strong>. Uraian kejadian selengkapnya sebagai berikut:</p>
        <p><strong>A. Peristiwa (Apa):</strong><br> {{ $laporan->apa }}</p>
        <p><strong>B. Latar Belakang (Mengapa):</strong><br> {{ $laporan->mengapa }}</p>
        <p><strong>C. Kronologis (Bagaimana):</strong><br> {{ $laporan->bagaimana }}</p>
    </div>

    <div class="section-title">II. PENDAPAT / ANALISA INTELIJEN</div>
    <div class="content-text" style="text-indent: 0;">
        {{ $laporan->analisa ?? 'Belum ada analisa.' }}
    </div>

    <div class="section-title">III. KESIMPULAN DAN SARAN TINDAKAN</div>
    <div class="content-text" style="text-indent: 0;">
        {{ $laporan->saran ?? 'Belum ada saran tindakan.' }}
        <br><br>
        Demikian laporan khusus ini dibuat untuk menjadi periksa dan mohon petunjuk Pimpinan lebih lanjut.
    </div>

    <div style="width: 100%; margin-top: 50px;">
        <div style="float: right; width: 300px; text-align: center;">
            <p>Mengetahui,</p>
            <p><strong>Kepala Seksi Intelijen</strong></p>
            <div style="margin: 15px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'lapsus', 'id' => $laporan->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($qrContent)) !!} ">
            </div>

            <p><u>Nama Kasi Intelijen</u></p>
            <p>NIP. 1234567890</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="clear"></div>
    <div class="rahasia-bottom">{{ strtoupper($laporan->tingkat_kerahasiaan) }}</div>

</body>

</html>