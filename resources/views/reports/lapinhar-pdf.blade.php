<!DOCTYPE html>
<html>

<head>
    <title>Laporan Informasi Harian</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
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
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .ttd {
            margin-top: 40px;
            float: right;
            width: 250px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEJAKSAAN REPUBLIK INDONESIA</h2>
        <h3>LAPORAN INFORMASI HARIAN (LAPINHAR)</h3>
        <p>Bidang Intelijen</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Waktu & No. Surat</th>
                <th style="width: 10%">Bidang</th>
                <th style="width: 15%">Sumber</th>
                <th style="width: 30%">Peristiwa / Fakta</th>
                <th style="width: 25%">Pendapat / Analisa</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop data dimulai di sini. Variabel $item HANYA boleh dipakai di dalam @foreach --}}
            @foreach($data as $index => $row)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($row->tanggal_surat)->format('d F Y') }}<br>
                    <small>No: {{ $row->nomor_surat ?? '-' }}</small>
                </td>
                <td style="text-align: center">{{ $row->bidang }}</td>
                <td>{{ $row->sumber_informasi }}</td>
                <td style="text-align: justify">{{ $row->peristiwa }}</td>
                <td style="text-align: justify">{{ $row->pendapat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>................., {{ date('d F Y') }}</p>
        <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
        <br><br><br>
        <p><strong>(Nama Pejabat)</strong><br>Jaksa Utama Pratama</p>
    </div>

</body>

</html>