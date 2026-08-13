<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Pengaduan Masyarakat</title>
    <style>
        /* PENGATURAN KERTAS & FONT */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* KOP SURAT */
        .header-container {
            text-align: center;
            position: relative;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .logo {
            width: 70px;
            position: absolute;
            left: 0;
            top: 0;
        }

        .header-text h3 {
            margin: 0;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text h2 {
            margin: 2px 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 0;
            font-size: 8pt;
            font-weight: normal;
        }

        /* JUDUL DOKUMEN */
        .title-doc {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        /* TABEL DATA */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 9pt;
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
            padding: 6px 4px;
            vertical-align: middle;
        }

        td {
            padding: 5px 6px;
            text-align: left;
            vertical-align: top;
        }

        /* STATUS BADGE */
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
            display: inline-block;
            margin-top: 5px;
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

<body onload="window.print()">

    {{-- KOP SURAT --}}
    <div class="header-container">
        @php
            $logoPath = public_path('img/logo-kejaksaan.png');
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/png;base64,' . $logoData;
        @endphp
        <img src="{{ $logoBase64 }}" class="logo">
        <div class="header-text">
            <h3>KEJAKSAAN REPUBLIK INDONESIA</h3>
            <h3>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h3>
            <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
            <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
            <p>Website: kejari-banjarmasin.go.id</p>
        </div>
    </div>

    {{-- JUDUL DOKUMEN --}}
    <div class="title-doc">
        REKAPITULASI LAPORAN PENGADUAN MASYARAKAT (LAPDU)
    </div>
    <div style="text-align: center; font-size: 9pt; margin-bottom: 15px;">
        Tanggal Cetak: {{ date('d F Y') }}
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 12%">Tgl Terima</th>
                <th style="width: 15%">Identitas Pelapor</th>
                <th style="width: 15%">Pihak Terlapor</th>
                <th style="width: 35%">Uraian Pengaduan</th>
                <th style="width: 19%">Status Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">
                    {{ \Carbon\Carbon::parse($row->tanggal_terima)->translatedFormat('d F Y') }}
                    <br>
                    <span style="font-size: 8pt; color: #555;">No: {{ $row->nomor_surat ?? '-' }}</span>
                </td>
                <td>
                    <strong>{{ strtoupper($row->nama_pelapor ?? 'ANONIM') }}</strong><br>
                    <span style="font-size: 8pt; color: #555;">HP: {{ $row->no_hp_pelapor ?? '-' }}</span>
                </td>
                <td><strong>{{ strtoupper($row->nama_terlapor ?? 'TIDAK DIKETAHUI') }}</strong></td>
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($row->uraian_pengaduan, 150) }}
                </td>
                <td style="text-align: center;">
                    @php
                    $statusText = match($row->status_laporan) {
                    'telaah' => 'DALAM TELAAH',
                    'lid' => 'PENYELIDIKAN (LID)',
                    'dik' => 'PENYIDIKAN (DIK)',
                    'tuntutan' => 'PENUNTUTAN',
                    'eksekusi' => 'EKSEKUSI',
                    'hentikan' => 'DIHENTIKAN',
                    'limpah' => 'DILIMPAHKAN',
                    default => strtoupper($row->status_laporan)
                    };
                    $statusColor = match($row->status_laporan) {
                    'hentikan' => 'red',
                    'lid' => 'blue',
                    'dik' => 'blue',
                    default => 'black'
                    };
                    @endphp
                    <span class="status-badge" style="color: {{ $statusColor }};">
                        {{ $statusText }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">Data laporan pengaduan tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TANDA TANGAN BESERTA QR CODE VALIDASI (REKAP LAPDU) --}}
    <div class="ttd-container" style="float: right; width: 320px; text-align: center; margin-top: 30px;">
        <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ now()->translatedFormat('d F Y') }}</p>
        <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

        <!-- Area QR Code Validasi LAPDU -->
        <div style="margin: 20px 0;">
            @php
            // Membuat isi QR Code khusus untuk Rekapitulasi Data
            $qrContent = "Dokumen Valid: Rekapitulasi LAPDU\nDicetak pada: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s');
            @endphp
            <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(95)->generate($qrContent)) !!} " alt="QR Code Validasi">
        </div>

        <!-- Identitas Penandatangan -->
        <p style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 10pt;">Raya Bimanta S.H., M.H</p>
        <p style="margin: 2px 0 0 0; font-size: 10pt;">Jaksa Utama Muda (IV/c)</p>
        <p style="margin: 0; font-size: 10pt;">NIP. 199001012020011001</p>
    </div>

</body>

</html>