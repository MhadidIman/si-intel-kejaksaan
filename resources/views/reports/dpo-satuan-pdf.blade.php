<!DOCTYPE html>
<html>

<head>
    <title>Biodata DPO - {{ $item->nama_lengkap }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
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
            color: #b91c1c;
        }

        /* Layout Foto dan Data */
        .container {
            width: 100%;
            margin-bottom: 20px;
        }

        .foto-container {
            float: right;
            width: 160px;
            height: 200px;
            border: 2px solid #b91c1c;
            /* Border Merah untuk DPO */
            margin-left: 20px;
            text-align: center;
            background-color: #fef2f2;
        }

        .foto-container img {
            max-width: 100%;
            max-height: 100%;
        }

        .placeholder {
            margin-top: 80px;
            font-size: 10px;
            color: #b91c1c;
            font-weight: bold;
        }

        /* Tabel Biodata */
        .data-table {
            width: 100%;
        }

        .data-table td {
            padding: 5px;
            vertical-align: top;
        }

        .label {
            width: 160px;
            font-weight: bold;
        }

        .sep {
            width: 10px;
        }

        /* Kotak Status */
        .status-box {
            margin-top: 20px;
            padding: 15px;
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

        .tertangkap {
            border-color: green;
            color: green;
            background-color: #f0fdf4;
        }

        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 10px;
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
        BIDANG INTELIJEN - TABUR (TANGKAP BURONAN)
    </div>

    <div class="judul">LEMBAR DATA PENCARIAN ORANG (DPO)</div>

    <div class="container">
        <div class="foto-container">
            @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
            <img src="{{ public_path('storage/' . $item->foto) }}">
            @else
            <div class="placeholder">FOTO TIDAK TERSEDIA</div>
            @endif
        </div>

        <table class="data-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="sep">:</td>
                <td><strong>{{ strtoupper($item->nama_lengkap) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Tempat Lahir</td>
                <td class="sep">:</td>
                <td>{{ $item->tempat_lahir }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td class="sep">:</td>
                <td>{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status Hukum</td>
                <td class="sep">:</td>
                <td>{{ strtoupper($item->status_hukum) }}</td>
            </tr>
            <tr>
                <td class="label">Ciri-ciri Fisik</td>
                <td class="sep">:</td>
                <td>{{ $item->ciri_fisik ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="section-title">KASUS POSISI / PERKARA</div>
    <div style="text-align: justify; border: 1px solid #ccc; padding: 10px; min-height: 100px;">
        {{ $item->kasus }}
    </div>

    @if($item->status_pencarian == 'buron')
    <div class="status-box buron">
        STATUS: MASIH BURON (DPO)
    </div>
    <p style="text-align: center; font-size: 10pt; color: red;">*Segera laporkan jika menemukan subjek ini.</p>
    @else
    <div class="status-box tertangkap">
        STATUS: SUDAH TERTANGKAP
    </div>
    @endif

    <div class="ttd">
        <p>{{ config('app.kota_kantor', 'Jakarta') }}, {{ date('d F Y') }}</p>
        <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
        <br><br><br>
        <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Utama Pratama</p>
    </div>

</body>

</html>