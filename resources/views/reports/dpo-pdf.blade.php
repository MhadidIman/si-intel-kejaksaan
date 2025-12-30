<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data DPO</title>
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

        /* STATUS BADGE */
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
            padding: 3px 6px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 5px;
        }

        .buron {
            color: #dc2626;
            border: 1px solid #dc2626;
            background-color: #fef2f2;
        }

        .tertangkap {
            color: #16a34a;
            border: 1px solid #16a34a;
            background-color: #f0fdf4;
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
        DAFTAR PENCARIAN ORANG (DPO)
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 22%">Identitas Buronan</th>
                <th style="width: 15%">Tempat/Tgl Lahir</th>
                <th style="width: 30%">Kasus Posisi</th>
                <th style="width: 13%">Status Hukum</th>
                <th style="width: 15%">Status DPO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    <strong style="text-transform: uppercase;">{{ $item->nama_lengkap }}</strong><br>
                    @if($item->ciri_fisik)
                    <div style="margin-top: 4px; font-size: 9pt; color: #444; font-style: italic;">
                        Ciri: {{ \Illuminate\Support\Str::limit($item->ciri_fisik, 60) }}
                    </div>
                    @endif
                </td>
                <td>
                    {{ $item->tempat_lahir ?? '-' }}<br>
                    <span style="font-size: 9pt;">
                        {{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                    </span>
                </td>
                <td style="text-align: justify;">
                    {{-- Pastikan nama kolom 'kasus_posisi' sesuai database --}}
                    {{ \Illuminate\Support\Str::limit($item->kasus_posisi, 200) }}
                </td>
                <td style="text-align: center;">
                    {{ $item->status_hukum }}
                </td>
                <td style="text-align: center;">
                    @if($item->status_pencarian == 'buron')
                    <span class="status-badge buron">MASIH BURON</span>
                    @else
                    <span class="status-badge tertangkap">TERTANGKAP</span>
                    @endif
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