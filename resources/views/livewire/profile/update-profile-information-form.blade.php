<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads; // Wajib ditambahkan untuk fitur upload file

    public string $name = '';
    public string $email = '';

    // Properti untuk Foto Profil
    public $foto_profile;
    public $foto_lama;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->foto_lama = Auth::user()->foto_profile;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'foto_profile' => ['nullable', 'image', 'max:2048'], // Validasi Foto Max 2MB
        ]);

        $user->fill([
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Logika Upload Foto Profil
        if ($this->foto_profile) {
            // Hapus foto lama jika ada
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }
            // Simpan foto baru
            $user->foto_profile = $this->foto_profile->store('profile-photos', 'public');

            // Perbarui preview foto lama dengan yang baru disimpan
            $this->foto_lama = $user->foto_profile;

            // Kosongkan inputan file agar bersih kembali
            $this->foto_profile = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
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
    <header>
        <h2 class="text-lg font-black text-slate-800 uppercase tracking-widest">
            <i class="fas fa-id-card text-emerald-500 mr-2"></i> {{ __('Profil & Kontak') }}
        </h2>
        <p class="mt-1 text-xs text-slate-500 font-medium leading-relaxed max-w-sm">
            {{ __("Perbarui foto identitas dan alamat email login Anda.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">

        <div class="space-y-2">
            <x-input-label value="Foto Profil" class="text-[10px] font-black uppercase tracking-widest text-slate-500" />
            <div class="flex items-center gap-6 p-4 border border-dashed border-slate-300 rounded-xl bg-slate-50 hover:border-emerald-300 transition-colors">

                <div class="shrink-0">
                    @if ($foto_profile)
                    <img src="{{ $foto_profile->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-full border-2 border-emerald-500 shadow-sm">
                    @elseif ($foto_lama)
                    <img src="{{ asset('storage/' . $foto_lama) }}" class="w-16 h-16 object-cover rounded-full border-2 border-slate-200 shadow-sm">
                    @else
                    <div class="w-16 h-16 bg-slate-200 rounded-full border-2 border-slate-300 flex items-center justify-center text-slate-400">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                    @endif
                </div>

                <div class="flex-1 min-w-0">
                    <input wire:model="foto_profile" type="file" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition cursor-pointer shadow-sm">
                    <p class="text-[9px] text-slate-400 mt-2 font-bold tracking-wider uppercase">Max: 2MB (JPG/PNG)</p>
                </div>
            </div>
            <x-input-error class="mt-2 text-[10px] uppercase font-bold" :messages="$errors->get('foto_profile')" />
        </div>

        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[10px] font-black uppercase tracking-widest text-slate-500" />
            <div class="relative">
                <x-text-input wire:model="name" id="name" name="name" type="text" class="block w-full bg-slate-100 text-slate-500 cursor-not-allowed border-slate-200 font-bold" required disabled readonly />
                <i class="fas fa-lock absolute right-4 top-3 text-slate-400 text-xs"></i>
            </div>
        </div>

        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Login')" class="text-[10px] font-black uppercase tracking-widest text-slate-500" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500/20 font-bold text-slate-700" required autocomplete="username" />
            <x-input-error class="mt-2 text-[10px] uppercase font-bold" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-6 border-t border-slate-100">
            <button type="submit" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg shadow-emerald-500/30 transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Profil
            </button>

            <span wire:loading wire:target="foto_profile, updateProfileInformation" class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest flex items-center gap-2">
                <i class="fas fa-spinner fa-spin"></i> Memproses...
            </span>

            <x-action-message class="me-3 text-emerald-600 font-black text-[10px] uppercase tracking-widest flex items-center gap-2" on="profile-updated">
                <i class="fas fa-check-circle text-sm"></i> {{ __('Berhasil Disimpan') }}
            </x-action-message>
        </div>
    </form>
</section>