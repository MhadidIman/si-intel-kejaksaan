<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
// Import Semua Model
use App\Models\Lapinhar;
use App\Models\Dpo;
use App\Models\Wna;
use App\Models\Ormas;
use App\Models\PamSdo;
use App\Models\JmsActivity;
use App\Models\Kerawanan;
use App\Models\Lapdu;

new class extends Component
{
    // Properti Hitungan Operasional
    public $cLapinhar = 0;
    public $cDpo = 0;
    public $cWna = 0;
    public $cOrmas = 0;
    public $totalOperasional = 0;

    // Properti Hitungan Pelayanan
    public $cPamSdo = 0;
    public $cLapdu = 0;
    public $cJms = 0;
    public $cKerawanan = 0;
    public $totalPelayanan = 0;

    public function mount()
    {
        // Hitung notifikasi hanya jika user adalah Admin
        if (Auth::check() && Auth::user()->isAdmin()) {

            // 1. HITUNG DATA OPERASIONAL (Pending)
            $this->cLapinhar = Lapinhar::where('status_verifikasi', 'pending')->count();
            $this->cDpo      = Dpo::where('status_verifikasi', 'pending')->count();
            $this->cWna      = Wna::where('status_verifikasi', 'pending')->count();
            $this->cOrmas    = Ormas::where('status_verifikasi', 'pending')->count();

            $this->totalOperasional = $this->cLapinhar + $this->cDpo + $this->cWna + $this->cOrmas;

            // 2. HITUNG DATA PELAYANAN (Pending)
            $this->cPamSdo    = PamSdo::where('status_verifikasi', 'pending')->count();
            $this->cLapdu     = Lapdu::where('status_verifikasi', 'pending')->count();
            $this->cJms       = JmsActivity::where('status_verifikasi', 'pending')->count();
            $this->cKerawanan = Kerawanan::where('status_verifikasi', 'pending')->count();

            $this->totalPelayanan = $this->cPamSdo + $this->cLapdu + $this->cJms + $this->cKerawanan;
        }
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

<nav x-data="{ 
        open: false,
        currentRoute: '{{ Route::currentRouteName() }}' 
    }"
    x-on:livewire:navigated.window="currentRoute = '{{ Route::currentRouteName() }}'"
    class="bg-emerald-950/60 backdrop-blur-xl border-b border-white/10 sticky top-0 z-50 shadow-2xl">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 group transition-all duration-300">
                        <div class="bg-emerald-500 p-2 rounded-xl group-hover:rotate-12 transition-transform shadow-lg shadow-emerald-500/20">
                            <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-8 w-8 object-contain">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-black text-xl tracking-tighter text-white leading-none group-hover:text-emerald-400 transition-colors">SI-INTEL</span>
                            <span class="text-[9px] font-bold text-emerald-300/60 uppercase tracking-[0.2em] leading-none mt-1">Kejaksaan RI</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ms-12 sm:flex sm:items-center">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                        class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 border-none hover:bg-white/5 {{ request()->routeIs('dashboard') ? 'bg-emerald-500/20 !text-emerald-400 shadow-inner' : 'text-gray-400 hover:text-white' }}">
                        <i class="fas fa-home-alt mr-2 opacity-50"></i>{{ __('Dashboard') }}
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" wire:navigate
                        class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 border-none hover:bg-white/5 {{ request()->routeIs('users.*') ? 'bg-emerald-500/20 !text-emerald-400 shadow-inner' : 'text-gray-400 hover:text-white' }}">
                        <i class="fas fa-users mr-2 opacity-50"></i>{{ __('Personil') }}
                    </x-nav-link>
                    @endif

                    <div class="ms-2 relative">
                        @php
                        $operasionalRoutes = ['lapinhar.*', 'dpo.*', 'wna.*', 'ormas.*'];
                        $isOperasionalActive = request()->routeIs($operasionalRoutes);
                        @endphp
                        <x-dropdown align="right" width="64">
                            <x-slot name="trigger">
                                <button class="relative inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 backdrop-blur-sm group
                                    {{ $isOperasionalActive ? 'bg-emerald-500/20 text-emerald-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    <i class="fas fa-briefcase mr-2 opacity-50 group-hover:rotate-12 transition-transform"></i>
                                    <div>Operasional</div>

                                    <div class="ms-2 opacity-50 group-hover:translate-y-0.5 transition-transform">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>

                                    @if(auth()->user()->isAdmin() && $totalOperasional > 0)
                                    <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border border-emerald-900"></span>
                                    </span>
                                    @endif
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 py-2 text-[10px] font-black uppercase tracking-widest text-emerald-500/50">Menu Operasional</div>

                                <x-dropdown-link :href="route('lapinhar.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between group">
                                    <div class="flex items-center"><i class="fas fa-file-alt w-5 opacity-50 text-xs"></i> Lapinhar</div>
                                    @if(auth()->user()->isAdmin() && $cLapinhar > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cLapinhar }}</span>
                                    @endif
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('dpo.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between group">
                                    <div class="flex items-center"><i class="fas fa-user-shield w-5 opacity-50 text-xs"></i> DPO / Tabur</div>
                                    @if(auth()->user()->isAdmin() && $cDpo > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cDpo }}</span>
                                    @endif
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('wna.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between group">
                                    <div class="flex items-center"><i class="fas fa-globe-asia w-5 opacity-50 text-xs"></i> Pengawasan WNA</div>
                                    @if(auth()->user()->isAdmin() && $cWna > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cWna }}</span>
                                    @endif
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('ormas.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between group">
                                    <div class="flex items-center"><i class="fas fa-users-class w-5 opacity-50 text-xs"></i> Pengawasan Ormas</div>
                                    @if(auth()->user()->isAdmin() && $cOrmas > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cOrmas }}</span>
                                    @endif
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="ms-2 relative">
                        @php
                        $pelayananRoutes = ['pam-sdo.*', 'jms.*', 'kerawanan.*', 'lapdu.*'];
                        $isPelayananActive = request()->routeIs($pelayananRoutes);
                        @endphp
                        <x-dropdown align="right" width="64">
                            <x-slot name="trigger">
                                <button class="relative inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 backdrop-blur-sm group
                                    {{ $isPelayananActive ? 'bg-emerald-500/20 text-emerald-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">

                                    <i class="fas fa-hand-holding-heart mr-2 opacity-50 group-hover:rotate-12 transition-transform"></i>
                                    <div>Giat & Pelayanan</div>

                                    <div class="ms-2 opacity-50 group-hover:translate-y-0.5 transition-transform">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>

                                    @if(auth()->user()->isAdmin() && $totalPelayanan > 0)
                                    <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border border-emerald-900"></span>
                                    </span>
                                    @endif
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 py-2 text-[10px] font-black uppercase tracking-widest text-emerald-500/50">Menu Pelayanan</div>

                                <x-dropdown-link :href="route('pam-sdo.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between group">
                                    <div class="flex items-center"><i class="fas fa-shield-check w-5 opacity-50 text-xs"></i> PAM SDO</div>
                                    @if(auth()->user()->isAdmin() && $cPamSdo > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cPamSdo }}</span>
                                    @endif
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('lapdu.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between group">
                                    <div class="flex items-center"><i class="fas fa-envelope-open-text w-5 opacity-50 text-xs"></i> Pelayanan Lapdu</div>
                                    @if(auth()->user()->isAdmin() && $cLapdu > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cLapdu }}</span>
                                    @endif
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('jms.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between group">
                                    <div class="flex items-center"><i class="fas fa-graduation-cap w-5 opacity-50 text-xs"></i> Jaksa Masuk Sekolah</div>
                                    @if(auth()->user()->isAdmin() && $cJms > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cJms }}</span>
                                    @endif
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('kerawanan.index')" wire:navigate class="hover:bg-emerald-500/10 flex items-center justify-between border-t border-white/5 group">
                                    <div class="flex items-center"><i class="fas fa-map-marked-alt w-5 opacity-50 text-xs"></i> Peta Kerawanan</div>
                                    @if(auth()->user()->isAdmin() && $cKerawanan > 0)
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">{{ $cKerawanan }}</span>
                                    @endif
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 transition-all group">
                            <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center font-black text-emerald-950 text-xs shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div class="text-start hidden lg:block">
                                <p class="text-[10px] font-black text-emerald-400 uppercase tracking-tighter leading-none">{{ auth()->user()->role }}</p>
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name" class="text-sm font-bold text-white leading-none mt-1"></div>
                            </div>
                            <svg class="fill-current h-4 w-4 text-gray-500 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-white/5 bg-white/5">
                            <p class="text-xs text-gray-400">Signed in as</p>
                            <p class="text-sm font-bold text-white truncate">{{ auth()->user()->nip ?? auth()->user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile')" wire:navigate class="hover:bg-emerald-500/10">
                            <i class="fas fa-user-cog mr-2 opacity-50"></i> Pengaturan Profil
                        </x-dropdown-link>
                        <div class="border-t border-white/10"></div>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link class="!text-red-400 font-bold hover:bg-red-500/10">
                                <i class="fas fa-sign-out-alt mr-2 opacity-50"></i> Keluar Sistem
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>