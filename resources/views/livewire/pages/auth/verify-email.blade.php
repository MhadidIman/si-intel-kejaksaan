<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('publik.lapor', absolute: false), navigate: true);

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

<div class="min-h-screen w-full flex flex-col items-center justify-center bg-slate-50 dark:bg-slate-900/50 dark:bg-slate-900 transition-colors duration-300 px-4 sm:px-6 relative overflow-hidden font-sans">

    {{-- Latar Belakang Modern --}}
    <div class="absolute top-[-20%] right-[-10%] w-[500px] h-[500px] bg-emerald-500/10 blur-[100px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-cyan-500/10 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="w-full max-w-lg relative z-10 animate-fade-in-up">

        <div class="bg-white p-8 sm:p-12 rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 dark:border-slate-700 relative overflow-hidden text-center">

            {{-- Garis Dekorasi --}}
            <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-emerald-500 to-cyan-500"></div>

            {{-- Ikon Email & Logo --}}
            <div class="relative inline-block mb-8 mt-2">
                <div class="w-24 h-24 bg-emerald-50 rounded-full mx-auto flex items-center justify-center shadow-inner relative z-10 border-4 border-white">
                    <i class="fas fa-envelope-open-text text-4xl text-emerald-600"></i>
                </div>
                <div class="absolute top-0 right-0 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md translate-x-1/4 -translate-y-1/4 z-20">
                    <i class="fas fa-check-circle text-xl text-cyan-500"></i>
                </div>
                {{-- Efek Radar --}}
                <div class="absolute inset-0 bg-emerald-400/30 rounded-full blur-md animate-ping"></div>
            </div>

            {{-- Judul & Deskripsi --}}
            <h2 class="text-2xl font-black text-slate-800 dark:text-slate-100 tracking-tight mb-3">Verifikasi Email Anda</h2>

            <p class="text-sm text-slate-500 leading-relaxed mb-8">
                Terima kasih telah mendaftar di <strong>Portal SI-INTEL Kejaksaan</strong>! Sebelum Anda dapat mulai membuat laporan pengaduan, kami perlu memastikan alamat email Anda valid. Silakan periksa kotak masuk Anda dan klik tautan verifikasi yang telah kami kirimkan.
            </p>

            {{-- Pesan Status (Muncul jika tombol kirim ulang diklik) --}}
            @if (session('status') == 'verification-link-sent')
            <div class="mb-8 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl flex items-start gap-3 text-left animate-pulse">
                <i class="fas fa-paper-plane text-emerald-500 mt-0.5"></i>
                <p class="text-[11px] font-bold text-emerald-800 uppercase tracking-wider leading-relaxed">
                    Tautan verifikasi baru telah berhasil dikirim ke alamat email yang Anda gunakan saat registrasi.
                </p>
            </div>
            @endif

            {{-- Aksi Utama --}}
            <div class="space-y-4">
                <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">
                    Belum menerima email?
                </div>

                <button wire:click="sendVerification" wire:loading.attr="disabled" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-slate-900 border border-slate-800 rounded-xl font-black text-xs text-white uppercase tracking-wider hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 transition-all duration-300 shadow-lg shadow-slate-900/30 transform hover:-translate-y-0.5 disabled:opacity-50">

                    <span wire:loading.remove wire:target="sendVerification" class="flex items-center gap-2">
                        <i class="fas fa-sync-alt"></i> Kirim Ulang Tautan
                    </span>

                    <span wire:loading wire:target="sendVerification" class="flex items-center gap-2">
                        <i class="fas fa-circle-notch fa-spin"></i> Mengirim...
                    </span>
                </button>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-700 mt-6 flex justify-center">
                    <button wire:click="logout" class="text-[11px] font-bold text-red-500 uppercase tracking-wider hover:text-red-700 transition flex items-center gap-1.5 px-4 py-2 rounded-lg hover:bg-red-50">
                        <i class="fas fa-sign-out-alt"></i> Logout Akun Ini
                    </button>
                </div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="mt-8 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest flex items-center justify-center gap-2">
                <i class="fas fa-shield-halved"></i> Kejaksaan Negeri Banjarmasin
            </p>
        </div>

    </div>
</div>