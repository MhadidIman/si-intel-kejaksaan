<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;

// 1. IMPORT CLASS UNTUK EMAIL VERIFIKASI
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SISTEM LOG AKTIVITAS OTOMATIS (KEAMANAN)
        |--------------------------------------------------------------------------
        | Mencatat setiap kali ada personil yang masuk atau keluar dari sistem
        | untuk keperluan audit internal dan keamanan data intelijen.
        */

        // 1. Catat Log saat User Berhasil Login
        Event::listen(Login::class, function ($event) {
            ActivityLog::create([
                'user_id'     => $event->user->id,
                'activity'    => 'Login',
                'description' => 'Personil berhasil masuk ke sistem SI-INTEL',
                'ip_address'  => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ]);
        });

        // 2. Catat Log saat User Logout
        Event::listen(Logout::class, function ($event) {
            if ($event->user) {
                ActivityLog::create([
                    'user_id'     => $event->user->id,
                    'activity'    => 'Logout',
                    'description' => 'Personil telah keluar dari sistem',
                    'ip_address'  => request()->ip(),
                    'user_agent'  => request()->userAgent(),
                ]);
            }
        });

        /*
        |--------------------------------------------------------------------------
        | KUSTOMISASI TAMPILAN SURAT EMAIL VERIFIKASI
        |--------------------------------------------------------------------------
        */
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('PENTING: Verifikasi Akun SI-INTEL Kejaksaan')
                ->view('emails.verify-email', ['url' => $url, 'notifiable' => $notifiable]);
        });
    }
}
