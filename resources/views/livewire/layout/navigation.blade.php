<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-slate-900 border-b border-emerald-900/50 sticky top-0 z-50 shadow-2xl">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-6">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 group">
                        <div class="p-1.5 bg-slate-800 rounded-xl border border-slate-700 group-hover:scale-105 transition duration-300 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                            <img src="{{ asset('img/logo-kejaksaan.png') }}" class="block h-10 w-10 object-contain" alt="Logo" />
                        </div>
                        <div class="flex flex-col hidden sm:block">
                            <span class="text-white font-black text-xl tracking-wider leading-none">SI-INTEL</span>
                            <span class="text-[9px] text-amber-400 font-black tracking-[0.2em] uppercase">Kejaksaan RI</span>
                        </div>
                    </a>
                </div>

                <div class="hidden lg:flex lg:items-center lg:space-x-1 ml-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-300 hover:text-emerald-400 focus:text-emerald-400 hover:bg-slate-800/80 px-4 py-2.5 rounded-xl transition-all font-bold tracking-wide">
                        <i class="fas fa-chart-pie mr-2"></i> Dashboard
                    </x-nav-link>

                    <div class="relative z-[100] flex items-center">
                        <x-dropdown align="left" width="56">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-bold rounded-xl text-slate-300 bg-transparent hover:text-emerald-400 hover:bg-slate-800/80 focus:outline-none transition ease-in-out duration-150 gap-2 tracking-wide {{ request()->routeIs('lapinhar.*', 'dpo.*', 'wna.*', 'ormas.*', 'pam-sdo.*', 'jms.*', 'kerawanan.*') ? 'text-emerald-400 bg-slate-800/80' : '' }}">
                                    <i class="fas fa-layer-group"></i> Modul Intelijen
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="bg-white rounded-xl shadow-2xl ring-1 ring-slate-100 overflow-hidden py-2 font-bold relative z-[100]">
                                    <x-dropdown-link :href="route('lapinhar.index')" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5">
                                        <i class="fas fa-bolt w-4 text-emerald-600 text-center"></i> Lapinhar
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('dpo.index')" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-user-secret w-4 text-emerald-600 text-center"></i> Buronan (DPO)
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('wna.index')" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-passport w-4 text-emerald-600 text-center"></i> Pengawasan WNA
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('ormas.index')" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-users w-4 text-emerald-600 text-center"></i> Ormas & Pakem
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('pam-sdo.index')" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-shield-alt w-4 text-emerald-600 text-center"></i> PAM SDO
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('jms.index')" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-school w-4 text-emerald-600 text-center"></i> Jaksa Masuk Sekolah
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('kerawanan.index')" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-map-marked-alt w-4 text-emerald-600 text-center"></i> Peta Kerawanan
                                    </x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <x-nav-link :href="route('lapdu.index')" :active="request()->routeIs('lapdu.*')" class="text-slate-300 hover:text-emerald-400 focus:text-emerald-400 hover:bg-slate-800/80 px-4 py-2.5 rounded-xl transition-all font-bold tracking-wide">
                        <i class="fas fa-bullhorn mr-2"></i> Lapdu
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                    <div class="relative z-[100] flex items-center">
                        <x-dropdown align="left" width="56">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-bold rounded-xl text-slate-300 bg-transparent hover:text-emerald-400 hover:bg-slate-800/80 focus:outline-none transition ease-in-out duration-150 gap-2 tracking-wide {{ request()->routeIs('users.*') ? 'text-emerald-400 bg-slate-800/80' : '' }}">
                                    <i class="fas fa-users-cog"></i> Personil
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="bg-white rounded-xl shadow-2xl ring-1 ring-slate-100 overflow-hidden py-2 font-bold relative z-[100]">
                                    <x-dropdown-link :href="route('users.index', ['viewMode' => 'list'])" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5">
                                        <i class="fas fa-user-edit w-4 text-emerald-600 text-center"></i> Kelola Akun
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('users.index', ['viewMode' => 'stats'])" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-chart-line w-4 text-emerald-600 text-center"></i> Kinerja Staff
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('users.index', ['viewMode' => 'logs'])" wire:navigate class="hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 text-slate-600 py-2.5 border-t border-slate-50">
                                        <i class="fas fa-shield-alt w-4 text-emerald-600 text-center"></i> Log Keamanan
                                    </x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endif
                </div>
            </div>

            <div class="hidden lg:flex sm:items-center relative z-[100]">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-3 py-2 border border-slate-700 hover:border-emerald-500 text-sm font-black rounded-full text-white bg-slate-800 hover:text-emerald-400 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-emerald-500 overflow-hidden shadow-inner">
                                @if(auth()->user()->foto_profile)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profile) }}" class="w-full h-full object-cover">
                                @else
                                {{ substr(auth()->user()->name, 0, 1) }}
                                @endif
                            </div>
                            <div class="flex flex-col text-left hidden sm:block max-w-[100px]">
                                <span class="truncate block text-xs">{{ auth()->user()->name }}</span>
                                <span class="text-[9px] text-amber-400 uppercase tracking-widest">{{ auth()->user()->role }}</span>
                            </div>
                            <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white rounded-xl shadow-2xl py-2 ring-1 ring-slate-100 relative z-[100]">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] text-slate-500 truncate mt-1 bg-slate-50 px-2 py-1 rounded inline-block">{{ auth()->user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile')" wire:navigate class="text-slate-600 hover:text-emerald-700 hover:bg-emerald-50 font-bold text-sm flex items-center gap-3 mt-1 py-2.5">
                                <i class="fas fa-cog w-4 text-center"></i> Pengaturan Akun
                            </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link class="text-red-600 hover:text-red-700 hover:bg-red-50 font-bold text-sm flex items-center gap-3 py-2.5">
                                    <i class="fas fa-power-off w-4 text-center"></i> Keluar Sistem
                                </x-dropdown-link>
                            </button>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>