<!DOCTYPE html>
<html>

<head>
    <title>Laporan PAM SDO - {{ $item->nama_pegawai }}</title>
    <style>
        /* Pengaturan Kertas dan Font Standar Dinas */
        @page {
            size: A4 portrait;
            margin: 2cm 2cm 2cm 2cm;
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
            /* Penyeimbang */
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
            margin-bottom: 20px;
        }

        /* --- STYLING ISI --- */
        .rahasia {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            margin-bottom: 10px;
            font-size: 11pt;
        }

        .judul {
            text-align: center;
            font-size: 13pt;
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
            padding: 3px 0;
        }

        .col-label {
            width: 200px;
            font-weight: bold;
        }

        .col-sep {
            width: 15px;
            text-align: center;
        }

        /* FOTO PROFILE */
        .foto-container {
            position: absolute;
            top: 210px;
            right: 0;
            width: 110px;
            height: 140px;
            border: 1px solid #000;
            padding: 3px;
        }

        .foto-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-box {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 30px;
            background-color: #f0f0f0;
        }

        .ttd {
            float: right;
            width: 300px;
            text-align: center;
            margin-top: 40px;
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
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop-ganda"></div>

    <div class="judul">LAPORAN PENGAMANAN SUMBER DAYA ORGANISASI (SDO)</div>

    @if($item->foto)
    <div class="foto-container">
        <img src="{{ public_path('storage/' . $item->foto) }}" class="foto-img">
    </div>
    @endif

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

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Kasi Intelijen,</p>
        <br><br><br><br>
        <p style="text-decoration: underline; font-weight: bold;">(NAMA PEJABAT)</p>
        <p>Jaksa Madya / NIP. ..........................</p>
    </div>

    <div style="clear: both;"></div>
    <div class="rahasia" style="margin-top: 30px;">RAHASIA</div>

</body>

</html>