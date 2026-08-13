<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // OTOMATIS JADIKAN MASYARAKAT
        $validated['role'] = 'masyarakat';

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        // ARAHKAN KE HALAMAN LAPOR SETELAH DAFTAR
        $this->redirect(route('publik.lapor', absolute: false), navigate: true);
    }
}; ?>

<div class="bg-white p-8 sm:p-10 rounded-3xl shadow-[0_20px_50px_rgba(16,185,129,0.1)] border border-emerald-100 relative overflow-hidden">
    {{-- Aksen Dekoratif --}}
    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-bl-full -z-10"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-amber-400/10 rounded-tr-full -z-10"></div>

    <div class="text-center mb-8">
        <h2 class="text-2xl font-black text-slate-800 dark:text-slate-100 tracking-tight">Buat Akun Pelapor</h2>
        <p class="text-xs text-slate-500 mt-2 font-medium">Sistem Pengaduan Masyarakat Terpadu</p>
    </div>

    <form wire:submit="register" class="space-y-5">
        <div>
            <x-input-label for="name" value="Nama Lengkap KTP" class="text-slate-700 font-bold" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Alamat Email Aktif" class="text-slate-700 font-bold" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Kata Sandi" class="text-slate-700 font-bold" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Ulangi Kata Sandi" class="text-slate-700 font-bold" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-lg shadow-emerald-600/30">
                Daftar Akun Sekarang
            </button>
            <div class="text-center text-sm text-slate-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" wire:navigate class="font-bold text-emerald-600 hover:text-emerald-500">Masuk di sini</a>
            </div>
        </div>
    </form>
</div>