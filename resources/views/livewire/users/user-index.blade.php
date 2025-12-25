<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Manajemen Personil</h2>
                <p class="text-sm text-emerald-400 mt-1">Kelola hak akses Jaksa dan Staf Intelijen Kejaksaan RI.</p>
            </div>

            @if(!$showForm)
            <button wire:click="create" class="group bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-emerald-900/50 hover:shadow-emerald-500/30 transition-all duration-300 flex items-center gap-2 border border-emerald-500/50">
                <svg class="w-5 h-5 group-hover:rotate-90 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Personil</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-emerald-900/80 backdrop-blur-sm border-l-4 border-emerald-500 text-emerald-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative">
            <div class="bg-white/5 px-6 py-4 border-b border-white/10 flex justify-between items-center">
                <h3 class="font-bold text-white text-lg">
                    {{ $isEditMode ? 'Edit Data Personil' : 'Tambah Personil Baru' }}
                </h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 md:p-8">
                <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-300 px-1 uppercase tracking-wider">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input wire:model="name" type="text" class="pl-10 block w-full rounded-lg bg-black/40 border-white/10 text-white placeholder-gray-600 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-inner py-3" placeholder="Nama Lengkap">
                        </div>
                        @error('name') <span class="text-red-400 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-300 px-1 uppercase tracking-wider">NIP (Pegawai)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                            </div>
                            <input wire:model="nip" type="text" class="pl-10 block w-full rounded-lg bg-black/40 border-white/10 text-white placeholder-gray-600 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-inner py-3" placeholder="Contoh: 19900101XXXXXXXX">
                        </div>
                        @error('nip') <span class="text-red-400 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-300 px-1 uppercase tracking-wider">Email Dinas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input wire:model="email" type="email" class="pl-10 block w-full rounded-lg bg-black/40 border-white/10 text-white placeholder-gray-600 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-inner py-3" placeholder="email@kejaksaan.go.id">
                        </div>
                        @error('email') <span class="text-red-400 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-300 px-1 uppercase tracking-wider">Otoritas / Role</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <select wire:model="role" class="pl-10 block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 focus:ring-emerald-500 transition py-3">
                                <option value="" class="bg-gray-900">Pilih Role</option>
                                <option value="admin" class="bg-gray-900 uppercase">Administrator (Full Access)</option>
                                <option value="staff" class="bg-gray-900 uppercase">Staff Intel (Operator)</option>
                            </select>
                        </div>
                        @error('role') <span class="text-red-400 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1 md:col-span-2 space-y-1 text-center">
                        <label class="block text-sm font-bold text-gray-300 uppercase tracking-wider px-1">
                            Password Keamanan
                            @if($isEditMode) <span class="text-[10px] font-normal text-gray-500 italic lowercase block">(Kosongkan jika tidak ingin mengubah)</span> @endif
                        </label>
                        <div class="relative max-w-md mx-auto">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input wire:model="password" type="password" class="pl-10 block w-full rounded-lg bg-black/40 border-white/10 text-white placeholder-gray-600 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-inner py-3 text-center" placeholder="••••••••">
                        </div>
                        @error('password') <span class="text-red-400 text-[10px] font-bold uppercase ml-1 block">{{ $message }}</span> @enderror
                    </div>
                </form>

                <div class="flex justify-end mt-8 space-x-3">
                    <button wire:click="closeModal" class="px-6 py-3 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 font-bold uppercase tracking-widest text-xs transition">
                        Batal
                    </button>
                    <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black uppercase tracking-widest text-xs shadow-lg shadow-emerald-900/50 hover:shadow-emerald-500/30 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $isEditMode ? 'Simpan Perubahan' : 'Konfirmasi & Buat Akun' }}
                    </button>
                </div>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">

            <div class="p-6 border-b border-white/10 bg-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-96 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-500/50 group-focus-within:text-emerald-400 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-10 block w-full rounded-xl border-white/10 bg-black/50 text-white focus:border-emerald-500 focus:ring-emerald-500 transition text-sm py-3 placeholder-gray-500" placeholder="Cari Nama, NIP, atau Email...">
                </div>
                <div class="text-sm font-bold uppercase tracking-widest text-gray-500">
                    Total Personil: <span class="text-emerald-400">{{ $users->total() }}</span>
                </div>
            </div>

            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/40 text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black border-b border-white/10">
                            <th class="px-6 py-5">Informasi Pegawai</th>
                            <th class="px-6 py-5">NIP</th>
                            <th class="px-6 py-5">Otoritas / Role</th>
                            <th class="px-6 py-5">Tgl Gabung</th>
                            <th class="px-6 py-5 text-center">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($users as $user)
                        <tr class="hover:bg-emerald-400/[0.02] transition duration-150 group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-emerald-900/40 text-emerald-400 flex items-center justify-center font-black text-xl border border-emerald-500/30 group-hover:scale-110 transition duration-300">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-gray-200 group-hover:text-emerald-400 transition uppercase tracking-wide">{{ $user->name }}</div>
                                        <div class="text-[11px] text-gray-500 font-bold uppercase tracking-tighter">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 font-mono text-emerald-500/80 font-bold">
                                {{ $user->nip }}
                            </td>
                            <td class="px-6 py-5">
                                @if($user->role === 'admin')
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black bg-emerald-500 text-black uppercase tracking-widest shadow-[0_0_10px_rgba(16,185,129,0.3)]">
                                    Administrator
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black bg-gray-800 text-emerald-500 border border-emerald-500/30 uppercase tracking-widest">
                                    Staff Intel
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-xs text-gray-500 font-bold uppercase">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-3">
                                    <button wire:click="edit({{ $user->id }})" class="p-2.5 rounded-xl text-blue-400 hover:bg-blue-500/10 border border-transparent hover:border-blue-500/20 transition" title="Edit Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    @if(auth()->id() !== $user->id)
                                    <button wire:confirm="PERINGATAN: Menghapus personil akan menghilangkan seluruh hak aksesnya ke sistem SI-INTEL. Lanjutkan?"
                                        wire:click="delete({{ $user->id }})"
                                        class="p-2.5 rounded-xl text-red-500 hover:bg-red-500/10 border border-transparent hover:border-red-500/20 transition" title="Hapus User">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-800 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <p class="text-gray-500 uppercase tracking-widest text-xs font-bold">Data personil tidak ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-white/10 bg-black/20">
                {{ $users->links() }}
            </div>
        </div>
        @endif

    </div>
</div>