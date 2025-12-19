<!DOCTYPE html>
<html>

<head>
    {{-- GANTI $item JADI $data --}}
    <title>Laporan Kegiatan - {{ $data->nama_sekolah }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
        }

        /* Tabel Data */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table td {
            padding: 8px;
            vertical-align: top;
            border-bottom: 1px solid #eee;
        }

        .label {
            width: 180px;
            font-weight: bold;
        }

        .sep {
            width: 10px;
            text-align: center;
        }

        /* Foto Dokumentasi */
        .foto-container {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .foto-container img {
            max-width: 100%;
            height: auto;
            max-height: 400px;
            border-radius: 4px;
        }

        .caption {
            font-size: 10pt;
            font-style: italic;
            color: #555;
            margin-top: 5px;
        }

        .ttd {
            float: right;
            width: 250px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="header">
        KEJAKSAAN REPUBLIK INDONESIA<br>
        BIDANG INTELIJEN - PENERANGAN HUKUM
    </div>

    <div class="judul">LAPORAN KEGIATAN JAKSA MASUK SEKOLAH</div>

    <h3 style="text-decoration: underline;">I. DATA KEGIATAN</h3>
    <table class="data-table">
        <tr>
            <td class="label">Nama Sekolah</td>
            <td class="sep">:</td>
            <td><strong>{{ strtoupper($data->nama_sekolah) }}</strong></td>
        </tr>
        <tr>
            <td class="label">Hari / Tanggal</td>
            <td class="sep">:</td>
            <td>{{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->isoFormat('dddd, D MMMM Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jaksa Pemateri</td>
            <td class="sep">:</td>
            <td>{{ $data->nama_jaksa }}</td>
        </tr>
    </table>

    <h3 style="text-decoration: underline;">II. MATERI & PESERTA</h3>
    <table class="data-table">
        <tr>
            <td class="label">Materi Disampaikan</td>
            <td class="sep">:</td>
            <td>{{ $data->materi }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Peserta</td>
            <td class="sep">:</td>
            <td>{{ $data->jumlah_siswa }} Siswa/Siswi</td>
        </tr>
        <tr>
            <td class="label">Keterangan Lain</td>
            <td class="sep">:</td>
            <td>{{ $data->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <h3 style="text-decoration: underline;">III. DOKUMENTASI KEGIATAN</h3>
    <div class="foto-container">
        {{-- Menggunakan $data->foto_kegiatan --}}
        @if($data->foto_kegiatan && file_exists(public_path('storage/' . $data->foto_kegiatan)))
        <img src="{{ public_path('storage/' . $data->foto_kegiatan) }}">
        <div class="caption">Dokumentasi pelaksanaan kegiatan JMS di {{ $data->nama_sekolah }}</div>
        @else
        <div style="padding: 50px; color: gray;">FOTO DOKUMENTASI TIDAK TERSEDIA</div>
        @endif
    </div>

    <div class="ttd">
        <p>{{ config('app.kota_kantor', 'Jakarta') }}, {{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->isoFormat('D MMMM Y') }}</p>
        <p>Petugas Pelaksana,</p>
        <br><br><br>
        <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Intelijen</p>
    </div>

</body>

</html>