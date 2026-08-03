<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Peta Kerawanan</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 landscape;
            /* Landscape untuk tabel rekap kerawanan */
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

        .sub-title {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 20px;
        }

        /* --- TABEL DATA (PERBAIKAN GARIS ATAS & BAWAH) --- */
        /* --- TABEL DATA (JURUS ANTI HILANG GARIS) --- */
        .table-data {
            width: 100%;
            /* Ganti collapse menjadi separate agar browser tidak memakan garis atas */
            border-collapse: separate !important;
            border-spacing: 0 !important;
            margin-top: 10px;
            font-size: 10pt;
            table-layout: fixed;
            border-top: 1px solid #000 !important;
            border-left: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
            border-bottom: 1px solid #000 !important;
        }

        .table-data th,
        .table-data td {
            /* Berikan garis pada setiap sisi sel */
            border: 1px solid #000 !important;
            padding: 8px 6px;
        }

        .table-data th {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            text-transform: uppercase;
            background-color: #ffffff !important;
            /* Paksa garis atas tebal khusus header */
            border-top: 1.5px solid #000 !important;
            border-bottom: 1.5px solid #000 !important;
        }

        .table-data td {
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* STATUS BADGE */
        .badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
            padding: 4px 6px;
            border-radius: 3px;
            display: inline-block;
        }

        .tinggi {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #b91c1c;
        }

        .sedang {
            background-color: #ffedd5;
            color: #c2410c;
            border: 1px solid #c2410c;
        }

        .rendah {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #15803d;
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
        REKAPITULASI PEMETAAN DAERAH RAWAN (PETA KERAWANAN)
    </div>
    <div class="sub-title">
        Wilayah Hukum Kejaksaan Negeri Banjarmasin<br>
        Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 4%">NO</th>
                <th style="width: 20%">LOKASI (KECAMATAN)</th>
                <th style="width: 15%">BIDANG INTELIJEN</th>
                <th style="width: 11%">TINGKAT</th>
                <th style="width: 30%">POTENSI ANCAMAN</th>
                <th style="width: 20%">SUMBER INFORMASI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>

                <!-- Lokasi -->
                <td style="text-align: left;">
                    <strong style="text-transform: uppercase;">{{ $row->kecamatan }}</strong>
                    @if(!empty($row->desa))
                    <br><span style="font-size: 8.5pt; color: #444;">Desa: {{ $row->desa }}</span>
                    @endif
                </td>

                <!-- Bidang -->
                <td style="text-align: left;">{{ $row->bidang }}</td>

                <!-- Tingkat Kerawanan -->
                <td style="text-align: center;">
                    @if(strtolower($row->tingkat_rawan) == 'tinggi')
                    <span class="badge tinggi">TINGGI</span>
                    @elseif(strtolower($row->tingkat_rawan) == 'sedang')
                    <span class="badge sedang">SEDANG</span>
                    @else
                    <span class="badge rendah">RENDAH</span>
                    @endif
                </td>

                <!-- Potensi Ancaman -->
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($row->potensi_ancaman, 200) }}
                </td>

                <!-- Sumber Info -->
                <td style="text-align: left;">
                    {{ $row->sumber_informasi ?? 'Tertutup / Terbuka' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; font-style: italic; padding: 15px;">Data Peta Kerawanan tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (REKAP KERAWANAN) -->
    <div class="ttd-wrapper">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code Validasi Kerawanan -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = "Dokumen Valid: Rekapitulasi Peta Kerawanan\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
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