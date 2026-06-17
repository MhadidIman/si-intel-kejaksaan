@if(auth()->user()->role === 'masyarakat')
{{-- ==================================================================== --}}
{{-- 1. TAMPILAN PROFIL PORTAL PUBLIK (UNTUK MASYARAKAT)                  --}}
{{-- ==================================================================== --}}
<div class="min-h-screen bg-slate-50 font-sans">
    {{-- Memanggil Navbar Publik --}}
    <livewire:layout.navigation-publik />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Header Ringkasan Akun Warga --}}
        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-200/50 border border-slate-100 mb-8 flex flex-col md:flex-row items-center gap-6 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 opacity-5 text-emerald-800 pointer-events-none">
                <i class="fas fa-user text-[12rem]"></i>
            </div>
            <div class="w-20 h-20 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl shadow-inner shrink-0 border border-emerald-100">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="text-center md:text-left grow">
                <div class="flex flex-col md:flex-row md:items-center gap-2 mb-2">
                    <h2 class="text-xl font-black text-slate-800">{{ auth()->user()->name }}</h2>
                    <span class="inline-block px-3 py-1 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-full font-black text-[10px] uppercase tracking-wider mx-auto md:mx-0">
                        Masyarakat Umum
                    </span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-1.5 text-xs text-slate-500 font-medium">
                    <p><i class="fas fa-id-card text-slate-400 w-5"></i> <strong>NIK:</strong> {{ auth()->user()->nik ?? '-' }}</p>
                    <p><i class="fas fa-envelope text-slate-400 w-5"></i> <strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><i class="fas fa-phone text-slate-400 w-5"></i> <strong>No. HP:</strong> {{ auth()->user()->no_hp ?? '-' }}</p>
                    <p><i class="fas fa-briefcase text-slate-400 w-5"></i> <strong>Pekerjaan:</strong> {{ auth()->user()->jabatan ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Formulir Update Data & Password --}}
        <div class="space-y-8">
            <div class="bg-white p-6 md:p-8 shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="bg-white p-6 md:p-8 shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>
        </div>
    </div>
</div>

@else
{{-- ==================================================================== --}}
{{-- 2. TAMPILAN PROFIL PORTAL INTERNAL (UNTUK ADMIN / STAFF KEJAKSAAN)  --}}
{{-- ==================================================================== --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-slate-800 leading-tight uppercase tracking-tight">
            {{ __('Manajemen Akun Petugas') }}
        </h2>
    </x-slot>

    <div class="py-12 font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Kartu Identitas Resmi Kejaksaan --}}
            <div class="bg-slate-950 text-white rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden border border-slate-800">
                <div class="absolute -right-16 -bottom-16 opacity-10 text-emerald-400 pointer-events-none">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-72 h-auto">
                </div>

                <div class="flex flex-col md:flex-row items-center gap-6 relative z-10">
                    <div class="w-24 h-24 rounded-2xl bg-emerald-900/50 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-4xl shadow-2xl shrink-0 backdrop-blur-sm">
                        <i class="fas fa-id-badge"></i>
                    </div>

                    <div class="text-center md:text-left grow">
                        <div class="flex flex-col md:flex-row md:items-center gap-3 mb-3">
                            <h3 class="text-2xl font-black tracking-tight text-white">{{ auth()->user()->name }}</h3>
                            <span class="inline-block px-3 py-1 bg-amber-500 text-slate-950 rounded-full font-black text-[10px] uppercase tracking-widest mx-auto md:mx-0 shadow-lg shadow-amber-500/20">
                                {{ auth()->user()->role === 'admin' ? 'Kasi Intelijen / Admin' : 'Staff Intelijen' }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-300 font-medium border-t border-slate-800 pt-4 mt-2">
                            <p><i class="fas fa-key text-emerald-400 w-5"></i> <strong>NIP:</strong> {{ auth()->user()->nip ?? '-' }}</p>
                            <p><i class="fas fa-shield-alt text-emerald-400 w-5"></i> <strong>Pangkat / Gol:</strong> {{ auth()->user()->pangkat ?? '-' }}</p>
                            <p><i class="fas fa-sitemap text-emerald-400 w-5"></i> <strong>Jabatan:</strong> {{ auth()->user()->jabatan ?? '-' }}</p>
                            <p><i class="fas fa-building text-emerald-400 w-5"></i> <strong>Satuan Kerja:</strong> {{ auth()->user()->satuan_kerja ?? 'Kejari Banjarmasin' }}</p>
                            <p><i class="fas fa-envelope text-emerald-400 w-5"></i> <strong>Email Dinas:</strong> {{ auth()->user()->email }}</p>
                            <p><i class="fas fa-phone text-emerald-400 w-5"></i> <strong>No. HP:</strong> {{ auth()->user()->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Formulir Konfigurasi Internal --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white p-6 md:p-8 shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-6 border-b border-slate-100 pb-3">Update Data Diri Petugas</h4>
                    <livewire:profile.update-profile-information-form />
                </div>

                <div class="bg-white p-6 md:p-8 shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-6 border-b border-slate-100 pb-3">Perbarui Password Akun</h4>
                    <livewire:profile.update-password-form />
                </div>
            </div>

            {{-- Opsi Hapus Akun (Hanya Muncul jika Bukan Eksekutif Tertinggi/Admin Utama demi Keamanan) --}}
            @if(auth()->user()->role !== 'admin')
            <div class="bg-white p-6 md:p-8 shadow-xl shadow-slate-200/50 rounded-3xl border border-rose-100 bg-gradient-to-r from-white to-rose-50/20">
                <h4 class="text-sm font-black text-rose-800 uppercase tracking-wider mb-2">Zona Bahaya</h4>
                <p class="text-xs text-slate-500 font-medium mb-4">Setelah akun dihapus, semua data operasional penugasan yang terkait mungkin akan mengalami penyesuaian hak akses.</p>
                <livewire:profile.delete-user-form />
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
@endif