<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Analisa Kerawanan - {{ $data->kecamatan }}</title>
    <style>
        /* PENGATURAN KERTAS AGAR LEBIH MUAT BANYAK */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm;
            /* Margin diperkecil sedikit */
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            /* Font diperkecil ke 11pt agar hemat ruang */
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
            margin-bottom: 15px;
        }

        /* --- KONTEN --- */
        .rahasia {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 10pt;
            margin-bottom: 5px;
        }

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
            margin-bottom: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border: 2px solid #000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10pt;
        }

        /* TABEL BIODATA */
        .table-info {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .table-info td {
            vertical-align: top;
            padding: 3px 0;
        }

        .label-field {
            width: 170px;
            font-weight: bold;
        }

        .separator {
            width: 15px;
            text-align: center;
        }

        /* SECTION STYLING */
        .title-sub {
            font-weight: bold;
            text-transform: uppercase;
            display: block;
            margin-bottom: 3px;
            text-decoration: underline;
            font-size: 11pt;
        }

        .box-text {
            border: 1px solid #000;
            padding: 8px;
            text-align: justify;
            min-height: 60px;
            margin-bottom: 15px;
        }

        /* --- TEKNIK "LEM" (GLUE) --- */
        /* Class ini membungkus Bagian II dan Tanda Tangan agar tidak terpisah */
        .keep-together {
            page-break-inside: avoid;
        }

        /* TANDA TANGAN */
        .ttd-container {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 20px;
        }

        .nama-pejabat {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 60px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="rahasia">RAHASIA</div>

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

    <div class="judul">LEMBAR ANALISA POTENSI KERAWANAN WILAYAH</div>

    {{-- STATUS --}}
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

    {{-- BIODATA --}}
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

    {{-- BAGIAN I: POTENSI ANCAMAN (Boleh terpisah halaman jika sangat panjang) --}}
    <div>
        <span class="title-sub">I. URAIAN POTENSI ANCAMAN / PERMASALAHAN</span>
        <div class="box-text">
            {{ $data->potensi_ancaman }}
        </div>
    </div>

    {{-- BAGIAN II & TANDA TANGAN (DI-LEM JADI SATU) --}}
    <div class="keep-together">

        <span class="title-sub">II. REKOMENDASI / UPAYA PENCEGAHAN</span>
        <div class="box-text">
            {{ $data->upaya_pencegahan ?? 'Belum ada rekomendasi khusus yang dicatat.' }}
        </div>

        <div style="width: 100%; margin-top: 50px;">
            <div style="float: right; width: 300px; text-align: center;">
                <p>Mengetahui,</p>
                <p><strong>Kepala Seksi Intelijen</strong></p>
                <div style="margin: 15px 0;">
                    @php
                    $qrContent = route('verifikasi.dokumen', ['tipe' => 'kerawanan', 'id' => $data->id]);
                    @endphp
                    <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($qrContent)) !!} ">
                </div>

                <p><u>Nama Kasi Intelijen</u></p>
                <p>NIP. 1234567890</p>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="clear"></div>

    </div>

    <div class="rahasia" style="margin-top: 20px;">RAHASIA</div>

</body>

</html>