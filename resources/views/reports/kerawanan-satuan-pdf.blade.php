<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Analisa Kerawanan - {{ $data->kecamatan }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .logo-cell {
            width: 100px;
            vertical-align: middle;
            text-align: left;
        }

        .logo-img {
            width: 80px;
            height: auto;
        }

        .teks-cell {
            text-align: center;
            vertical-align: middle;
            padding-right: 80px;
        }

        .teks-cell h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-cell p {
            font-size: 9pt;
            margin: 1px 0;
            line-height: 1.2;
        }

        .garis-kop-ganda {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            height: 2px;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        .rahasia {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 11pt;
            margin-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .section {
            margin-bottom: 20px;
        }

        /* PERBAIKAN CSS STATUS AGAR TIDAK MENUTUPI TABEL */
        .status-container {
            text-align: right;
            margin-bottom: 15px;
            /* Memberi jarak ke bawah agar tidak nempel tabel */
        }

        .status-tag {
            display: inline-block;
            /* Supaya kotak mengikuti isi teks */
            padding: 5px 15px;
            border: 2px solid #000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10pt;
        }

        .table-info {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table-info td {
            vertical-align: top;
            padding: 4px 0;
        }

        .label-field {
            width: 180px;
            font-weight: bold;
        }

        .separator {
            width: 15px;
            text-align: center;
        }

        .box-text {
            border: 1px solid #000;
            padding: 10px;
            text-align: justify;
            min-height: 80px;
            margin-top: 5px;
        }

        .title-sub {
            font-weight: bold;
            text-transform: uppercase;
            display: block;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        .ttd {
            float: right;
            width: 300px;
            text-align: center;
            margin-top: 40px;
        }

        .nama-pejabat {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 70px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="rahasia">RAHASIA</div>

    <table class="kop-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('img/logo-kejaksaan.png') }}" class="logo-img">
            </td>
            <td class="teks-cell">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop-ganda"></div>

    <div class="judul">LEMBAR ANALISA POTENSI KERAWANAN WILAYAH</div>

    <div class="section">
        {{-- PERBAIKAN HTML: Menggunakan Container khusus untuk Status --}}
        <div class="status-container">
            @if($data->tingkat_rawan == 'tinggi')
            <span class="status-tag" style="background-color: #fee2e2;">
                @elseif($data->tingkat_rawan == 'sedang')
                <span class="status-tag" style="background-color: #ffedd5;">
                    @else
                    <span class="status-tag" style="background-color: #dcfce7;">
                        @endif
                        TINGKAT: {{ strtoupper($data->tingkat_rawan) }}
                    </span>
        </div>

        <table class="table-info">
            <tr>
                <td class="label-field">Wilayah Kecamatan</td>
                <td class="separator">:</td>
                <td><strong>{{ strtoupper($data->kecamatan) }}</strong></td>
            </tr>
            <tr>
                <td class="label-field">Bidang Intelijen</td>
                <td class="separator">:</td>
                <td>{{ $data->bidang }}</td>
            </tr>
            <tr>
                <td class="label-field">Sumber Informasi</td>
                <td class="separator">:</td>
                <td>{{ $data->sumber_informasi ?? 'Terbuka / Tertutup' }}</td>
            </tr>
            <tr>
                <td class="label-field">Tanggal Analisa</td>
                <td class="separator">:</td>
                <td>{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <span class="title-sub">I. URAIAN POTENSI ANCAMAN / PERMASALAHAN</span>
        <div class="box-text">
            {{ $data->potensi_ancaman }}
        </div>
    </div>

    <div class="section">
        <span class="title-sub">II. REKOMENDASI / UPAYA PENCEGAHAN</span>
        <div class="box-text">
            {{ $data->upaya_pencegahan ?? 'Belum ada rekomendasi khusus yang dicatat.' }}
        </div>
    </div>

    <div class="ttd">
        <p>Banjarmasin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Petugas Analis Intelijen,</p>

        <div class="nama-pejabat">{{ auth()->user()->name }}</div>
        <div>Jaksa Intelijen / NIP. {{ auth()->user()->nip ?? '....................' }}</div>
    </div>

    <div class="clear"></div>
    <div class="rahasia" style="margin-top: 20px;">RAHASIA</div>

</body>

</html>