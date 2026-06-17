<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $nik = '';
    public string $no_hp = '';
    public string $jabatan = '';
    public string $nip = '';
    public string $pangkat = '';
    public string $satuan_kerja = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nik = $user->nik ?? '';
        $this->no_hp = $user->no_hp ?? '';
        $this->jabatan = $user->jabatan ?? '';
        $this->nip = $user->nip ?? '';
        $this->pangkat = $user->pangkat ?? '';
        $this->satuan_kerja = $user->satuan_kerja ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'nik' => ['nullable', 'string', 'digits:16', Rule::unique(User::class)->ignore($user->id)],
            'no_hp' => ['required', 'string', 'max:20'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:50', Rule::unique(User::class)->ignore($user->id)],
            'pangkat' => ['nullable', 'string', 'max:255'],
            'satuan_kerja' => ['nullable', 'string', 'max:255'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }
}; ?>

<section class="font-sans">
    <header class="mb-6">
        <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-xs text-slate-500 font-medium">
            {{ __('Perbarui informasi profil akun dan alamat email Anda.') }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="space-y-5">
        {{-- FIELD UMUM (BERLAKU UNTUK SEMUA ROLE) --}}
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
            <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800">
                {{ __('Alamat email Anda belum terverifikasi.') }}
                <button form="send-verification" class="underline font-bold text-amber-900 hover:text-amber-700 ml-1">
                    {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                </button>
            </div>
            @endif
        </div>

        <div>
            <x-input-label for="no_hp" :value="__('Nomor HP / WhatsApp')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="no_hp" id="no_hp" name="no_hp" type="text" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm font-mono" required />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>

        {{-- PERCABANGAN FORM BERDASARKAN ROLE PENGGUNA --}}
        @if(auth()->user()->role === 'masyarakat')
        {{-- ATRIBUT KHUSUS AKUN MASYARAKAT --}}
        <div>
            <x-input-label for="nik" :value="__('NIK (Nomor Induk Kependudukan)')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="nik" id="nik" name="nik" type="text" maxlength="16" readonly class="block mt-1 w-full bg-slate-200 text-slate-500 cursor-not-allowed border-slate-200 rounded-xl text-sm font-mono shadow-inner" />
            <span class="text-[10px] text-emerald-600 font-bold mt-1 block"><i class="fas fa-lock"></i> NIK telah dikunci sistem demi validitas data hukum</span>
            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
        </div>

        <div>
            <x-input-label for="jabatan" :value="__('Pekerjaan / Profesi')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="jabatan" id="jabatan" name="jabatan" type="text" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm" placeholder="Contoh: Wiraswasta, Karyawan Swasta" />
            <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
        </div>
        @else
        {{-- ATRIBUT KHUSUS AKUN INTERNAL (ADMIN / STAFF) --}}
        <div>
            <x-input-label for="nip" :value="__('NIP (Nomor Induk Pegawai)')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="nip" id="nip" name="nip" type="text" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm font-mono" />
            <x-input-error class="mt-2" :messages="$errors->get('nip')" />
        </div>

        <div>
            <x-input-label for="pangkat" :value="__('Pangkat / Golongan')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="pangkat" id="pangkat" name="pangkat" type="text" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm" placeholder="Contoh: Penata Muda (III/a)" />
            <x-input-error class="mt-2" :messages="$errors->get('pangkat')" />
        </div>

        <div>
            <x-input-label for="jabatan" :value="__('Jabatan Dinas')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="jabatan" id="jabatan" name="jabatan" type="text" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm" placeholder="Contoh: Jaksa Fungsional, Staff Intelijen" />
            <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
        </div>

        <div>
            <x-input-label for="satuan_kerja" :value="__('Satuan Kerja')" class="text-xs font-bold text-slate-700 uppercase tracking-wider" />
            <x-text-input wire:model="satuan_kerja" id="satuan_kerja" name="satuan_kerja" type="text" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm" />
            <x-input-error class="mt-2" :messages="$errors->get('satuan_kerja')" />
        </div>
        @endif

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-lg shadow-emerald-600/20 flex items-center gap-2">
                <i class="fas fa-save"></i> {{ __('Simpan Perubahan') }}
            </button>

            <x-action-message class="text-xs font-bold text-emerald-600" on="profile-updated">
                <i class="fas fa-check-circle"></i> {{ __('Berhasil disimpan.') }}
            </x-action-message>
        </div>
    </form>
</section>