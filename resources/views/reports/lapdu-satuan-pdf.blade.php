<!DOCTYPE html>
<html>

<head>
    <title>Disposisi Lapdu - {{ $data->nama_terlapor }}</title>
    <style>
        /* Pengaturan Standar Surat Dinas */
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

        /* --- KOP SURAT --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
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

        /* --- ISI DOKUMEN --- */
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
            margin-bottom: 30px;
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
            width: 200px;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .box-uraian {
            border: 1px solid #000;
            padding: 15px;
            min-height: 100px;
            margin-bottom: 20px;
            text-align: justify;
        }

        .box-disposisi {
            border: 2px solid #000;
            min-height: 150px;
            margin-top: 5px;
            padding: 15px;
        }

        .catatan {
            font-weight: bold;
            text-decoration: underline;
            font-style: italic;
        }

        .footer {
            margin-top: 40px;
        }

        .ttd {
            float: right;
            width: 300px;
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
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop-ganda"></div>

    <div class="judul">KARTU PENERUS DISPOSISI PENGADUAN</div>

    <table class="table-data">
        <tr>
            <td class="label">Tanggal Terima</td>
            <td>: {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
        </tr>
        <tr>
            <td class="label">Nama Pelapor</td>
            <td>: {{ $data->nama_pelapor ?? 'ANONIM' }}</td>
        </tr>
        <tr>
            <td class="label">NIK / Kontak</td>
            <td>: {{ $data->nik ?? '-' }} / {{ $data->no_hp ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Pihak Terlapor</td>
            <td>: <strong>{{ strtoupper($data->nama_terlapor ?? 'TIDAK DIKETAHUI') }}</strong></td>
        </tr>
        <tr>
            <td class="label">Kategori Laporan</td>
            <td>: {{ $data->kategori_laporan }}</td>
        </tr>
        <tr>
            <td class="label">Status Saat Ini</td>
            <td>:
                @if($data->status_laporan == 'selesai')
                <span style="color: green; font-weight: bold;">SELESAI</span>
                @elseif($data->status_laporan == 'proses')
                <span style="color: orange; font-weight: bold;">SEDANG DIPROSES</span>
                @else
                <span style="color: gray; font-weight: bold;">MENUNGGU DISPOSISI</span>
                @endif
            </td>
        </tr>
    </table>

    <div style="margin-bottom: 5px; font-weight: bold;">URAIAN SINGKAT PENGADUAN:</div>
    <div class="box-uraian">
        {{ $data->uraian_pengaduan }}
    </div>

    <div style="margin-bottom: 5px; font-weight: bold;">DISPOSISI / TINDAK LANJUT PIMPINAN:</div>
    <div class="box-disposisi">
        <span class="catatan">Catatan / Petunjuk:</span>
        <br><br>
        <p style="line-height: 1.6;">
            {{ $data->keterangan_tindak_lanjut ?? 'Belum ada catatan tindak lanjut.' }}
        </p>
    </div>

    <div class="footer">
        <div class="ttd">
            <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Petugas Penerima,</p>
            <br><br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">{{ auth()->user()->name }}</p>
            <p>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '....................' }}</p>
        </div>
    </div>
    <div class="clear"></div>

</body>

</html>