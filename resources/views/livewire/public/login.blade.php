<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    // Deklarasikan variabel secara mandiri (tanpa LoginForm bawaan)
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

<div class="bg-white p-8 sm:p-10 rounded-3xl shadow-[0_20px_50px_rgba(16,185,129,0.1)] border border-emerald-100 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-bl-full -z-10"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-amber-400/10 rounded-tr-full -z-10"></div>

    <div class="text-center mb-8">
        <h2 class="text-2xl font-black text-slate-800 tracking-tight">Masuk Layanan Publik</h2>
        <p class="text-xs text-slate-500 mt-2 font-medium">Gunakan email yang Anda daftarkan untuk masuk</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-5">
        <div>
            <x-input-label for="email" value="Alamat Email" class="text-slate-700 font-bold" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" value="Kata Sandi" class="text-slate-700 font-bold" />
                @if (Route::has('password.request'))
                <a class="text-xs font-bold text-emerald-600 hover:text-emerald-500" href="{{ route('password.request') }}" wire:navigate>
                    Lupa Sandi?
                </a>
                @endif
            </div>
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-2">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <input wire:model="remember" id="remember" type="checkbox"
                    class="rounded-lg border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500 transition cursor-pointer group-hover:border-emerald-400">
                <span class="ml-2 text-[10px] font-bold text-slate-500 uppercase tracking-wider group-hover:text-emerald-600 transition">Ingat Saya</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <button type="submit" class="w-full flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-black py-3.5 px-4 rounded-xl transition-all shadow-lg shadow-emerald-600/30 transform hover:-translate-y-0.5">
                <span wire:loading.remove wire:target="login">Masuk ke Portal Publik</span>
                <span wire:loading wire:target="login"><i class="fas fa-circle-notch fa-spin"></i> Memeriksa...</span>
            </button>
            <div class="text-center text-sm text-slate-500 font-medium">
                Belum punya akun?
                <a href="{{ route('register') }}" wire:navigate class="font-bold text-emerald-600 hover:text-emerald-500 border-b border-emerald-600">Daftar sekarang</a>
            </div>
        </div>
    </form>
</div>