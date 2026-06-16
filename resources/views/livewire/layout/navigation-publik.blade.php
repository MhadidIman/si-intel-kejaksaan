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

<nav class="bg-white border-b-4 border-emerald-700 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">

        {{-- Logo & Nama Instansi --}}
        <a href="{{ route('publik.dashboard') }}" wire:navigate class="flex items-center gap-4 group">
            <img src="{{ asset('img/logo-kejaksaan.png') }}" alt="Logo Kejaksaan RI" class="h-12 md:h-14 w-auto drop-shadow-sm group-hover:scale-105 transition">
            <div>
                <h1 class="text-base md:text-xl font-black text-slate-800 tracking-tight leading-none uppercase">Kejaksaan Negeri Banjarmasin</h1>
                <p class="text-[10px] md:text-xs font-bold text-emerald-700 tracking-widest uppercase mt-1">Bidang Intelijen | SI-INTEL</p>
            </div>
        </a>

        {{-- Menu Navigasi Kanan --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('publik.dashboard') }}" wire:navigate class="hidden sm:inline-block text-xs font-black uppercase tracking-wider {{ request()->routeIs('publik.dashboard') ? 'text-emerald-700' : 'text-slate-600 hover:text-emerald-600' }} transition">
                Beranda
            </a>
            <a href="{{ route('publik.lapor') }}" wire:navigate class="hidden sm:inline-block text-xs font-black uppercase tracking-wider {{ request()->routeIs('publik.lapor') ? 'text-emerald-700' : 'text-slate-600 hover:text-emerald-600' }} transition">
                Buat Laporan
            </a>
            <a href="{{ route('publik.riwayat') }}" wire:navigate class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl uppercase tracking-wider transition flex items-center gap-2">
                <i class="fas fa-search text-emerald-600"></i> Lacak Status
            </a>

            {{-- Tombol Logout Masyarakat --}}
            <button wire:click="logout" class="p-2 text-slate-400 hover:text-red-500 transition" title="Keluar">
                <i class="fas fa-sign-out-alt text-lg"></i>
            </button>
        </div>

    </div>
</nav>