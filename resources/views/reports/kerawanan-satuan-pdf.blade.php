<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Analisa Kerawanan - {{ $data->kecamatan }}</title>
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
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-center h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
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

        /* --- KONTEN LAPORAN --- */
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 13pt;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* STATUS BADGE */
        .status-wrapper {
            text-align: right;
            margin-bottom: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border: 2px solid #000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10pt;
        }

        /* TABEL BIODATA */
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

        .label-field {
            width: 180px;
            font-weight: bold;
        }

        .separator {
            width: 15px;
            text-align: center;
            font-weight: bold;
        }

        /* SECTION STYLING */
        .title-sub {
            font-weight: bold;
            text-transform: uppercase;
            display: block;
            margin-bottom: 5px;
            text-decoration: underline;
            font-size: 11pt;
        }

        .box-text {
            border: 1px solid #000;
            padding: 10px;
            text-align: justify;
            min-height: 60px;
            margin-bottom: 15px;
        }

        .keep-together {
            page-break-inside: avoid;
        }

        /* --- TANDA TANGAN --- */
        .ttd-wrapper {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
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

    <div class="judul">LEMBAR ANALISA POTENSI KERAWANAN WILAYAH</div>

    <!-- STATUS BADGE -->
    <div class="status-wrapper">
        @php
        $bgColor = '#ffffff';
        if($data->tingkat_rawan == 'tinggi') $bgColor = '#fee2e2';
        elseif($data->tingkat_rawan == 'sedang') $bgColor = '#ffedd5';
        elseif($data->tingkat_rawan == 'rendah') $bgColor = '#dcfce7';
        @endphp

        <span class="status-badge" style="background-color: {{ $bgColor }};">
            TINGKAT: {{ strtoupper($data->tingkat_rawan) }}
        </span>
    </div>

    <!-- INFORMASI UMUM -->
    <table class="table-info">
        <tr>
            <td class="label-field">Wilayah Kecamatan</td>
            <td class="separator">:</td>
            <td><strong>{{ strtoupper($data->kecamatan) }}</strong></td>
        </tr>
        <tr>
            <td class="label-field">Bidang Intelijen</td>
            <td class="separator">:</td>
            <td>{{ $data->bidang }}</td>
        </tr>
        <tr>
            <td class="label-field">Sumber Informasi</td>
            <td class="separator">:</td>
            <td>{{ $data->sumber_informasi ?? 'Terbuka / Tertutup' }}</td>
        </tr>
        <tr>
            <td class="label-field">Tanggal Analisa</td>
            <td class="separator">:</td>
            <td>{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
        </tr>
    </table>

    <!-- BAGIAN I -->
    <div>
        <span class="title-sub">I. URAIAN POTENSI ANCAMAN / PERMASALAHAN</span>
        <div class="box-text">
            {!! nl2br(e($data->potensi_ancaman)) !!}
        </div>
    </div>

    <!-- BAGIAN II & TANDA TANGAN (DI-LEM JADI SATU AGAR TIDAK PISAH HALAMAN) -->
    <div class="keep-together">
        <span class="title-sub">II. REKOMENDASI / UPAYA PENCEGAHAN</span>
        <div class="box-text">
            {!! nl2br(e($data->upaya_pencegahan ?? 'Belum ada rekomendasi khusus yang dicatat.')) !!}
        </div>

        <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (KERAWANAN SATUAN) -->
        <div class="ttd-wrapper">
            <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
                <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p style="margin: 0; font-weight: bold; font-size: 10pt;">Mengetahui,</p>
                <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

                <!-- Area QR Code (Fungsi Route Verifikasi Dipertahankan) -->
                <div style="margin: 20px 0;">
                    @php
                    $qrContent = route('verifikasi.dokumen', ['tipe' => 'kerawanan', 'id' => $data->id]);
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
    </div>

    <div class="rahasia-bottom">RAHASIA</div>

</body>

</html>