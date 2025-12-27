<div class="py-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="relative">
                <div class="absolute -left-4 top-0 w-1.5 h-full bg-emerald-600 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.4)]"></div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter italic uppercase">
                    Manajemen <span class="text-emerald-700">Personil</span>
                </h2>
                <p class="text-[11px] text-slate-500 mt-2 font-black tracking-[0.2em] uppercase flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.6)] animate-pulse"></span>
                    Kontrol Otoritas Jaksa & Staf Intelijen
                </p>
            </div>

            @if(!$showForm)
            <button wire:click="create" class="group relative overflow-hidden bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 px-10 rounded-2xl shadow-[0_10px_20px_rgba(5,150,105,0.2)] transition-all duration-300 flex items-center gap-3 text-xs uppercase tracking-widest border-2 border-emerald-500">
                <i class="fas fa-user-plus text-base group-hover:scale-110 transition duration-300"></i>
                <span>Tambah Personil Baru</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-emerald-50 border-2 border-emerald-100 text-emerald-700 px-8 py-5 rounded-2xl shadow-sm mb-6 flex items-center justify-between text-xs font-black uppercase tracking-widest">
            <div class="flex items-center gap-4">
                <i class="fas fa-check-circle text-xl text-emerald-500"></i>
                {{ session('message') }}
            </div>
            <button @click="show = false" class="text-emerald-300 hover:text-emerald-600 transition text-xl">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            class="bg-white rounded-[3rem] shadow-2xl border-2 border-emerald-100 overflow-hidden mb-12 relative">

            <div class="bg-emerald-50 px-10 py-8 border-b-2 border-emerald-100 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-emerald-600 text-white rounded-2xl shadow-lg">
                        <i class="fas fa-id-badge text-xl"></i>
                    </div>
                    <h3 class="font-black text-emerald-900 text-lg uppercase tracking-[0.2em] italic">
                        {{ $isEditMode ? 'Update Data Otoritas' : 'Registrasi Akun Baru' }}
                    </h3>
                </div>
                <button wire:click="closeModal" class="p-3 bg-white border-2 border-slate-200 text-slate-400 hover:text-red-600 hover:border-red-200 rounded-2xl transition shadow-md">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-10 md:p-14">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="space-y-3">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest ml-1">Nama Lengkap Petugas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-emerald-600">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <input wire:model="name" type="text" class="pl-14 block w-full rounded-2xl bg-slate-50 border-2 border-slate-100 text-slate-900 font-bold focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-500/5 transition-all py-5 shadow-sm" placeholder="Nama Lengkap">
                        </div>
                        @error('name') <span class="text-red-600 text-[10px] font-black uppercase italic ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest ml-1">NIP (Pegawai)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-emerald-600">
                                <i class="fas fa-id-card-alt"></i>
                            </div>
                            <input wire:model="nip" type="text" class="pl-14 block w-full rounded-2xl bg-slate-50 border-2 border-slate-100 text-slate-900 font-bold focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-500/5 transition-all py-5 shadow-sm" placeholder="19XXXXXXXXXXXXX">
                        </div>
                        @error('nip') <span class="text-red-600 text-[10px] font-black uppercase italic ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest ml-1">Email Dinas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-emerald-600">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                            <input wire:model="email" type="email" class="pl-14 block w-full rounded-2xl bg-slate-50 border-2 border-slate-100 text-slate-900 font-bold focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-500/5 transition-all py-5 shadow-sm" placeholder="user@kejaksaan.go.id">
                        </div>
                        @error('email') <span class="text-red-600 text-[10px] font-black uppercase italic ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest ml-1">Level Otoritas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-emerald-600">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <select wire:model="role" class="pl-14 block w-full rounded-2xl bg-slate-50 border-2 border-slate-100 text-slate-900 font-black focus:border-emerald-600 focus:bg-white transition-all py-5 shadow-sm appearance-none">
                                <option value="">-- Pilih Akses --</option>
                                <option value="admin">ADMINISTRATOR (FULL ACCESS)</option>
                                <option value="staff">STAFF INTEL (OPERATOR)</option>
                            </select>
                        </div>
                        @error('role') <span class="text-red-600 text-[10px] font-black uppercase italic ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1 md:col-span-2 space-y-3">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest text-center">Keamanan Akun (Password)</label>
                        <div class="relative max-w-lg mx-auto">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-emerald-600">
                                <i class="fas fa-key"></i>
                            </div>
                            <input wire:model="password" type="password" class="pl-14 block w-full rounded-2xl bg-slate-50 border-2 border-slate-100 text-slate-900 font-bold focus:border-emerald-600 focus:bg-white transition-all py-5 shadow-sm text-center tracking-[0.5em]" placeholder="••••••••">
                        </div>
                        @if($isEditMode) <p class="text-[10px] text-center font-bold text-slate-400 mt-2 uppercase">* Kosongkan jika tidak ingin mengubah</p> @endif
                    </div>
                </div>

                <div class="flex justify-end mt-16 space-x-6">
                    <button type="button" wire:click="closeModal" class="px-10 py-5 rounded-2xl border-2 border-slate-200 text-slate-600 hover:bg-slate-50 font-black uppercase text-xs tracking-widest transition shadow-sm">Batal</button>
                    <button type="submit" class="px-14 py-5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-black uppercase text-xs tracking-widest shadow-xl shadow-emerald-200 transition transform hover:-translate-y-1 border-2 border-emerald-500">
                        {{ $isEditMode ? 'Simpan Perubahan' : 'Proses Registrasi Akun' }}
                    </button>
                </div>
            </form>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-white rounded-[3rem] shadow-[0_10px_40px_rgba(0,0,0,0.04)] border-2 border-slate-100 overflow-hidden">

            <div class="p-8 border-b-2 border-slate-50 bg-slate-50/40 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="relative w-full md:w-[600px] group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-emerald-600">
                        <i class="fas fa-search"></i>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-14 block w-full rounded-2xl border-2 border-slate-200 bg-white text-slate-900 font-bold focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/5 transition-all text-sm py-4 shadow-sm placeholder:text-slate-400" placeholder="Cari Personil (Nama, NIP, atau Email Dinas)...">
                </div>
                <span class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] bg-white px-5 py-3 rounded-xl border border-slate-100 shadow-sm">
                    Total Korps: <span class="text-emerald-600 text-lg">{{ $users->total() }}</span>
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 text-[10px] uppercase tracking-[0.3em] font-black border-b-2 border-slate-100 italic">
                            <th class="px-10 py-8 italic">Profil & Identitas Akun</th>
                            <th class="px-10 py-8 text-center italic">Hak Akses</th>
                            <th class="px-10 py-8 text-center italic">Manajemen Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-slate-50">
                        @forelse($users as $user)
                        <tr class="hover:bg-emerald-50/30 transition duration-300 group">
                            <td class="px-10 py-8">
                                <div class="flex items-center gap-6">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 to-emerald-800 text-white flex items-center justify-center font-black text-2xl shadow-lg shadow-emerald-200 group-hover:rotate-6 transition duration-500">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-slate-900 text-base uppercase tracking-tight">{{ $user->name }}</div>
                                        <div class="flex items-center gap-2 mt-1.5 font-bold">
                                            <span class="text-[11px] text-slate-500 uppercase tracking-tighter">NIP. {{ $user->nip }}</span>
                                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                            <span class="text-[11px] text-emerald-600 tracking-tight">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-8 text-center">
                                <span class="inline-flex items-center px-5 py-2 rounded-full text-[10px] font-black {{ $user->role === 'admin' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-100 border-emerald-400' : 'bg-white text-slate-600 border-2 border-slate-200' }} uppercase tracking-widest border">
                                    <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : 'fa-user-edit' }} mr-2"></i> {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-10 py-8">
                                <div class="flex justify-center items-center gap-4">
                                    <button wire:click="edit({{ $user->id }})" class="flex items-center gap-2 px-6 py-3 bg-blue-50 border-2 border-blue-200 rounded-xl text-blue-600 hover:bg-blue-600 hover:text-white transition-all font-black uppercase text-[10px] tracking-widest shadow-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    @if(auth()->id() !== $user->id)
                                    <button wire:confirm="Hapus akun personil ini?" wire:click="delete({{ $user->id }})" class="flex items-center gap-2 px-6 py-3 bg-red-50 border-2 border-red-200 rounded-xl text-red-600 hover:bg-red-600 hover:text-white transition-all font-black uppercase text-[10px] tracking-widest shadow-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-10 py-32 text-center bg-slate-50/30 text-slate-300 font-black uppercase italic tracking-widest">
                                Database Korps Kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-8 border-t-2 border-slate-50 bg-slate-50/50">
                {{ $users->links() }}
            </div>
        </div>
        @endif
    </div>
</div>