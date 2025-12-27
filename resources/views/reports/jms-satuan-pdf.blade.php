<!DOCTYPE html>
<html>

<head>
    <title>Laporan JMS - {{ $data->nama_sekolah }}</title>
    <style>
        /* Pengaturan Kertas dan Font Standar Dinas */
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
            margin-bottom: 25px;
        }

        /* --- STYLING ISI --- */
        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .sub-judul {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 12pt;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .data-table td {
            padding: 5px;
            vertical-align: top;
        }

        .label {
            width: 180px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
        }

        /* FOTO */
        .foto-container {
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .foto-img {
            max-width: 100%;
            height: auto;
            max-height: 350px;
            /* Batasi tinggi agar tidak pecah halaman */
            border: 1px solid #000;
        }

        .caption {
            font-size: 10pt;
            font-style: italic;
            margin-top: 5px;
            color: #333;
        }

        .ttd {
            float: right;
            width: 300px;
            text-align: center;
            margin-top: 50px;
        }

        .clear {
            clear: both;
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
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop-ganda"></div>

    <div class="judul">LAPORAN KEGIATAN JAKSA MASUK SEKOLAH</div>

    <div class="sub-judul">I. DATA PELAKSANAAN</div>
    <table class="data-table">
        <tr>
            <td class="label">Nama Sekolah / Tempat</td>
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

    <div class="sub-judul">II. MATERI DAN PESERTA</div>
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
            <td>{{ $data->keterangan ?? 'Tidak ada keterangan tambahan.' }}</td>
        </tr>
    </table>

    <div class="sub-judul">III. DOKUMENTASI KEGIATAN</div>
    <div class="foto-container">
        @if($data->foto_kegiatan)
        <img src="{{ public_path('storage/' . $data->foto_kegiatan) }}" class="foto-img">
        <div class="caption">
            Dokumentasi pelaksanaan kegiatan JMS di {{ $data->nama_sekolah }}<br>
            Tanggal: {{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->format('d/m/Y') }}
        </div>
        @else
        <div style="padding: 40px; color: gray; font-style: italic;">
            [ Foto dokumentasi tidak tersedia ]
        </div>
        @endif
    </div>

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->isoFormat('D MMMM Y') }}</p>
        <p>Petugas Pelaksana,</p>
        <br><br><br><br>
        <p style="text-decoration: underline; font-weight: bold;">{{ auth()->user()->name }}</p>
        <p>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '....................' }}</p>
    </div>

    <div class="clear"></div>

</body>

</html>