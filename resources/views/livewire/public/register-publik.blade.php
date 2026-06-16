<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.public')] class extends Component
{
    public string $nik = '';
    public string $name = '';
    public string $email = '';
    public string $no_hp = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;

    public function register(): void
    {
        $validated = $this->validate([
            'nik' => ['required', 'numeric', 'digits:16', 'unique:users,nik'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'no_hp' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'terms' => ['accepted']
        ], [
            'nik.digits' => 'NIK wajib terdiri dari 16 digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar dalam sistem.',
            'terms.accepted' => 'Anda wajib menyetujui pernyataan tanggung jawab hukum.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        $user = User::create([
            'nik' => $validated['nik'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'password' => Hash::make($validated['password']),
            'role' => 'masyarakat', // Kunci role otomatis
        ]);

        // Mengirimkan Link Verifikasi Ke Email (Wajib implementasi MustVerifyEmail di Model User)
        event(new Registered($user));

        Auth::login($user);

        // Arahkan ke halaman pemberitahuan untuk cek email (Fitur bawaan Laravel Breeze)
        $this->redirectRoute('verification.notice', navigate: true);
    }
}; ?>

<div class="min-h-screen bg-white flex">
    {{-- BAGIAN KIRI: Form Pendaftaran --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-12">

        <div class="mb-10 text-center lg:text-left">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Registrasi Pelapor</h2>
            <p class="text-slate-500 text-sm mt-2 font-medium">Buat akun untuk mengajukan Laporan Pengaduan (Lapdu) dan memantau perkembangannya.</p>
        </div>

        <form wire:submit="register" class="space-y-5">
            {{-- DATA IDENTITAS KTP --}}
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-4">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-emerald-600 border-b border-slate-200 pb-2"><i class="fas fa-id-card mr-1"></i> 1. Identitas Sesuai KTP</h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                    <input wire:model="nik" type="text" maxlength="16" placeholder="16 Digit Angka NIK" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 font-mono text-sm bg-white">
                    @error('nik') <span class="text-[10px] font-bold text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input wire:model="name" type="text" placeholder="Sesuai KTP" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm bg-white">
                    @error('name') <span class="text-[10px] font-bold text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- DATA KONTAK --}}
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-4">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-emerald-600 border-b border-slate-200 pb-2"><i class="fas fa-address-book mr-1"></i> 2. Data Kontak & Login</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email Aktif <span class="text-red-500">*</span></label>
                        <input wire:model="email" type="email" placeholder="email@contoh.com" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm bg-white">
                        @error('email') <span class="text-[10px] font-bold text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp / HP <span class="text-red-500">*</span></label>
                        <input wire:model="no_hp" type="text" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 font-mono text-sm bg-white">
                        @error('no_hp') <span class="text-[10px] font-bold text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- KEAMANAN AKUN --}}
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-4">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-emerald-600 border-b border-slate-200 pb-2"><i class="fas fa-lock mr-1"></i> 3. Keamanan Akun</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi <span class="text-red-500">*</span></label>
                        <input wire:model="password" type="password" placeholder="Minimal 8 karakter" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm bg-white">
                        @error('password') <span class="text-[10px] font-bold text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
                        <input wire:model="password_confirmation" type="password" placeholder="Ulangi kata sandi" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm bg-white">
                    </div>
                </div>
            </div>

            {{-- VALIDASI HUKUM --}}
            <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl">
                <label class="flex items-start cursor-pointer">
                    <div class="flex items-center h-5 mt-0.5">
                        <input wire:model="terms" type="checkbox" class="w-5 h-5 text-amber-600 bg-white border-amber-300 rounded focus:ring-amber-500 focus:ring-2 transition cursor-pointer">
                    </div>
                    <div class="ml-3 text-xs">
                        <span class="font-black text-amber-900 block mb-1">Pernyataan Validitas Hukum <span class="text-red-500">*</span></span>
                        <span class="text-amber-800 font-medium leading-relaxed">
                            Saya menyatakan bahwa seluruh data identitas yang diberikan adalah <strong>BENAR</strong>. Saya bersedia mempertanggungjawabkannya secara hukum apabila di kemudian hari ditemukan pemalsuan identitas atau laporan fiktif (Hoax).
                        </span>
                    </div>
                </label>
                @error('terms') <span class="text-[10px] font-bold text-red-500 mt-2 block ml-8">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full py-4 bg-slate-900 hover:bg-slate-800 text-white font-black text-sm uppercase tracking-widest rounded-xl transition shadow-xl shadow-slate-900/20 flex items-center justify-center gap-2">
                <span wire:loading.remove wire:target="register"><i class="fas fa-user-plus text-emerald-400"></i> Buat Akun Publik</span>
                <span wire:loading wire:target="register"><i class="fas fa-circle-notch fa-spin text-emerald-400"></i> Memproses...</span>
            </button>

            <p class="text-center text-xs text-slate-500 font-medium pt-2">
                Sudah memiliki akun? <a href="{{ route('publik.login') }}" wire:navigate class="font-bold text-emerald-600 hover:underline">Masuk di sini</a>
            </p>
        </form>
    </div>

    {{-- BAGIAN KANAN: Visual Edukasi (Hanya muncul di Desktop) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-slate-900 relative overflow-hidden items-center justify-center p-12">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute -right-20 -bottom-20 opacity-5 pointer-events-none">
            <i class="fas fa-shield-alt text-[30rem] text-emerald-400 transform -rotate-12"></i>
        </div>

        <div class="relative z-10 max-w-md text-center">
            <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-28 mx-auto mb-8 drop-shadow-2xl" alt="Logo Kejaksaan">
            <h2 class="text-3xl font-black text-white mb-4">Sistem Terintegrasi Intelijen Kejaksaan</h2>
            <p class="text-emerald-400 font-bold uppercase tracking-widest text-xs mb-8 border-b border-slate-700 pb-6">Transparansi, Integritas, Kepastian Hukum</p>

            <div class="space-y-6 text-left">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/30"><i class="fas fa-lock"></i></div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Privasi Terjamin</h4>
                        <p class="text-slate-400 text-xs mt-1 leading-relaxed">Data NIK dan identitas Anda dienkripsi secara aman dan dilindungi Undang-Undang Perlindungan Saksi.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center shrink-0 border border-blue-500/30"><i class="fas fa-bell"></i></div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Notifikasi Real-time</h4>
                        <p class="text-slate-400 text-xs mt-1 leading-relaxed">Dapatkan pembaruan langsung (update) atas status penanganan laporan pengaduan Anda ke email.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>