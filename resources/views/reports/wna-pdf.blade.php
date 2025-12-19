<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengawasan Orang Asing</title>
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

        /* Utility Classes untuk Status */
        .text-danger {
            color: red;
            font-weight: bold;
        }

        .text-warning {
            color: #e67e22;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEJAKSAAN REPUBLIK INDONESIA</h2>
        <h3>LAPORAN PENGAWASAN ORANG ASING (PORA)</h3>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Nama & Paspor</th>
                <th style="width: 15%">Kebangsaan</th>
                <th style="width: 15%">Tujuan</th>
                <th style="width: 15%">Sponsor/Penjamin</th>
                <th style="width: 15%">Masa Berlaku Izin Tinggal</th>
                <th style="width: 15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            @php
            $isOverstay = $item->masa_berlaku_izin_tinggal < now();
                $sisaHari=now()->diffInDays($item->masa_berlaku_izin_tinggal, false);
                @endphp
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->nama_lengkap }}</strong><br>
                        <small>Paspor: {{ $item->nomor_paspor }}</small>
                    </td>
                    <td>{{ $item->kebangsaan }}</td>
                    <td>{{ $item->tujuan_kunjungan }}</td>
                    <td>{{ $item->sponsor ?? '-' }}</td>

                    {{-- Logika Warna Tanggal --}}
                    <td style="{{ $isOverstay ? 'color: red; font-weight: bold;' : '' }}">
                        {{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->format('d M Y') }}
                    </td>

                    {{-- Kolom Status (Hasil Proses Sistem) --}}
                    <td>
                        @if($isOverstay)
                        <span class="text-danger">OVERSTAY</span>
                        @elseif($sisaHari < 30)
                            <span class="text-warning">WARNING (< 30 Hari)</span>
                                @else
                                <span>AMAN</span>
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