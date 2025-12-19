<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Ormas & LSM</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3 {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .ttd {
            margin-top: 50px;
            float: right;
            width: 200px;
            text-align: center;
        }

        /* Warna Status */
        .status-dilarang {
            color: red;
            font-weight: bold;
        }

        .status-diawasi {
            color: #d35400;
            font-weight: bold;
        }

        /* Orange gelap */
        .status-vakum {
            color: gray;
            font-style: italic;
        }

        .status-aktif {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEJAKSAAN REPUBLIK INDONESIA</h2>
        <h3>DATA ORGANISASI KEMASYARAKATAN (ORMAS) & LSM</h3>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Nama Organisasi</th>
                <th style="width: 15%">Ketua / Pimpinan</th>
                <th style="width: 10%">Bentuk</th>
                <th style="width: 15%">Legalitas (SKT/AHU)</th>
                <th style="width: 20%">Alamat Sekretariat</th>
                <th style="width: 15%">Status Pantauan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->nama_organisasi }}</strong><br>
                    <small>Anggota: {{ $item->jumlah_anggota }} Orang</small>
                </td>
                <td>{{ $item->ketua }}</td>
                <td style="text-align: center">{{ $item->bentuk_organisasi }}</td>
                <td>{{ $item->nomor_legalitas ?? '-' }}</td>
                <td>{{ $item->alamat_sekretariat }}</td>

                {{-- Logika Warna Status --}}
                <td>
                    @if($item->status == 'dilarang')
                    <span class="status-dilarang">DILARANG</span>
                    @elseif($item->status == 'diawasi')
                    <span class="status-diawasi">DALAM PENGAWASAN</span>
                    @elseif($item->status == 'vakum')
                    <span class="status-vakum">VAKUM</span>
                    @else
                    <span class="status-aktif">AKTIF</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
        <br><br><br>
        <p><strong>(Nama Pejabat)</strong><br>Jaksa Utama Pratama</p>
    </div>

</body>

</html>