<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi LAPINHAR</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 landscape;
            /* Diubah ke Landscape agar tabel muat banyak */
            margin: 1.5cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            /* Font sedikit diperkecil untuk tabel */
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
        }

        /* --- TANDA TANGAN --- */
        .ttd-wrapper {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
            /* Menghindari tanda tangan terpotong ke halaman baru */
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

    <!-- KOP SURAT 3 KOLOM AGAR PRESISI DI TENGAH -->
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
        LAPORAN INFORMASI HARIAN (LAPINHAR)
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
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
            @forelse($data as $index => $item)
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
            @empty
            <tr>
                <td colspan="6" style="text-align: center; font-style: italic; padding: 15px;">Data Lapinhar tidak ditemukan.</td>
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
                // Membuat isi QR Code khusus untuk Rekapitulasi Data
                $qrContent = "Dokumen Valid: Rekapitulasi LAPINHAR\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(90)->generate($qrContent)) !!} ">
            </div>

            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Nama Kasi Intelijen</p>
            <p style="margin: 0;">NIP. 1234567890</p>
        </div>
        <div class="clear"></div>
    </div>

</body>

</html>