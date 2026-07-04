<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar DPO - {{ $data->nama_lengkap }}</title>
    <style>
        /* PENGATURAN KERTAS & PAGE BREAK */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm;
            /* Margin sedikit diperkecil agar muat */
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            /* Font sedikit diperkecil agar hemat ruang */
            line-height: 1.3;
            color: #000;
        }

        /* --- STYLING KOP SURAT --- */
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
            /* Kompensasi lebar logo agar teks tetap di tengah */
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

        /* --- STYLING ISI --- */
        .rahasia-top {
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
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .sub-judul {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* --- LAYOUT BIODATA & FOTO --- */
        .main-layout {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .col-left {
            width: 65%;
            vertical-align: top;
            padding-right: 10px;
        }

        .col-right {
            width: 35%;
            vertical-align: top;
            text-align: center;
        }

        /* TABEL BIODATA */
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data td {
            vertical-align: top;
            padding: 3px 0;
            /* Padding diperkecil */
        }

        .label {
            width: 130px;
            font-weight: bold;
        }

        .sep {
            width: 10px;
            text-align: center;
        }

        .val {
            text-align: justify;
        }

        /* FOTO & STAMP */
        .foto-box {
            width: 100%;
            border: 2px solid #000;
            padding: 4px;
            box-sizing: border-box;
            display: inline-block;
        }

        .foto-img {
            width: 140px;
            height: 190px;
            object-fit: cover;
        }

        .no-foto {
            height: 190px;
            width: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            font-size: 9pt;
            color: #666;
            margin: 0 auto;
            border: 1px dashed #ccc;
            line-height: 190px;
            /* Vertikal center trick untuk dompdf */
        }

        .status-stamp {
            margin-top: 15px;
            font-size: 14pt;
            font-weight: bold;
            border: 3px double;
            padding: 5px;
            transform: rotate(-5deg);
            display: inline-block;
            width: 90%;
        }

        .status-buron {
            color: #b91c1c;
            border-color: #b91c1c;
        }

        .status-tertangkap {
            color: #15803d;
            border-color: #15803d;
        }

        /* KASUS POSISI */
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 5px;
            text-decoration: underline;
            font-size: 11pt;
        }

        .box-text {
            border: 1px solid #000;
            padding: 8px;
            text-align: justify;
            min-height: 60px;
            font-size: 10.5pt;
            margin-bottom: 10px;
        }

        /* TANDA TANGAN (FIX PAGE BREAK) */
        .ttd-wrapper {
            width: 100%;
            page-break-inside: avoid;
            /* Mencegah ttd terpotong */
            margin-top: 20px;
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

        .footer-rahasia {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 10pt;
            margin-top: 10px;
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

    {{-- JUDUL --}}
    <div class="judul">DAFTAR PENCARIAN ORANG (DPO)</div>
    <div class="sub-judul">TINDAK PIDANA {{ strtoupper($data->status_hukum) }}</div>

    {{-- KONTEN UTAMA --}}
    <table class="main-layout">
        <tr>
            {{-- KOLOM KIRI: BIODATA --}}
            <td class="col-left">
                <table class="table-data">
                    <tr>
                        <td class="label">Nama Lengkap</td>
                        <td class="sep">:</td>
                        <td class="val"><strong>{{ strtoupper($data->nama_lengkap) }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Tempat Lahir</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $data->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Lahir</td>
                        <td class="sep">:</td>
                        <td class="val">
                            {{ $data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Status Hukum</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $data->status_hukum }}</td>
                    </tr>
                    <tr>
                        <td class="label">Ciri-Ciri Fisik</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $data->ciri_fisik ?? '-' }}</td>
                    </tr>
                </table>
            </td>

            {{-- KOLOM KANAN: FOTO & STATUS --}}
            <td class="col-right">
                <div class="foto-box">
                    @if($data->foto)
                    <img src="{{ public_path('storage/' . $data->foto) }}" class="foto-img">
                    @else
                    <div class="no-foto">FOTO TIDAK TERSEDIA</div>
                    @endif
                </div>

                @if(strtolower($data->status_pencarian ?? $data->status_dpo) == 'buron')
                <div class="status-stamp status-buron">STATUS: BURON</div>
                @else
                <div class="status-stamp status-tertangkap">TERTANGKAP</div>
                @endif
            </td>
        </tr>
    </table>

    {{-- KASUS POSISI --}}
    <div class="section-title">KASUS POSISI / URAIAN PERKARA</div>
    <div class="box-text">
        {{-- Gunakan limit atau nl2br agar rapi --}}
        {!! nl2br(e($data->kasus_posisi ?? $data->kasus ?? '-')) !!}
    </div>

    {{-- TANDA TANGAN (WRAPPER AGAR TIDAK PECAH HALAMAN) --}}
    <div style="width: 100%; margin-top: 50px;">
        <div style="float: right; width: 300px; text-align: center;">
            <p>Mengetahui,</p>
            <p><strong>Kepala Seksi Intelijen</strong></p>
            <div style="margin: 15px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'dpo', 'id' => $data->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($qrContent)) !!} ">
            </div>

            <p><u>Nama Kasi Intelijen</u></p>
            <p>NIP. 1234567890</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="footer-rahasia">RAHASIA</div>

</body>

</html>