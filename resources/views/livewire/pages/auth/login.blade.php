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

<div class="min-h-screen w-full flex items-center justify-center bg-[#0a1615] relative overflow-hidden font-sans">

    <div class="absolute top-[-20%] left-[-10%] w-[70%] h-[70%] bg-[#10b981] opacity-[0.07] blur-[150px] rounded-full"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[60%] h-[60%] bg-[#0f766e] opacity-[0.1] blur-[150px] rounded-full"></div>

    <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(#10b981 0.5px, transparent 0.5px); background-size: 30px 30px;"></div>

    <div class="w-full max-w-lg z-10 px-6 py-12">
        <div class="text-center mb-10">
            <div class="relative inline-block group">
                <div class="absolute inset-0 bg-[#10b981] opacity-20 blur-2xl rounded-full group-hover:opacity-40 transition-opacity duration-500"></div>

                <div class="relative inline-flex items-center justify-center p-1 bg-gradient-to-br from-[#2d4a47] to-[#152624] rounded-2xl border border-[#3d5a57] shadow-2xl">
                    <div class="bg-[#0d1b1a] p-4 rounded-xl border border-[#10b981]/20">
                        <img src="{{ asset('logo-kejaksaan.png') }}"
                            alt="Logo Kejaksaan RI"
                            class="w-16 h-16 object-contain filter drop-shadow-[0_0_8px_rgba(16,185,129,0.4)]">
                    </div>
                </div>
            </div>

            <h2 class="mt-6 text-3xl font-black text-white tracking-[0.25em] uppercase leading-tight">
                Si-Intelijen <span class="text-[#10b981]">Kejaksaan</span>
            </h2>
            <div class="flex items-center justify-center gap-4 mt-3">
                <span class="h-[1px] w-10 bg-[#2d4a47]"></span>
                <p class="text-[#8e9a99] text-[11px] tracking-[0.5em] uppercase font-bold">Satya Adhi Wicaksana</p>
                <span class="h-[1px] w-10 bg-[#2d4a47]"></span>
            </div>
        </div>

        <div class="bg-[#152624]/40 backdrop-blur-3xl border border-[#2d4a47] rounded-[2.5rem] p-10 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] relative">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-[2px] bg-gradient-to-r from-transparent via-[#10b981] to-transparent shadow-[0_0_15px_#10b981]"></div>

            <x-auth-session-status class="mb-6 text-emerald-400 text-center text-sm font-medium" :status="session('status')" />

            <form wire:submit="login" class="space-y-7">
                <div class="group">
                    <label for="email" class="block text-[11px] font-bold text-[#10b981] uppercase tracking-[0.2em] mb-3 ml-2">ID Pengguna</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-[#4a5f5d] group-focus-within:text-[#10b981] transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input
                            wire:model="form.email"
                            id="email"
                            type="email"
                            required
                            autofocus
                            placeholder="Masukkan ID Pengguna"
                            class="w-full bg-[#0d1b1a]/60 border-[#2d4a47] focus:border-[#10b981] focus:ring-1 focus:ring-[#10b981] rounded-2xl py-4 pl-14 pr-6 text-gray-100 text-sm transition-all duration-300 placeholder:text-[#3d5a57]" />
                    </div>
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-xs text-red-400 font-medium ml-2" />
                </div>

                <div class="group">
                    <label for="password" class="block text-[11px] font-bold text-[#10b981] uppercase tracking-[0.2em] mb-3 ml-2">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-[#4a5f5d] group-focus-within:text-[#10b981] transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input
                            wire:model="form.password"
                            id="password"
                            type="password"
                            required
                            placeholder="••••••••••••"
                            class="w-full bg-[#0d1b1a]/60 border-[#2d4a47] focus:border-[#10b981] focus:ring-1 focus:ring-[#10b981] rounded-2xl py-4 pl-14 pr-6 text-gray-100 text-sm transition-all duration-300 placeholder:text-[#3d5a57]" />
                    </div>
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-xs text-red-400 font-medium ml-2" />
                </div>

                <div class="flex items-center justify-between text-[11px] px-2 font-black uppercase tracking-widest">
                    <label class="flex items-center cursor-pointer group text-[#8e9a99] hover:text-[#10b981] transition-colors">
                        <input wire:model="form.remember" type="checkbox" class="h-4 w-4 rounded border-[#2d4a47] bg-[#0d1b1a] text-[#10b981] focus:ring-[#10b981] transition cursor-pointer focus:ring-offset-[#0d1b1a]">
                        <span class="ml-2">Ingat Sesi</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" wire:navigate class="text-[#10b981] hover:text-white transition-colors">
                        Lupa Akses?
                    </a>
                    @endif
                </div>

                <div class="pt-4">
                    <button type="submit" class="group w-full bg-[#10b981] hover:bg-[#059669] text-[#0d1b1a] font-black py-4.5 rounded-2xl transition-all duration-300 shadow-[0_15px_30px_-10px_rgba(16,185,129,0.4)] active:scale-[0.98] uppercase tracking-[0.3em] text-[13px] flex justify-center items-center relative overflow-hidden">
                        <div class="absolute inset-0 w-full h-full bg-white/20 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

                        <span wire:loading.remove wire:target="login">Masuk Ke Sistem</span>
                        <span wire:loading wire:target="login" class="flex items-center">
                            <svg class="animate-spin h-5 w-5 mr-3 text-[#0d1b1a]" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memverifikasi...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-12 text-center">
            <p class="text-[10px] text-[#4a5f5d] uppercase tracking-[0.5em] font-black leading-[2]">
                Direktorat Intelijen <br> Kejaksaan Agung Republik Indonesia
                <span class="block mt-2 opacity-40 font-bold">&copy; 2025 • Versi 1.0.4</span>
            </p>
        </div>
    </div>
</div>