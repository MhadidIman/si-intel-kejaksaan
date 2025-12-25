<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    {{-- GANTI $item JADI $data --}}
    <title>Laporan Kegiatan - {{ $data->nama_sekolah }}</title>
    <style>
        /* Pengaturan Kertas */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm 2cm 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
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
        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

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
            width: 280px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

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
        @if($data->foto_kegiatan && file_exists(public_path('storage/' . $data->foto_kegiatan)))
        <img src="{{ public_path('storage/' . $data->foto_kegiatan) }}">
        <div class="caption">Dokumentasi pelaksanaan kegiatan JMS di {{ $data->nama_sekolah }}</div>
        @else
        <div style="padding: 50px; color: gray;">FOTO DOKUMENTASI TIDAK TERSEDIA</div>
        @endif
    </div>

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->isoFormat('D MMMM Y') }}</p>
        <p>Petugas Pelaksana,</p>
        <br><br><br><br>
        <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '..........' }}</p>
    </div>

</body>

</html>