<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengamanan - {{ $item->target }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
        }

        .rahasia {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            margin-bottom: 0px;
            font-size: 11pt;
        }

        .content-block {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .value {
            text-align: justify;
            padding-left: 20px;
        }

        .table-info {
            width: 100%;
            margin-bottom: 20px;
        }

        .table-info td {
            vertical-align: top;
            padding: 5px;
        }

        .col-label {
            width: 180px;
            font-weight: bold;
        }

        .col-sep {
            width: 10px;
        }

        .status-box {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            background-color: #f9f9f9;
        }

        .ttd {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="rahasia">RAHASIA</div>

    <div class="header">
        KEJAKSAAN REPUBLIK INDONESIA<br>
        BIDANG INTELIJEN - PENGAMANAN SDO
    </div>

    <div class="judul">LAPORAN PELAKSANAAN PENGAMANAN</div>

    <div class="content-block">
        <table class="table-info">
            <tr>
                <td class="col-label">Hari / Tanggal</td>
                <td class="col-sep">:</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_laporan)->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
                <td class="col-label">Kategori Pengamanan</td>
                <td class="col-sep">:</td>
                <td>{{ $item->kategori }}</td>
            </tr>
            <tr>
                <td class="col-label">Target / Sasaran</td>
                <td class="col-sep">:</td>
                <td><strong>{{ $item->target }}</strong></td>
            </tr>
            <tr>
                <td class="col-label">Identitas (NIP/No)</td>
                <td class="col-sep">:</td>
                <td>{{ $item->nip_atau_nomor ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="content-block">
        <div class="label">I. URAIAN PERMASALAHAN / ANCAMAN</div>
        <div class="value">
            {{ $item->uraian_masalah }}
        </div>
    </div>

    <div class="content-block">
        <div class="label">II. TINDAKAN PENGAMANAN YANG DILAKUKAN</div>
        <div class="value">
            {{ $item->tindakan_pam ?? 'Belum ada tindakan khusus yang dicatat.' }}
        </div>
    </div>

    <div class="content-block">
        <div class="label">III. KETERANGAN TAMBAHAN</div>
        <div class="value">
            {{ $item->keterangan ?? '-' }}
        </div>
    </div>

    <div class="status-box">
        STATUS TERAKHIR: {{ $item->status }}
    </div>

    <div class="ttd">
        <p>{{ config('app.kota_kantor', 'Jakarta') }}, {{ \Carbon\Carbon::parse($item->tanggal_laporan)->isoFormat('D MMMM Y') }}</p>
        <p>Petugas PAM,</p>
        <br><br><br>
        <p style="text-decoration: underline; font-weight: bold;">{{ auth()->user()->name }}</p>
        <p>Jaksa Intelijen</p>
    </div>

    <div style="clear: both;"></div>
    <div class="rahasia" style="margin-top: 30px;">RAHASIA</div>

</body>

</html>