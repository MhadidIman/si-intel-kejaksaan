<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-white leading-tight uppercase tracking-[0.2em]">
            {{ __('Pengaturan Profil Personil') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#061e1b] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="p-8 bg-[#0a2623]/80 backdrop-blur-xl border border-emerald-500/10 shadow-2xl sm:rounded-[2rem]">
                <div class="max-w-xl">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-emerald-500 uppercase tracking-widest">Informasi Dasar</h3>
                        <p class="mt-1 text-sm text-emerald-100/50">Perbarui informasi profil dan alamat email akun Anda.</p>
                    </div>
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-8 bg-[#0a2623]/80 backdrop-blur-xl border border-emerald-500/10 shadow-2xl sm:rounded-[2rem]">
                <div class="max-w-xl">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-emerald-500 uppercase tracking-widest">Keamanan Akun</h3>
                        <p class="mt-1 text-sm text-emerald-100/50">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
                    </div>
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-8 bg-red-950/20 backdrop-blur-xl border border-red-500/10 shadow-2xl sm:rounded-[2rem]">
                <div class="max-w-xl">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-red-400 uppercase tracking-widest">Hapus Akses</h3>
                        <p class="mt-1 text-sm text-red-200/50">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
                    </div>
                    <livewire:profile.delete-user-form />
                </div>
            </div>

        </div>
    </div>
</x-app-layout>