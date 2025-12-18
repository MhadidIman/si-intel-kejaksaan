<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Informasi - {{ $item->nomor_surat }}</title>
    <style>
        /* Pengaturan Kertas dan Font Standar Dinas */
        @page {
            size: A4 portrait;
            margin: 2.5cm 2.5cm 2.5cm 2.5cm;
            /* Margin standar surat dinas */
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        /* Klasifikasi Rahasia */
        .rahasia-top {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 11pt;
            margin-bottom: 0px;
        }

        .rahasia-bottom {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 11pt;
            margin-top: 30px;
        }

        /* Kop Surat Sederhana */
        .kop-surat {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        /* Garis Pemisah Kop */
        .garis-kop {
            border-bottom: 3px double black;
            /* Garis ganda tebal tipis */
            margin-bottom: 20px;
        }

        /* Judul Laporan */
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

        /* Bagian Kepada/Dari (Header Laporan) */
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

        /* Isi Laporan */
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .content-text {
            text-align: justify;
            text-indent: 30px;
            /* Menjorok ke dalam seperti paragraf surat */
            margin-bottom: 10px;
        }

        /* Tanda Tangan */
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
    </style>
</head>

<body>

    <div class="rahasia-top">RAHASIA</div>

    <div class="kop-surat">
        KEJAKSAAN REPUBLIK INDONESIA<br>
        KEJAKSAAN TINGGI (PROVINSI ANDA)<br>
        KEJAKSAAN NEGERI (KOTA ANDA)
    </div>

    <div class="garis-kop"></div>

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
            <td class="label">Perihal</td>
            <td class="sep">:</td>
            <td style="font-weight: bold; text-transform: uppercase;">{{ $item->peristiwa }}</td>
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
        {{ $item->peristiwa }}
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
        <p>{{ config('app.kota_kantor', 'Jakarta') }}, {{ \Carbon\Carbon::parse($item->tanggal_surat)->isoFormat('D MMMM Y') }}</p>
        <p>Pelapor,</p>

        <div class="nama-terang">{{ auth()->user()->name }}</div>
        <div>Jaksa Pratama / NIP. ....................</div>
    </div>

    <div style="clear: both;"></div>
    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>