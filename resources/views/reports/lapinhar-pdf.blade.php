<!DOCTYPE html>
<html>

<head>
    <title>Laporan Informasi Harian</title>
    <style>
        /* PENGATURAN KERTAS & FONT */
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* KOP SURAT (STANDAR RESMI) */
        .header-container {
            text-align: center;
            position: relative;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            /* Garis ganda tebal tipis */
            padding-bottom: 10px;
        }

        .logo {
            width: 85px;
            position: absolute;
            left: 0;
            top: 5px;
        }

        .header-text h3 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text h2 {
            margin: 2px 0;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
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
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* TABEL DATA */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10pt;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            padding: 8px 5px;
            vertical-align: middle;
        }

        td {
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        /* TANDA TANGAN */
        .ttd-container {
            float: right;
            width: 40%;
            text-align: center;
            margin-top: 40px;
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
    <div class="title-doc">
        LAPORAN INFORMASI HARIAN (LAPINHAR)
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Waktu & No. Surat</th>
                <th style="width: 10%">Bidang</th>
                <th style="width: 15%">Sumber</th>
                <th style="width: 30%">Peristiwa / Fakta</th>
                <th style="width: 25%">Pendapat / Analisa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d F Y') }}</strong><br>
                    <span style="font-size: 9pt; color: #333;">No: {{ $item->nomor_surat ?? '-' }}</span>
                </td>
                <td style="text-align: center; text-transform: uppercase; font-size: 9pt;">
                    {{ $item->bidang }}
                </td>
                <td>{{ $item->sumber_informasi }}</td>
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($item->peristiwa, 200) }}
                </td>
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($item->pendapat, 200) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="ttd-container">
        <p>Banjarmasin, {{ now()->translatedFormat('d F Y') }}</p>
        <p>Kepala Seksi Intelijen,</p>
        <br><br><br>
        <p style="font-weight: bold; text-decoration: underline; margin-bottom: 0;">Dimas Purnama Putra, S.H.,M.H</p>
        <p style="margin-top: 2px;">Jaksa Madya NIP. 19850101 201001 1 001</p>
    </div>

</body>

</html>