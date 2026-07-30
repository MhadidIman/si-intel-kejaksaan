<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Informasi - {{ $item->nomor_surat }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #000;
            -webkit-print-color-adjust: exact;
            /* Memastikan warna/grafis tercetak jelas di browser */
        }

        .rahasia-top {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-bottom: 10px;
        }

        /* --- KOP SURAT --- */
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

        /* --- KONTEN LAPORAN --- */
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 13pt;
            margin-bottom: 2px;
        }

        .nomor {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 25px;
        }

        .meta-data {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .meta-data td {
            vertical-align: top;
            padding-bottom: 5px;
            font-size: 11pt;
        }

        .label {
            width: 130px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .content-text {
            text-align: justify;
            margin-bottom: 10px;
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

        .rahasia-bottom {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-top: 30px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<!-- Menambahkan onload window.print() di sini -->

<body onload="window.print()">

    <div class="rahasia-top">RAHASIA</div>

    <!-- KOP SURAT 3 KOLOM AGAR PRESISI DI TENGAH -->
    <table class="kop-table">
        <tr>
            <!-- Kolom 1: Logo (15%) -->
            <td style="width: 15%; text-align: center;">
                <img src="{{ asset('img/logo-kejaksaan.png') }}" style="width: 75px; height: auto;">
            </td>
            <!-- Kolom 2: Teks Utama (70%) -->
            <td class="teks-center" style="width: 70%;">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
            <!-- Kolom 3: Penyeimbang (15%) - Kosong -->
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <div class="garis-tipis"></div>

    <div class="judul">LAPORAN INFORMASI</div>
    <div class="nomor">NOMOR: {{ $item->nomor_surat ?? 'R-......./......./.......' }}</div>

    <table class="meta-data">
        <tr>
            <td class="label">Kepada Yth.</td>
            <td class="sep">:</td>
            <td>Kepala Kejaksaan Negeri</td>
        </tr>
        <tr>
            <td class="label">Dari</td>
            <td class="sep">:</td>
            <td>Kepala Seksi Intelijen</td>
        </tr>
        <tr>
            <td class="label">Tanggal</td>
            <td class="sep">:</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->isoFormat('D MMMM Y') }}</td>
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
                LAPORAN INFORMASI {{ $item->bidang }}
            </td>
        </tr>
    </table>

    <div style="border-bottom: 2px solid black; margin-bottom: 20px;"></div>

    <div class="section-title">I. PENDAHULUAN (SUMBER INFORMASI)</div>
    <div class="content-text">
        Informasi ini diperoleh dari sumber {{ $item->sumber_informasi }}. Informasi diterima pada tanggal {{ \Carbon\Carbon::parse($item->tanggal_surat)->isoFormat('D MMMM Y') }} mengenai situasi dan kondisi di wilayah hukum Kejaksaan Negeri Banjarmasin terkait bidang {{ $item->bidang }}.
    </div>

    <div class="section-title">II. FAKTA - FAKTA</div>
    <div class="content-text">
        Berdasarkan pemantauan dan pengumpulan data di lapangan, diperoleh fakta-fakta sebagai berikut:
    </div>
    <div class="content-text">
        {{ $item->peristiwa }}
    </div>

    <div class="section-title">III. PENDAPAT / ANALISA INTELIJEN</div>
    <div class="content-text">
        {{ $item->pendapat }}
    </div>

    <div class="section-title">IV. KESIMPULAN DAN SARAN</div>
    <div class="content-text">
        Berdasarkan uraian fakta dan analisa di atas, disarankan kepada Pimpinan untuk menindaklanjuti informasi ini sesuai dengan prosedur yang berlaku serta terus melakukan monitoring terhadap perkembangan situasi.
    </div>

    <!-- TANDA TANGAN -->
    <div class="ttd-container">
        <div class="ttd-box">
            <p style="margin: 0; font-weight: bold;">Mengetahui,</p>
            <p style="margin: 0; font-weight: bold;">Kepala Seksi Intelijen</p>

            <div style="margin: 10px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'lapinhar', 'id' => $item->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(90)->generate($qrContent)) !!} ">
            </div>

            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Nama Kasi Intelijen</p>
            <p style="margin: 0;">NIP. 1234567890</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>