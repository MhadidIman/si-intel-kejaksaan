<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Biodata WNA - {{ $item->nama_lengkap }}</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #000;
            -webkit-print-color-adjust: exact;
        }

        /* --- STYLING LABEL RAHASIA --- */
        .rahasia-top {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-bottom: 10px;
        }

        .rahasia-bottom {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-top: 30px;
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
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
        }

        .teks-center h2 {
            font-size: 16pt;
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
            font-weight: bold;
            text-decoration: underline;
            font-size: 13pt;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        /* --- LAYOUT UTAMA (TABEL 2 KOLOM) --- */
        .main-layout {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .col-left {
            width: 68%;
            vertical-align: top;
            padding-right: 15px;
        }

        .col-right {
            width: 32%;
            vertical-align: top;
            text-align: center;
        }

        /* --- TABEL BIODATA --- */
        .bio-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bio-table td {
            vertical-align: top;
            padding-bottom: 8px;
            font-size: 11pt;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
            font-weight: bold;
        }

        .val {
            text-align: justify;
        }

        /* --- FOTO --- */
        .photo-box {
            width: 150px;
            height: 200px;
            border: 2px solid black;
            padding: 4px;
            box-sizing: border-box;
            background-color: #fff;
            display: inline-block;
        }

        .photo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-photo {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            font-size: 9pt;
            color: #666;
            border: 1px dashed #ccc;
            box-sizing: border-box;
            line-height: 1.2;
        }

        /* --- STATUS BOX --- */
        .section-sub {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-size: 11pt;
        }

        .status-box {
            margin-top: 15px;
            padding: 10px;
            border: 3px double;
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
        }

        .overstay {
            border-color: red;
            color: red;
            background-color: #ffe6e6;
        }

        .aman {
            border-color: green;
            color: green;
            background-color: #e6fffa;
        }

        /* --- TANDA TANGAN --- */
        .ttd-container {
            width: 100%;
            margin-top: 40px;
        }

        .ttd-box {
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

    <div class="judul">LEMBAR DATA PENGAWASAN ORANG ASING</div>

    <!-- LAYOUT UTAMA: BIODATA KIRI - FOTO KANAN -->
    <table class="main-layout">
        <tr>
            <!-- KOLOM KIRI -->
            <td class="col-left">
                <table class="bio-table">
                    <tr>
                        <td class="label">Nama Lengkap</td>
                        <td class="sep">:</td>
                        <td class="val"><strong>{{ strtoupper($item->nama_lengkap) }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Kebangsaan</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->kebangsaan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor Paspor</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->nomor_paspor }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tujuan Kunjungan</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->tujuan_kunjungan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Sponsor / Penjamin</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->sponsor ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Alamat Menginap</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->alamat_menginap }}</td>
                    </tr>
                </table>
            </td>

            <!-- KOLOM KANAN (FOTO) -->
            <td class="col-right">
                <div class="photo-box">
                    @if($item->foto_dokumen)
                    <!-- Pemanggilan foto menggunakan asset() -->
                    <img src="{{ asset('storage/' . $item->foto_dokumen) }}" class="photo-img">
                    @else
                    <div class="no-photo">FOTO<br>TIDAK TERSEDIA</div>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <div class="section-sub">STATUS IZIN TINGGAL</div>

    <table class="bio-table" style="width: 100%;">
        <tr>
            <td class="label" style="width: 150px;">Tanggal Tiba</td>
            <td class="sep">:</td>
            <td class="val">
                {{ $item->tanggal_tiba ? \Carbon\Carbon::parse($item->tanggal_tiba)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td class="label">Masa Berlaku Izin</td>
            <td class="sep">:</td>
            <td class="val">
                <strong>{{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->translatedFormat('d F Y') }}</strong>
            </td>
        </tr>
    </table>

    <!-- LOGIKA OVERSTAY -->
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

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (WNA SATUAN) -->
    <div class="ttd-container">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt;">Mengetahui,</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code (Fungsi Route Verifikasi Dipertahankan) -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'wna', 'id' => $item->id]);
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