<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data DPO</title>
    <style>
        /* PENGATURAN KERTAS & FONT */
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            /* Ukuran font standar surat dinas */
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
            width: 80px;
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
            font-size: 9pt;
            /* Font tabel sedikit lebih kecil agar muat */
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
            text-transform: uppercase;
        }

        td {
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
            /* Teks rata atas */
        }

        /* STATUS BADGE */
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 7pt;
            padding: 2px 5px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 0;
        }

        .buron {
            color: #b91c1c;
            /* Merah gelap */
            border: 1px solid #b91c1c;
            background-color: #fef2f2;
        }

        .tertangkap {
            color: #15803d;
            /* Hijau gelap */
            border: 1px solid #15803d;
            background-color: #f0fdf4;
        }

        /* TANDA TANGAN */
        .ttd-container {
            float: right;
            width: 35%;
            text-align: center;
            margin-top: 30px;
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
                <th style="width: 4%">No</th>
                <th style="width: 20%">Identitas Buronan</th>
                <th style="width: 14%">Tempat/Tgl Lahir</th>
                <th style="width: 34%">Kasus Posisi</th> {{-- Kolom diperlebar --}}
                <th style="width: 13%">Status Hukum</th>
                <th style="width: 15%">Status DPO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>

                {{-- Identitas --}}
                <td>
                    <strong style="text-transform: uppercase;">{{ $item->nama_lengkap }}</strong><br>
                    @if(!empty($item->ciri_fisik) || !empty($item->ciri_ciri))
                    <div style="margin-top: 4px; font-size: 8.5pt; color: #333; font-style: italic;">
                        Ciri: {{ \Illuminate\Support\Str::limit($item->ciri_fisik ?? $item->ciri_ciri, 80) }}
                    </div>
                    @endif
                </td>

                {{-- TTL --}}
                <td>
                    {{ $item->tempat_lahir ?? '-' }}<br>
                    <span style="font-size: 9pt;">
                        {{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                    </span>
                </td>

                {{-- Kasus Posisi (FIX: Cek beberapa kemungkinan nama kolom) --}}
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($item->kasus_posisi ?? $item->kronologi ?? $item->kasus ?? '-', 250) }}
                </td>

                {{-- Status Hukum --}}
                <td style="text-align: center;">
                    {{ $item->status_hukum ?? '-' }}
                </td>

                {{-- Status DPO --}}
                <td style="text-align: center;">
                    {{-- Cek berbagai kemungkinan value status (buron, DPO, tertangkap) --}}
                    @if(in_array(strtolower($item->status_dpo ?? $item->status_pencarian), ['buron', 'dpo', 'masih buron']))
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