<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Analisa Kerawanan - {{ $data->kecamatan }}</title>
    <style>
        /* Pengaturan Standar Surat Dinas Intelijen */
        @page {
            size: A4 portrait;
            margin: 2.5cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        .rahasia {
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            font-size: 11pt;
            margin-bottom: 10px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 25px;
        }

        .status-tag {
            float: right;
            padding: 8px 15px;
            border: 2px solid #000;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #f3f4f6;
        }

        .table-info {
            width: 100%;
            margin-bottom: 20px;
        }

        .table-info td {
            vertical-align: top;
            padding: 4px 0;
        }

        .label-field {
            width: 160px;
            font-weight: bold;
        }

        .separator {
            width: 15px;
            text-align: center;
        }

        .box-text {
            border: 1px solid #000;
            padding: 15px;
            text-align: justify;
            background-color: #fafafa;
            min-height: 100px;
        }

        .title-sub {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }

        .ttd {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 50px;
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

    <div class="header">
        KEJAKSAAN REPUBLIK INDONESIA<br>
        BIDANG INTELIJEN - PEMETAAN WILAYAH KERAWANAN
    </div>

    <div class="judul">LEMBAR ANALISA POTENSI KERAWANAN WILAYAH</div>

    <div class="section">
        <div class="status-tag">
            TINGKAT: {{ $data->tingkat_rawan }}
        </div>

        <table class="table-info">
            <tr>
                <td class="label-field">Kecamatan</td>
                <td class="separator">:</td>
                <td><strong>{{ strtoupper($data->kecamatan) }}</strong></td>
            </tr>
            <tr>
                <td class="label-field">Desa / Kelurahan</td>
                <td class="separator">:</td>
                <td>{{ $data->desa }}</td>
            </tr>
            <tr>
                <td class="label-field">Jenis Ancaman</td>
                <td class="separator">:</td>
                <td>{{ $data->jenis_ancaman }}</td>
            </tr>
            <tr>
                <td class="label-field">Tokoh Kunci</td>
                <td class="separator">:</td>
                <td>{{ $data->tokoh_kunci ?? 'Tidak teridentifikasi' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <span class="title-sub">I. Deskripsi Kerawanan / Potensi Konflik</span>
        <div class="box-text">
            {{ $data->deskripsi_singkat }}
        </div>
    </div>

    <div class="section">
        <span class="title-sub">II. Analisa Intelijen</span>
        <div class="box-text">
            Berdasarkan data yang dihimpun, wilayah {{ $data->kecamatan }} khususnya Desa {{ $data->desa }} dikategorikan memiliki tingkat rawan {{ strtoupper($data->tingkat_rawan) }}. Hal ini memerlukan atensi khusus dari pimpinan untuk meminimalisir eskalasi konflik di lapangan yang dapat mengganggu ketertiban umum.
        </div>
    </div>

    <div class="section">
        <span class="title-sub">III. Rekomendasi Tindakan</span>
        <div class="box-text">
            Disarankan untuk melakukan pemantauan secara tertutup terhadap pergerakan tokoh-tokoh yang terlibat dan melakukan koordinasi dengan pihak-pihak terkait guna melakukan langkah pencegahan (Pre-emptive) sebelum situasi berkembang menjadi gangguan nyata.
        </div>
    </div>

    <div class="ttd">
        <p>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Petugas Analis Intelijen,</p>

        <div class="nama-pejabat">{{ auth()->user()->name }}</div>
        <div>Jaksa Intelijen</div>
    </div>

    <div class="clear"></div>
    <div class="rahasia" style="margin-top: 30px;">RAHASIA</div>

</body>

</html>