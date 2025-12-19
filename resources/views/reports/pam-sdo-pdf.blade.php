<!DOCTYPE html>
<html>

<head>
    <title>Laporan PAM SDO</title>
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

        /* Warna Kategori */
        .badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEJAKSAAN REPUBLIK INDONESIA</h2>
        <h3>LAPORAN PENGAMANAN SUMBER DAYA ORGANISASI (PAM SDO)</h3>
        <p>Bidang Intelijen - Personil, Materiil, & Dokumen</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 10%">Kategori</th>
                <th style="width: 20%">Target / Sasaran</th>
                <th style="width: 25%">Uraian Masalah</th>
                <th style="width: 15%">Status</th>
                <th style="width: 10%">Ket.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d F Y') }}</td>
                <td style="text-align: center">{{ $item->kategori }}</td>
                <td>
                    <strong>{{ $item->target }}</strong><br>
                    <small>{{ $item->nip_atau_nomor ?? '-' }}</small>
                </td>
                <td>{{ Str::limit($item->uraian_masalah, 100) }}</td>
                <td style="text-align: center; font-weight: bold; text-transform: uppercase;">
                    {{ $item->status }}
                </td>
                <td>{{ $item->keterangan }}</td>
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