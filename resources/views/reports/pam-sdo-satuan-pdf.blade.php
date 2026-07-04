<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan PAM SDO - {{ $item->nama_pegawai }}</title>
    <style>
        /* PENGATURAN KERTAS (MARGIN DIKURANGI SEDIKIT AGAR MUAT) */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            /* Font sedikit diperkecil agar hemat ruang */
            line-height: 1.3;
            color: #000;
        }

        /* --- KOP SURAT --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .logo-cell {
            width: 90px;
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
            padding-right: 90px;
        }

        .teks-cell h1 {
            font-size: 13pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell h2 {
            font-size: 15pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell p {
            font-size: 9pt;
            margin: 1px 0;
            line-height: 1.1;
        }

        .garis-kop-ganda {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            height: 2px;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        /* --- KONTEN --- */
        .rahasia-top {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 10pt;
            margin-bottom: 5px;
        }

        .judul {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 25px;
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
            font-size: 11pt;
        }

        .value-text {
            text-align: justify;
            padding-left: 0;
            /* Hemat ruang */
            margin-bottom: 10px;
            border: 1px solid #000;
            /* Tambah border agar rapi & jelas batasnya */
            padding: 8px;
            min-height: 50px;
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
            width: 180px;
            font-weight: bold;
        }

        .col-sep {
            width: 15px;
            text-align: center;
        }

        /* FOTO */
        .foto-wrapper {
            margin-top: 15px;
            text-align: center;
            page-break-inside: avoid;
            /* Jangan potong foto */
        }

        .foto-container {
            width: 250px;
            /* Perkecil sedikit agar muat */
            height: auto;
            border: 1px solid #000;
            padding: 4px;
            margin: 0 auto;
            background-color: #f9f9f9;
        }

        .foto-img {
            width: 100%;
            height: auto;
            display: block;
        }

        .foto-label {
            font-size: 9pt;
            font-weight: bold;
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        /* STATUS BOX */
        .status-box {
            border: 2px solid black;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            background-color: #f0f0f0;
            font-size: 11pt;
            page-break-inside: avoid;
        }

        /* TANDA TANGAN (FIX PAGE BREAK) */
        .ttd-wrapper {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
            /* KUNCI UTAMA: Agar ttd tidak pindah halaman sendirian */
        }

        .ttd-container {
            float: right;
            width: 280px;
            text-align: center;
        }

        .nama-terang {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 60px;
        }

        .rahasia-bottom {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 10pt;
            margin-top: 20px;
            clear: both;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="rahasia-top">RAHASIA</div>

    {{-- KOP SURAT --}}
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

    {{-- BIODATA --}}
    <div class="content-block">
        <table class="table-info">
            <tr>
                <td class="col-label">Hari / Tanggal</td>
                <td class="col-sep">:</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
                <td class="col-label">Nama Pegawai</td>
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

    {{-- ISI LAPORAN (DIBERI BORDER AGAR RAPI) --}}
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

    {{-- STATUS BOX --}}
    <div class="status-box">
        STATUS:
        @if($item->status_pam == 'clear')
        <span style="color: #15803d;">AMAN / CLEAR</span>
        @elseif($item->status_pam == 'ditindak')
        <span style="color: #d97706;">DITINDAK LANJUTI</span>
        @else
        <span style="color: #b91c1c;">DALAM PENGAWASAN</span>
        @endif
    </div>

    {{-- LAMPIRAN FOTO --}}
    @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
    <div class="foto-wrapper">
        <div class="foto-label">Lampiran Dokumentasi</div>
        <div class="foto-container">
            <img src="{{ public_path('storage/' . $item->foto) }}" class="foto-img">
        </div>
    </div>
    @endif

    {{-- TANDA TANGAN (WRAPPER AGAR TIDAK PECAH HALAMAN) --}}
    <div style="width: 100%; margin-top: 50px;">
        <div style="float: right; width: 300px; text-align: center;">
            <p>Mengetahui,</p>
            <p><strong>Kepala Seksi Intelijen</strong></p>
            <div style="margin: 15px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'pam-sdo', 'id' => $item->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($qrContent)) !!} ">
            </div>

            <p><u>Nama Kasi Intelijen</u></p>
            <p>NIP. 1234567890</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>