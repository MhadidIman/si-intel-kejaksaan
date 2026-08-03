<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan PAM SDO - {{ $item->nama_pegawai }}</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.3;
            color: #000;
            -webkit-print-color-adjust: exact;
            /* Wajib agar background warna status tercetak */
        }

        /* --- STYLING LABEL RAHASIA --- */
        .rahasia-top {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-bottom: 5px;
        }

        .rahasia-bottom {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-top: 20px;
            clear: both;
        }

        /* --- KOP SURAT 3 KOLOM --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px solid black;
        }

        .kop-table td {
            vertical-align: middle;
            padding-bottom: 5px;
        }

        .teks-center {
            text-align: center;
        }

        .teks-center h1 {
            font-size: 13pt;
            margin: 0;
            font-weight: bold;
        }

        .teks-center h2 {
            font-size: 15pt;
            margin: 0;
            font-weight: bold;
        }

        .teks-center p {
            font-size: 9pt;
            margin: 2px 0 0 0;
            line-height: 1.2;
        }

        .garis-tipis {
            border-top: 1px solid black;
            margin-top: 2px;
            margin-bottom: 20px;
        }

        /* --- JUDUL --- */
        .judul {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        /* --- KONTEN BIODATA --- */
        .content-block {
            margin-bottom: 15px;
        }

        .table-info {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table-info td {
            vertical-align: top;
            padding: 3px 0;
            font-size: 11pt;
        }

        .col-label {
            width: 180px;
            font-weight: bold;
        }

        .col-sep {
            width: 15px;
            text-align: center;
            font-weight: bold;
        }

        /* --- KONTEN URAIAN --- */
        .label-heading {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            text-decoration: underline;
            font-size: 11pt;
        }

        .value-text {
            text-align: justify;
            margin-bottom: 10px;
            border: 1px solid #000;
            padding: 8px 10px;
            min-height: 50px;
        }

        /* --- STATUS BOX --- */
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

        /* --- FOTO LAMPIRAN --- */
        .foto-wrapper {
            margin-top: 20px;
            text-align: center;
            page-break-inside: avoid;
        }

        .foto-container {
            width: 250px;
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
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
            text-decoration: underline;
        }

        /* --- TANDA TANGAN --- */
        .ttd-wrapper {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .ttd-container {
            float: right;
            width: 250px;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="rahasia-top">RAHASIA</div>

    <!-- KOP SURAT 3 KOLOM AGAR PRESISI DI TENGAH -->
    <table class="kop-table">
        <tr>
            <td style="width: 15%; text-align: center;">
                <img src="{{ asset('img/logo-kejaksaan.png') }}" style="width: 75px; height: auto;">
            </td>
            <td class="teks-center" style="width: 70%;">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <div class="garis-tipis"></div>

    <div class="judul">LAPORAN PENGAMANAN SUMBER DAYA ORGANISASI (SDO)</div>

    <!-- BIODATA -->
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

    <!-- ISI LAPORAN -->
    <div class="content-block">
        <div class="label-heading">I. URAIAN PERMASALAHAN / INDIKASI</div>
        <div class="value-text">
            {!! nl2br(e($item->permasalahan)) !!}
        </div>
    </div>

    <div class="content-block">
        <div class="label-heading">II. KETERANGAN / TINDAK LANJUT</div>
        <div class="value-text">
            {!! nl2br(e($item->keterangan ?? 'Tidak ada keterangan tambahan.')) !!}
        </div>
    </div>

    <!-- STATUS BOX -->
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

    <!-- LAMPIRAN FOTO -->
    @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
    <div class="foto-wrapper">
        <div class="foto-label">Lampiran Dokumentasi</div>
        <div class="foto-container">
            <img src="{{ asset('storage/' . $item->foto) }}" class="foto-img">
        </div>
    </div>
    @endif

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (PAM SDO SATUAN) -->
    <div class="ttd-wrapper">
        <div class="ttd-container" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt;">Mengetahui,</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code (Fungsi Route Verifikasi Dipertahankan) -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'pam-sdo', 'id' => $item->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(95)->generate($qrContent)) !!} " alt="QR Code Validasi">
            </div>

            <!-- Identitas Penandatangan -->
            <p style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 10pt;">Raya Bimanta S.H., M.H</p>
            <p style="margin: 2px 0 0 0; font-size: 10pt;">Jaksa Utama Muda (IV/c)</p>
            <p style="margin: 0; font-size: 10pt;">NIP. 199001012020011001</p>
        </div>
        <div class="clear" style="clear: both;"></div>
    </div>

    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>