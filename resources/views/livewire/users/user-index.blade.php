<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight uppercase">
                    @if($viewMode === 'list')
                    Manajemen <span class="text-emerald-600">Personil</span>
                    @elseif($viewMode === 'stats')
                    Bank Data <span class="text-blue-600">Kinerja Staff</span>
                    @else
                    Log <span class="text-slate-600">Keamanan Sistem</span>
                    @endif
                </h2>
                <p class="text-slate-500 text-xs font-medium mt-1 uppercase tracking-widest">
                    Otoritas Manajemen Pusat Data Intelijen Kejaksaan
                </p>
            </div>

            <div class="flex items-center gap-3">
                @if($viewMode === 'stats')
                <a href="{{ route('cetak.user-stats') }}" target="_blank" class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white transition-all duration-200 bg-red-600 rounded-xl hover:bg-red-700 shadow-lg shadow-red-200">
                    <i class="fas fa-file-pdf mr-2"></i> Cetak Rekap Kinerja
                </a>
                @endif

                @if(!$showForm && $viewMode === 'list')
                <button wire:click="create" class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white transition-all duration-200 bg-emerald-600 rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-200">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Personil
                </button>
                @endif
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if (session()->has('message'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-center gap-3 animate-fade-in-down">
            <div class="p-2 bg-emerald-100 rounded-full text-emerald-600"><i class="fas fa-check"></i></div>
            <span class="font-bold text-emerald-800 text-sm">{{ session('message') }}</span>
        </div>
        @endif
        @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex items-center gap-3 animate-fade-in-down mb-4">
            <div class="p-2 bg-red-100 rounded-full text-red-600"><i class="fas fa-exclamation-triangle"></i></div>
            <span class="font-bold text-red-800 text-sm">{{ session('error') }}</span>
        </div>
        @endif

        {{-- MAIN CONTENT --}}
        @if(!$showForm)
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

            {{-- Search Bar & Filter Info --}}
            <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="relative w-full md:max-w-md">
                    <i class="fas fa-search absolute left-4 top-3.5 text-slate-400"></i>
                    <input wire:model.live="search" type="text" class="pl-10 w-full rounded-xl border-slate-200 bg-white text-sm font-bold text-slate-700 focus:border-emerald-500 focus:ring-emerald-500/20 placeholder-slate-400 transition shadow-sm" placeholder="Cari personil...">
                </div>
                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest bg-white px-4 py-2 rounded-lg border border-slate-100 shadow-sm flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Tampilan: {{ $viewMode === 'list' ? 'Daftar Akun' : ($viewMode === 'stats' ? 'Statistik Data' : 'Riwayat Aktifitas') }}
                </div>
            </div>

            @if($viewMode === 'list')
            {{-- TABEL 1: KELOLA AKUN --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white text-slate-400 uppercase text-[10px] font-black tracking-widest border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-5">Personil</th>
                            <th class="px-6 py-5">Jabatan & Pangkat</th>
                            <th class="px-6 py-5">Role & Kontak</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50/80 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-emerald-50 text-emerald-600 flex items-center justify-center font-black border border-emerald-100 group-hover:border-emerald-300 transition-all shadow-sm">
                                        @if($user->foto_profile)
                                        <img src="{{ asset('storage/' . $user->foto_profile) }}" class="w-full h-full object-cover">
                                        @else
                                        {{ substr($user->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm group-hover:text-emerald-700 transition">{{ $user->name }}</p>
                                        <p class="text-[10px] text-slate-400 font-mono">NIP: {{ $user->nip ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-700 text-xs">{{ $user->jabatan ?? '-' }}</span>
                                    <span class="text-slate-400 text-[10px]">{{ $user->pangkat ?? '-' }}</span>
                                    <span class="text-slate-400 text-[9px] mt-0.5">{{ $user->satuan_kerja }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase {{ $user->role === 'admin' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    {{ $user->role }}
                                </span>
                                <div class="text-[10px] text-slate-500 mt-1">{{ $user->no_hp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $user->id }})" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition border border-blue-100"><i class="fas fa-edit text-xs"></i></button>
                                    <button wire:confirm="Hapus user ini?" wire:click="delete({{ $user->id }})" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition border border-red-100"><i class="fas fa-trash text-xs"></i></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-slate-400 font-bold italic">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-50 bg-slate-50/30">
                {{ $users->links() }}
            </div>

            @elseif($viewMode === 'stats')
            {{-- TABEL 2: STATISTIK DATA (BANK DATA) --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-100/50 text-slate-500 uppercase text-[9px] font-black tracking-tighter border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-4 border-r border-slate-200">Nama Staff</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">Lapinhar</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">DPO</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">WNA</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">ORMAS</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">PAM SDO</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">JMS</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">RAWAN</th>
                            <th class="px-2 py-4 text-center border-r border-slate-200">LAPDU</th>
                            <th class="px-4 py-4 text-center bg-emerald-100 text-emerald-900 font-black">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                        @php
                        $total = $user->dpos_count + $user->wnas_count + $user->ormas_count +
                        $user->pam_sdos_count + $user->jms_activities_count +
                        $user->kerawanans_count + $user->lapdus_count + $user->lapinhars_count;
                        @endphp
                        <tr class="hover:bg-emerald-50/30 transition">
                            <td class="px-4 py-3 border-r border-slate-100 font-bold text-slate-900 text-xs">{{ $user->name }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->lapinhars_count }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->dpos_count }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->wnas_count }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->ormas_count }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->pam_sdos_count }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->jms_activities_count }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->kerawanans_count }}</td>
                            <td class="px-2 py-3 text-center border-r border-slate-100 text-xs font-bold text-slate-800">{{ $user->lapdus_count }}</td>
                            <td class="px-4 py-3 text-center bg-emerald-50 text-emerald-700 font-black text-sm">{{ $total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-50 bg-slate-50/30">
                {{ $users->links() }}
            </div>

            @elseif($viewMode === 'logs')
            {{-- TABEL 3: LOG AKTIVITAS (KEAMANAN) --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-100/50 text-slate-500 uppercase text-[10px] font-black tracking-widest border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4">Waktu Akses</th>
                            <th class="px-6 py-4">Nama Personil</th>
                            <th class="px-6 py-4">Aktivitas</th>
                            <th class="px-6 py-4">Alamat IP</th>
                            <th class="px-6 py-4">Sistem Operasi / Browser</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($logs as $log)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-xs font-mono text-slate-500 italic">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="px-6 py-4"><span class="font-bold text-slate-900 text-xs">{{ $log->user->name ?? 'Sistem' }}</span></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-md {{ $log->activity == 'Login' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }} text-[10px] font-black uppercase tracking-tighter">
                                    {{ $log->activity }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-emerald-700">{{ $log->ip_address }}</td>
                            <td class="px-6 py-4 text-[10px] text-slate-400 truncate max-w-xs font-medium">{{ $log->user_agent }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-slate-400 font-bold italic">Belum ada riwayat aktivitas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-50 bg-slate-50/30">
                {{ $logs->links() }}
            </div>
            @endif
        </div>
        @endif

        {{-- FORM MODAL (DIREVISI SESUAI DATABASE) --}}
        @if($showForm)
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden max-w-4xl mx-auto animate-fade-in-up">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-500 px-8 py-6 flex justify-between items-center text-white">
                <div>
                    <h3 class="font-black text-xl uppercase tracking-widest italic">{{ $isEditMode ? 'Edit Personil' : 'Registrasi Personil' }}</h3>
                    <p class="text-emerald-100 text-xs font-medium opacity-80">Pastikan data yang diinput benar dan sesuai NIP.</p>
                </div>
                <button wire:click="closeModal" class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full hover:bg-white/40 transition"><i class="fas fa-times"></i></button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 space-y-8">

                {{-- BAGIAN 1: IDENTITAS --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black text-emerald-600 uppercase tracking-widest border-b border-emerald-100 pb-2">Identitas Pegawai</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input wire:model="name" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white transition">
                            @error('name') <span class="text-red-500 text-[10px] font-bold italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">NIP</label>
                            <input wire:model="nip" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white transition" placeholder="NIP Pegawai">
                            @error('nip') <span class="text-red-500 text-[10px] font-bold italic">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 2: JABATAN & INSTANSI --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black text-emerald-600 uppercase tracking-widest border-b border-emerald-100 pb-2">Jabatan & Instansi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Satuan Kerja</label>
                            <input wire:model="satuan_kerja" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white" placeholder="Contoh: Kejari Banjarmasin">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Kontak/WA</label>
                            <input wire:model="no_hp" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Jabatan</label>
                            <input wire:model="jabatan" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Pangkat / Golongan</label>
                            <input wire:model="pangkat" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white">
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 3: AKUN & FOTO --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black text-emerald-600 uppercase tracking-widest border-b border-emerald-100 pb-2">Akun & Profil</h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Email Login <span class="text-red-500">*</span></label>
                            <input wire:model="email" type="email" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white">
                            @error('email') <span class="text-red-500 text-[10px] font-bold italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Role <span class="text-red-500">*</span></label>
                            <select wire:model="role" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white">
                                <option value="staff">STAFF</option>
                                <option value="admin">ADMIN</option>
                            </select>
                            @error('role') <span class="text-red-500 text-[10px] font-bold italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">
                                Password
                                @if($isEditMode)
                                <span class="text-slate-400 font-normal normal-case">(Opsional)</span>
                                @else
                                <span class="text-red-500">*</span>
                                @endif
                            </label>
                            <input wire:model="password" type="password" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 bg-slate-50 focus:bg-white" placeholder="*******">
                            <p class="text-[10px] text-slate-400">Minimal 6 karakter</p>
                            @error('password') <span class="text-red-500 text-[10px] font-bold italic">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Upload Foto --}}
                    <div class="space-y-2 mt-4">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest">Foto Profile (Opsional)</label>
                        <div class="flex items-center gap-6 p-4 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50">
                            @if ($foto_profile)
                            <img src="{{ $foto_profile->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-full border-2 border-emerald-500 shadow-sm">
                            @elseif ($foto_lama)
                            <img src="{{ asset('storage/' . $foto_lama) }}" class="w-16 h-16 object-cover rounded-full border-2 border-slate-200 shadow-sm">
                            @else
                            <div class="w-16 h-16 bg-slate-200 rounded-full border-2 border-slate-300 flex items-center justify-center text-slate-400"><i class="fas fa-user"></i></div>
                            @endif
                            <input wire:model="foto_profile" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 transition cursor-pointer">
                        </div>
                        @error('foto_profile') <span class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-500 font-bold text-xs uppercase transition hover:bg-slate-50">Batal</button>

                    <button type="submit"
                        wire:loading.attr="disabled"
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-xs uppercase shadow-lg transition transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">

                        <span wire:loading wire:target="store, update">
                            <i class="fas fa-spinner fa-spin"></i> Menyimpan...
                        </span>

                        <span wire:loading.remove wire:target="store, update">
                            {{ $isEditMode ? 'Simpan Perubahan' : 'Buat Personil Baru' }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>