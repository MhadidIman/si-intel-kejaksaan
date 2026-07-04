<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Informasi - {{ $item->nomor_surat }}</title>
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

<body>

    <div class="rahasia-top">RAHASIA</div>

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
            <td style="text-transform: uppercase; font-weight: bold;">Laporan Informasi {{ $item->bidang }}</td>
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
    <div class="content-text" style="text-indent: 0;">
        {{ $item->peristiwa }}
    </div>

    <div class="section-title">III. PENDAPAT / ANALISA INTELIJEN</div>
    <div class="content-text" style="text-indent: 0;">
        {{ $item->pendapat }}
    </div>

    <div class="section-title">IV. KESIMPULAN DAN SARAN</div>
    <div class="content-text">
        Berdasarkan uraian fakta dan analisa di atas, disarankan kepada Pimpinan untuk menindaklanjuti informasi ini sesuai dengan prosedur yang berlaku serta terus melakukan monitoring terhadap perkembangan situasi.
    </div>

    <div style="width: 100%; margin-top: 50px;">
        <div style="float: right; width: 300px; text-align: center;">
            <p>Mengetahui,</p>
            <p><strong>Kepala Seksi Intelijen</strong></p>

            <div style="margin: 15px 0;">
                @php
                // Diubah ke $item->id agar sesuai dengan variabel data di file ini
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'lapinhar', 'id' => $item->id]);
                @endphp

                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($qrContent)) !!} ">
            </div>

            <p><u>Nama Kasi Intelijen</u></p>
            <p>NIP. 1234567890</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="clear"></div>
    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>