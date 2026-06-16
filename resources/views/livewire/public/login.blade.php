<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.public')] class extends Component // Menggunakan layout public agar seragam
{
    // Deklarasikan variabel secara mandiri
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        // 1. Validasi input
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Cek kecocokan email dan password di Database
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau Kata Sandi yang Anda masukkan salah.',
            ]);
        }

        // 3. Keamanan Tambahan: Cegah Petugas/Admin masuk lewat pintu Masyarakat
        if (Auth::user()->role !== 'masyarakat') {
            Auth::logout(); // Keluarkan paksa
            throw ValidationException::withMessages([
                'email' => 'Akses ditolak. Ini adalah akun Petugas. Silakan login lewat Portal Internal.',
            ]);
        }

        // 4. Jika sukses, buat sesi baru dan masuk ke Dashboard Publik
        Session::regenerate();
        $this->redirectIntended(default: route('publik.dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-white flex">

    {{-- BAGIAN KIRI: Form Login --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-12">

        <div class="mb-10 text-center lg:text-left">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 mb-6 lg:hidden shadow-inner border border-emerald-100">
                <i class="fas fa-shield-alt text-3xl"></i>
            </div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Masuk Layanan Publik</h2>
            <p class="text-slate-500 text-sm mt-2 font-medium">Gunakan email dan kata sandi yang Anda daftarkan untuk masuk dan memantau status pengaduan.</p>
        </div>

        {{-- Pesan Status (Misal: setelah berhasil reset password) --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login" class="space-y-5">

            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5" for="email">Alamat Email <span class="text-red-500">*</span></label>
                    <input wire:model="email" id="email" type="email" placeholder="email@contoh.com" required autofocus autocomplete="username"
                        class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm bg-white shadow-sm transition">
                    @error('email') <span class="text-[10px] font-bold text-red-500 mt-1.5 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-bold text-slate-700" for="password">Kata Sandi <span class="text-red-500">*</span></label>
                        @if (Route::has('password.request'))
                        <a class="text-[10px] font-bold text-emerald-600 hover:text-emerald-500 hover:underline" href="{{ route('password.request') }}" wire:navigate>
                            Lupa Sandi?
                        </a>
                        @endif
                    </div>
                    <input wire:model="password" id="password" type="password" placeholder="Masukkan kata sandi Anda" required autocomplete="current-password"
                        class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm bg-white shadow-sm transition">
                    @error('password') <span class="text-[10px] font-bold text-red-500 mt-1.5 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center px-1">
                <label class="flex items-center cursor-pointer group">
                    <input wire:model="remember" type="checkbox" class="w-4 h-4 text-emerald-600 bg-white border-slate-300 rounded focus:ring-emerald-500 focus:ring-2 transition cursor-pointer">
                    <span class="ml-2 text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition">Ingat Saya di Perangkat Ini</span>
                </label>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black text-sm uppercase tracking-widest rounded-xl transition shadow-xl shadow-emerald-600/20 flex items-center justify-center gap-2">
                    <span wire:loading.remove wire:target="login"><i class="fas fa-sign-in-alt text-emerald-200"></i> Masuk ke Portal</span>
                    <span wire:loading wire:target="login"><i class="fas fa-circle-notch fa-spin text-emerald-200"></i> Memverifikasi...</span>
                </button>
            </div>

            <p class="text-center text-xs text-slate-500 font-medium pt-4">
                Belum punya akun? <a href="{{ route('publik.register') }}" wire:navigate class="font-bold text-emerald-600 hover:underline">Daftar sekarang</a>
            </p>
        </form>
    </div>

    {{-- BAGIAN KANAN: Visual Edukasi (Hanya muncul di Layar Besar) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-slate-900 relative overflow-hidden items-center justify-center p-12">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute -right-20 -bottom-20 opacity-5 pointer-events-none">
            <i class="fas fa-fingerprint text-[30rem] text-emerald-400 transform -rotate-12"></i>
        </div>

        <div class="relative z-10 max-w-md text-center">
            <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-28 mx-auto mb-8 drop-shadow-2xl" alt="Logo Kejaksaan">
            <h2 class="text-3xl font-black text-white mb-4">Akses Aman & Terenkripsi</h2>
            <p class="text-emerald-400 font-bold uppercase tracking-widest text-xs mb-8 border-b border-slate-700 pb-6">Sistem Informasi Intelijen Kejaksaan</p>

            <div class="space-y-6 text-left">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/30"><i class="fas fa-user-secret"></i></div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Privasi & Identitas Dilindungi</h4>
                        <p class="text-slate-400 text-xs mt-1 leading-relaxed">Sistem menjamin kerahasiaan identitas pelapor dari pihak manapun selama proses operasional intelijen berlangsung sesuai undang-undang.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center shrink-0 border border-blue-500/30"><i class="fas fa-history"></i></div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Lacak Riwayat Real-time</h4>
                        <p class="text-slate-400 text-xs mt-1 leading-relaxed">Masuk ke dalam akun Anda untuk melacak status penanganan dan tindak lanjut laporan yang telah Anda kirimkan ke tim Intelijen.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>