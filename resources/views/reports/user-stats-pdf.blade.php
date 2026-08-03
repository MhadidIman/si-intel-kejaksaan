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

        /* KOP SURAT MENGGUNAKAN TABEL (DIJAMIN TIDAK TABRAKAN) */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-table td {
            border: none !important;
            padding: 0;
        }

        .header-text h3 {
            margin: 0;
            font-size: 13pt;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header-text h2 {
            margin: 2px 0;
            font-size: 15pt;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header-text p {
            margin: 0;
            font-size: 8.5pt;
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

        /* TABEL DATA UTAMA */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .data-table,
        .data-table th,
        .data-table td {
            border: 1px solid black;
        }

        .data-table th {
            background-color: #f2f2f2;
            padding: 8px 4px;
            font-size: 8.5pt;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
        }

        .data-table td {
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
        .ttd-wrapper {
            margin-top: 30px;
        }

        .ttd-container {
            float: right;
            width: 320px;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">
    {{-- KOP SURAT MENGGUNAKAN TABEL --}}
    <table class="kop-table">
        <tr>
            <td style="width: 90px; text-align: left; vertical-align: middle;">
                <img src="{{ asset('img/logo-kejaksaan.png') }}" style="width: 75px;" alt="Logo Kejaksaan">
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <div class="header-text">
                    <h3>KEJAKSAAN REPUBLIK INDONESIA</h3>
                    <h3>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h3>
                    <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                    <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                    <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
                </div>
            </td>
        </tr>
    </table>

    {{-- JUDUL DOKUMEN --}}
    <div class="title-doc">REKAPITULASI KINERJA INPUT DATA STAFF INTELIJEN</div>
    <div style="text-align: center; font-size: 9pt; margin-bottom: 10px;">
        Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    {{-- TABEL DATA --}}
    <table class="data-table">
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
                <th class="total-bg">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $user)
            @php
            $total = $user->lapinhars_count + $user->dpos_count + $user->wnas_count + $user->ormas_count +
            $user->pam_sdos_count + $user->jms_activities_count + $user->kerawanans_count;
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
                <td class="total-bg">{{ $total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TANDA TANGAN BESERTA QR CODE VALIDASI (USER STATS ADMIN) --}}
    <div class="ttd-wrapper">
        <div class="ttd-container">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code Validasi User Stats -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = "Dokumen Valid: Laporan Statistik User (Admin)\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
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

</body>

</html>