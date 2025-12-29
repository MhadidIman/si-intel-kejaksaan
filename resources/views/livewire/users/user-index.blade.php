<div class="py-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Header & Tombol Tambah --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600 border border-emerald-100">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Manajemen Personil</h2>
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">Kelola Akun & Monitoring Kinerja</p>
                </div>
            </div>

            @if(!$showForm)
            <button wire:click="create" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-lg shadow-emerald-200 transition-all flex items-center gap-2">
                <i class="fas fa-user-plus"></i> Tambah User
            </button>
            @endif
        </div>

        {{-- Alert Messages --}}
        @if (session()->has('message'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r shadow-sm flex items-center gap-2 animate-fade-in-down">
            <i class="fas fa-check-circle"></i>
            <span class="font-bold text-sm">{{ session('message') }}</span>
        </div>
        @endif
        @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r shadow-sm flex items-center gap-2 animate-fade-in-down">
            <i class="fas fa-exclamation-circle"></i>
            <span class="font-bold text-sm">{{ session('error') }}</span>
        </div>
        @endif

        {{-- Tabel User --}}
        @if(!$showForm)
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                <div class="relative max-w-md">
                    <i class="fas fa-search absolute left-4 top-3.5 text-slate-400"></i>
                    <input wire:model.live="search" type="text" class="pl-10 w-full rounded-xl border-slate-200 bg-white text-sm font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-400" placeholder="Cari Nama atau NIP...">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Identitas Personil</th>
                            <th class="px-6 py-4">Jabatan & Pangkat</th>
                            <th class="px-6 py-4 text-center">Role</th>
                            <th class="px-6 py-4 text-center">Total Input</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm">
                        @foreach($users as $user)
                        <tr class="hover:bg-emerald-50/30 transition duration-300">
                            <td class="px-6 py-4">
                                <button wire:click="viewStats({{ $user->id }})" class="flex items-center gap-3 text-left group w-full outline-none">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-black text-sm group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300 shadow-sm border border-slate-200 group-hover:border-emerald-400">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 uppercase group-hover:text-emerald-700 transition-colors">{{ $user->name }}</p>
                                        <p class="text-xs text-slate-400 font-mono mt-0.5 group-hover:text-emerald-600/70">{{ $user->nip ?? '-' }}</p>
                                    </div>
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-700 text-xs">{{ $user->jabatan ?? '-' }}</span>
                                    <span class="text-[10px] text-slate-400 uppercase tracking-wide">{{ $user->pangkat ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->role === 'admin')
                                <span class="px-3 py-1 rounded-full bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest">Admin</span>
                                @else
                                <span class="px-3 py-1 rounded-full bg-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-widest">Staff</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @php
                                $totalInput = $user->lapinhars_count + $user->dpos_count + $user->wnas_count + $user->ormas_count +
                                $user->pam_sdos_count + $user->jms_activities_count + $user->kerawanans_count + $user->lapdus_count;
                                @endphp
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 font-black text-xs border border-emerald-100">
                                    {{ $totalInput }} <span class="text-[9px] text-emerald-400 uppercase">Data</span>
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $user->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm border border-blue-100" title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </button>
                                    <button wire:confirm="Yakin ingin menghapus user ini?" wire:click="delete({{ $user->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100" title="Hapus">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-50">
                {{ $users->links() }}
            </div>
        </div>
        @endif

        {{-- FORM MODAL (Create / Edit) --}}
        @if($showForm)
        <div class="bg-white rounded-[2rem] shadow-lg border border-emerald-100 overflow-hidden max-w-4xl mx-auto animate-fade-in-up">
            <div class="bg-emerald-50 px-8 py-6 border-b border-emerald-100 flex justify-between items-center">
                <h3 class="font-black text-emerald-900 text-lg uppercase tracking-widest italic">
                    {{ $isEditMode ? 'Edit Personil' : 'Tambah Personil Baru' }}
                </h3>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-white rounded-full text-slate-400 hover:text-red-500 shadow-sm transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 space-y-6">

                {{-- Grid Identitas Utama --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nama Lengkap</label>
                        <input wire:model="name" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300" placeholder="Nama Pegawai">
                        @error('name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">NIP (Username Login)</label>
                        <input wire:model="nip" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300" placeholder="19xxxxxxxxxx">
                        @error('nip') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Grid Jabatan & Pangkat (NEW) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Jabatan</label>
                        <input wire:model="jabatan" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300" placeholder="Contoh: Kasubsi A / Staff TU">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Pangkat / Golongan</label>
                        <input wire:model="pangkat" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300" placeholder="Contoh: Jaksa Pratama / III.c">
                    </div>
                </div>

                {{-- Grid Kontak & Satuan Kerja (NEW) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nomor HP / WA</label>
                        <input wire:model="no_hp" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300" placeholder="08xxxxxxxx">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Satuan Kerja</label>
                        <input type="text" value="Kejari Banjarmasin" readonly class="w-full rounded-xl border-slate-200 bg-slate-100 font-bold text-slate-500 cursor-not-allowed focus:ring-0">
                        <p class="text-[10px] text-slate-400 italic">*Satuan kerja diatur otomatis.</p>
                    </div>
                </div>

                <hr class="border-slate-100 border-dashed">

                {{-- Grid Akun --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Email</label>
                        <input wire:model="email" type="email" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0">
                        @error('email') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Role Akses</label>
                        <select wire:model="role" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0">
                            <option value="staff">STAFF (Penginput)</option>
                            <option value="admin">ADMIN (Verifikator)</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Password {{ $isEditMode ? '(Isi jika ubah)' : '' }}</label>
                        <input wire:model="password" type="password" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0" placeholder="*******">
                        @error('password') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-50">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-slate-50 transition">Batal</button>

                    <button type="submit"
                        wire:loading.attr="disabled"
                        wire:target="{{ $isEditMode ? 'update' : 'store' }}"
                        class="px-8 py-3 rounded-xl bg-emerald-600 text-white font-bold text-xs uppercase tracking-widest hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">

                        <span wire:loading.remove wire:target="{{ $isEditMode ? 'update' : 'store' }}">
                            {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data' }}
                        </span>

                        <span wire:loading wire:target="{{ $isEditMode ? 'update' : 'store' }}">
                            <i class="fas fa-spinner fa-spin"></i> Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>
        @endif

        {{-- Modal Statistik (Sama seperti sebelumnya tapi dirapikan codingannya) --}}
        @if($showStatsModal && $selectedUser)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 transition-opacity">
            <div class="bg-white w-full max-w-4xl rounded-[2.5rem] shadow-2xl border-2 border-white relative overflow-hidden animate-fade-in-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50 pointer-events-none -mr-16 -mt-16"></div>
                <div class="relative z-10 p-8">
                    <div class="flex justify-between items-start mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-2xl shadow-lg shadow-emerald-200">
                                {{ substr($selectedUser->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight">{{ $selectedUser->name }}</h3>
                                <p class="text-sm font-bold text-slate-500">{{ $selectedUser->nip ?? 'NIP Tidak Ada' }} • {{ strtoupper($selectedUser->role) }}</p>
                                <p class="text-xs text-slate-400 font-mono mt-1">{{ $selectedUser->jabatan ?? '' }}</p>
                            </div>
                        </div>
                        <button wire:click="closeStatsModal" class="w-10 h-10 flex items-center justify-center bg-slate-100 rounded-full text-slate-400 hover:bg-red-100 hover:text-red-600 transition duration-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    {{-- Grid Statistik --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        {{-- Helper Component untuk Card Stat biar kodingan rapi --}}
                        <div class="p-5 bg-emerald-50 rounded-2xl border border-emerald-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-emerald-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Lapinhar</span>
                                <i class="fas fa-file-alt text-emerald-300 group-hover:text-emerald-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->lapinhars_count }}</span>
                        </div>

                        <div class="p-5 bg-red-50 rounded-2xl border border-red-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-red-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-red-600">DPO</span>
                                <i class="fas fa-user-secret text-red-300 group-hover:text-red-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->dpos_count }}</span>
                        </div>

                        <div class="p-5 bg-blue-50 rounded-2xl border border-blue-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-blue-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-blue-600">WNA</span>
                                <i class="fas fa-globe-asia text-blue-300 group-hover:text-blue-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->wnas_count }}</span>
                        </div>

                        <div class="p-5 bg-purple-50 rounded-2xl border border-purple-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-purple-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-purple-600">Ormas</span>
                                <i class="fas fa-users-class text-purple-300 group-hover:text-purple-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->ormas_count }}</span>
                        </div>

                        <div class="p-5 bg-amber-50 rounded-2xl border border-amber-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-amber-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-amber-600">PAM SDO</span>
                                <i class="fas fa-shield-check text-amber-300 group-hover:text-amber-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->pam_sdos_count }}</span>
                        </div>

                        <div class="p-5 bg-cyan-50 rounded-2xl border border-cyan-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-cyan-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-cyan-600">JMS</span>
                                <i class="fas fa-graduation-cap text-cyan-300 group-hover:text-cyan-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->jms_activities_count }}</span>
                        </div>

                        <div class="p-5 bg-orange-50 rounded-2xl border border-orange-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-orange-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-orange-600">Kerawanan</span>
                                <i class="fas fa-map-marked-alt text-orange-300 group-hover:text-orange-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->kerawanans_count }}</span>
                        </div>

                        <div class="p-5 bg-indigo-50 rounded-2xl border border-indigo-100 flex flex-col justify-between h-32 group hover:shadow-lg hover:shadow-indigo-100 transition duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-black uppercase tracking-widest text-indigo-600">Lapdu</span>
                                <i class="fas fa-envelope-open-text text-indigo-300 group-hover:text-indigo-500 transition text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-800">{{ $selectedUser->lapdus_count }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>