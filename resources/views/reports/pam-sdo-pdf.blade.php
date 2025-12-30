<!DOCTYPE html>
<html>

<head>
    <title>Laporan PAM SDO</title>
    <style>
        /* PENGATURAN KERTAS & FONT */
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* KOP SURAT YANG LEBIH RAPI */
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
            /* Ukuran logo lebih proporsional */
            position: absolute;
            left: 0;
            top: 5px;
        }

        .header-text {
            margin-left: 0;
            /* Bisa disesuaikan jika ingin offset dari logo */
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

        /* JUDUL LAPORAN */
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

        /* STATUS BADGE */
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
            padding: 2px 0;
            display: block;
            text-align: center;
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
        LAPORAN PENGAMANAN SUMBER DAYA ORGANISASI (PAM SDO)
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 12%">Tanggal Input</th>
                <th style="width: 20%">Identitas Pegawai</th>
                <th style="width: 18%">Jabatan & Satker</th>
                <th style="width: 25%">Permasalahan</th>
                <th style="width: 12%">Status PAM</th>
                <th style="width: 8%">Ket.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td style="text-align: center">
                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                </td>
                <td>
                    <strong style="text-transform: uppercase;">{{ $item->nama_pegawai }}</strong><br>
                    <span style="font-size: 9pt; color: #333;">NIP/NRP: {{ $item->nip_nrp ?? '-' }}</span>
                </td>
                <td>
                    {{ $item->pangkat_jabatan }}<br>
                    <small><i>{{ $item->satuan_kerja }}</i></small>
                </td>
                <td>
                    {{ \Illuminate\Support\Str::limit($item->permasalahan, 150) }}
                </td>
                <td style="text-align: center;">
                    @php
                    $statusText = match($item->status_pam) {
                    'diawasi' => 'DIAWASI',
                    'ditindak' => 'DITINDAK',
                    'clear' => 'AMAN',
                    default => strtoupper($item->status_pam)
                    };
                    @endphp
                    <span class="status-badge">
                        {{ $statusText }}
                    </span>
                </td>
                <td>{{ $item->keterangan ?? '-' }}</td>
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