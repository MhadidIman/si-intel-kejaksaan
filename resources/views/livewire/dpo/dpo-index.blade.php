<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        {{-- ============================================================== --}}
        {{-- HEADER: TEMA EXECUTIVE SLATE-RED                               --}}
        {{-- ============================================================== --}}
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl border-b-4 border-red-600 group">

            <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/20 blur-[100px] rounded-full pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-red-900/40 blur-[100px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">

                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-3 shadow-[0_0_30px_rgba(220,38,38,0.3)] shrink-0">
                        <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-full h-full object-contain" alt="Logo Kejaksaan">
                    </div>
                    <div>
                        <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight drop-shadow-md">
                            Data <span class="text-red-500">BURONAN (DPO)</span>
                        </h2>
                        <p class="text-xs text-slate-300 font-medium mt-2 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse shadow-[0_0_8px_rgba(239,68,68,0.8)]"></span>
                            Daftar Pencarian Orang Tindak Pidana
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="{{ route('cetak.dpo') }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/50 border border-slate-600 text-slate-300 hover:text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 text-xs uppercase tracking-widest backdrop-blur-sm">
                        <i class="fas fa-print text-sm"></i>
                        <span>Cetak Rekap</span>
                    </a>

                    @if(!$showForm)
                    <button wire:click="create" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-black py-3 px-8 rounded-xl shadow-lg shadow-red-600/30 transition-all duration-300 text-xs uppercase tracking-widest transform hover:-translate-y-1 border border-red-500">
                        <i class="fas fa-user-plus text-sm"></i>
                        <span>Input DPO</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between gap-3 animate-fade-in-down">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-100 rounded-full text-red-600"><i class="fas fa-check"></i></div>
                <span class="font-bold text-red-800 text-sm tracking-wide">{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-red-500 hover:text-red-700 transition"><i class="fas fa-times"></i></button>
        </div>
        @endif

        {{-- ============================================================== --}}
        {{-- TABEL DATA (TAMPILAN BERSIH & MODERN)                          --}}
        {{-- ============================================================== --}}
        @if(!$showForm)
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden w-full">

            {{-- Toolbar Filter & Pencarian --}}
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:max-w-md group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-red-500 transition-colors">
                        <i class="fas fa-search"></i>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-11 block w-full rounded-xl border-slate-200 bg-white text-slate-800 font-medium focus:border-red-500 focus:ring-red-500/20 py-3 shadow-sm text-sm transition-all" placeholder="Cari Nama Buronan atau Kasus...">
                </div>
                <div class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 shadow-sm flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        Total DPO: <span class="text-red-600 text-base ml-1">{{ $dpos->total() }}</span>
                    </span>
                </div>
            </div>

            {{-- Tabel Pembungkus --}}
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white text-slate-400 text-[10px] uppercase font-black tracking-widest border-b-2 border-slate-100">
                            <th class="px-6 py-5 text-center w-20">Foto</th>
                            <th class="px-6 py-5 w-1/4">Identitas Buronan</th>
                            <th class="px-6 py-5 w-1/3">Kasus & Ciri Fisik</th>
                            <th class="px-6 py-5 text-center">Status</th>
                            <th class="px-6 py-5 text-center">Verifikasi</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-800">
                        @forelse($dpos as $item)
                        <tr class="hover:bg-slate-50/80 transition duration-200 group">

                            <td class="px-6 py-6 text-center align-top">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden border border-slate-200 shadow-sm mx-auto group-hover:border-red-300 transition-colors">
                                    @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                        <i class="fas fa-user-secret text-xl"></i>
                                    </div>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-6 align-top whitespace-nowrap">
                                <div class="font-black text-slate-900 text-sm uppercase tracking-tight">{{ $item->nama_lengkap }}</div>
                                <div class="text-[10px] text-slate-500 font-bold mt-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-map-marker-alt text-red-400"></i>
                                    {{ $item->tempat_lahir ?? '-' }}, {{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d M Y') : '-' }}
                                </div>
                                <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-[9px] font-bold text-slate-500 border border-slate-200 uppercase tracking-widest">
                                    <i class="fas fa-gavel text-slate-400"></i>
                                    {{ $item->status_hukum }}
                                </div>
                            </td>

                            <td class="px-6 py-6 align-top min-w-[300px]">
                                <div class="font-bold text-slate-700 text-xs leading-relaxed uppercase" title="{{ $item->kasus }}">
                                    {{ $item->kasus }}
                                </div>
                                @if($item->ciri_fisik)
                                <div class="mt-2 text-[10px] text-slate-500 italic border-l-2 border-slate-200 pl-2">
                                    <span class="font-black not-italic text-slate-400 uppercase tracking-widest text-[8px] block mb-0.5">Ciri Fisik:</span>
                                    {{ $item->ciri_fisik }}
                                </div>
                                @endif

                                <div class="mt-4 pt-3 border-t border-slate-100/80 flex items-center justify-end gap-3">
                                    <div class="flex items-center gap-2 bg-slate-50 px-2.5 py-1.5 rounded-xl border border-slate-200 shadow-sm" title="Diinput pada: {{ $item->created_at->format('d M Y, H:i') }}">
                                        <div class="w-6 h-6 rounded-full bg-red-100 text-red-700 flex items-center justify-center font-black text-[9px] shadow-inner border border-red-200">
                                            {{ substr($item->user->name ?? 'S', 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] font-bold text-slate-700 max-w-[100px] truncate leading-none">{{ $item->user->name ?? 'Sistem' }}</span>
                                            <span class="text-[8px] font-black text-slate-400 flex items-center gap-1 tracking-widest mt-0.5">
                                                <i class="far fa-clock"></i> {{ $item->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                @if($item->status_pencarian == 'buron')
                                <div class="inline-flex items-center justify-center gap-2 w-28 py-2 px-3 rounded-xl text-[9px] font-black uppercase tracking-widest border border-red-200 bg-red-50 text-red-600 shadow-sm animate-pulse">
                                    <i class="fas fa-search-location"></i> BURON
                                </div>
                                @else
                                <div class="inline-flex items-center justify-center gap-2 w-28 py-2 px-3 rounded-xl text-[9px] font-black uppercase tracking-widest border border-emerald-200 bg-emerald-50 text-emerald-600 shadow-sm">
                                    <i class="fas fa-check-circle"></i> TERTANGKAP
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                @php
                                $statusColor = [
                                'pending' => 'bg-amber-50 text-amber-600 border-amber-200',
                                'disetujui' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                'ditolak' => 'bg-red-50 text-red-600 border-red-200'
                                ];
                                $iconStatus = [
                                'pending' => 'fa-hourglass-half',
                                'disetujui' => 'fa-check-circle',
                                'ditolak' => 'fa-times-circle'
                                ];
                                $currentStatus = strtolower($item->status_verifikasi ?? 'pending');
                                $theme = $statusColor[$currentStatus] ?? 'bg-slate-50 text-slate-600 border-slate-200';
                                $icon = $iconStatus[$currentStatus] ?? 'fa-info-circle';
                                @endphp

                                @if(auth()->user()->isAdmin())
                                <button wire:click="openStatusModal({{ $item->id }})"
                                    class="inline-flex items-center justify-center gap-2 w-32 py-2 px-3 rounded-xl text-[9px] font-black uppercase tracking-widest border shadow-sm {{ $theme }} hover:shadow-md transition-all cursor-pointer" title="Klik untuk verifikasi">
                                    <i class="fas {{ $icon }}"></i>
                                    <span class="truncate">{{ $item->status_verifikasi ?? 'PENDING' }}</span>
                                </button>
                                @else
                                <div class="inline-flex items-center justify-center gap-2 w-32 py-2 px-3 rounded-xl text-[9px] font-black uppercase tracking-widest border {{ $theme }}">
                                    <i class="fas {{ $icon }}"></i>
                                    <span>{{ $item->status_verifikasi ?? 'PENDING' }}</span>
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('cetak.dpo.satuan', $item->id) }}" target="_blank"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-800 hover:border-slate-800 hover:text-white transition-all shadow-sm"
                                        title="Cetak Laporan">
                                        <i class="fas fa-print text-xs"></i>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                                        title="Edit Data">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>

                                    @if(auth()->user()->isAdmin())
                                    <button wire:confirm="Hapus data ini secara permanen?" wire:click="delete({{ $item->id }})"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                        title="Hapus Data">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium italic">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-user-secret text-3xl opacity-20"></i>
                                    <span>Belum ada rekaman data DPO.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-100 bg-slate-50/30">
                {{ $dpos->links() }}
            </div>
        </div>
        @endif

        {{-- ============================================================== --}}
        {{-- FORM MODAL INPUT / EDIT                                        --}}
        {{-- ============================================================== --}}
        @if($showForm)
        <div x-transition class="bg-white rounded-[2.rem] shadow-2xl shadow-red-600/10 border border-slate-100 overflow-hidden mb-12 relative animate-fade-in-up">

            <div class="bg-slate-900 px-8 py-5 border-b-4 border-red-600 flex justify-between items-center">
                <div class="flex items-center gap-3 text-white">
                    <i class="fas {{ $isEditMode ? 'fa-edit' : 'fa-user-plus' }} text-red-500"></i>
                    <h3 class="font-black text-sm uppercase tracking-widest">{{ $isEditMode ? 'Edit Data DPO' : 'Input Data DPO Baru' }}</h3>
                </div>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white rounded-full transition"><i class="fas fa-times"></i></button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 md:p-10 space-y-8 bg-slate-50/30">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input wire:model="nama_lengkap" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-red-500 focus:ring-red-500/20 transition-all py-3 px-4 shadow-sm placeholder-slate-300 text-sm">
                        @error('nama_lengkap') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tempat Lahir</label>
                            <input wire:model="tempat_lahir" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-red-500 focus:ring-red-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                            <input wire:model="tanggal_lahir" type="date" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-red-500 focus:ring-red-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Kasus Posisi</label>
                        <textarea wire:model="kasus" rows="4" class="block w-full rounded-2xl bg-white border border-slate-200 text-slate-900 font-medium focus:border-red-500 focus:ring-red-500/20 transition-all py-4 px-5 shadow-sm placeholder-slate-300 text-sm leading-relaxed" placeholder="Jelaskan ringkasan kasus..."></textarea>
                        @error('kasus') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Status Hukum</label>
                                <div class="relative">
                                    <select wire:model="status_hukum" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-red-500 focus:ring-red-500/20 transition-all py-3 px-4 shadow-sm appearance-none text-sm cursor-pointer">
                                        <option value="">-- Pilih --</option>
                                        <option value="Tersangka">Tersangka</option>
                                        <option value="Terdakwa">Terdakwa</option>
                                        <option value="Terpidana">Terpidana</option>
                                        <option value="Saksi">Saksi</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Status Pencarian</label>
                                <div class="relative">
                                    <select wire:model="status_pencarian" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-red-500 focus:ring-red-500/20 transition-all py-3 px-4 shadow-sm appearance-none text-sm cursor-pointer">
                                        <option value="buron">BURON</option>
                                        <option value="tertangkap">TERTANGKAP</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Ciri-Ciri Fisik Khusus</label>
                            <input wire:model="ciri_fisik" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-red-500 focus:ring-red-500/20 transition-all py-3 px-4 shadow-sm placeholder-slate-300 text-sm" placeholder="Contoh: Tinggi 170cm, Tato di lengan, dll">
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Foto DPO (Opsional)</label>
                    <div class="flex items-center gap-6 p-4 border border-dashed border-slate-300 rounded-xl bg-white">
                        @if ($foto)
                        <img src="{{ $foto->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-xl border border-red-200 shadow-sm">
                        @elseif ($foto_lama)
                        <img src="{{ asset('storage/' . $foto_lama) }}" class="w-16 h-16 object-cover rounded-xl border border-slate-200 shadow-sm">
                        @else
                        <div class="w-16 h-16 bg-slate-100 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300"><i class="fas fa-camera text-xl"></i></div>
                        @endif
                        <input wire:model="foto" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition cursor-pointer">
                    </div>
                    @error('foto') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-slate-200">
                    <button type="button" wire:click="closeModal" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 font-bold uppercase text-[10px] tracking-widest transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-red-600 text-white font-black uppercase text-[10px] tracking-widest shadow-lg shadow-red-500/30 hover:bg-red-700 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>{{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data' }}</span>
                    </button>
                </div>
            </form>
        </div>
        @endif

        {{-- ============================================================== --}}
        {{-- MODAL VERIFIKASI STATUS                                        --}}
        {{-- ============================================================== --}}
        @if($showStatusModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 transition-opacity">
            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl p-8 relative animate-fade-in-up border border-slate-100">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-slate-50 text-slate-700 border-2 border-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <i class="fas fa-clipboard-check text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest">Verifikasi Data</h3>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Validasi status data DPO ini.</p>
                </div>

                <div class="space-y-3">
                    <button wire:click="updateStatus('disetujui')" class="w-full py-3.5 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-200 hover:border-emerald-600 font-black uppercase text-xs tracking-widest transition-all flex items-center justify-center gap-3">
                        <i class="fas fa-check-circle"></i> Setujui
                    </button>
                    <button wire:click="updateStatus('ditolak')" class="w-full py-3.5 rounded-xl bg-red-50 hover:bg-red-600 text-red-700 hover:text-white border border-red-200 hover:border-red-600 font-black uppercase text-xs tracking-widest transition-all flex items-center justify-center gap-3">
                        <i class="fas fa-times-circle"></i> Tolak
                    </button>
                    <button wire:click="updateStatus('pending')" class="w-full py-3.5 rounded-xl bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white border border-amber-200 hover:border-amber-500 font-black uppercase text-xs tracking-widest transition-all flex items-center justify-center gap-3">
                        <i class="fas fa-hourglass-half"></i> Pending
                    </button>
                </div>

                <button wire:click="closeStatusModal" class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

    </div>
</div>