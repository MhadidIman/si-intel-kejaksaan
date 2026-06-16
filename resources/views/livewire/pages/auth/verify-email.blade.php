<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            // PERBAIKAN: Arahkan ke dashboard publik, bukan dashboard internal
            $this->redirectIntended(default: route('publik.dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="min-h-screen bg-slate-50 flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 selection:bg-emerald-500 selection:text-white relative overflow-hidden">

    {{-- Elemen Latar Belakang --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-bl-full -z-10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-tr-full -z-10 blur-3xl"></div>

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">

        {{-- Garis Aksen Atas --}}
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600"></div>

        <div class="p-8 sm:p-10 text-center">

            {{-- Ikon Amplop --}}
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-50 text-emerald-600 mb-6 shadow-inner border border-emerald-100">
                <i class="fas fa-envelope-open-text text-4xl mt-1"></i>
            </div>

            <h2 class="text-2xl font-black text-slate-800 tracking-tight mb-3">Verifikasi Email Anda</h2>

            <p class="text-sm text-slate-500 leading-relaxed mb-6 font-medium">
                Terima kasih telah mendaftar di <strong>SI-INTEL</strong>! Sebelum memulai, harap verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami akan mengirimkan ulang.
            </p>

            {{-- Pesan Sukses Kirim Ulang --}}
            @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3 text-left">
                <i class="fas fa-check-circle text-emerald-600 mt-0.5 text-lg shrink-0"></i>
                <p class="text-xs font-bold text-emerald-800 leading-relaxed">
                    Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran. Silakan periksa folder Inbox atau Spam Anda.
                </p>
            </div>
            @endif

            <div class="space-y-4 mt-2">
                {{-- Tombol Kirim Ulang --}}
                <button wire:click="sendVerification" class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-widest rounded-xl transition shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-2">
                    <span wire:loading.remove wire:target="sendVerification"><i class="fas fa-paper-plane"></i> Kirim Ulang Email</span>
                    <span wire:loading wire:target="sendVerification"><i class="fas fa-circle-notch fa-spin"></i> Mengirim...</span>
                </button>

                {{-- Tombol Logout --}}
                <button wire:click="logout" type="button" class="w-full py-3.5 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs uppercase tracking-widest rounded-xl border border-slate-200 transition flex items-center justify-center gap-2">
                    <i class="fas fa-sign-out-alt text-slate-400"></i> Keluar (Log Out)
                </button>
            </div>

        </div>
    </div>

    <div class="mt-8 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">
        &copy; {{ date('Y') }} Kejaksaan Negeri Banjarmasin
    </div>
</div>