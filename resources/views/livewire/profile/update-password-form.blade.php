<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <header class="mb-6">
        <h2 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-widest">
            {{ __('Perbarui Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('Pastikan akun Anda aman dengan menggunakan password yang kuat.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="space-y-6">
        <div class="space-y-2">
            <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" class="!text-xs !font-black !text-slate-500 !uppercase !tracking-widest" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full !rounded-xl !border-2 !border-slate-200 !bg-slate-50 dark:bg-slate-900/50 focus:!border-amber-500 focus:!ring-0 font-bold text-slate-800 dark:text-slate-100"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password" :value="__('Password Baru')" class="!text-xs !font-black !text-slate-500 !uppercase !tracking-widest" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password"
                class="mt-1 block w-full !rounded-xl !border-2 !border-slate-200 !bg-slate-50 dark:bg-slate-900/50 focus:!border-amber-500 focus:!ring-0 font-bold text-slate-800 dark:text-slate-100"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password')" class="!text-xs !font-black !text-slate-500 !uppercase !tracking-widest" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full !rounded-xl !border-2 !border-slate-200 !bg-slate-50 dark:bg-slate-900/50 focus:!border-amber-500 focus:!ring-0 font-bold text-slate-800 dark:text-slate-100"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="!bg-amber-500 hover:!bg-amber-600 !rounded-xl !py-3 !px-6 !font-black !uppercase !tracking-widest shadow-lg shadow-amber-200 transition-transform hover:-translate-y-1">
                {{ __('Update Password') }}
            </x-primary-button>

            <x-action-message class="me-3 font-bold text-amber-600" on="password-updated">
                {{ __('Password Berhasil Diubah.') }}
            </x-action-message>
        </div>
    </form>
</section>