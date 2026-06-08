<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\{Lapinhar, Dpo, Wna, Ormas, PamSdo, JmsActivity, Kerawanan, Lapdu};

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/petugas', navigate: true); // Petugas kembali ke portal internal
    }

    public function with(): array
    {
        if (auth()->user()?->isAdmin()) {
            $pendingCounts = [
                'Lapinhar' => Lapinhar::where('status_verifikasi', 'pending')->count(),
                'DPO' => Dpo::where('status_verifikasi', 'pending')->count(),
                'Pengawasan WNA' => Wna::where('status_verifikasi', 'pending')->count(),
                'Ormas & Pakem' => Ormas::where('status_verifikasi', 'pending')->count(),
                'PAM SDO' => PamSdo::where('status_verifikasi', 'pending')->count(),
                'JMS' => JmsActivity::where('status_verifikasi', 'pending')->count(),
                'Peta Kerawanan' => Kerawanan::where('status_verifikasi', 'pending')->count(),
                'Pengaduan (Lapdu)' => Lapdu::where('status_verifikasi', 'pending')->count(),
            ];
            $totalPending = array_sum($pendingCounts);
        } else {
            $pendingCounts = [];
            $totalPending = 0;
        }

        return [
            'pendingCounts' => $pendingCounts,
            'totalPending' => $totalPending,
        ];
    }
}; ?>

