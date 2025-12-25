<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Informasi - {{ $item->nomor_surat }}</title>
    <style>
        /* Pengaturan Kertas dan Font Standar Dinas */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm 2cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        /* --- STYLING KOP SURAT PRESISI --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .logo-cell {
            width: 100px;
            /* Lebar kolom logo */
            vertical-align: middle;
            text-align: left;
        }

        .logo-img {
            width: 90px;
            /* Logo diperbesar agar lebih presisi */
            height: auto;
        }

        .teks-cell {
            text-align: center;
            vertical-align: middle;
            padding-right: 90px;
            /* Penyeimbang agar teks benar-benar di tengah */
        }

        .teks-cell h1 {
            font-size: 13pt;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            font-weight: normal;
        }

        .teks-cell h2 {
            font-size: 15pt;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            font-weight: bold;
        }

        .teks-cell p {
            font-size: 8.5pt;
            margin: 1px 0;
            padding: 0;
            line-height: 1.2;
        }

        .garis-kop-ganda {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            height: 2px;
            margin-top: 8px;
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
        }

        .nomor {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .meta-data {
            width: 100%;
            margin-bottom: 20px;
        }

        .meta-data td {
            vertical-align: top;
            padding-bottom: 2px;
        }

        .label {
            width: 100px;
        }

        .sep {
            width: 10px;
            text-align: center;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .content-text {
            text-align: justify;
            text-indent: 30px;
            margin-bottom: 10px;
        }

        .ttd-container {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 50px;
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
                <p>JALAN BRIG JEND H. HASAN BASRI NO. 3 RW.002 KELURAHAN PANGERAN KECAMATAN BANJARMASIN UTARA</p>
                <p>KOTA BANJARMASIN PROVINSI KALIMANTAN SELATAN KODE POS 70124</p>
                <p>TELPON : (0511) 3300402 / 6723314 FAX : (0511) 6723314</p>
                <p>website : kejari-banjarmasin.go.id, email : kasubagbin@kejari-banjarmasin.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop-ganda"></div>

    <div class="judul">LAPORAN INFORMASI</div>
    <div class="nomor">NOMOR: {{ $item->nomor_surat ?? 'R-......./......./.......' }}</div>

    <table class="meta-data" border="0" cellspacing="0" cellpadding="0">
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
            <td class="label">Bidang</td>
            <td class="sep">:</td>
            <td>{{ $item->bidang }}</td>
        </tr>
    </table>

    <div style="border-bottom: 1px solid black; margin-bottom: 20px;"></div>

    <div class="section-title">I. PENDAHULUAN (SUMBER INFORMASI)</div>
    <div class="content-text">
        Informasi ini diperoleh dari {{ $item->sumber_informasi }}. Informasi diterima pada tanggal {{ \Carbon\Carbon::parse($item->tanggal_surat)->isoFormat('D MMMM Y') }} terkait situasi di wilayah hukum Kejaksaan Negeri.
    </div>

    <div class="section-title">II. FAKTA - FAKTA</div>
    <div class="content-text">
        Telah dilaporkan mengenai peristiwa: <strong>{{ $item->peristiwa }}</strong>.
    </div>
    <div class="content-text">
        Adapun rincian kejadian dan data pendukung terkait peristiwa tersebut telah diverifikasi dan dicatat sesuai dengan temuan di lapangan.
    </div>

    <div class="section-title">III. PENDAPAT / ANALISA INTELIJEN</div>
    <div class="content-text">
        {{ $item->pendapat }}
    </div>

    <div class="section-title">IV. KESIMPULAN DAN SARAN</div>
    <div class="content-text">
        Berdasarkan fakta-fakta dan analisa di atas, disarankan kepada Pimpinan untuk menindaklanjuti informasi ini sesuai dengan prosedur yang berlaku dan melakukan monitoring perkembangan situasi lebih lanjut.
    </div>

    <div class="ttd-container">
        <p>Banjarmasin, {{ \Carbon\Carbon::parse($item->tanggal_surat)->isoFormat('D MMMM Y') }}</p>
        <p>Pelapor,</p>

        <div class="nama-terang">{{ auth()->user()->name }}</div>
        <div>Jaksa Pratama / NIP. {{ auth()->user()->nip ?? '....................' }}</div>
    </div>

    <div style="clear: both;"></div>
    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>