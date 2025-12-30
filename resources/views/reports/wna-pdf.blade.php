<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengawasan Orang Asing</title>
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
        .status-aman {
            color: green;
            font-weight: bold;
        }

        .status-overstay {
            color: red;
            font-weight: bold;
        }

        .status-warning {
            color: #d97706;
            font-weight: bold;
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
            <p>Website: kejari-banjarmasin.go.id</p>
        </div>
    </div>

    {{-- JUDUL DOKUMEN --}}
    <div class="title-doc">
        DATA PENGAWASAN ORANG ASING (WNA)
    </div>
    <div style="text-align: center; font-size: 9pt; margin-bottom: 15px;">
        Tanggal Cetak: {{ date('d F Y') }}
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 22%">Identitas WNA</th>
                <th style="width: 15%">Izin Tinggal</th>
                <th style="width: 20%">Tujuan & Sponsor</th>
                <th style="width: 24%">Alamat Menginap</th>
                <th style="width: 15%">Status Izin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    <strong style="text-transform: uppercase;">{{ $item->nama_lengkap }}</strong><br>
                    <span style="font-size: 8pt; color: #444;">
                        Paspor: {{ $item->nomor_paspor }}<br>
                        Negara: {{ $item->kebangsaan }}
                    </span>
                </td>
                <td>
                    <span style="display: block; font-size: 8pt; color: #555;">Tiba:</span>
                    {{ $item->tanggal_tiba ? \Carbon\Carbon::parse($item->tanggal_tiba)->format('d/m/Y') : '-' }}
                    <br>
                    <span style="display: block; font-size: 8pt; color: #555; margin-top: 2px;">Berlaku s/d:</span>
                    <strong>{{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->format('d/m/Y') }}</strong>
                </td>
                <td>
                    {{ $item->tujuan_kunjungan }}<br>
                    <span style="font-size: 8pt; color: #555;">Sponsor: {{ $item->sponsor ?? '-' }}</span>
                </td>
                <td>
                    {{ \Illuminate\Support\Str::limit($item->alamat_menginap, 100) }}
                </td>
                <td style="text-align: center;">
                    @php
                    $tglExp = \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->startOfDay();
                    $today = \Carbon\Carbon::now()->startOfDay();
                    $diff = $today->diffInDays($tglExp, false);
                    @endphp

                    @if($diff < 0)
                        <span class="status-overstay">OVERSTAY</span><br>
                        <span style="font-size: 8pt; color: red;">({{ abs($diff) }} Hari)</span>
                        @elseif($diff <= 30)
                            <span class="status-warning">WARNING</span><br>
                            <span style="font-size: 8pt;">(Sisa {{ $diff }} Hari)</span>
                            @else
                            <span class="status-aman">AMAN</span>
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