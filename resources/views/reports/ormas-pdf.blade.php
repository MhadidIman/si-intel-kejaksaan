<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Ormas & LSM</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 landscape;
            /* Kertas Landscape untuk tabel lebar */
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
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .tgl-cetak {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 20px;
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
            padding: 8px 6px;
        }

        .table-data th {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            text-transform: uppercase;
            background-color: transparent;
            /* Formal look */
        }

        .table-data td {
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* --- STATUS BADGE --- */
        .status-aktif {
            color: #16a34a;
            /* Hijau */
            font-weight: bold;
        }

        .status-diawasi {
            color: #d97706;
            /* Orange/Kuning */
            font-weight: bold;
        }

        .status-dilarang {
            color: #dc2626;
            /* Merah */
            font-weight: bold;
        }

        .status-vakum {
            color: #4b5563;
            /* Abu-abu gelap */
            font-style: italic;
        }

        /* --- TANDA TANGAN --- */
        .ttd-wrapper {
            width: 100%;
            margin-top: 40px;
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
        DATA ORGANISASI KEMASYARAKATAN (ORMAS) & LSM
    </div>
    <div class="tgl-cetak">
        Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 4%">NO</th>
                <th style="width: 25%">NAMA ORGANISASI</th>
                <th style="width: 15%">KETUA</th>
                <th style="width: 10%">BENTUK</th>
                <th style="width: 15%">LEGALITAS</th>
                <th style="width: 20%">ALAMAT</th>
                <th style="width: 11%">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: left;">
                    <strong style="text-transform: uppercase;">{{ $item->nama_organisasi }}</strong><br>
                    <span style="font-size: 9pt; color: #444;">
                        Anggota: {{ $item->jumlah_anggota ?? '-' }} Orang
                    </span>
                </td>
                <td style="text-align: left;">{{ $item->ketua }}</td>
                <td style="text-align: center;">{{ $item->bentuk_organisasi }}</td>
                <td style="text-align: left;">{{ $item->nomor_legalitas ?? '-' }}</td>
                <td style="text-align: left;">
                    {{ \Illuminate\Support\Str::limit($item->alamat_sekretariat, 100) }}
                </td>
                <td style="text-align: center;">
                    @if($item->status == 'aktif')
                    <span class="status-aktif">AKTIF</span>
                    @elseif($item->status == 'diawasi')
                    <span class="status-diawasi">DIAWASI</span>
                    @elseif($item->status == 'dilarang')
                    <span class="status-dilarang">DILARANG</span>
                    @else
                    <span class="status-vakum">VAKUM</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; font-style: italic; padding: 15px;">Data Ormas & LSM tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (REKAP ORMAS & LSM) -->
    <div class="ttd-wrapper">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code Validasi ORMAS & LSM -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = "Dokumen Valid: Rekapitulasi ORMAS & LSM\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
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