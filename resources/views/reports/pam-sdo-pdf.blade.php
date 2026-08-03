<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan PAM SDO</title>
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

        /* --- TABEL DATA (SUPER OVERRIDE UNTUK CETAK PDF) --- */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10pt;
            table-layout: fixed;
            border: 1px solid black !important;
            border-bottom: 1px solid black !important;
        }

        .table-data th,
        .table-data td {
            border: 1px solid black !important;
            padding: 8px 6px;
        }

        /* Trik Khusus: Memaksa sel pada baris terakhir untuk menebalkan garis bawahnya */
        .table-data tbody tr:last-child td {
            border-bottom: 1.5px solid black !important;
        }

        /* Trik Khusus: Mencegah browser memotong garis saat ganti halaman */
        .table-data tr {
            page-break-inside: avoid !important;
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

        /* --- STATUS BADGE --- */
        .status-aman {
            color: #16a34a;
            font-weight: bold;
        }

        .status-ditindak {
            color: #d97706;
            font-weight: bold;
        }

        .status-diawasi {
            color: #dc2626;
            font-weight: bold;
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
        LAPORAN PENGAMANAN SUMBER DAYA ORGANISASI (PAM SDO)
    </div>
    <div class="tgl-cetak">
        Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 4%">NO</th>
                <th style="width: 12%">TGL INPUT</th>
                <th style="width: 19%">IDENTITAS PEGAWAI</th>
                <th style="width: 18%">JABATAN & SATKER</th>
                <th style="width: 25%">PERMASALAHAN</th>
                <th style="width: 12%">STATUS</th>
                <th style="width: 10%">KET</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">
                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                </td>
                <td style="text-align: left;">
                    <strong style="text-transform: uppercase;">{{ $item->nama_pegawai }}</strong><br>
                    <span style="font-size: 9pt; color: #444;">
                        NIP/NRP: {{ $item->nip_nrp ?? '-' }}
                    </span>
                </td>
                <td style="text-align: left;">
                    {{ $item->pangkat_jabatan }}<br>
                    <span style="font-size: 9pt; font-style: italic; color: #444;">{{ $item->satuan_kerja }}</span>
                </td>
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($item->permasalahan, 150) }}
                </td>
                <td style="text-align: center;">
                    @if($item->status_pam == 'clear')
                    <span class="status-aman">AMAN</span>
                    @elseif($item->status_pam == 'ditindak')
                    <span class="status-ditindak">DITINDAK</span>
                    @else
                    <span class="status-diawasi">DIAWASI</span>
                    @endif
                </td>
                <td style="text-align: center; font-size: 9pt;">
                    {{ $item->keterangan ?? '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; font-style: italic; padding: 15px;">Data PAM SDO tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (REKAP PAM SDO) -->
    <div class="ttd-wrapper">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code Validasi PAM SDO -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = "Dokumen Valid: Rekapitulasi PAM SDO\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
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