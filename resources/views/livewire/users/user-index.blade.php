<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight uppercase">
                    Manajemen <span class="text-emerald-600">Personil</span>
                </h2>
                <p class="text-slate-500 font-medium text-sm mt-1">
                    Kelola data pegawai, hak akses, dan monitoring kinerja intelijen.
                </p>
            </div>

            @if(!$showForm)
            <button wire:click="create" class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white transition-all duration-200 bg-emerald-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-200">
                <i class="fas fa-user-plus mr-2"></i> Tambah Personil
            </button>
            @endif
        </div>

        {{-- ALERT MESSAGES --}}
        @if (session()->has('message'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-center gap-3 animate-fade-in-down">
            <div class="p-2 bg-emerald-100 rounded-full text-emerald-600"><i class="fas fa-check"></i></div>
            <span class="font-bold text-emerald-800 text-sm">{{ session('message') }}</span>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex items-center gap-3 animate-fade-in-down">
            <div class="p-2 bg-red-100 rounded-full text-red-600"><i class="fas fa-exclamation-triangle"></i></div>
            <span class="font-bold text-red-800 text-sm">{{ session('error') }}</span>
        </div>
        @endif

        {{-- MAIN CONTENT --}}
        @if(!$showForm)
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            {{-- Search Bar --}}
            <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="relative w-full md:max-w-md">
                    <i class="fas fa-search absolute left-4 top-3.5 text-slate-400"></i>
                    <input wire:model.live="search" type="text" class="pl-10 w-full rounded-xl border-slate-200 bg-white text-sm font-bold text-slate-700 focus:border-emerald-500 focus:ring-emerald-500/20 placeholder-slate-400 transition shadow-sm" placeholder="Cari Nama atau NIP...">
                </div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-white px-3 py-1 rounded-lg border border-slate-100 shadow-sm">
                    Total: {{ $users->total() }} Personil
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white text-slate-400 uppercase text-[10px] font-black tracking-widest border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-5">Personil</th>
                            <th class="px-6 py-5">Jabatan & Pangkat</th>
                            <th class="px-6 py-5">Role & Kontak</th>
                            <th class="px-6 py-5 text-center">Kinerja</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50/80 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-lg border border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm group-hover:text-emerald-700 transition">{{ $user->name }}</p>
                                        <p class="text-[11px] text-slate-400 font-mono">NIP: {{ $user->nip ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <span class="font-bold text-slate-700 text-xs flex items-center gap-2">
                                        <i class="fas fa-briefcase text-slate-300 text-[10px]"></i>
                                        {{ $user->jabatan ?? '-' }}
                                    </span>
                                    <span class="font-medium text-slate-500 text-[11px] bg-slate-100 px-2 py-0.5 rounded w-fit">
                                        {{ $user->pangkat ?? '-' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2 items-start">
                                    @if($user->role === 'admin')
                                    <span class="px-3 py-1 rounded-full bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest shadow-md shadow-slate-900/20">
                                        <i class="fas fa-crown text-yellow-400 mr-1"></i> Admin
                                    </span>
                                    @else
                                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[9px] font-black uppercase tracking-widest border border-slate-200">
                                        Staff
                                    </span>
                                    @endif
                                    @if($user->no_hp)
                                    <span class="text-[10px] text-slate-400 font-mono"><i class="fas fa-phone-alt mr-1"></i> {{ $user->no_hp }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                $totalInput = $user->lapinhars_count + $user->dpos_count + $user->wnas_count + $user->ormas_count +
                                $user->pam_sdos_count + $user->jms_activities_count + $user->kerawanans_count + $user->lapdus_count;
                                @endphp
                                <button wire:click="viewStats({{ $user->id }})" class="group/stats relative inline-flex items-center justify-center gap-1 px-4 py-2 bg-white border-2 border-emerald-100 rounded-xl hover:border-emerald-500 hover:bg-emerald-50 transition-all duration-300">
                                    <span class="font-black text-emerald-600 text-lg">{{ $totalInput }}</span>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase">Data</span>
                                    <i class="fas fa-chart-pie absolute -top-2 -right-2 text-emerald-500 bg-white rounded-full p-1 border border-emerald-100 text-xs opacity-0 group-hover/stats:opacity-100 transition-opacity"></i>
                                </button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $user->id }})" class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm hover:shadow-blue-200 border border-blue-100">
                                        <i class="fas fa-pencil-alt text-sm"></i>
                                    </button>
                                    <button wire:confirm="Hapus personil ini?" wire:click="delete({{ $user->id }})" class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition shadow-sm hover:shadow-red-200 border border-red-100">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center opacity-50">
                                    <i class="fas fa-users-slash text-4xl text-slate-300 mb-3"></i>
                                    <p class="text-sm font-bold text-slate-500">Tidak ada data personil ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-50 bg-slate-50/30">
                {{ $users->links() }}
            </div>
        </div>
        @endif

        {{-- FORM MODAL (CREATE / EDIT) --}}
        @if($showForm)
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden max-w-4xl mx-auto animate-fade-in-up relative">

            {{-- Header Form --}}
            <div class="bg-gradient-to-r from-emerald-600 to-teal-500 px-8 py-6 flex justify-between items-center text-white">
                <div>
                    <h3 class="font-black text-xl uppercase tracking-widest italic">
                        {{ $isEditMode ? 'Edit Personil' : 'Registrasi Personil' }}
                    </h3>
                    <p class="text-emerald-100 text-xs font-medium opacity-80">Lengkapi data diri dan hak akses pegawai.</p>
                </div>
                <button wire:click="closeModal" class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full hover:bg-white/40 transition backdrop-blur-md">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 space-y-8">

                {{-- Bagian 1: Identitas --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black text-emerald-600 uppercase tracking-widest border-b border-emerald-100 pb-2">I. Identitas Pegawai</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Nama Lengkap</label>
                            <input wire:model="name" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300 bg-slate-50 focus:bg-white transition" placeholder="Contoh: M. Hadid Iman">
                            @error('name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">NIP (Nomor Induk Pegawai)</label>
                            <input wire:model="nip" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300 bg-slate-50 focus:bg-white transition" placeholder="19xxxxxxxxxx">
                            @error('nip') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian 2: Jabatan & Kontak --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black text-emerald-600 uppercase tracking-widest border-b border-emerald-100 pb-2">II. Jabatan & Kontak</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Jabatan Struktural/Fungsional</label>
                            <input wire:model="jabatan" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300 bg-slate-50 focus:bg-white" placeholder="Contoh: Kasubsi A">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Pangkat / Golongan</label>
                            <input wire:model="pangkat" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300 bg-slate-50 focus:bg-white" placeholder="Contoh: Jaksa Pratama (III/c)">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Nomor HP / WhatsApp</label>
                            <input wire:model="no_hp" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 placeholder-slate-300 bg-slate-50 focus:bg-white" placeholder="08xxxxxxxx">
                        </div>
                    </div>
                </div>

                {{-- Bagian 3: Akun --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black text-emerald-600 uppercase tracking-widest border-b border-emerald-100 pb-2">III. Pengaturan Akun</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Email Login</label>
                            <input wire:model="email" type="email" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white">
                            @error('email') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Role Akses</label>
                            <select wire:model="role" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white cursor-pointer">
                                <option value="staff">STAFF (User)</option>
                                <option value="admin">ADMIN (Verifikator)</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Password {{ $isEditMode ? '(Opsional)' : '' }}</label>
                            <input wire:model="password" type="password" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white" placeholder="*******">
                            @error('password') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-xs uppercase tracking-widest shadow-lg shadow-emerald-200 transition transform hover:-translate-y-1">
                        {{ $isEditMode ? 'Simpan Perubahan' : 'Buat Personil Baru' }}
                    </button>
                </div>
            </form>
        </div>
        @endif

        {{-- MODAL STATISTIK (PREMIUM STYLE) --}}
        @if($showStatsModal && $selectedUser)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-md p-4 transition-opacity animate-fade-in">
            <div class="bg-white w-full max-w-4xl rounded-[3rem] shadow-2xl relative overflow-hidden animate-zoom-in border border-slate-200">

                {{-- Decorative Header --}}
                <div class="absolute top-0 left-0 w-full h-40 bg-gradient-to-br from-slate-900 to-slate-800">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl -mr-16 -mt-20"></div>
                </div>

                <div class="relative z-10 p-8">
                    {{-- User Profile Header --}}
                    <div class="flex justify-between items-start mb-8">
                        <div class="flex items-center gap-6">
                            <div class="w-24 h-24 rounded-[2rem] bg-white p-1 shadow-xl">
                                <div class="w-full h-full bg-emerald-600 rounded-[1.8rem] flex items-center justify-center text-white font-black text-4xl">
                                    {{ substr($selectedUser->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="text-white mt-4">
                                <h3 class="text-3xl font-black tracking-tight">{{ $selectedUser->name }}</h3>
                                <div class="flex items-center gap-3 mt-1 text-emerald-200 text-sm font-medium">
                                    <span class="bg-white/10 px-3 py-1 rounded-full border border-white/10 uppercase tracking-widest text-[10px] font-bold">{{ $selectedUser->role }}</span>
                                    <span>{{ $selectedUser->nip ?? 'NIP: -' }}</span>
                                </div>
                                <p class="text-slate-300 text-xs mt-2 font-mono">{{ $selectedUser->jabatan ?? 'Jabatan Belum Diisi' }}</p>
                            </div>
                        </div>
                        <button wire:click="closeStatsModal" class="w-10 h-10 flex items-center justify-center bg-white/10 hover:bg-white/20 rounded-full text-white transition backdrop-blur-md">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    {{-- Stats Grid (Overlap) --}}
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl -mt-4 border border-slate-100 relative z-20">
                        <div class="flex justify-between items-center mb-8">
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-3">
                                <div class="p-2 bg-emerald-100 rounded-lg text-emerald-600 shadow-sm">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                Akumulasi Kinerja
                            </h4>
                            <div class="px-4 py-1 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                Total Record
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                            @php
                            $stats = [
                            ['label' => 'Lapinhar', 'icon' => 'fa-file-contract', 'color' => 'emerald', 'val' => $selectedUser->lapinhars_count],
                            ['label' => 'DPO', 'icon' => 'fa-user-secret', 'color' => 'red', 'val' => $selectedUser->dpos_count],
                            ['label' => 'WNA', 'icon' => 'fa-passport', 'color' => 'blue', 'val' => $selectedUser->wnas_count],
                            ['label' => 'Ormas', 'icon' => 'fa-users', 'color' => 'purple', 'val' => $selectedUser->ormas_count],
                            ['label' => 'PAM SDO', 'icon' => 'fa-shield-alt', 'color' => 'amber', 'val' => $selectedUser->pam_sdos_count],
                            ['label' => 'JMS', 'icon' => 'fa-graduation-cap', 'color' => 'cyan', 'val' => $selectedUser->jms_activities_count],
                            ['label' => 'Kerawanan', 'icon' => 'fa-map-marked-alt', 'color' => 'orange', 'val' => $selectedUser->kerawanans_count],
                            ['label' => 'Lapdu', 'icon' => 'fa-envelope-open-text', 'color' => 'indigo', 'val' => $selectedUser->lapdus_count],
                            ];
                            @endphp

                            @foreach($stats as $stat)
                            <div class="group relative bg-white p-5 rounded-3xl border border-slate-100 hover:border-{{ $stat['color'] }}-200 transition-all duration-300 hover:shadow-lg hover:shadow-{{ $stat['color'] }}-50 hover:-translate-y-1 cursor-default">

                                {{-- Decorative Dot (Indikator jika ada data) --}}
                                <div class="absolute top-5 right-5 w-2 h-2 rounded-full {{ $stat['val'] > 0 ? 'bg-'.$stat['color'].'-500 animate-pulse' : 'bg-slate-100' }}"></div>

                                <div class="flex flex-col h-full justify-between gap-4">
                                    {{-- Icon Bubble --}}
                                    <div class="w-12 h-12 rounded-2xl bg-{{ $stat['color'] }}-50 flex items-center justify-center text-{{ $stat['color'] }}-500 text-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 shadow-sm border border-{{ $stat['color'] }}-100/50">
                                        <i class="fas {{ $stat['icon'] }}"></i>
                                    </div>

                                    {{-- Data Text --}}
                                    <div>
                                        <span class="block text-3xl font-black text-slate-800 tracking-tight group-hover:text-{{ $stat['color'] }}-600 transition-colors duration-300">
                                            {{ $stat['val'] }}
                                        </span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-slate-500 transition-colors">
                                            {{ $stat['label'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>