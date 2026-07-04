<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Biodata WNA - {{ $item->nama_lengkap }}</title>
    <style>
        /* PENGATURAN KERTAS */
        @page {
            size: A4 portrait;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #000;
        }

        /* KOP SURAT */
        .header {
            text-align: center;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            width: 80px;
            position: absolute;
            left: 0;
            top: 0;
        }

        .header h3,
        .header h2,
        .header p {
            margin: 2px 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header p {
            font-size: 9pt;
            font-weight: normal;
            text-transform: none;
        }

        /* JUDUL */
        .rahasia-top {
            text-align: right;
            font-weight: bold;
            text-decoration: underline;
            font-size: 10pt;
            margin-bottom: 10px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        /* LAYOUT UTAMA (TABEL 2 KOLOM) */
        .main-layout {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .col-left {
            width: 68%;
            vertical-align: top;
            padding-right: 15px;
        }

        .col-right {
            width: 32%;
            vertical-align: top;
            text-align: center;
        }

        /* TABEL BIODATA */
        .bio-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bio-table td {
            vertical-align: top;
            padding: 4px 0;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .sep {
            width: 15px;
            text-align: center;
        }

        .val {
            text-align: justify;
        }

        /* FOTO */
        .photo-box {
            width: 150px;
            height: 200px;
            border: 2px solid black;
            padding: 4px;
            object-fit: cover;
        }

        .no-photo {
            width: 150px;
            height: 200px;
            border: 2px solid black;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10pt;
        }

        /* STATUS BOX */
        .status-box {
            margin-top: 15px;
            padding: 10px;
            border: 3px double;
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
        }

        .overstay {
            border-color: red;
            color: red;
            background-color: #ffe6e6;
        }

        .aman {
            border-color: green;
            color: green;
            background-color: #e6fffa;
        }

        /* SECTION SUB */
        .section-sub {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        /* TANDA TANGAN */
        .signature {
            float: right;
            width: 40%;
            text-align: center;
            margin-top: 40px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="rahasia-top">RAHASIA</div>

    <div class="header">
        <img src="{{ public_path('img/logo-kejaksaan.png') }}" class="logo">
        <h3>KEJAKSAAN REPUBLIK INDONESIA</h3>
        <h3>KEJAKSAAN TINGGI KALIMANTAN SELATAN</h3>
        <h2>KEJAKSAAN NEGERI BANJARMASIN</h2>
        <p>Jalan Brig Jend H. Hasan Basri No. 3 Banjarmasin</p>
        <p>Telp. (0511) 3300402 Website: kejari-banjarmasin.go.id</p>
    </div>

    <div class="judul">LEMBAR DATA PENGAWASAN ORANG ASING</div>

    {{-- LAYOUT UTAMA: BIODATA KIRI - FOTO KANAN --}}
    <table class="main-layout">
        <tr>
            {{-- KOLOM KIRI --}}
            <td class="col-left">
                <table class="bio-table">
                    <tr>
                        <td class="label">Nama Lengkap</td>
                        <td class="sep">:</td>
                        <td class="val"><strong>{{ strtoupper($item->nama_lengkap) }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Kebangsaan</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->kebangsaan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor Paspor</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->nomor_paspor }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tujuan Kunjungan</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->tujuan_kunjungan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Sponsor / Penjamin</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->sponsor ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Alamat Menginap</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $item->alamat_menginap }}</td>
                    </tr>
                </table>
            </td>

            {{-- KOLOM KANAN --}}
            <td class="col-right">
                @if($item->foto_dokumen && file_exists(public_path('storage/' . $item->foto_dokumen)))
                <img src="{{ public_path('storage/' . $item->foto_dokumen) }}" class="photo-box">
                @else
                <div class="photo-box" style="display:inline-block; line-height:200px; text-align:center; background:#eee;">FOTO TIDAK ADA</div>
                @endif
            </td>
        </tr>
    </table>

    <div class="section-sub">STATUS IZIN TINGGAL</div>

    <table class="bio-table" style="width: 100%;">
        <tr>
            <td class="label" style="width: 150px;">Tanggal Tiba</td>
            <td class="sep">:</td>
            <td class="val">
                {{ $item->tanggal_tiba ? \Carbon\Carbon::parse($item->tanggal_tiba)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td class="label">Masa Berlaku Izin</td>
            <td class="sep">:</td>
            <td class="val">
                <strong>{{ \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->translatedFormat('d F Y') }}</strong>
            </td>
        </tr>
    </table>

    {{-- LOGIKA OVERSTAY --}}
    @php
    $tglIzin = \Carbon\Carbon::parse($item->masa_berlaku_izin_tinggal)->startOfDay();
    $tglSkrg = \Carbon\Carbon::now()->startOfDay();
    $isOverstay = $tglSkrg->gt($tglIzin);
    $hariTelat = $tglSkrg->diffInDays($tglIzin);
    @endphp

    @if($isOverstay)
    <div class="status-box overstay">
        PERINGATAN: SUBJEK TELAH OVERSTAY<br>
        <span style="font-size: 10pt; font-weight: normal;">(Melewati batas izin tinggal selama {{ $hariTelat }} hari)</span>
    </div>
    @else
    <div class="status-box aman">
        STATUS: IZIN TINGGAL BERLAKU (AMAN)
    </div>
    @endif

    {{-- TANDA TANGAN --}}
    <div style="width: 100%; margin-top: 50px;">
        <div style="float: right; width: 300px; text-align: center;">
            <p>Mengetahui,</p>
            <p><strong>Kepala Seksi Intelijen</strong></p>
            <div style="margin: 15px 0;">
                @php
                $qrContent = route('verifikasi.dokumen', ['tipe' => 'wna', 'id' => $item->id]);
                @endphp
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($qrContent)) !!} ">
            </div>

            <p><u>Nama Kasi Intelijen</u></p>
            <p>NIP. 1234567890</p>
        </div>
        <div style="clear: both;"></div>
    </div>


    <div class="clear"></div>
    <div class="rahasia-top" style="margin-top: 30px;">RAHASIA</div>

</body>

</html>