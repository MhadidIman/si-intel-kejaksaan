<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar DPO - {{ $data->nama_lengkap }}</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            /* Disesuaikan agar proporsional seperti Lapsus */
            line-height: 1.5;
            color: #000;
            -webkit-print-color-adjust: exact;
            /* Memastikan warna/grafis tercetak jelas di browser */
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
            margin-bottom: 2px;
        }

        .sub-judul {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        /* --- LAYOUT BIODATA & FOTO --- */
        .main-layout {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .col-left {
            width: 65%;
            vertical-align: top;
            padding-right: 15px;
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
            padding-bottom: 8px;
            font-size: 11pt;
        }

        .label {
            width: 130px;
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

        /* FOTO & STAMP */
        .foto-box {
            width: 150px;
            height: 200px;
            border: 2px solid #000;
            padding: 4px;
            box-sizing: border-box;
            display: inline-block;
            background-color: #fff;
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
            background-color: #f3f4f6;
            font-size: 9pt;
            color: #666;
            border: 1px dashed #ccc;
            box-sizing: border-box;
            line-height: 1.2;
        }

        .status-stamp {
            margin-top: 15px;
            font-size: 13pt;
            font-weight: bold;
            border: 3px double;
            padding: 8px 5px;
            transform: rotate(-5deg);
            display: inline-block;
            width: 80%;
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
            margin-bottom: 8px;
            text-decoration: underline;
            font-size: 11pt;
        }

        .box-text {
            border: 1px solid #000;
            padding: 10px;
            text-align: justify;
            min-height: 60px;
            margin-bottom: 10px;
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
                <!-- Pemanggilan Logo menggunakan asset() -->
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

    <div class="judul">DAFTAR PENCARIAN ORANG (DPO)</div>
    <div class="sub-judul">TINDAK PIDANA {{ strtoupper($data->status_hukum) }}</div>

    <!-- KONTEN UTAMA: BIODATA & FOTO -->
    <table class="main-layout">
        <tr>
            <!-- KOLOM KIRI: BIODATA -->
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

            <!-- KOLOM KANAN: FOTO & STATUS -->
            <td class="col-right">
                <div class="foto-box">
                    @if($data->foto)
                    <!-- Pemanggilan Foto DPO menggunakan asset() -->
                    <img src="{{ asset('storage/' . $data->foto) }}" class="foto-img">
                    @else
                    <div class="no-foto">FOTO<br>TIDAK TERSEDIA</div>
                    @endif
                </div>

                <br>

                @if(strtolower($data->status_pencarian ?? $data->status_dpo) == 'buron')
                <div class="status-stamp status-buron">STATUS: BURON</div>
                @else
                <div class="status-stamp status-tertangkap">TERTANGKAP</div>
                @endif
            </td>
        </tr>
    </table>

    <div class="section-title">KASUS POSISI / URAIAN PERKARA</div>
    <div class="box-text">
        {!! nl2br(e($data->kasus_posisi ?? $data->kasus ?? '-')) !!}
    </div>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (DPO SATUAN) -->
    <div class="ttd-wrapper">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code (Fungsi Route Verifikasi Dipertahankan) -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'dpo', 'id' => $data->id]);
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