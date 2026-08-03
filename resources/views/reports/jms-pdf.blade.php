<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi JMS</title>
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
            text-transform: uppercase;
        }

        .teks-center h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
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
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .sub-title {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 20px;
        }

        /* --- TABEL DATA (PERBAIKAN GARIS) --- */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10pt;
            table-layout: fixed;
            border: 1px solid black !important;
            /* Paksa bingkai luar tabel */
        }

        .table-data th,
        .table-data td {
            border: 1px solid black !important;
            /* Paksa garis tiap sel muncul */
            padding: 10px 8px;
        }

        .table-data th {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            text-transform: uppercase;
            background-color: transparent;
        }

        .table-data td {
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* --- TANDA TANGAN --- */
        .ttd-wrapper {
            width: 100%;
            margin-top: 40px;
            display: inline-block;
            page-break-inside: avoid;
            break-inside: avoid;
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
        LAPORAN KEGIATAN PENERANGAN HUKUM (JMS)
    </div>
    <div class="sub-title">
        Program Jaksa Masuk Sekolah<br>
        Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%">NO</th>
                <th style="width: 15%">TANGGAL</th>
                <th style="width: 20%">NAMA SEKOLAH</th>
                <th style="width: 30%">MATERI DISAMPAIKAN</th>
                <th style="width: 10%">SISWA</th>
                <th style="width: 20%">JAKSA PEMATERI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">
                    {{ \Carbon\Carbon::parse($row->tanggal_kegiatan)->translatedFormat('d F Y') }}
                </td>
                <td style="text-align: left;">
                    <strong style="text-transform: uppercase;">{{ $row->nama_sekolah }}</strong>
                </td>
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($row->materi, 150) }}
                </td>
                <td style="text-align: center;">
                    {{ $row->jumlah_siswa }} Org
                </td>
                <td style="text-align: left;">
                    {{ $row->nama_jaksa }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; font-style: italic; padding: 15px;">Belum ada data kegiatan JMS.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (REKAP JMS) -->
    <div class="ttd-wrapper">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code Validasi JMS -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = "Dokumen Valid: Rekapitulasi Kegiatan JMS\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
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