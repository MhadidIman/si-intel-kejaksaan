<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data DPO</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
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
        }

        .ttd {
            margin-top: 50px;
            float: right;
            width: 200px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEJAKSAAN REPUBLIK INDONESIA</h2>
        <h3>DAFTAR PENCARIAN ORANG (DPO)</h3>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Nama Lengkap</th>
                <th style="width: 15%">Tempat/Tgl Lahir</th>
                <th style="width: 30%">Kasus Posisi</th>
                <th style="width: 15%">Status Hukum</th>
                <th style="width: 15%">Status DPO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->nama_lengkap }}</strong><br>
                    <small>Ciri: {{ $item->ciri_fisik ?? '-' }}</small>
                </td>
                <td>
                    {{ $item->tempat_lahir }}<br>
                    {{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') : '-' }}
                </td>
                <td>{{ $item->kasus }}</td>
                <td>{{ $item->status_hukum }}</td>
                <td>
                    @if($item->status_pencarian == 'buron')
                    <span style="color: red; font-weight: bold;">BURON</span>
                    @else
                    <span style="color: green; font-weight: bold;">TERTANGKAP</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
        <br><br><br>
        <p><strong>(M. Hadid Iman Firdaus)</strong><br>NIP. 221001006875622</p>
    </div>

</body>

</html>