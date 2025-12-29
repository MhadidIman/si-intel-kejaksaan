<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Biodata WNA - {{ $item->nama_lengkap }}</title>
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

        /* --- STYLING KOP SURAT (SERAGAM) --- */
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
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        /* Layout Foto & Data */
        .container-info {
            width: 100%;
            margin-bottom: 20px;
        }

        .foto-container {
            float: right;
            width: 160px;
            height: 220px;
            border: 2px solid #000;
            padding: 5px;
            text-align: center;
            margin-left: 20px;
            background-color: #f9f9f9;
        }

        .foto-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-foto {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10pt;
            color: #666;
            text-align: center;
            padding-top: 80px;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data td {
            vertical-align: top;
            padding: 5px 0;
        }

        .label {
            width: 170px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
        }

        /* Stampel Status */
        .status-box {
            margin-top: 30px;
            padding: 15px;
            border: 3px double;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .overstay {
            border-color: #dc2626;
            color: #dc2626;
            background-color: #fef2f2;
        }

        .aman {
            border-color: #16a34a;
            color: #16a34a;
            background-color: #f0fdf4;
        }

        .section-sub {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        /* Tanda Tangan */
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

    <div class="judul">LEMBAR DATA PENGAWASAN ORANG ASING</div>

    <div class="container-info">
        <div class="foto-container">
            @if($item->foto_dokumen && file_exists(public_path('storage/' . $item->foto_dokumen)))
            <img src="{{ public_path('storage/' . $item->foto_dokumen) }}" class="foto-img">
            @else
            <div class="no-foto">FOTO TIDAK TERSEDIA</div>
            @endif
        </div>

        <table class="table-data">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="sep">:</td>
                <td><strong>{{ strtoupper($item->nama_lengkap) }}</strong></td>
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

    <div class="clear"></div>

    <div class="section-sub">STATUS IZIN TINGGAL</div>
    <table class="table-data">
        <tr>
            <td class="label">Tanggal Tiba</td>
            <td class="sep">:</td>
            <td>{{ $item->tanggal_tiba ? \Carbon\Carbon::parse($item->tanggal_tiba)->isoFormat('D MMMM Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Masa Berlaku Izin</td>
            <td class="sep">:</td>
            <td><strong>{{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->isoFormat('D MMMM Y') }}</strong></td>
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
        <span style="font-size: 10pt; font-weight: normal;">(Melewati batas izin tinggal selama {{ $hariTelat }} hari)</span>
    </div>
    @else
    <div class="status-box aman">
        STATUS: IZIN TINGGAL BERLAKU (AMAN)
    </div>
    @endif

    <div class="ttd-container">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Petugas Pengawas,</p>

        <div class="nama-terang">{{ auth()->user()->name }}</div>
        <div>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '....................' }}</div>
    </div>

    <div class="clear"></div>
    <div class="rahasia-top" style="margin-top: 30px;">RAHASIA</div>

</body>

</html>