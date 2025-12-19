<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peta Kerawanan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
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

        /* Pewarnaan Status */
        .tinggi {
            background-color: #fee2e2;
            color: #b91c1c;
            font-weight: bold;
        }

        .sedang {
            background-color: #fef3c7;
            color: #92400e;
            font-weight: bold;
        }

        .rendah {
            background-color: #dcfce7;
            color: #166534;
            font-weight: bold;
        }

        .ttd {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEJAKSAAN REPUBLIK INDONESIA</h2>
        <h3>REKAPITULASI PEMETAAN DAERAH RAWAN (PETA KERAWANAN)</h3>
        <p>Wilayah Hukum Kejaksaan Negeri</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Lokasi (Kec/Desa)</th>
                <th style="width: 15%">Jenis Ancaman</th>
                <th style="width: 10%">Tingkat</th>
                <th style="width: 30%">Deskripsi Kerawanan</th>
                <th style="width: 20%">Tokoh Kunci</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $row->kecamatan }}</strong><br>
                    <small>Desa: {{ $row->desa }}</small>
                </td>
                <td>{{ $row->jenis_ancaman }}</td>
                <td style="text-align: center" class="{{ $row->tingkat_rawan }}">
                    {{ strtoupper($row->tingkat_rawan) }}
                </td>
                <td>{{ $row->deskripsi_singkat }}</td>
                <td>{{ $row->tokoh_kunci ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
        <br><br><br>
        <p><strong>(Nama Pejabat)</strong><br>Jaksa Utama Pratama</p>
    </div>

</body>

</html>