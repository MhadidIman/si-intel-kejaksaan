<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan PAM SDO - {{ $item->nama_pegawai }}</title>
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

        /* --- STYLING KOP SURAT --- */
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
        .rahasia-top {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 11pt;
            margin-bottom: 10px;
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
            margin-bottom: 15px;
        }

        .label-heading {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        .value-text {
            text-align: justify;
            padding-left: 20px;
            margin-bottom: 10px;
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
            width: 220px;
            font-weight: bold;
        }

        .col-sep {
            width: 15px;
            text-align: center;
        }

        /* FOTO DI BAWAH */
        .foto-wrapper {
            margin-top: 20px;
            text-align: center;
            page-break-inside: avoid;
        }

        .foto-container {
            width: 300px;
            height: auto;
            border: 1px solid #000;
            padding: 5px;
            margin: 0 auto;
            background-color: #f9f9f9;
        }

        .foto-img {
            width: 100%;
            height: auto;
            display: block;
        }

        .foto-label {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        /* STATUS BOX */
        .status-box {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 30px;
            background-color: #f0f0f0;
        }

        /* TANDA TANGAN */
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

    <div class="judul">LAPORAN PENGAMANAN SUMBER DAYA ORGANISASI (SDO)</div>

    <div class="content-block">
        <table class="table-info">
            <tr>
                <td class="col-label">Hari / Tanggal Laporan</td>
                <td class="col-sep">:</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
                <td class="col-label">Nama Pegawai / Jaksa</td>
                <td class="col-sep">:</td>
                <td><strong>{{ strtoupper($item->nama_pegawai) }}</strong></td>
            </tr>
            <tr>
                <td class="col-label">NIP / NRP</td>
                <td class="col-sep">:</td>
                <td>{{ $item->nip_nrp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="col-label">Pangkat / Jabatan</td>
                <td class="col-sep">:</td>
                <td>{{ $item->pangkat_jabatan }}</td>
            </tr>
            <tr>
                <td class="col-label">Satuan Kerja</td>
                <td class="col-sep">:</td>
                <td>{{ $item->satuan_kerja }}</td>
            </tr>
        </table>
    </div>

    <div class="content-block">
        <div class="label-heading">I. URAIAN PERMASALAHAN / INDIKASI</div>
        <div class="value-text">
            {{ $item->permasalahan }}
        </div>
    </div>

    <div class="content-block">
        <div class="label-heading">II. KETERANGAN / TINDAK LANJUT</div>
        <div class="value-text">
            {{ $item->keterangan ?? 'Tidak ada keterangan tambahan.' }}
        </div>
    </div>

    <div class="status-box">
        STATUS PENGAMANAN:
        @if($item->status_pam == 'clear')
        <span style="color: green;">AMAN / CLEAR</span>
        @elseif($item->status_pam == 'ditindak')
        <span style="color: orange;">DITINDAK LANJUTI</span>
        @else
        <span style="color: red;">DALAM PENGAWASAN</span>
        @endif
    </div>

    @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
    <div class="foto-wrapper">
        <div class="foto-label">Lampiran Dokumentasi</div>
        <div class="foto-container">
            <img src="{{ public_path('storage/' . $item->foto) }}" class="foto-img">
        </div>
    </div>
    @endif
    <div class="ttd-container">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Kepala Seksi Intelijen,</p>

        <br><br><br>

        <div class="nama-terang">Dimas Purnama Putra, S.H.,M.H</div>
        <div>Jaksa Madya / NIP. 19850101 201001 1 001</div>
    </div>

    <div class="clear"></div>
    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>