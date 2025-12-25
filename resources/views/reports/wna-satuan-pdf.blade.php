<!DOCTYPE html>
<html>

<head>
    <title>Biodata WNA - {{ $item->nama_lengkap }}</title>
    <style>
        /* Pengaturan Kertas */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm 2cm 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
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
            /* Ukuran kolom logo diperbesar */
            vertical-align: middle;
            text-align: left;
        }

        .logo-img {
            width: 90px;
            /* Logo diperbesar agar lebih jelas */
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

        .container {
            width: 100%;
            margin-bottom: 20px;
            position: relative;
        }

        .foto-container {
            float: right;
            width: 160px;
            height: 200px;
            border: 1px solid #000;
            text-align: center;
            background-color: #f9f9f9;
            overflow: hidden;
        }

        .foto-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .placeholder {
            padding-top: 80px;
            font-size: 10px;
            color: gray;
        }

        .data-table {
            width: calc(100% - 190px);
            border-collapse: collapse;
        }

        .data-table td {
            padding: 5px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .label {
            width: 160px;
            font-weight: bold;
        }

        .sep {
            width: 10px;
        }

        .status-box {
            margin-top: 20px;
            padding: 15px;
            border: 2px solid black;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        .overstay {
            border-color: red;
            color: red;
            background-color: #fff5f5;
        }

        .aman {
            border-color: green;
            color: green;
            background-color: #f0fdf4;
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

    <div class="judul">LEMBAR DATA ORANG ASING</div>

    <div class="container">
        <div class="foto-container">
            @if($item->foto_dokumen && file_exists(public_path('storage/' . $item->foto_dokumen)))
            <img src="{{ public_path('storage/' . $item->foto_dokumen) }}">
            @else
            <div class="placeholder">FOTO TIDAK TERSEDIA</div>
            @endif
        </div>

        <table class="data-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="sep">:</td>
                <td style="font-weight: bold;">{{ strtoupper($item->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td class="label">Kebangsaan</td>
                <td class="sep">:</td>
                <td>{{ $item->kebangsaan }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Paspor</td>
                <td class="sep">:</td>
                <td>{{ $item->nomor_paspor }}</td>
            </tr>
            <tr>
                <td class="label">Tujuan Kunjungan</td>
                <td class="sep">:</td>
                <td>{{ $item->tujuan_kunjungan }}</td>
            </tr>
            <tr>
                <td class="label">Sponsor / Penjamin</td>
                <td class="sep">:</td>
                <td>{{ $item->sponsor ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Menginap</td>
                <td class="sep">:</td>
                <td>{{ $item->alamat_menginap }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>
    <hr style="border: 0.5px solid #ccc;">

    <h3 style="margin-bottom: 10px; text-transform: uppercase;">Status Izin Tinggal</h3>
    <table class="data-table">
        <tr>
            <td class="label">Tanggal Tiba</td>
            <td class="sep">:</td>
            <td>{{ $item->tanggal_tiba ? \Carbon\Carbon::parse($item->tanggal_tiba)->isoFormat('DD MMMM YYYY') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Masa Berlaku s/d</td>
            <td class="sep">:</td>
            <td style="font-weight: bold;">{{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->isoFormat('DD MMMM YYYY') }}</td>
        </tr>
    </table>

    @php
    $tglIzin = \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->startOfDay();
    $tglSkrg = \Carbon\Carbon::now()->startOfDay();
    $isOverstay = $tglSkrg->gt($tglIzin);
    $hariTelat = $tglSkrg->diffInDays($tglIzin);
    @endphp

    @if($isOverstay)
    <div class="status-box overstay">
        PERINGATAN: SUBJEK TELAH OVERSTAY<br>
        <span style="font-size: 10pt;">(Melewati Batas Izin Tinggal Selama {{ $hariTelat }} Hari)</span>
    </div>
    @else
    <div class="status-box aman">
        STATUS: IZIN TINGGAL BERLAKU (AMAN)
    </div>
    @endif

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</p>
        <p>Petugas Pengawas,</p>
        <br><br><br><br>
        <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '..........' }}</p>
    </div>

</body>

</html>