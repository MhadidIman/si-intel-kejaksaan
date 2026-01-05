<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peta Kerawanan</title>
    <style>
        /* PENGATURAN KERTAS & FONT */
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* KOP SURAT (STANDAR RESMI) */
        .header-container {
            text-align: center;
            position: relative;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .logo {
            width: 80px;
            position: absolute;
            left: 0;
            top: 5px;
        }

        .header-text h3 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text h2 {
            margin: 2px 0;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 0;
            font-size: 9pt;
            font-weight: normal;
        }

        /* JUDUL DOKUMEN */
        .title-doc {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        /* TABEL DATA */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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
            padding: 8px 4px;
            vertical-align: middle;
            text-transform: uppercase;
        }

        td {
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        /* STATUS BADGE */
        .badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
            padding: 2px 5px;
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
            <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
        </div>
    </div>

    {{-- JUDUL DOKUMEN --}}
    <div class="title-doc">
        REKAPITULASI PEMETAAN DAERAH RAWAN (PETA KERAWANAN)
    </div>
    <div style="text-align: center; font-size: 9pt; margin-bottom: 15px;">
        Wilayah Hukum Kejaksaan Negeri Banjarmasin
    </div>

    {{-- TABEL DATA --}}
    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 20%">Lokasi (Kecamatan)</th>
                <th style="width: 15%">Bidang Intelijen</th>
                <th style="width: 10%">Tingkat</th>
                <th style="width: 31%">Potensi Ancaman</th>
                <th style="width: 20%">Sumber Informasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>

                {{-- Lokasi --}}
                <td>
                    <strong style="text-transform: uppercase;">{{ $row->kecamatan }}</strong>
                    {{-- Jika ada kolom desa, tampilkan. Jika tidak, hapus baris ini --}}
                    @if(!empty($row->desa))
                    <br><span style="font-size: 8pt; color: #555;">Desa: {{ $row->desa }}</span>
                    @endif
                </td>

                {{-- Bidang --}}
                <td>{{ $row->bidang }}</td>

                {{-- Tingkat Kerawanan --}}
                <td style="text-align: center;">
                    @if(strtolower($row->tingkat_rawan) == 'tinggi')
                    <span class="badge tinggi">TINGGI</span>
                    @elseif(strtolower($row->tingkat_rawan) == 'sedang')
                    <span class="badge sedang">SEDANG</span>
                    @else
                    <span class="badge rendah">RENDAH</span>
                    @endif
                </td>

                {{-- Potensi Ancaman (Gunakan nl2br agar enter terbaca) --}}
                <td style="text-align: justify;">
                    {{ \Illuminate\Support\Str::limit($row->potensi_ancaman, 200) }}
                </td>

                {{-- Sumber Info --}}
                <td>
                    {{ $row->sumber_informasi ?? 'Tertutup / Terbuka' }}
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