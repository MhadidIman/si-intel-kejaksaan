<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengamanan - {{ $item->target }}</title>
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
            vertical-align: middle;
            text-align: left;
        }

        .logo-img {
            width: 90px;
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

        /* --- STYLING ISI DOKUMEN --- */
        .rahasia {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            margin-bottom: 5px;
            font-size: 11pt;
        }

        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .content-block {
            margin-bottom: 20px;
        }

        .label-heading {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .value-text {
            text-align: justify;
            padding-left: 25px;
        }

        .table-info {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table-info td {
            vertical-align: top;
            padding: 4px 0;
        }

        .col-label {
            width: 180px;
            font-weight: bold;
        }

        .col-sep {
            width: 15px;
            text-align: center;
        }

        .status-box {
            border: 2px solid black;
            padding: 12px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            background-color: #f4f4f4;
        }

        .ttd {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="rahasia">RAHASIA</div>

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

    <div class="judul">LAPORAN PELAKSANAAN PENGAMANAN SDO</div>

    <div class="content-block">
        <table class="table-info">
            <tr>
                <td class="col-label">Hari / Tanggal</td>
                <td class="col-sep">:</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_laporan)->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
                <td class="col-label">Kategori Pengamanan</td>
                <td class="col-sep">:</td>
                <td>{{ $item->kategori }}</td>
            </tr>
            <tr>
                <td class="col-label">Target / Sasaran</td>
                <td class="col-sep">:</td>
                <td><strong>{{ strtoupper($item->target) }}</strong></td>
            </tr>
            <tr>
                <td class="col-label">Identitas (NIP/No)</td>
                <td class="col-sep">:</td>
                <td>{{ $item->nip_atau_nomor ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="content-block">
        <div class="label-heading">I. URAIAN PERMASALAHAN / ANCAMAN</div>
        <div class="value-text">
            {{ $item->uraian_masalah }}
        </div>
    </div>

    <div class="content-block">
        <div class="label-heading">II. TINDAKAN PENGAMANAN YANG DILAKUKAN</div>
        <div class="value-text">
            {{ $item->tindakan_pam ?? 'Belum ada tindakan khusus yang dicatat.' }}
        </div>
    </div>

    <div class="content-block">
        <div class="label-heading">III. KETERANGAN TAMBAHAN</div>
        <div class="value-text">
            {{ $item->keterangan ?? '-' }}
        </div>
    </div>

    <div class="status-box">
        STATUS TERAKHIR: {{ strtoupper($item->status) }}
    </div>

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::parse($item->tanggal_laporan)->isoFormat('D MMMM Y') }}</p>
        <p>Petugas PAM,</p>
        <br><br><br><br>
        <p style="text-decoration: underline; font-weight: bold;">{{ auth()->user()->name }}</p>
        <p>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '....................' }}</p>
    </div>

    <div style="clear: both;"></div>
    <div class="rahasia" style="margin-top: 30px;">RAHASIA</div>

</body>

</html>