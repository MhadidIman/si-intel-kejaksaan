<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan Khusus</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 landscape;
            margin: 1.5cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            line-height: 1.3;
            color: #000;
            -webkit-print-color-adjust: exact;
        }

        /* --- STYLING LABEL RAHASIA --- */
        .rahasia-top {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
            color: red;
            /* Khusus Lapsus, warna merah */
            margin-bottom: 10px;
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

    <div class="rahasia-top">DOKUMEN RAHASIA</div>

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
        REKAPITULASI LAPORAN KHUSUS (LAPSUS)
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal & Waktu</th>
                <th style="width: 10%;">Sifat</th>
                <th style="width: 20%;">Siapa & Lokasi</th>
                <th style="width: 25%;">Peristiwa (Apa)</th>
                <th style="width: 25%;">Saran / Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lapsus as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ \Carbon\Carbon::parse($item->tanggal_laporan)->translatedFormat('d F Y') }}</strong><br>
                    <span style="font-size: 9pt; color: #333;">Waktu: {{ $item->kapan }}</span>
                </td>
                <td style="text-align: center; font-weight: bold; font-size: 9pt; color: {{ $item->tingkat_kerahasiaan == 'Sangat Rahasia' ? 'red' : '#333' }};">
                    {{ strtoupper($item->tingkat_kerahasiaan) }}
                </td>
                <td>
                    <strong>Subjek:</strong> {{ $item->siapa }}<br>
                    <strong>Lokasi:</strong> {{ $item->dimana }}
                </td>
                <td style="text-align: justify;">
                    {{ $item->apa }}
                </td>
                <td style="text-align: justify;">
                    {{ $item->saran ?? '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; font-style: italic; padding: 15px;">Data Lapsus tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (REKAP LAPSUS) -->
    <div class="ttd-wrapper">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code Validasi LAPSUS -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = "Dokumen Valid: Rekapitulasi LAPSUS\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
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