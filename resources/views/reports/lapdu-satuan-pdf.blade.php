<!DOCTYPE html>
<html>

<head>
    <title>Disposisi Lapdu - {{ $data->terlapor }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            font-weight: bold;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
            font-size: 14pt;
        }

        .rahasia {
            text-align: right;
            font-weight: bold;
            font-style: italic;
            margin-bottom: 10px;
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
            height: 180px;
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
    </style>
</head>

<body>
    <div class="rahasia">RAHASIA</div>

    <div class="header">
        KEJAKSAAN REPUBLIK INDONESIA<br>
        BIDANG INTELIJEN
    </div>

    <div class="judul">KARTU PENERUS DISPOSISI PENGADUAN</div>

    <table class="table-data">
        <tr>
            <td class="label">Nomor Surat</td>
            <td>: {{ $data->nomor_surat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Terima</td>
            {{-- Menggunakan tanggal_terima sesuai migration --}}
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
        {{-- Menggunakan uraian_pengaduan sesuai migration --}}
        {{ $data->uraian_pengaduan }}
    </div>

    <strong>DISPOSISI PIMPINAN:</strong>
    <div class="box-disposisi">
        <span class="catatan">Petunjuk Kasi Intel / Kajari:</span>
        <br><br>
        {{-- Menampilkan disposisi_pimpinan jika sudah diisi --}}
        {{ $data->disposisi_pimpinan ?? '' }}
    </div>

    <div class="footer">
        <div class="ttd">
            <p>{{ config('app.kota', 'Jakarta') }}, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Petugas Penerima,</p>
            <br><br><br><br>
            <p><strong>{{ auth()->user()->name }}</strong></p>
        </div>
    </div>
</body>

</html>