<!DOCTYPE html>
<html>

<head>
    <title>Laporan Rekapitulasi JMS</title>
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
        <h3>LAPORAN KEGIATAN PENERANGAN HUKUM (JMS)</h3>
        <p>Program Jaksa Masuk Sekolah</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 25%">Nama Sekolah</th>
                <th style="width: 25%">Materi Disampaikan</th>
                <th style="width: 10%">Siswa</th>
                <th style="width: 20%">Jaksa Pemateri</th>
            </tr>
        </thead>
        <tbody>
            {{-- Menggunakan $data dari Controller --}}
            @foreach($data as $index => $row)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                {{-- Menggunakan isoFormat agar Bahasa Indonesia --}}
                <td>{{ \Carbon\Carbon::parse($row->tanggal_kegiatan)->isoFormat('D MMMM Y') }}</td>
                <td><strong>{{ $row->nama_sekolah }}</strong></td>
                <td>{{ $row->materi }}</td>
                <td style="text-align: center">{{ $row->jumlah_siswa }} Orang</td>
                <td>{{ $row->nama_jaksa }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        {{-- Tanggal cetak laporan --}}
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
        <br><br><br>
        <p><strong>(Nama Pejabat)</strong><br>Jaksa Utama Pratama</p>
    </div>

</body>

</html>