<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">

        <div class="text-center mb-8">
            <h3 class="text-lg font-black text-slate-700 uppercase tracking-widest">Silakan Masuk</h3>
            <p class="text-xs text-slate-400 font-medium">Gunakan NIP dan Password Anda.</p>
        </div>

        <div class="space-y-2">
            <label for="nip" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nomor Induk Pegawai (NIP)</label>
            <div class="relative">
                <input wire:model="form.nip" id="nip" type="text" name="nip" required autofocus autocomplete="username"
                    class="block w-full rounded-xl border-2 border-slate-200 bg-slate-50 text-slate-900 font-bold focus:border-emerald-500 focus:bg-white focus:ring-0 transition-all py-3.5 px-4 shadow-sm placeholder-slate-300 text-sm"
                    placeholder="Contoh: 198501012010011001">

                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('form.nip')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label for="password" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Password</label>
            <div class="relative">
                <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full rounded-xl border-2 border-slate-200 bg-slate-50 text-slate-900 font-bold focus:border-emerald-500 focus:bg-white focus:ring-0 transition-all py-3.5 px-4 shadow-sm placeholder-slate-300 text-sm"
                    placeholder="••••••••">

                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded-lg border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500 transition cursor-pointer group-hover:border-emerald-400">
                <span class="ml-2 text-xs font-bold text-slate-500 uppercase tracking-wider group-hover:text-emerald-600 transition">Ingat Saya</span>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-4 bg-emerald-600 border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-[0.15em] hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-300 shadow-lg shadow-emerald-200 transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM6.166 5.106a.75.75 0 010 1.06 8.25 8.25 0 1011.668 0 .75.75 0 111.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.809 3.808-9.98 3.808-13.788 0-3.808-3.809-3.808-9.98 0-13.788a.75.75 0 011.06 0z" clip-rule="evenodd" />
                </svg>
                Masuk Sistem
            </button>
        </div>
    </form>
</div>