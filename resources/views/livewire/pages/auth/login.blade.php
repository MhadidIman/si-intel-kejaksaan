<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="fixed inset-0 w-full h-full flex flex-col items-center justify-center bg-[#040d0c] overflow-hidden font-sans">

    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[60%] h-[60%] bg-emerald-900/20 blur-[140px] rounded-full animate-pulse"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] bg-teal-800/10 blur-[140px] rounded-full animate-bounce" style="animation-duration: 10s"></div>

        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#10b981 0.5px, transparent 0.5px); background-size: 30px 30px;"></div>
    </div>

    <div class="w-full max-w-[440px] z-10 px-6">
        <div class="text-center mb-8 transform transition-all duration-700">
            <div class="flex justify-center mb-6">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>

                    <div class="relative bg-[#0a1a18] backdrop-blur-sm border border-emerald-500/20 p-5 rounded-3xl shadow-2xl">
                        <img src="{{ asset('img/logo-kejaksaan.png') }}" alt="Logo" class="w-20 h-20 object-contain filter drop-shadow-[0_0_8px_rgba(16,185,129,0.5)]">
                    </div>
                </div>
            </div>

            <h2 class="text-3xl font-black text-white tracking-tight leading-tight uppercase italic">
                Si-Intelijen <span class="text-emerald-500 not-italic">Kejaksaan</span>
            </h2>
            <div class="flex items-center justify-center gap-4 mt-3">
                <span class="h-[1px] w-10 bg-gradient-to-r from-transparent via-emerald-800 to-transparent"></span>
                <p class="text-emerald-500/60 text-[10px] tracking-[0.5em] uppercase font-bold">Satya Adhi Wicaksana</p>
                <span class="h-[1px] w-10 bg-gradient-to-r from-emerald-800 via-emerald-800 to-transparent"></span>
            </div>
        </div>

        <div class="relative group">
            <div class="absolute -inset-[1px] bg-gradient-to-b from-emerald-500/40 via-transparent to-emerald-500/10 rounded-[2.5rem] blur-[2px]"></div>

            <div class="relative bg-[#0a1a18]/90 backdrop-blur-2xl border border-white/5 rounded-[2.5rem] p-10 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.7)] overflow-hidden">

                <div class="absolute -top-24 -left-24 w-48 h-48 bg-emerald-500/10 blur-[60px] rounded-full"></div>

                <x-auth-session-status class="mb-6 text-emerald-400 text-center text-sm font-medium" :status="session('status')" />

                <form wire:submit="login" class="space-y-7">
                    <div class="space-y-2">
                        <label for="nip" class="block text-[11px] font-bold text-emerald-500/80 uppercase tracking-[0.2em] ml-2">Identitas NIP</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-900 group-focus-within/input:text-emerald-400 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input
                                wire:model="form.nip"
                                id="nip"
                                type="text"
                                required
                                autofocus
                                placeholder="Masukkan NIP Pegawai"
                                class="w-full bg-white/[0.03] border-emerald-900/40 focus:border-emerald-500/50 focus:ring-4 focus:ring-emerald-500/10 rounded-2xl py-4 pl-12 pr-4 text-emerald-50 text-sm transition-all duration-300 placeholder:text-emerald-900/30 shadow-inner" />
                        </div>
                        <x-input-error :messages="$errors->get('form.nip')" class="mt-2 text-[10px] text-red-400/80 font-medium italic ml-2" />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-[11px] font-bold text-emerald-500/80 uppercase tracking-[0.2em] ml-2">Kata Sandi</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-900 group-focus-within/input:text-emerald-400 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input
                                wire:model="form.password"
                                id="password"
                                type="password"
                                required
                                placeholder="••••••••"
                                class="w-full bg-white/[0.03] border-emerald-900/40 focus:border-emerald-500/50 focus:ring-4 focus:ring-emerald-500/10 rounded-2xl py-4 pl-12 pr-4 text-emerald-50 text-sm transition-all duration-300 placeholder:text-emerald-900/30 shadow-inner" />
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-[10px] text-red-400/80 font-medium italic ml-2" />
                    </div>

                    <div class="flex items-center px-2">
                        <label class="flex items-center cursor-pointer group/check">
                            <div class="relative flex items-center">
                                <input wire:model="form.remember" type="checkbox" class="peer h-4 w-4 rounded border-emerald-900 bg-black/40 text-emerald-600 focus:ring-offset-0 focus:ring-emerald-500 transition cursor-pointer">
                            </div>
                            <span class="ml-3 text-[11px] font-bold text-emerald-900 group-hover/check:text-emerald-500 transition-colors uppercase tracking-widest italic">Ingat Sesi Akses</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="relative w-full group/btn overflow-hidden rounded-2xl bg-emerald-600 p-[1px] transition-all duration-300 hover:shadow-[0_0_30px_rgba(16,185,129,0.4)] active:scale-[0.97]">
                            <div class="relative bg-emerald-600 hover:bg-emerald-500 text-[#061e1b] font-black py-4 rounded-2xl transition-all duration-300 uppercase tracking-[0.3em] text-[13px] flex justify-center items-center">
                                <span wire:loading.remove wire:target="login" class="flex items-center gap-2">
                                    Otorisasi Akses
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                                <span wire:loading wire:target="login" class="flex items-center">
                                    <svg class="animate-spin h-5 w-5 mr-3 text-[#061e1b]" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memverifikasi...
                                </span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-10 text-center">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-1.5 rounded-full bg-emerald-500/5 border border-emerald-500/10">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[8px] text-emerald-500/70 font-bold uppercase tracking-[0.2em]">Secure Encryption Active</span>
            </div>
            <p class="text-[10px] text-emerald-900 uppercase tracking-[0.4em] font-bold leading-relaxed">
                Kejaksaan Negeri Banjarmasin <br>
                <span class="opacity-40 font-medium tracking-normal text-[9px]">&copy; 2025 • Intelligence Asset Management Portal</span>
            </p>
        </div>
    </div>
</div>