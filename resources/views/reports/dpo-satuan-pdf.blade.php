<!DOCTYPE html>
<html>

<head>
    <title>Biodata DPO - {{ $item->nama_lengkap }}</title>
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
            /* Padding untuk mengimbangi lebar logo agar teks benar-benar di tengah */
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
            margin-bottom: 25px;
            color: #b91c1c;
            text-transform: uppercase;
        }

        .container {
            width: 100%;
            position: relative;
            min-height: 210px;
        }

        .foto-container {
            float: right;
            width: 160px;
            height: 200px;
            border: 2px solid #b91c1c;
            text-align: center;
            background-color: #fef2f2;
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
            color: #b91c1c;
            font-weight: bold;
        }

        .data-table-wna {
            width: calc(100% - 190px);
            border-collapse: collapse;
        }

        .data-table-wna td {
            padding: 4px 5px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .label {
            width: 130px;
            font-weight: bold;
        }

        .sep {
            width: 10px;
        }

        .status-box {
            margin-top: 20px;
            padding: 12px;
            border: 3px solid black;
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .buron {
            border-color: red;
            color: red;
            background-color: #fff5f5;
        }

        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .ttd {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 40px;
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

    <div class="judul">LEMBAR DATA PENCARIAN ORANG (DPO)</div>

    <div class="container">
        <div class="foto-container">
            @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
            <img src="{{ public_path('storage/' . $item->foto) }}">
            @else
            <div class="placeholder">FOTO TIDAK TERSEDIA</div>
            @endif
        </div>

        <table class="data-table-wna">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="sep">:</td>
                <td style="color: #b91c1c;"><strong>{{ strtoupper($item->nama_lengkap) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Tempat Lahir</td>
                <td class="sep">:</td>
                <td>{{ $item->tempat_lahir }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td class="sep">:</td>
                <td>{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->isoFormat('DD MMMM YYYY') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status Hukum</td>
                <td class="sep">:</td>
                <td><strong>{{ strtoupper($item->status_hukum) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Ciri-ciri Fisik</td>
                <td class="sep">:</td>
                <td style="text-align: justify;">{{ $item->ciri_fisik ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="section-title">KASUS POSISI / PERKARA</div>
    <div style="text-align: justify; border: 1px solid #ccc; padding: 12px; min-height: 80px; background-color: #fcfcfc;">
        {{ $item->kasus }}
    </div>

    @if($item->status_pencarian == 'buron')
    <div class="status-box buron">
        STATUS: MASIH BURON (DPO)
    </div>
    <p style="text-align: center; font-size: 9pt; color: red; font-weight: bold; margin-top: 5px;">
        *Segera laporkan kepada Kejaksaan atau Kepolisian terdekat jika menemukan subjek ini.
    </p>
    @else
    <div class="status-box" style="border-color: green; color: green; background-color: #f0fdf4;">
        STATUS: SUDAH TERTANGKAP
    </div>
    @endif

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</p>
        <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
        <br><br><br><br>
        <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Utama Pratama / NIP. {{ auth()->user()->nip ?? '..........' }}</p>
    </div>

</body>

</html>