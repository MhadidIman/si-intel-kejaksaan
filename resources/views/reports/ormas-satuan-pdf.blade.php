<!DOCTYPE html>
<html>

<head>
    <title>Data Ormas - {{ $item->nama_organisasi }}</title>
    <style>
        /* Pengaturan Kertas */
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm 2cm 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
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
            vertical-align: middle;
            text-align: left;
        }

        .logo-img {
            width: 90px;
            height: auto;
        }

        .teks-cell {
            text-align: center;
            vertical-align: middle;
            padding-right: 90px;
            /* Penyeimbang agar teks benar-benar di tengah */
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
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table td {
            padding: 8px;
            vertical-align: top;
            border-bottom: 1px solid #eee;
        }

        .label {
            width: 200px;
            font-weight: bold;
            background-color: #fafafa;
        }

        .sep {
            width: 10px;
            text-align: center;
        }

        .status-box {
            margin-top: 30px;
            padding: 15px;
            border: 3px solid black;
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .dilarang {
            border-color: red;
            color: red;
            background-color: #fff5f5;
        }

        .diawasi {
            border-color: orange;
            color: #d35400;
            background-color: #fffaf0;
        }

        .aktif {
            border-color: green;
            color: green;
            background-color: #f0fdf4;
        }

        .vakum {
            border-color: gray;
            color: gray;
            background-color: #f9f9f9;
        }

        .section-title {
            background-color: #eee;
            padding: 5px 10px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-left: 5px solid #333;
            text-transform: uppercase;
        }

        .ttd {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 50px;
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

    <div class="judul">LEMBAR DATA ORGANISASI KEMASYARAKATAN</div>

    <div class="section-title">I. Identitas Organisasi</div>
    <table class="data-table">
        <tr>
            <td class="label">Nama Organisasi</td>
            <td class="sep">:</td>
            <td><strong>{{ strtoupper($item->nama_organisasi) }}</strong></td>
        </tr>
        <tr>
            <td class="label">Bentuk Organisasi</td>
            <td class="sep">:</td>
            <td>{{ $item->bentuk_organisasi }}</td>
        </tr>
        <tr>
            <td class="label">Nama Ketua / Pimpinan</td>
            <td class="sep">:</td>
            <td>{{ $item->ketua }}</td>
        </tr>
        <tr>
            <td class="label">Alamat Sekretariat</td>
            <td class="sep">:</td>
            <td>{{ $item->alamat_sekretariat }}</td>
        </tr>
    </table>

    <div class="section-title">II. Legalitas & Aktivitas</div>
    <table class="data-table">
        <tr>
            <td class="label">Nomor Legalitas</td>
            <td class="sep">:</td>
            <td>{{ $item->nomor_legalitas ?? 'Tidak Ada / Belum Terdata' }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Anggota</td>
            <td class="sep">:</td>
            <td>± {{ $item->jumlah_anggota }} Orang</td>
        </tr>
        <tr>
            <td class="label">Kegiatan Terakhir</td>
            <td class="sep">:</td>
            <td>{{ $item->kegiatan_terakhir ?? '-' }}</td>
        </tr>
    </table>

    @if($item->status == 'dilarang')
    <div class="status-box dilarang">
        STATUS: ORGANISASI DILARANG
        <div style="font-size: 10pt; margin-top: 5px; color: black; font-weight: normal; text-transform: none;">
            Organisasi ini telah dibubarkan atau dilarang oleh Pemerintah.
        </div>
    </div>
    @elseif($item->status == 'diawasi')
    <div class="status-box diawasi">
        STATUS: DALAM PENGAWASAN INTENSIF
    </div>
    @elseif($item->status == 'vakum')
    <div class="status-box vakum">
        STATUS: VAKUM / TIDAK AKTIF
    </div>
    @else
    <div class="status-box aktif">
        STATUS: AKTIF TERDAFTAR
    </div>
    @endif

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</p>
        <p>Petugas Pendata,</p>
        <br><br><br><br>
        <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Fungsional / NIP. {{ auth()->user()->nip ?? '..........' }}</p>
    </div>

</body>

</html>