<nav x-data="{ open: false }" wire:poll.30s class="bg-slate-900 border-b border-emerald-900/50 sticky top-0 z-50 shadow-2xl">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-6">

                {{-- LOGO INTERNAL --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 group">
                        <div class="p-1.5 bg-slate-800 rounded-xl border border-slate-700 group-hover:scale-105 transition duration-300 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                            <img src="{{ asset('img/logo-kejaksaan.png') }}" class="block h-10 w-10 object-contain" alt="Logo" />
                        </div>
                        <div class="flex flex-col hidden sm:block">
                            <span class="text-white font-black text-xl tracking-wider leading-none">SI-INTEL</span>
                            <span class="text-[9px] text-amber-400 font-black tracking-[0.2em] uppercase">Portal Internal</span>
                        </div>
                    </a>
                </div>

                {{-- MENU DESKTOP INTERNAL --}}
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
                        <i class="fas fa-bullhorn mr-2"></i> Lapdu Masuk
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
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endif
                </div>
            </div>

            <div class="hidden lg:flex sm:items-center relative z-[100]">
                {{-- NOTIFIKASI BELL ADMIN --}}
                @if(auth()->user()->isAdmin())
                <div class="mr-4">
                    <x-dropdown align="right" width="72">
                        <x-slot name="trigger">
                            <button class="relative p-2 text-slate-400 hover:text-emerald-400 focus:outline-none transition-colors">
                                <i class="fas fa-bell text-xl"></i>
                                @if($totalPending > 0)
                                <span class="absolute top-1 right-1 flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-slate-900"></span>
                                </span>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-white rounded-xl shadow-2xl py-2 ring-1 ring-slate-100 relative z-[100]">
                                <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Menunggu Verifikasi</p>
                                    <span class="bg-red-100 text-red-600 py-0.5 px-2 rounded text-[9px] font-black animate-pulse">{{ $totalPending }} Baru</span>
                                </div>

                                <div class="max-h-80 overflow-y-auto custom-scrollbar">
                                    @if($totalPending > 0)
                                    @foreach($pendingCounts as $menu => $count)
                                    @if($count > 0)
                                    @php
                                    $route = match($menu) {
                                    'Lapinhar' => route('lapinhar.index'),
                                    'DPO' => route('dpo.index'),
                                    'Pengawasan WNA' => route('wna.index'),
                                    'Ormas & Pakem' => route('ormas.index'),
                                    'PAM SDO' => route('pam-sdo.index'),
                                    'JMS' => route('jms.index'),
                                    'Peta Kerawanan' => route('kerawanan.index'),
                                    'Pengaduan (Lapdu)' => route('lapdu.index'),
                                    default => '#'
                                    };
                                    @endphp
                                    <a href="{{ $route }}" wire:navigate class="flex items-center justify-between px-4 py-3 border-b border-slate-50 hover:bg-emerald-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">
                                                <i class="fas fa-file-signature text-[10px]"></i>
                                            </div>
                                            <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-700 transition-colors">{{ $menu }}</span>
                                        </div>
                                        <span class="text-[10px] font-black text-white bg-amber-500 px-2 py-0.5 rounded-md shadow-sm">{{ $count }}</span>
                                    </a>
                                    @endif
                                    @endforeach
                                    @else
                                    <div class="px-4 py-8 text-center flex flex-col items-center">
                                        <i class="fas fa-clipboard-check text-4xl text-emerald-200 mb-3"></i>
                                        <p class="text-xs font-bold text-slate-500">Semua data telah diverifikasi.</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif

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

            <div class="-me-2 flex items-center lg:hidden gap-4">
                @if(auth()->user()->isAdmin())
                <button @click="open = ! open" class="relative p-2 text-slate-400 hover:text-emerald-400 focus:outline-none transition-colors">
                    <i class="fas fa-bell text-xl"></i>
                    @if($totalPending > 0)
                    <span class="absolute top-1 right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-slate-900"></span>
                    </span>
                    @endif
                </button>
                @endif
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 border border-slate-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE INTERNAL --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-slate-900 border-t border-slate-800 shadow-2xl absolute w-full z-50">
        <div class="pt-4 pb-4 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-chart-pie mr-2 w-5 text-center"></i> Dashboard
            </x-responsive-nav-link>

            <div class="px-4 py-2 text-[10px] font-black text-slate-500 uppercase tracking-widest mt-4 mb-1">Modul Intelijen</div>
            <x-responsive-nav-link :href="route('lapinhar.index')" :active="request()->routeIs('lapinhar.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-bolt mr-2 w-5 text-center"></i> Lapinhar
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dpo.index')" :active="request()->routeIs('dpo.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-user-secret mr-2 w-5 text-center"></i> Buronan (DPO)
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('wna.index')" :active="request()->routeIs('wna.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-passport mr-2 w-5 text-center"></i> Pengawasan WNA
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('ormas.index')" :active="request()->routeIs('ormas.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-users mr-2 w-5 text-center"></i> Ormas & Pakem
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pam-sdo.index')" :active="request()->routeIs('pam-sdo.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-shield-alt mr-2 w-5 text-center"></i> PAM SDO
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jms.index')" :active="request()->routeIs('jms.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-school mr-2 w-5 text-center"></i> Jaksa Masuk Sekolah
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kerawanan.index')" :active="request()->routeIs('kerawanan.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-map-marked-alt mr-2 w-5 text-center"></i> Peta Kerawanan
            </x-responsive-nav-link>

            <div class="px-4 py-2 text-[10px] font-black text-slate-500 uppercase tracking-widest mt-4 mb-1">Layanan Publik</div>
            <x-responsive-nav-link :href="route('lapdu.index')" :active="request()->routeIs('lapdu.*')" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-bullhorn mr-2 w-5 text-center"></i> Lapdu Masuk
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
            <div class="px-4 py-2 text-[10px] font-black text-slate-500 uppercase tracking-widest mt-4 mb-1">Pengaturan (Admin)</div>
            <x-responsive-nav-link :href="route('users.index', ['viewMode' => 'list'])" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-user-edit mr-2 w-5 text-center"></i> Kelola Akun
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.index', ['viewMode' => 'stats'])" wire:navigate class="text-slate-300 hover:text-emerald-400 hover:bg-slate-800 rounded-xl font-bold">
                <i class="fas fa-chart-line mr-2 w-5 text-center"></i> Kinerja Staff
            </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t border-slate-800 bg-slate-950">
            <div class="px-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-slate-800 border-2 border-emerald-500/30 flex items-center justify-center text-emerald-500 overflow-hidden">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-black text-lg text-white">{{ auth()->user()->name }}</div>
                    <div class="font-bold text-[10px] text-emerald-500 uppercase tracking-widest">{{ auth()->user()->role }}</div>
                </div>
            </div>
            <div class="mt-4 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="text-slate-300 hover:text-white rounded-xl font-bold">
                    <i class="fas fa-cog mr-2 w-5 text-center"></i> Pengaturan Akun
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="text-red-400 hover:text-red-300 hover:bg-red-900/20 rounded-xl font-bold">
                        <i class="fas fa-power-off mr-2 w-5 text-center"></i> Keluar Sistem
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>