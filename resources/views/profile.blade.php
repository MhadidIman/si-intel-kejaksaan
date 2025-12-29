<x-app-layout>
    <div class="py-12 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="flex items-center gap-4 mb-8">
                <div class="p-3 bg-emerald-50 rounded-2xl border border-emerald-100 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-emerald-600">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Pengaturan Akun</h2>
                    <p class="text-sm text-slate-500 font-medium">Kelola informasi profil, NIP, dan keamanan akun Anda.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">

                <div class="p-8 bg-white shadow-sm sm:rounded-[2rem] border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-emerald-500"></div>
                    <div class="max-w-xl">
                        <livewire:profile.update-profile-information-form />
                    </div>
                </div>

                <div class="p-8 bg-white shadow-sm sm:rounded-[2rem] border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-amber-500"></div>
                    <div class="max-w-xl">
                        <livewire:profile.update-password-form />
                    </div>
                </div>

                <div class="p-8 bg-white shadow-sm sm:rounded-[2rem] border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-red-500"></div>
                    <div class="max-w-xl">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>