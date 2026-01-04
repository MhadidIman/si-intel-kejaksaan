<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Kinerja Staff</title>
    <style>
        /* PENGATURAN DASAR */
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* KOP SURAT SESUAI STYLE TERBARU */
        .header-container {
            text-align: center;
            position: relative;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .logo {
            width: 80px;
            position: absolute;
            left: 0;
            top: 0;
        }

        .header-text h3 {
            margin: 0;
            font-size: 14pt;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header-text h2 {
            margin: 2px 0;
            font-size: 16pt;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header-text p {
            margin: 0;
            font-size: 9pt;
            font-weight: normal;
        }

        /* JUDUL DOKUMEN */
        .title-doc {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
            margin-top: 10px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        /* TABEL DATA */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
            padding: 8px 4px;
            font-size: 8.5pt;
            text-transform: uppercase;
            font-weight: bold;
        }

        td {
            padding: 6px;
            text-align: center;
            font-size: 9pt;
        }

        .text-left {
            text-align: left;
        }

        .total-bg {
            background-color: #f0fdf4;
            font-weight: bold;
            color: #15803d;
        }

        /* TANDA TANGAN */
        .ttd-container {
            margin-top: 30px;
            float: right;
            width: 300px;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>
    {{-- KOP SURAT --}}
    <div class="header-container">
        <img src="{{ public_path('img/logo-kejaksaan.png') }}" class="logo">
        <div class="header-text">
            <h3>KEJAKSAAN REPUBLIK INDONESIA</h3>
            <h3>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h3>
            <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
            <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
            <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
        </div>
    </div>

    {{-- JUDUL DOKUMEN --}}
    <div class="title-doc">REKAPITULASI KINERJA INPUT DATA STAFF INTELIJEN</div>
    <div style="text-align: center; font-size: 9pt; margin-bottom: 10px;">
        Tanggal Cetak: {{ date('d F Y') }}
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 3%">No</th>
                <th class="text-left" style="width: 20%">Nama Staff / NIP</th>
                <th>Lapinhar</th>
                <th>DPO</th>
                <th>WNA</th>
                <th>Ormas</th>
                <th>PAM SDO</th>
                <th>JMS</th>
                <th>Rawan</th>
                <th>Lapdu</th>
                <th class="total-bg">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $user)
            @php
            $total = $user->lapinhars_count + $user->dpos_count + $user->wnas_count + $user->ormas_count +
            $user->pam_sdos_count + $user->jms_activities_count + $user->kerawanans_count + $user->lapdus_count;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-left">
                    <strong>{{ $user->name }}</strong><br>
                    <small style="color: #444;">NIP. {{ $user->nip ?? '-' }}</small>
                </td>
                <td>{{ $user->lapinhars_count }}</td>
                <td>{{ $user->dpos_count }}</td>
                <td>{{ $user->wnas_count }}</td>
                <td>{{ $user->ormas_count }}</td>
                <td>{{ $user->pam_sdos_count }}</td>
                <td>{{ $user->jms_activities_count }}</td>
                <td>{{ $user->kerawanans_count }}</td>
                <td>{{ $user->lapdus_count }}</td>
                <td class="total-bg">{{ $total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="ttd-container">
        <p>Banjarmasin, {{ date('d F Y') }}</p>
        <p>Kepala Seksi Intelijen,</p>
        <br><br><br>
        <p style="text-decoration: underline; font-weight: bold; margin-bottom: 0;">Dimas Purnama Putra, S.H.,M.H</p>
        <p style="margin-top: 2px;">Jaksa Madya NIP. 19850101 201001 1 001</p>
    </div>

    <div class="clear"></div>
</body>

</html>