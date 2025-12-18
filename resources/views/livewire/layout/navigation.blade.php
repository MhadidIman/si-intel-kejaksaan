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

<nav x-data="{ open: false }" class="bg-emerald-950/40 backdrop-blur-md border-b border-white/10 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex flex-col group">
                        <span class="font-black text-xl tracking-tight text-white leading-none group-hover:text-yellow-400 transition">SI-INTEL</span>
                        <span class="text-[10px] font-bold text-emerald-200 uppercase tracking-widest leading-none">Kejaksaan RI</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                        class="text-gray-300 hover:text-white border-transparent hover:border-yellow-400 focus:text-white focus:border-yellow-400 {{ request()->routeIs('dashboard') ? '!border-yellow-500 !text-yellow-400 font-bold' : '' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" wire:navigate
                        class="text-gray-300 hover:text-white border-transparent hover:border-yellow-400 focus:text-white focus:border-yellow-400 {{ request()->routeIs('users.index') ? '!border-yellow-500 !text-yellow-400 font-bold' : '' }}">
                        {{ __('Personil') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-emerald-100 bg-white/10 hover:bg-white/20 hover:text-white focus:outline-none transition ease-in-out duration-150 backdrop-blur-sm">
                                    <div>Bank Data Intel</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase tracking-wider">
                                    Bidang Operasional
                                </div>
                                <x-dropdown-link :href="route('lapinhar.index')" wire:navigate>Laporan Informasi (LAPINHAR)</x-dropdown-link>
                                <x-dropdown-link :href="route('dpo.index')" wire:navigate>Data DPO / Tangbur</x-dropdown-link>
                                <x-dropdown-link :href="route('wna.index')" wire:navigate>Pengawasan Orang Asing</x-dropdown-link>
                                <x-dropdown-link :href="route('ormas.index')" wire:navigate>Data Ormas & PAKEM</x-dropdown-link>

                                <div class="border-t border-gray-100 my-1"></div>

                                <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase tracking-wider">
                                    Giat & Pelayanan
                                </div>
                                <x-dropdown-link :href="route('pam-sdo.index')" wire:navigate>PAM SDO</x-dropdown-link>
                                <x-dropdown-link :href="route('jms.index')" wire:navigate>Jaksa Masuk Sekolah</x-dropdown-link>
                                <x-dropdown-link :href="route('kerawanan.index')" wire:navigate>Peta Kerawanan</x-dropdown-link>
                                <x-dropdown-link :href="route('lapdu.index')" wire:navigate>Pengaduan Masyarakat</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-emerald-100 bg-white/10 hover:text-white hover:bg-white/20 focus:outline-none transition ease-in-out duration-150 backdrop-blur-sm">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <button wire:click="logout" class="w-full text-start text-red-600">
                            <x-dropdown-link class="text-red-600">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-emerald-200 hover:text-white hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-emerald-950/90 backdrop-blur-xl border-t border-white/10">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-gray-300 hover:text-white hover:bg-white/10 {{ request()->routeIs('dashboard') ? '!bg-white/10 !text-yellow-400 !border-yellow-400' : '' }}">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" wire:navigate class="text-gray-300 hover:text-white hover:bg-white/10 {{ request()->routeIs('users.index') ? '!bg-white/10 !text-yellow-400 !border-yellow-400' : '' }}">
                {{ __('Personil') }}
            </x-responsive-nav-link>

            <div class="border-t border-white/10 my-2"></div>
            <div class="px-4 py-2 text-xs font-semibold text-emerald-400 uppercase tracking-widest">
                Bank Data Intelijen
            </div>

            <x-responsive-nav-link :href="route('lapinhar.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - LAPINHAR
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dpo.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - Data DPO
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('wna.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - Orang Asing
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('ormas.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - Ormas & PAKEM
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pam-sdo.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - PAM SDO
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jms.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - JMS
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kerawanan.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - Peta Kerawanan
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('lapdu.index')" wire:navigate class="pl-8 text-gray-400 hover:text-white text-sm">
                - Lapdu
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-white/10 bg-black/20">
            <div class="px-4">
                <div class="font-medium text-base text-white" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-400">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="text-gray-300 hover:text-white hover:bg-white/10">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="text-red-400 hover:text-red-300 hover:bg-red-900/20">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>