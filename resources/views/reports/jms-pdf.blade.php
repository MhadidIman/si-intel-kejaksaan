<!DOCTYPE html>
<html>

<head>
    <title>Laporan Rekapitulasi JMS</title>
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
        LAPORAN KEGIATAN PENERANGAN HUKUM (JMS)
    </div>
    <div style="text-align: center; font-size: 9pt; margin-bottom: 15px;">
        Program Jaksa Masuk Sekolah
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 20%">Nama Sekolah</th>
                <th style="width: 30%">Materi Disampaikan</th>
                <th style="width: 10%">Siswa</th>
                <th style="width: 20%">Jaksa Pemateri</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td style="text-align: center;">
                    {{ \Carbon\Carbon::parse($row->tanggal_kegiatan)->translatedFormat('d F Y') }}
                </td>
                <td>
                    <strong>{{ $row->nama_sekolah }}</strong>
                </td>
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($row->materi, 150) }}
                </td>
                <td style="text-align: center;">
                    {{ $row->jumlah_siswa }} Org
                </td>
                <td>{{ $row->nama_jaksa }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">Belum ada data kegiatan JMS.</td>
            </tr>
            @endforelse
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