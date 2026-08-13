<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        // Mengarahkan kembali ke halaman utama publik setelah logout
        $this->redirect('/', navigate: true);
    }
}; ?>

{{-- Tambahkan x-data untuk mendeteksi status klik pada menu mobile --}}
<nav x-data="{ mobileMenuOpen: false }" class="bg-white border-b-4 border-emerald-700 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">

        {{-- Logo & Nama Instansi --}}
        <a href="{{ route('publik.dashboard') }}" wire:navigate class="flex items-center gap-3 sm:gap-4 group">
            <img src="{{ asset('img/logo-kejaksaan.png') }}" alt="Logo Kejaksaan RI" class="h-10 md:h-14 w-auto drop-shadow-sm group-hover:scale-105 transition">
            <div>
                <h1 class="text-[13px] md:text-xl font-black text-slate-800 tracking-tight leading-none uppercase">Kejaksaan Negeri Banjarmasin</h1>
                <p class="text-[9px] md:text-xs font-bold text-emerald-700 tracking-widest uppercase mt-1">Bidang Intelijen | SI-INTEL</p>
            </div>
        </a>

        {{-- Menu Navigasi Kanan (Desktop) --}}
        <div class="flex items-center gap-2 sm:gap-4">

            {{-- Menu Desktop (Disembunyikan di Layar HP) --}}
            <a href="{{ route('publik.dashboard') }}" wire:navigate class="hidden sm:inline-block text-xs font-black uppercase tracking-wider {{ request()->routeIs('publik.dashboard') ? 'text-emerald-700' : 'text-slate-600 hover:text-emerald-600' }} transition">
                Beranda
            </a>
            <a href="{{ route('publik.lapor') }}" wire:navigate class="hidden sm:inline-block text-xs font-black uppercase tracking-wider {{ request()->routeIs('publik.lapor') ? 'text-emerald-700' : 'text-slate-600 hover:text-emerald-600' }} transition">
                Buat Laporan
            </a>
            <a href="{{ route('publik.riwayat') }}" wire:navigate class="hidden sm:inline-flex px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl uppercase tracking-wider transition items-center gap-2">
                <i class="fas fa-search text-emerald-600"></i> Lacak Status
            </a>

            {{-- Theme Toggle Button (Desktop) --}}
            <button type="button" onclick="toggleTheme()" class="hidden sm:flex items-center justify-center p-2 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-emerald-700 transition">
                <i class="fas fa-moon text-lg theme-toggle-dark-icon hidden"></i>
                <i class="fas fa-sun text-lg theme-toggle-light-icon hidden"></i>
            </button>

            {{-- Dropdown Profil & Logout (Desktop & Mobile) --}}
            @auth
            <div class="relative ml-1 sm:ml-2" x-data="{ open: false }" @click.outside="open = false">
                <button @click="open = !open" class="flex items-center gap-2 p-1.5 sm:p-2 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-emerald-700 transition">
                    <i class="fas fa-user-circle text-[22px] sm:text-xl text-emerald-600"></i>
                    <span class="text-xs font-bold hidden md:block">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-[10px] hidden sm:block transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-56 bg-white border border-slate-100 rounded-2xl shadow-xl py-2 z-50"
                    style="display: none;">

                    {{-- Info User Mobile --}}
                    <div class="block md:hidden px-4 py-2 border-b border-slate-50 mb-2">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Masuk sebagai</p>
                        <p class="text-xs font-black text-slate-800 truncate">{{ Auth::user()->name }}</p>
                    </div>

                    <a href="{{ route('profile') }}" wire:navigate class="block px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-emerald-600 transition flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0"><i class="fas fa-user-cog text-[10px]"></i></div>
                        Pengaturan Akun
                    </a>

                    <hr class="border-slate-100 my-1">

                    <button wire:click="logout" class="w-full text-left px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-red-50 hover:text-red-600 transition flex items-center gap-3 group">
                        <div class="w-6 h-6 rounded-full bg-slate-50 group-hover:bg-red-100 text-slate-400 group-hover:text-red-500 flex items-center justify-center shrink-0 transition"><i class="fas fa-sign-out-alt text-[10px]"></i></div>
                        Keluar Akun
                    </button>
                </div>
            </div>
            @endauth

            {{-- Theme Toggle Button (Mobile) --}}
            <button type="button" onclick="toggleTheme()" class="sm:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-emerald-700 transition flex items-center justify-center">
                <i class="fas fa-moon text-xl theme-toggle-dark-icon hidden"></i>
                <i class="fas fa-sun text-xl theme-toggle-light-icon hidden"></i>
            </button>

            {{-- Tombol Hamburger Khusus Mobile --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="sm:hidden p-2 ml-1 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-emerald-700 transition flex items-center justify-center">
                {{-- Icon berubah jadi X saat menu terbuka --}}
                <i class="fas text-xl" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    {{-- Dropdown Menu Mobile --}}
    <div x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="sm:hidden absolute w-full bg-white border-b shadow-lg"
        style="display: none;">

        <div class="px-4 pt-2 pb-4 space-y-2">
            <a href="{{ route('publik.dashboard') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-3 rounded-lg text-sm font-bold uppercase tracking-wider {{ request()->routeIs('publik.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }} transition">
                <i class="fas fa-home w-6 text-center mr-2 text-emerald-600"></i> Beranda
            </a>
            <a href="{{ route('publik.lapor') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-3 rounded-lg text-sm font-bold uppercase tracking-wider {{ request()->routeIs('publik.lapor') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }} transition">
                <i class="fas fa-file-alt w-6 text-center mr-2 text-emerald-600"></i> Buat Laporan
            </a>
            <a href="{{ route('publik.riwayat') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-3 rounded-lg bg-slate-100 text-slate-700 text-sm font-bold uppercase tracking-wider hover:bg-slate-200 transition mt-2">
                <i class="fas fa-search w-6 text-center mr-2 text-emerald-600"></i> Lacak Status Laporan
            </a>
        </div>
    </div>
</nav>