<!DOCTYPE html>
<html>

<head>
    <title>Data Ormas - {{ $item->nama_organisasi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
        }

        /* Tabel Data */
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
            width: 180px;
            font-weight: bold;
            background-color: #fafafa;
        }

        .sep {
            width: 10px;
            text-align: center;
        }

        /* Kotak Status */
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
        }

        .ttd {
            float: right;
            width: 250px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="header">
        KEJAKSAAN REPUBLIK INDONESIA<br>
        BIDANG INTELIJEN - PENGAWASAN ALIRAN KEPERCAYAAN & ORMAS
    </div>

    <div class="judul">LEMBAR DATA ORGANISASI KEMASYARAKATAN</div>

    <div class="section-title">I. IDENTITAS ORGANISASI</div>
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

    <div class="section-title">II. LEGALITAS & AKTIVITAS</div>
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
        <div style="font-size: 10pt; margin-top: 5px; color: black; font-weight: normal;">Organisasi ini telah dibubarkan atau dilarang oleh Pemerintah.</div>
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
        <p>{{ config('app.kota_kantor', 'Jakarta') }}, {{ date('d F Y') }}</p>
        <p>Petugas Pendata,</p>
        <br><br><br>
        <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Fungsional</p>
    </div>

</body>

</html>