<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Verifikasi Email SI-INTEL</title>
</head>

<body style="background-color: #f8fafc; padding: 30px 10px; font-family: Helvetica, Arial, sans-serif; margin: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">

        <div style="background-color: #047857; padding: 30px; text-align: center; border-bottom: 4px solid #10b981;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 900; letter-spacing: 1px;">SI-INTEL KEJAKSAAN</h1>
            <p style="color: #a7f3d0; margin: 5px 0 0; font-size: 13px; text-transform: uppercase; letter-spacing: 2px;">Kejaksaan Negeri Banjarmasin</p>
        </div>

        <div style="padding: 40px 30px;">
            <h2 style="color: #1e293b; font-size: 20px; margin-top: 0; font-weight: bold;">Yth. {{ $notifiable->name }},</h2>

            <p style="color: #475569; line-height: 1.6; font-size: 15px; margin-bottom: 25px;">
                Terima kasih telah melakukan registrasi pada <strong>Portal Layanan Pengaduan Masyarakat (SI-INTEL)</strong> Kejaksaan Negeri Banjarmasin.
            </p>

            <div style="background-color: #f1f5f9; border-left: 4px solid #047857; padding: 15px; margin-bottom: 25px;">
                <p style="margin: 0; font-size: 14px; color: #334155;">
                    Untuk mengaktifkan akun Anda dan mulai mengirimkan laporan dugaan pelanggaran hukum, sistem kami mewajibkan verifikasi keabsahan alamat email ini terlebih dahulu.
                </p>
            </div>

            <div style="text-align: center; margin: 40px 0;">
                <a href="{{ $url }}" style="background-color: #10b981; color: #ffffff; text-decoration: none; padding: 14px 30px; border-radius: 8px; font-weight: bold; font-size: 16px; display: inline-block; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25); text-transform: uppercase; letter-spacing: 1px;">
                    Verifikasi Email Sekarang
                </a>
            </div>

            <p style="color: #64748b; font-size: 12px; line-height: 1.6; border-top: 1px solid #e2e8f0; padding-top: 25px;">
                <em>Jika tombol hijau di atas tidak merespon saat diklik, Anda dapat menyalin tautan otentikasi di bawah ini dan menempelkannya langsung ke web browser Anda:</em><br>
                <a href="{{ $url }}" style="color: #059669; word-break: break-all; margin-top: 5px; display: inline-block;">{{ $url }}</a>
            </p>
        </div>

        <div style="background-color: #0f172a; padding: 20px; text-align: center;">
            <p style="color: #94a3b8; font-size: 11px; margin: 0; line-height: 1.5;">
                &copy; {{ date('Y') }} Tim Keamanan Data Intelijen Kejaksaan Negeri Banjarmasin.<br>
                Email ini dihasilkan secara otomatis oleh sistem, mohon tidak membalas pesan ini.
            </p>
        </div>

    </div>
</body>

</html>