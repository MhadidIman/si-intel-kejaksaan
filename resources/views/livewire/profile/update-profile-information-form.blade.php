<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $nip = ''; // GANTI EMAIL KE NIP

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->nip = $user->nip; // AMBIL NIP
    }

    /**
     * Update the profile information.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            // VALIDASI NIP (Harus unik kecuali punya sendiri)
            'nip' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        // Jika NIP berubah, reset verifikasi (opsional, jika pakai verifikasi email/nip)
        if ($user->isDirty('nip')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification. (Bisa dihapus jika tidak pakai email)
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header class="mb-6">
        <h2 class="text-lg font-black text-slate-900 uppercase tracking-widest">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __("Perbarui nama lengkap dan Nomor Induk Pegawai (NIP) akun Anda.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="space-y-6">
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="!text-xs !font-black !text-slate-500 !uppercase !tracking-widest" />
            <x-text-input wire:model="name" id="name" name="name" type="text"
                class="mt-1 block w-full !rounded-xl !border-2 !border-slate-200 !bg-slate-50 focus:!border-emerald-500 focus:!ring-0 font-bold text-slate-800"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-input-label for="nip" :value="__('Nomor Induk Pegawai (NIP)')" class="!text-xs !font-black !text-slate-500 !uppercase !tracking-widest" />
            <x-text-input wire:model="nip" id="nip" name="nip" type="text"
                class="mt-1 block w-full !rounded-xl !border-2 !border-slate-200 !bg-slate-50 focus:!border-emerald-500 focus:!ring-0 font-bold text-slate-800"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('nip')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="!bg-emerald-600 hover:!bg-emerald-700 !rounded-xl !py-3 !px-6 !font-black !uppercase !tracking-widest shadow-lg shadow-emerald-200 transition-transform hover:-translate-y-1">
                {{ __('Simpan Perubahan') }}
            </x-primary-button>

            <x-action-message class="me-3 font-bold text-emerald-600" on="profile-updated">
                {{ __('Tersimpan.') }}
            </x-action-message>
        </div>
    </form>
</section>