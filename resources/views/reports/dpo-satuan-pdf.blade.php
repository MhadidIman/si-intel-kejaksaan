<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar DPO - {{ $data->nama_lengkap }}</title>
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
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .sub-judul {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        /* --- PERBAIKAN LAYOUT UTAMA (AGAR TIDAK KEPOTONG) --- */
        .main-layout {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* Kolom Kiri (Biodata) dapat 68% lebar agar teks panjang bisa turun ke bawah */
        .col-left {
            width: 68%;
            vertical-align: top;
            padding-right: 15px;
        }

        /* Kolom Kanan (Foto) dapat 32% */
        .col-right {
            width: 32%;
            vertical-align: top;
        }

        /* TABEL DATA (Di dalam kolom kiri) */
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data td {
            vertical-align: top;
            padding: 5px 0;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
        }

        /* Text-align justify agar ciri-ciri rapi */
        .val {
            text-align: justify;
        }

        /* FOTO */
        .foto-box {
            width: 100%;
            border: 2px solid #000;
            padding: 5px;
            text-align: center;
            box-sizing: border-box;
        }

        .foto-img {
            width: 150px;
            height: 200px;
            object-fit: cover;
        }

        .no-foto {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            font-size: 10pt;
            color: #666;
            padding-top: 90px;
        }

        /* STATUS STAMP */
        .status-stamp {
            margin-top: 20px;
            text-align: center;
            font-size: 18pt;
            font-weight: bold;
            border: 3px double;
            padding: 10px;
            transform: rotate(-5deg);
            width: 100%;
            box-sizing: border-box;
        }

        .status-buron {
            color: #dc2626;
            border-color: #dc2626;
        }

        .status-tertangkap {
            color: #16a34a;
            border-color: #16a34a;
        }

        /* LAINNYA */
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        .box-text {
            border: 1px solid #000;
            padding: 10px;
            text-align: justify;
            min-height: 80px;
        }

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

    <div class="judul">DAFTAR PENCARIAN ORANG (DPO)</div>
    <div class="sub-judul">TINDAK PIDANA {{ strtoupper($data->status_hukum) }}</div>

    <table class="main-layout">
        <tr>
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
                        <td class="val">{{ $data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status Hukum</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $data->status_hukum }}</td>
                    </tr>
                    {{-- CIRI FISIK: Sekarang aman karena ada di kolom sendiri --}}
                    <tr>
                        <td class="label">Ciri-Ciri Fisik</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $data->ciri_fisik ?? '-' }}</td>
                    </tr>
                </table>
            </td>

            <td class="col-right">
                <div class="foto-box">
                    @if($data->foto)
                    <img src="{{ public_path('storage/' . $data->foto) }}" class="foto-img">
                    @else
                    <div class="no-foto">FOTO TIDAK TERSEDIA</div>
                    @endif
                </div>

                @if($data->status_pencarian == 'buron')
                <div class="status-stamp status-buron">STATUS: BURON</div>
                @else
                <div class="status-stamp status-tertangkap">TERTANGKAP</div>
                @endif
            </td>
        </tr>
    </table>

    <div class="section-title">KASUS POSISI / URAIAN PERKARA</div>
    <div class="box-text">
        {{ $data->kasus }}
    </div>

    <div class="ttd-container">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Kepala Seksi Intelijen,</p>

        <br><br><br>

        <div class="nama-terang">Dimas Purnama Putra, S.H.,M.H</div>
        <div>Jaksa Madya / NIP. 19850101 201001 1 001</div>
    </div>

    <div class="clear"></div>
    <div class="rahasia-top" style="margin-top: 30px;">RAHASIA</div>

</body>

</html>