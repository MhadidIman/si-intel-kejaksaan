<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Disposisi Lapdu - {{ $data->terlapor }}</title>
    <style>
        /* Pengaturan Standar Surat Dinas */
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
            /* Ukuran logo diperbesar agar presisi */
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
            margin-bottom: 20px;
        }

        /* --- STYLING ISI DOKUMEN --- */
        .rahasia {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-data td {
            padding: 8px;
            vertical-align: top;
            border: 1px solid #000;
        }

        .label {
            width: 180px;
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .box-uraian {
            border: 1px solid #000;
            padding: 10px;
            min-height: 120px;
            margin-bottom: 20px;
            text-align: justify;
        }

        .box-disposisi {
            border: 2px solid #000;
            min-height: 180px;
            margin-top: 5px;
            padding: 10px;
            position: relative;
        }

        .catatan {
            font-weight: bold;
            text-decoration: underline;
        }

        .footer {
            margin-top: 30px;
        }

        .ttd {
            float: right;
            width: 250px;
            text-align: center;
        }

        .clear {
            clear: both;
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

    <div class="judul">KARTU PENERUS DISPOSISI PENGADUAN</div>

    <table class="table-data">
        <tr>
            <td class="label">Nomor Surat</td>
            <td>: {{ $data->nomor_surat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Terima</td>
            <td>: {{ \Carbon\Carbon::parse($data->tanggal_terima)->isoFormat('dddd, D MMMM Y') }}</td>
        </tr>
        <tr>
            <td class="label">Nama Pelapor</td>
            <td>: {{ $data->nama_pelapor ?? 'ANONIM' }}</td>
        </tr>
        <tr>
            <td class="label">Pihak Terlapor</td>
            <td>: <strong>{{ strtoupper($data->terlapor) }}</strong></td>
        </tr>
        <tr>
            <td class="label">Status Laporan</td>
            <td>: <span style="text-transform: uppercase; font-weight: bold;">{{ $data->status }}</span></td>
        </tr>
    </table>

    <strong>URAIAN PENGADUAN:</strong>
    <div class="box-uraian">
        {{ $data->uraian_pengaduan }}
    </div>

    <strong>DISPOSISI PIMPINAN:</strong>
    <div class="box-disposisi">
        <span class="catatan">Petunjuk Kasi Intel / Kajari:</span>
        <br><br>
        {{ $data->disposisi_pimpinan ?? '' }}
    </div>

    <div class="footer">
        <div class="ttd">
            <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Petugas Penerima,</p>
            <br><br><br><br>
            <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '..........' }}</p>
        </div>
    </div>
    <div class="clear"></div>
</body>

</html>