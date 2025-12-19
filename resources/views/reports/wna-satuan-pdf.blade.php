<!DOCTYPE html>
<html>

<head>
    <title>Biodata WNA - {{ $item->nama_lengkap }}</title>
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
            border: 1px solid #000;
            margin-left: 20px;
            text-align: center;
        }

        .foto-container img {
            max-width: 100%;
            max-height: 100%;
        }

        .placeholder {
            margin-top: 80px;
            font-size: 10px;
            color: gray;
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

        .status-box {
            margin-top: 20px;
            padding: 10px;
            border: 2px solid black;
            text-align: center;
            font-weight: bold;
        }

        .overstay {
            border-color: red;
            color: red;
        }

        .aman {
            border-color: green;
            color: green;
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
        BIDANG INTELIJEN - PENGAWASAN ORANG ASING
    </div>

    <div class="judul">LEMBAR DATA ORANG ASING</div>

    <div class="container">
        <div class="foto-container">
            @if($item->foto_dokumen && file_exists(public_path('storage/' . $item->foto_dokumen)))
            <img src="{{ public_path('storage/' . $item->foto_dokumen) }}">
            @else
            <div class="placeholder">FOTO TIDAK TERSEDIA</div>
            @endif
        </div>

        <table class="data-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="sep">:</td>
                <td>{{ strtoupper($item->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td class="label">Kebangsaan</td>
                <td class="sep">:</td>
                <td>{{ $item->kebangsaan }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Paspor</td>
                <td class="sep">:</td>
                <td>{{ $item->nomor_paspor }}</td>
            </tr>
            <tr>
                <td class="label">Tujuan Kunjungan</td>
                <td class="sep">:</td>
                <td>{{ $item->tujuan_kunjungan }}</td>
            </tr>
            <tr>
                <td class="label">Sponsor / Penjamin</td>
                <td class="sep">:</td>
                <td>{{ $item->sponsor ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Menginap</td>
                <td class="sep">:</td>
                <td>{{ $item->alamat_menginap }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>
    <hr>

    <h3 style="margin-bottom: 5px;">STATUS IZIN TINGGAL</h3>
    <table class="data-table">
        <tr>
            <td class="label">Tanggal Tiba</td>
            <td class="sep">:</td>
            <td>{{ $item->tanggal_tiba ? \Carbon\Carbon::parse($item->tanggal_tiba)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Masa Berlaku s/d</td>
            <td class="sep">:</td>
            <td>{{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->format('d F Y') }}</td>
        </tr>
    </table>

    @php
    $isOverstay = $item->masa_berlaku_izin_tinggal < now();
        $hariTelat=now()->diffInDays($item->masa_berlaku_izin_tinggal);
        @endphp

        @if($isOverstay)
        <div class="status-box overstay">
            PERINGATAN: SUBJEK TELAH OVERSTAY<br>
            (Melewati Batas Izin Tinggal Selama {{ $hariTelat }} Hari)
        </div>
        @else
        <div class="status-box aman">
            STATUS: IZIN TINGGAL BERLAKU (AMAN)
        </div>
        @endif

        <div class="ttd">
            <p>{{ config('app.kota_kantor', 'Jakarta') }}, {{ date('d F Y') }}</p>
            <p>Petugas Pengawas,</p>
            <br><br><br>
            <p><strong>{{ auth()->user()->name }}</strong><br>Jaksa Intelijen</p>
        </div>

</body>

</html>