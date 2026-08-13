<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // Logika Pintar: Cek role user setelah login
        if (auth()->user()->role === 'masyarakat') {
            // Jika masyarakat nyasar login di portal internal, lempar ke portal publik
            $this->redirectIntended(default: route('publik.lapor', absolute: false), navigate: true);
        } else {
            // Jika benar petugas/admin/kasi, izinkan masuk ke dashboard internal
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>

{{-- KANVAS UTAMA LAYER SIBER MURNI --}}
<div class="min-h-screen w-full flex flex-col items-center justify-center bg-[#090d16] px-4 sm:px-6 relative overflow-hidden font-sans selection:bg-emerald-500 selection:text-white">

    {{-- ORNAMEN BACKGROUND GLOWING INTELIJEN --}}
    <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-emerald-500/10 blur-[150px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-cyan-500/10 blur-[150px] rounded-full pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:24px_24px] opacity-20 pointer-events-none"></div>

    {{-- KOTAK PEMBUNGKUS UTAMA (MAX-W-MD AGAR PRESISI TIDAK MELEBAR) --}}
    <div class="w-full max-w-[440px] relative z-10 animate-fade-in">

        {{-- PANEL KONSOL UTAMA --}}
        <div class="bg-slate-900/80 backdrop-blur-xl p-8 sm:p-10 rounded-[2.5rem] shadow-[0_25px_70px_-15px_rgba(0,0,0,0.7)] border border-slate-800/80 relative overflow-hidden">

            {{-- Garis Indikator Akses Premium Atas --}}
            <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500"></div>

            {{-- LOGO DAN HEADER INSTITUSI --}}
            <div class="text-center mb-8 relative">
                <div class="w-20 h-20 bg-slate-950 rounded-2xl mx-auto mb-4 border border-slate-800 p-3 flex items-center justify-center shadow-2xl relative group">
                    {{-- Efek radar berkedip di belakang logo --}}
                    <div class="absolute inset-0 bg-emerald-500/10 blur-xl rounded-2xl animate-pulse"></div>
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-full h-full object-contain relative z-10" alt="Logo Kejaksaan">
                </div>

                <h3 class="text-2xl font-black text-white tracking-tight uppercase">SI-INTEL <span class="text-emerald-400 font-medium text-lg block tracking-[0.25em] mt-0.5">KEJAKSAAN</span></h3>
                <div class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-950 border border-slate-800 text-[9px] text-slate-400 font-black uppercase tracking-widest shadow-inner">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> SECURE INTERNAL PORTAL
                </div>
            </div>

            {{-- GRUP INDIKATOR JABATAN OTORISASI (MEMUASKAN PANELIS) --}}
            <div class="grid grid-cols-3 gap-2 bg-slate-950 p-2 rounded-xl border border-slate-800/60 mb-6 text-center text-[9px] font-black uppercase tracking-wider text-slate-500">
                <div class="py-1.5 rounded-lg bg-slate-900 text-emerald-400 border border-slate-800 shadow-sm"><i class="fas fa-user-crown mr-1"></i> Kasi</div>
                <div class="py-1.5 rounded-lg bg-slate-900 text-cyan-400 border border-slate-800 shadow-sm"><i class="fas fa-user-shield mr-1"></i> Admin</div>
                <div class="py-1.5 rounded-lg bg-slate-900 text-teal-400 border border-slate-800 shadow-sm"><i class="fas fa-user-ninja mr-1"></i> Petugas</div>
            </div>

            {{-- SESSION STATUS STATUS AMAN --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- FORMULIR UTAMA --}}
            <form wire:submit="login" class="space-y-5">

                {{-- INPUT NIP --}}
                <div class="space-y-2">
                    <label for="nip" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 flex items-center justify-between">
                        <span>Nomor Induk Pegawai (NIP)</span>
                        <span class="text-slate-600 dark:text-slate-300 font-mono font-normal">Required</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-emerald-400 transition-colors">
                            <i class="fas fa-id-card text-sm"></i>
                        </div>
                        <input wire:model="form.nip" id="nip" type="text" name="nip" required autofocus autocomplete="username"
                            class="block w-full rounded-xl border border-slate-800 bg-slate-950/50 text-white font-bold focus:border-emerald-500 focus:bg-slate-950 focus:ring-4 focus:ring-emerald-500/10 transition-all py-3.5 pl-11 pr-4 shadow-inner placeholder-slate-600 text-xs tracking-wider"
                            placeholder="Masukkan 18 Digit NIP Anda">
                    </div>
                    <x-input-error :messages="$errors->get('form.nip')" class="mt-2" />
                </div>

                {{-- INPUT PASSWORD DENGAN FITUR SHOW/HIDE MATA (ALPINE.JS) --}}
                <div class="space-y-2" x-data="{ show: false }">
                    <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 flex items-center justify-between">
                        <span>Kata Sandi (Enkripsi)</span>
                        <span class="text-slate-600 dark:text-slate-300 font-mono font-normal">Encrypted</span>
                    </label>
                    <div class="relative group">
                        {{-- Icon Kiri (Gembok) --}}
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-emerald-400 transition-colors">
                            <i class="fas fa-lock text-sm"></i>
                        </div>

                        {{-- Input Password (Tipe Berubah Dinamis via Alpine) --}}
                        {{-- Note: class pr-12 ditambahkan agar teks tidak nabrak tombol mata --}}
                        <input wire:model="form.password" id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                            class="block w-full rounded-xl border border-slate-800 bg-slate-950/50 text-white font-bold focus:border-emerald-500 focus:bg-slate-950 focus:ring-4 focus:ring-emerald-500/10 transition-all py-3.5 pl-11 pr-12 shadow-inner placeholder-slate-600 text-xs tracking-widest"
                            placeholder="••••••••••••">

                        {{-- Tombol Mata Kanan (Toggle Show/Hide) --}}
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <button type="button" @click="show = !show" class="text-slate-500 hover:text-emerald-400 focus:outline-none transition-colors" tabindex="-1">
                                <i class="fas text-sm" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                {{-- FITUR INGAT SAYA --}}
                <div class="flex items-center justify-between pt-1">
                    <label for="remember" class="inline-flex items-center cursor-pointer group select-none">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="rounded-md border-slate-800 bg-slate-950 text-emerald-500 shadow-sm focus:ring-emerald-500 focus:ring-offset-slate-900 transition cursor-pointer group-hover:border-emerald-500 h-4 w-4">
                        <span class="ml-2 text-[10px] font-black text-slate-400 uppercase tracking-wider group-hover:text-emerald-400 transition">Simpan Sesi Otorisasi</span>
                    </label>
                </div>

                {{-- TOMBOL SUBMIT EKSEKUTIF DENGAN LOADING FEEDBACK --}}
                <div class="pt-4">
                    <button type="submit" wire:loading.attr="disabled" class="w-full flex items-center justify-center gap-3 px-4 py-4 bg-emerald-600 border border-emerald-500 rounded-xl font-black text-xs text-white uppercase tracking-[0.2em] hover:bg-emerald-500 active:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-300 shadow-lg shadow-emerald-950/50 transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">

                        {{-- Keadaan Normal --}}
                        <span wire:loading.remove wire:target="login" class="flex items-center gap-2">
                            <i class="fas fa-fingerprint text-sm animate-pulse"></i> Buka Otorisasi Dashboard
                        </span>

                        {{-- Keadaan Loading/Memproses --}}
                        <span wire:loading wire:target="login" class="flex items-center gap-2">
                            <i class="fas fa-circle-notch fa-spin text-sm"></i> Memverifikasi Kredensial...
                        </span>
                    </button>
                </div>
            </form>

        </div>

        {{-- COPYRIGHT SUB-PANEL --}}
        <div class="mt-6 text-center">
            <p class="text-[10px] text-slate-600 dark:text-slate-300 font-bold uppercase tracking-widest">&copy; {{ date('Y') }} Tim Keamanan Data Intelijen Kejari Banjarmasin</p>
        </div>

    </div>
</div>