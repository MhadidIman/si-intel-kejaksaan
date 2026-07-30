<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data WNA</title>
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

        /* --- TABEL DATA (SESUAI GAMBAR) --- */
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
            /* Background dihilangkan agar formal */
        }

        .table-data td {
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* --- STATUS BADGE --- */
        .status-aman {
            color: #15803d;
            /* Hijau */
            font-weight: bold;
        }

        .status-overstay {
            color: #b91c1c;
            /* Merah */
            font-weight: bold;
        }

        .status-warning {
            color: #d97706;
            /* Orange */
            font-weight: bold;
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

    <!-- KOP SURAT -->
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
        DATA PENGAWASAN ORANG ASING (WNA)
    </div>
    <div class="tgl-cetak">
        Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%">NO</th>
                <th style="width: 25%">IDENTITAS WNA</th>
                <th style="width: 15%">IZIN TINGGAL</th>
                <th style="width: 20%">TUJUAN & SPONSOR</th>
                <th style="width: 20%">ALAMAT MENGINAP</th>
                <th style="width: 15%">STATUS IZIN</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: left;">
                    <strong style="text-transform: uppercase;">{{ $item->nama_lengkap }}</strong><br>
                    <span style="font-size: 9pt; color: #000;">
                        Paspor: {{ $item->nomor_paspor }}<br>
                        Negara: {{ $item->kebangsaan }}
                    </span>
                </td>
                <td style="text-align: left;">
                    <span style="font-size: 9pt;">Tiba:<br>
                        {{ $item->tanggal_tiba ? \Carbon\Carbon::parse($item->tanggal_tiba)->format('d/m/Y') : '-' }}</span>
                    <br><br>
                    <span style="font-size: 9pt;">Berlaku s/d:<br>
                        <strong>{{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->format('d/m/Y') }}</strong></span>
                </td>
                <td style="text-align: left;">
                    {{ $item->tujuan_kunjungan }}<br><br>
                    <span style="font-size: 9pt;">Sponsor: {{ $item->sponsor ?? '-' }}</span>
                </td>
                <td style="text-align: center;">
                    {{ $item->alamat_menginap }}
                </td>
                <td style="text-align: center;">
                    @php
                    $tglExp = \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->startOfDay();
                    $today = \Carbon\Carbon::now()->startOfDay();
                    $diff = $today->diffInDays($tglExp, false);
                    @endphp

                    @if($diff < 0)
                        <span class="status-overstay">OVERSTAY</span><br>
                        <span style="font-size: 9pt; color: #b91c1c;">({{ abs($diff) }} Hari)</span>
                        @elseif($diff <= 30)
                            <span class="status-warning">WARNING</span><br>
                            <span style="font-size: 9pt; color: #d97706;">(Sisa {{ $diff }} Hari)</span>
                            @else
                            <span class="status-aman">AMAN</span>
                            @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; font-style: italic; padding: 15px;">Data WNA tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <div class="ttd-wrapper">
        <div class="ttd-box">
            <p style="margin: 0;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold;">Kepala Seksi Intelijen,</p>

            <div style="margin: 15px 0;">
                @php
                $qrContent = "Dokumen Valid: Rekapitulasi Pengawasan WNA\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
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