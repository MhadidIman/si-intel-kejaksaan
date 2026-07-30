<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data DPO</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 landscape;
            /* Landscape untuk tabel panjang */
            margin: 1.5cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            line-height: 1.3;
            color: #000;
            -webkit-print-color-adjust: exact;
        }

        /* --- KOP SURAT 3 KOLOM --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px solid black;
        }

        .kop-table td {
            vertical-align: middle;
            padding-bottom: 5px;
        }

        .teks-center {
            text-align: center;
        }

        .teks-center h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
        }

        .teks-center h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
        }

        .teks-center p {
            font-size: 9pt;
            margin: 2px 0 0 0;
            line-height: 1.2;
        }

        .garis-tipis {
            border-top: 1px solid black;
            margin-top: 2px;
            margin-bottom: 20px;
        }

        /* --- JUDUL DOKUMEN --- */
        .title-doc {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* --- TABEL DATA --- */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10pt;
            table-layout: fixed;
        }

        .table-data th,
        .table-data td {
            border: 1px solid black;
            padding: 6px 8px;
        }

        .table-data th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            text-transform: uppercase;
        }

        .table-data td {
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* --- STATUS BADGE --- */
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
            padding: 4px 6px;
            border-radius: 3px;
            display: inline-block;
        }

        .buron {
            color: #b91c1c;
            border: 1px solid #b91c1c;
            background-color: #fef2f2;
        }

        .tertangkap {
            color: #15803d;
            border: 1px solid #15803d;
            background-color: #f0fdf4;
        }

        /* --- TANDA TANGAN --- */
        .ttd-wrapper {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .ttd-box {
            float: right;
            width: 300px;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- KOP SURAT 3 KOLOM -->
    <table class="kop-table">
        <tr>
            <td style="width: 15%; text-align: center;">
                <img src="{{ asset('img/logo-kejaksaan.png') }}" style="width: 75px; height: auto;">
            </td>
            <td class="teks-center" style="width: 70%;">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <div class="garis-tipis"></div>

    <!-- JUDUL DOKUMEN -->
    <div class="title-doc">
        DAFTAR PENCARIAN ORANG (DPO)
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 20%">Identitas Buronan</th>
                <th style="width: 14%">Tempat/Tgl Lahir</th>
                <th style="width: 34%">Kasus Posisi</th>
                <th style="width: 13%">Status Hukum</th>
                <th style="width: 15%">Status DPO</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>

                <!-- Identitas -->
                <td>
                    <strong style="text-transform: uppercase;">{{ $item->nama_lengkap }}</strong><br>
                    @if(!empty($item->ciri_fisik) || !empty($item->ciri_ciri))
                    <div style="margin-top: 4px; font-size: 8.5pt; color: #333; font-style: italic;">
                        Ciri: {{ \Illuminate\Support\Str::limit($item->ciri_fisik ?? $item->ciri_ciri, 80) }}
                    </div>
                    @endif
                </td>

                <!-- TTL -->
                <td>
                    {{ $item->tempat_lahir ?? '-' }}<br>
                    <span style="font-size: 9pt;">
                        {{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                    </span>
                </td>

                <!-- Kasus Posisi -->
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($item->kasus_posisi ?? $item->kronologi ?? $item->kasus ?? '-', 250) }}
                </td>

                <!-- Status Hukum -->
                <td style="text-align: center;">
                    {{ $item->status_hukum ?? '-' }}
                </td>

                <!-- Status DPO -->
                <td style="text-align: center;">
                    @if(in_array(strtolower($item->status_dpo ?? $item->status_pencarian), ['buron', 'dpo', 'masih buron']))
                    <span class="status-badge buron">MASIH BURON</span>
                    @else
                    <span class="status-badge tertangkap">TERTANGKAP</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; font-style: italic; padding: 15px;">Data DPO tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI -->
    <div class="ttd-wrapper">
        <div class="ttd-box">
            <p style="margin: 0;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold;">Kepala Seksi Intelijen,</p>

            <div style="margin: 15px 0;">
                @php
                $qrContent = "Dokumen Valid: Rekapitulasi Data DPO\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(90)->generate($qrContent)) !!} ">
            </div>

            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Dimas Purnama Putra, S.H.,M.H</p>
            <p style="margin: 0;">Jaksa Madya NIP. 19850101 201001 1 001</p>
        </div>
        <div class="clear"></div>
    </div>

</body>

</html>