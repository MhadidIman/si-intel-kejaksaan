<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Seleksi arah berdasarkan role pengguna
        $urlRedirect = $request->user()->role === 'masyarakat'
            ? route('publik.lapor')
            : route('dashboard');

        // GANTI DI SINI: Gunakan redirect() biasa, jangan pakai intended()
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($urlRedirect . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // GANTI DI SINI: Gunakan redirect() biasa, jangan pakai intended()
        return redirect($urlRedirect . '?verified=1');
    }
}
