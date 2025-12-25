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
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ 
        open: false,
        currentRoute: '{{ Route::currentRouteName() }}' 
    }"
    x-on:livewire:navigated.window="currentRoute = '{{ Route::currentRouteName() }}'"
    class="bg-emerald-950/40 backdrop-blur-md border-b border-white/10 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex flex-col group">
                        <span class="font-black text-xl tracking-tight text-white leading-none group-hover:text-yellow-400 transition">SI-INTEL</span>
                        <span class="text-[10px] font-bold text-emerald-200 uppercase tracking-widest leading-none">Kejaksaan RI</span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex sm:items-center">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                        class="text-gray-300 hover:text-white border-transparent hover:border-white-400 {{ request()->routeIs('dashboard') ? '!border-yellow-500 !text-yellow-400 font-bold' : '' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" wire:navigate
                        class="text-gray-300 hover:text-white border-transparent hover:border-yellow-400 {{ request()->routeIs('users.*') ? '!border-yellow-500 !text-yellow-400 font-bold' : '' }}">
                        {{ __('Personil') }}
                    </x-nav-link>
                    @endif

                    <div class="ms-3 relative">
                        @php
                        $operasionalRoutes = ['lapinhar.*', 'dpo.*', 'wna.*', 'ormas.*'];
                        $isOperasionalActive = request()->routeIs($operasionalRoutes);
                        @endphp
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md transition ease-in-out duration-150 backdrop-blur-sm 
                                    {{ $isOperasionalActive ? 'bg-yellow-500/10 text-yellow-400 border-yellow-500/50 ring-1 ring-yellow-500/30' : 'text-emerald-100 bg-white/5 hover:bg-white/10 hover:text-white border border-white/5' }}">
                                    <div>Bidang Operasional</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('lapinhar.index')" wire:navigate :active="request()->routeIs('lapinhar.*')">LAPINHAR</x-dropdown-link>
                                <x-dropdown-link :href="route('dpo.index')" wire:navigate :active="request()->routeIs('dpo.*')">Data DPO / Tabur</x-dropdown-link>
                                <x-dropdown-link :href="route('wna.index')" wire:navigate :active="request()->routeIs('wna.*')">Pengawasan WNA</x-dropdown-link>
                                <x-dropdown-link :href="route('ormas.index')" wire:navigate :active="request()->routeIs('ormas.*')">Pengawasan Ormas</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="ms-3 relative">
                        @php
                        $pelayananRoutes = ['pam-sdo.*', 'jms.*', 'kerawanan.*', 'lapdu.*'];
                        $isPelayananActive = request()->routeIs($pelayananRoutes);
                        @endphp
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md transition ease-in-out duration-150 backdrop-blur-sm 
                                    {{ $isPelayananActive ? 'bg-yellow-500/10 text-yellow-400 border-yellow-500/50 ring-1 ring-yellow-500/30' : 'text-emerald-100 bg-white/5 hover:bg-white/10 hover:text-white border border-white/5' }}">
                                    <div>Giat & Pelayanan</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('pam-sdo.index')" wire:navigate :active="request()->routeIs('pam-sdo.*')">Pengamanan SDO</x-dropdown-link>
                                <x-dropdown-link :href="route('lapdu.index')" wire:navigate :active="request()->routeIs('lapdu.*')">Pelayanan Lapdu</x-dropdown-link>
                                <x-dropdown-link :href="route('jms.index')" wire:navigate :active="request()->routeIs('jms.*')">Jaksa Masuk Sekolah</x-dropdown-link>
                                <x-dropdown-link :href="route('kerawanan.index')" wire:navigate :active="request()->routeIs('kerawanan.*')">Peta Kerawanan</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-full text-emerald-100 bg-white/5 hover:bg-white/10 hover:text-white focus:outline-none transition ease-in-out duration-150 backdrop-blur-sm border border-white/10 {{ request()->routeIs('profile') ? 'ring-2 ring-yellow-500 border-yellow-500 text-yellow-400' : '' }}">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <div class="ms-2 opacity-50">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>Profil</x-dropdown-link>
                        <div class="border-t border-white/10"></div>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link class="text-red-400 font-bold hover:bg-red-500/10 hover:text-red-500">
                                Keluar Sistem
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>