<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Ormas & LSM</title>
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
        .status-aktif {
            color: green;
            font-weight: bold;
        }

        .status-diawasi {
            color: #d97706;
            font-weight: bold;
        }

        .status-dilarang {
            color: red;
            font-weight: bold;
        }

        .status-vakum {
            color: #6b7280;
            font-style: italic;
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
        DATA ORGANISASI KEMASYARAKATAN (ORMAS) & LSM
    </div>
    <div style="text-align: center; font-size: 9pt; margin-bottom: 15px;">
        Tanggal Cetak: {{ date('d F Y') }}
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 25%">Nama Organisasi</th>
                <th style="width: 15%">Ketua</th>
                <th style="width: 10%">Bentuk</th>
                <th style="width: 15%">Legalitas</th>
                <th style="width: 20%">Alamat</th>
                <th style="width: 11%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    <strong style="text-transform: uppercase;">{{ $item->nama_organisasi }}</strong><br>
                    <span style="font-size: 8pt; color: #444;">
                        Anggota: {{ $item->jumlah_anggota ?? '-' }} Orang
                    </span>
                </td>
                <td>{{ $item->ketua }}</td>
                <td style="text-align: center;">{{ $item->bentuk_organisasi }}</td>
                <td>{{ $item->nomor_legalitas ?? '-' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($item->alamat_sekretariat, 100) }}</td>
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