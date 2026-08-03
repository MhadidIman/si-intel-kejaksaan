<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan JMS - {{ $data->nama_sekolah }}</title>
    <style>
        /* --- PENGATURAN KERTAS & FONT --- */
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #000;
            -webkit-print-color-adjust: exact;
        }

        /* --- KOP SURAT 3 KOLOM --- */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px solid black;
        }

        .kop-table td {
            vertical-align: middle;
            padding-bottom: 5px;
        }

        .teks-center {
            text-align: center;
        }

        .teks-center h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-center h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .teks-center p {
            font-size: 9pt;
            margin: 2px 0 0 0;
            line-height: 1.2;
        }

        .garis-tipis {
            border-top: 1px solid black;
            margin-top: 2px;
            margin-bottom: 20px;
        }

        /* --- KONTEN LAPORAN --- */
        .judul {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .sub-judul {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 11pt;
            text-transform: uppercase;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .data-table td {
            padding: 5px 0;
            vertical-align: top;
            font-size: 11pt;
        }

        .label {
            width: 180px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
            font-weight: bold;
        }

        /* --- FOTO DOKUMENTASI --- */
        .foto-wrapper {
            text-align: center;
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            page-break-inside: avoid;
        }

        .foto-img {
            max-width: 100%;
            height: auto;
            max-height: 350px;
            border: 2px solid #000;
            display: block;
            margin: 0 auto;
        }

        .caption {
            font-size: 10pt;
            font-style: italic;
            margin-top: 10px;
            color: #333;
        }

        .no-foto {
            padding: 40px;
            color: #666;
            font-style: italic;
            border: 1px dashed #ccc;
        }

        /* --- TANDA TANGAN --- */
        .ttd-wrapper {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .ttd-box {
            float: right;
            width: 250px;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- KOP SURAT 3 KOLOM AGAR PRESISI DI TENGAH -->
    <table class="kop-table">
        <tr>
            <td style="width: 15%; text-align: center;">
                <img src="{{ asset('img/logo-kejaksaan.png') }}" style="width: 75px; height: auto;">
            </td>
            <td class="teks-center" style="width: 70%;">
                <h1>KEJAKSAAN REPUBLIK INDONESIA</h1>
                <h1>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h1>
                <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
                <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
                <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
            </td>
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <div class="garis-tipis"></div>

    <div class="judul">LAPORAN KEGIATAN JAKSA MASUK SEKOLAH</div>

    <div class="sub-judul">I. DATA PELAKSANAAN</div>
    <table class="data-table">
        <tr>
            <td class="label">Nama Sekolah / Tempat</td>
            <td class="sep">:</td>
            <td><strong>{{ strtoupper($data->nama_sekolah) }}</strong></td>
        </tr>
        <tr>
            <td class="label">Hari / Tanggal</td>
            <td class="sep">:</td>
            <td>{{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->isoFormat('dddd, D MMMM Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jaksa Pemateri</td>
            <td class="sep">:</td>
            <td>{{ $data->nama_jaksa }}</td>
        </tr>
    </table>

    <div class="sub-judul">II. MATERI DAN PESERTA</div>
    <table class="data-table">
        <tr>
            <td class="label">Materi Disampaikan</td>
            <td class="sep">:</td>
            <td>{{ $data->materi }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Peserta</td>
            <td class="sep">:</td>
            <td>{{ $data->jumlah_siswa }} Siswa/Siswi</td>
        </tr>
        <tr>
            <td class="label">Keterangan Lain</td>
            <td class="sep">:</td>
            <td>{{ $data->keterangan ?? 'Tidak ada keterangan tambahan.' }}</td>
        </tr>
    </table>

    <div class="sub-judul">III. DOKUMENTASI KEGIATAN</div>
    <div class="foto-wrapper">
        @if($data->foto_kegiatan)
        <img src="{{ asset('storage/' . $data->foto_kegiatan) }}" class="foto-img">
        <div class="caption">
            Dokumentasi pelaksanaan kegiatan JMS di {{ $data->nama_sekolah }}<br>
            Tanggal: {{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->format('d/m/Y') }}
        </div>
        @else
        <div class="no-foto">
            [ Foto dokumentasi tidak tersedia ]
        </div>
        @endif
    </div>

    <!-- TANDA TANGAN BESERTA QR CODE VALIDASI (JMS SATUAN) -->
    <div class="ttd-wrapper">
        <div class="ttd-box" style="float: right; width: 320px; text-align: center;">
            <p style="margin: 0; font-size: 10pt;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt;">Mengetahui,</p>
            <p style="margin: 0; font-weight: bold; font-size: 10pt; text-transform: uppercase;">Kepala Seksi Intelijen,</p>

            <!-- Area QR Code (Fungsi Route Verifikasi Dipertahankan) -->
            <div style="margin: 20px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'jms', 'id' => $data->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(95)->generate($qrContent)) !!} " alt="QR Code Validasi">
            </div>

            <!-- Identitas Penandatangan -->
            <p style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 10pt;">Raya Bimanta S.H., M.H</p>
            <p style="margin: 2px 0 0 0; font-size: 10pt;">Jaksa Utama Muda (IV/c)</p>
            <p style="margin: 0; font-size: 10pt;">NIP. 199001012020011001</p>
        </div>
        <div class="clear" style="clear: both;"></div>
    </div>

</body>

</html>