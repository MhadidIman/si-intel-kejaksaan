<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Pengaduan Masyarakat</title>
    <style>
        /* Pengaturan Dasar */
        body {
            font-family: sans-serif;
            font-size: 10px;
            color: #333;
        }

        /* Header Laporan */
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .header h3 {
            margin: 5px 0;
            padding: 0;
            font-size: 14px;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 11px;
            font-style: italic;
        }

        /* Styling Tabel */
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

        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            padding: 6px;
            vertical-align: top;
            line-height: 1.4;
        }

        /* Badge Status */
        .status {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }

        /* Footer / Tanda Tangan */
        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .ttd {
            float: right;
            width: 250px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEJAKSAAN REPUBLIK INDONESIA</h2>
        <h3>REKAPITULASI LAPORAN PENGADUAN MASYARAKAT (LAPDU)</h3>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y, HH:mm') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%">No</th>
                <th style="width: 10%">Tgl Terima</th>
                <th style="width: 12%">No. Surat</th>
                <th style="width: 15%">Identitas Pelapor</th>
                <th style="width: 15%">Pihak Terlapor</th>
                <th style="width: 30%">Uraian Pengaduan</th>
                <th style="width: 15%">Status Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">
                    {{ \Carbon\Carbon::parse($row->tanggal_terima)->isoFormat('D MMM Y') }}
                </td>
                <td>{{ $row->nomor_surat ?? '-' }}</td>
                <td>
                    <strong>{{ $row->nama_pelapor ?? 'ANONIM' }}</strong><br>
                    <small>HP: {{ $row->no_hp_pelapor ?? '-' }}</small>
                </td>
                <td><strong>{{ strtoupper($row->terlapor) }}</strong></td>
                <td>{{ $row->uraian_pengaduan }}</td>
                <td class="status">
                    @if($row->status == 'lid')
                    INTELIJEN (LID)
                    @elseif($row->status == 'telaah')
                    DALAM TELAAH
                    @elseif($row->status == 'arsipkan')
                    DIARSIPKAN
                    @else
                    {{ $row->status }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">Data laporan pengaduan tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="ttd">
            <p>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Mengetahui,<br>Kepala Seksi Intelijen</p>
            <br><br><br><br>
            <p><strong>( ___________________________ )</strong><br>Jaksa Utama Pratama</p>
        </div>
    </div>

</body>

</html>