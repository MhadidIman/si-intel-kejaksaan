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

<nav x-data="{ open: false }" class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-900 border-b border-emerald-700 sticky top-0 z-50 shadow-md">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex flex-col group">
                        <span class="font-black text-2xl tracking-tighter text-white leading-none group-hover:text-yellow-400 transition">SI-INTEL</span>
                        <span class="text-[10px] font-bold text-emerald-200 uppercase tracking-widest leading-none">Kejaksaan RI</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                        class="text-emerald-100 hover:text-white border-transparent hover:border-yellow-400 focus:text-white focus:border-yellow-400 {{ request()->routeIs('dashboard') ? '!border-yellow-500 !text-yellow-400 font-bold' : '' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" wire:navigate
                        class="text-emerald-100 hover:text-white border-transparent hover:border-yellow-400 focus:text-white focus:border-yellow-400 {{ request()->routeIs('users.index') ? '!border-yellow-500 !text-yellow-400 font-bold' : '' }}">
                        {{ __('Personil') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-emerald-100 bg-emerald-800/50 hover:bg-emerald-700 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                    <div>Bank Data Intel</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 text-[10px] text-emerald-700 uppercase tracking-wider font-extrabold bg-emerald-50 border-b border-emerald-100">
                                    Bidang Operasional
                                </div>
                                <x-dropdown-link :href="route('lapinhar.index')" wire:navigate>Laporan Informasi (LAPINHAR)</x-dropdown-link>
                                <x-dropdown-link :href="route('dpo.index')" wire:navigate>Data DPO / Tangbur</x-dropdown-link>
                                <x-dropdown-link :href="route('wna.index')" wire:navigate>Pengawasan Orang Asing</x-dropdown-link>
                                <x-dropdown-link :href="route('ormas.index')" wire:navigate>Data Ormas & PAKEM</x-dropdown-link>

                                <div class="px-4 py-2 text-[10px] text-emerald-700 uppercase tracking-wider font-extrabold bg-emerald-50 border-t border-b border-emerald-100 mt-1">
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
                        <button class="inline-flex items-center px-3 py-2 border border-emerald-600 text-sm leading-4 font-medium rounded-full text-emerald-100 bg-emerald-800 hover:bg-emerald-700 hover:text-white focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-xs text-gray-500">Login Sebagai:</p>
                            <p class="font-bold text-gray-800 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile Saya') }}
                        </x-dropdown-link>

                        <button wire:click="logout" class="w-full text-start text-red-600 hover:bg-red-50">
                            <x-dropdown-link class="text-red-600">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-emerald-200 hover:text-white hover:bg-emerald-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-emerald-900 border-t border-emerald-800 shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="!text-emerald-100 hover:!bg-emerald-800 hover:!text-white border-l-4 border-transparent hover:border-yellow-400 {{ request()->routeIs('dashboard') ? '!bg-emerald-800 !text-white !border-yellow-500' : '' }}">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" wire:navigate class="!text-emerald-100 hover:!bg-emerald-800 hover:!text-white border-l-4 border-transparent hover:border-yellow-400">
                {{ __('Data Personil') }}
            </x-responsive-nav-link>

            <div class="mt-2 pt-2 pb-2 bg-emerald-950/50">
                <div class="px-4 py-2 text-[10px] font-black text-yellow-500 uppercase tracking-widest">Bank Data Intelijen</div>

                <x-responsive-nav-link :href="route('lapinhar.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - LAPINHAR
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dpo.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - Data DPO
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('wna.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - Orang Asing
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('ormas.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - Ormas & PAKEM
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pam-sdo.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - PAM SDO
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('jms.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - JMS
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kerawanan.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - Peta Kerawanan
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('lapdu.index')" wire:navigate class="!text-emerald-200 hover:!text-white pl-8 text-xs">
                    - Lapdu
                </x-responsive-nav-link>
            </div>
        </div>

        <div class="pt-4 pb-1 border-t border-emerald-800 bg-emerald-950">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-700 flex items-center justify-center text-emerald-200 font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-base text-white" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-xs text-emerald-400">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2 pb-2">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="rounded-lg !text-emerald-200 hover:!bg-emerald-800 hover:!text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="rounded-lg !text-red-300 hover:!bg-red-900/30 hover:!text-red-200">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>