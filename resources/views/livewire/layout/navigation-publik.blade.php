<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true); // Masyarakat kembali ke landing page publik
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                {{-- LOGO PUBLIK --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('publik.dashboard') }}" wire:navigate class="flex items-center gap-3 group">
                        <img src="{{ asset('img/logo-kejaksaan.png') }}" class="block h-8 w-8 object-contain transition-transform group-hover:scale-105" alt="Logo" />
                        <div class="flex flex-col hidden sm:block leading-none">
                            <span class="text-slate-800 font-black text-lg tracking-widest">SI-INTEL</span>
                            <span class="text-[8px] text-emerald-600 font-black tracking-[0.2em] uppercase">Layanan Publik</span>
                        </div>
                    </a>
                </div>

                {{-- MENU DESKTOP PUBLIK --}}
                <div class="hidden lg:flex lg:items-center lg:space-x-2 ml-6">
                    <x-nav-link :href="route('publik.dashboard')" :active="request()->routeIs('publik.dashboard')" class="text-slate-600 hover:text-emerald-600 font-bold px-3 py-2">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('publik.lapor')" :active="request()->routeIs('publik.lapor')" class="text-slate-600 hover:text-emerald-600 font-bold px-3 py-2">
                        <i class="fas fa-bullhorn mr-2"></i> Buat Laporan
                    </x-nav-link>

                    <x-nav-link :href="route('publik.riwayat')" :active="request()->routeIs('publik.riwayat')" class="text-slate-600 hover:text-emerald-600 font-bold px-3 py-2">
                        <i class="fas fa-history mr-2"></i> Riwayat & Proses
                    </x-nav-link>
                </div>
            </div>

            {{-- PROFIL & LOGOUT DESKTOP --}}
            <div class="hidden lg:flex sm:items-center relative z-[100]">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50 text-sm font-bold rounded-full text-slate-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="w-7 h-7 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs shadow-inner">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="truncate max-w-[100px]">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white rounded-xl shadow-xl py-2 ring-1 ring-slate-100">
                            <div class="px-4 py-2 border-b border-slate-100 mb-1">
                                <p class="text-xs font-black text-slate-800 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-[9px] text-slate-500 uppercase tracking-widest mt-0.5">Masyarakat</p>
                            </div>
                            <x-dropdown-link :href="route('profile')" wire:navigate class="text-slate-600 hover:text-emerald-700 text-xs font-bold flex items-center gap-2">
                                <i class="fas fa-cog w-4 text-center"></i> Pengaturan Akun
                            </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link class="text-red-600 hover:text-red-700 text-xs font-bold flex items-center gap-2">
                                    <i class="fas fa-power-off w-4 text-center"></i> Keluar
                                </x-dropdown-link>
                            </button>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- HAMBURGER MENU MOBILE --}}
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-emerald-500 hover:bg-slate-100 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE PUBLIK --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-white border-b border-slate-200 shadow-lg absolute w-full z-50">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('publik.dashboard')" :active="request()->routeIs('publik.dashboard')" wire:navigate class="font-bold text-sm">
                <i class="fas fa-home mr-2 w-5 text-center"></i> Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('publik.lapor')" :active="request()->routeIs('publik.lapor')" wire:navigate class="font-bold text-sm">
                <i class="fas fa-bullhorn mr-2 w-5 text-center"></i> Buat Laporan
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('publik.riwayat')" :active="request()->routeIs('publik.riwayat')" wire:navigate class="font-bold text-sm">
                <i class="fas fa-history mr-2 w-5 text-center"></i> Riwayat & Proses
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-4 border-t border-slate-100 bg-slate-50">
            <div class="px-5 flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-black text-sm text-slate-800">{{ auth()->user()->name }}</div>
                    <div class="font-bold text-[9px] text-emerald-600 uppercase tracking-widest">Masyarakat</div>
                </div>
            </div>
            <div class="space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="font-bold text-sm text-slate-600">
                    <i class="fas fa-cog mr-2 w-5 text-center"></i> Pengaturan
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="font-bold text-sm text-red-600">
                        <i class="fas fa-power-off mr-2 w-5 text-center"></i> Keluar
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>