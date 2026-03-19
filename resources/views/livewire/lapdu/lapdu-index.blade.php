<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        {{-- ============================================================== --}}
        {{-- HEADER: TEMA EXECUTIVE SLATE-CYAN                              --}}
        {{-- ============================================================== --}}
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl border-b-4 border-cyan-500 group">

            <div class="absolute -top-24 -right-24 w-96 h-96 bg-cyan-500/20 blur-[100px] rounded-full pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-900/40 blur-[100px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">

                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-3 shadow-[0_0_30px_rgba(6,182,212,0.3)] shrink-0">
                        <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-full h-full object-contain" alt="Logo Kejaksaan">
                    </div>
                    <div>
                        <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight drop-shadow-md">
                            Layanan <span class="text-cyan-400">PENGADUAN</span>
                        </h2>
                        <p class="text-xs text-slate-300 font-medium mt-2 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                            Pos Pelayanan Hukum & Pengaduan Masyarakat
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="{{ route('cetak.lapdu') }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/50 border border-slate-600 text-slate-300 hover:text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 text-xs uppercase tracking-widest backdrop-blur-sm">
                        <i class="fas fa-print text-sm"></i>
                        <span>Cetak Rekap</span>
                    </a>

                    @if(!$showForm)
                    <button wire:click="create" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-700 text-white font-black py-3 px-8 rounded-xl shadow-lg shadow-cyan-600/30 transition-all duration-300 text-xs uppercase tracking-widest transform hover:-translate-y-1 border border-cyan-500">
                        <i class="fas fa-bullhorn text-sm"></i>
                        <span>Buat Pengaduan</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-cyan-50 border-l-4 border-cyan-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between gap-3 animate-fade-in-down">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-cyan-100 rounded-full text-cyan-600"><i class="fas fa-check"></i></div>
                <span class="font-bold text-cyan-800 text-sm tracking-wide">{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-cyan-500 hover:text-cyan-700 transition"><i class="fas fa-times"></i></button>
        </div>
        @endif

        {{-- ============================================================== --}}
        {{-- TABEL DATA                                                     --}}
        {{-- ============================================================== --}}
        @if(!$showForm)
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden w-full">

            {{-- Toolbar --}}
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:max-w-md group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-cyan-500 transition-colors">
                        <i class="fas fa-search"></i>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-11 block w-full rounded-xl border-slate-200 bg-white text-slate-800 font-medium focus:border-cyan-500 focus:ring-cyan-500/20 py-3 shadow-sm text-sm transition-all" placeholder="Cari Nama Pelapor atau Terlapor...">
                </div>
                <div class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 shadow-sm flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        Total Laporan: <span class="text-cyan-600 text-base ml-1">{{ $lapdus->total() }}</span>
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white text-slate-400 text-[10px] uppercase font-black tracking-widest border-b-2 border-slate-100">
                            <th class="px-6 py-5 text-center w-20">Bukti</th>
                            <th class="px-6 py-5 w-1/4">Pelapor & Waktu</th>
                            <th class="px-6 py-5 w-1/3">Substansi & Terlapor</th>
                            <th class="px-6 py-5 text-center">Status</th>
                            <th class="px-6 py-5 text-center">Verifikasi</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-800">
                        @forelse($lapdus as $item)
                        <tr class="hover:bg-slate-50/80 transition duration-200 group">

                            <td class="px-6 py-6 text-center align-top">
                                @if($item->bukti_dukung)
                                <a href="{{ asset('storage/' . $item->bukti_dukung) }}" target="_blank" class="inline-flex items-center justify-center w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl border border-cyan-100 hover:bg-cyan-600 hover:text-white transition-all shadow-sm" title="Lihat Bukti">
                                    <i class="fas fa-file-alt text-lg"></i>
                                </a>
                                @else
                                <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-300">
                                    <i class="fas fa-file-excel text-lg"></i>
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 align-top whitespace-nowrap">
                                <div class="font-black text-slate-900 text-sm uppercase tracking-tight">{{ $item->nama_pelapor }}</div>
                                <div class="text-[10px] text-slate-500 font-bold mt-1 flex items-center gap-1.5">
                                    <i class="fas fa-phone-alt text-cyan-400 text-[9px]"></i> {{ $item->no_hp_pelapor ?? '-' }}
                                </div>
                                @if($item->nik)
                                <div class="mt-2 text-[9px] text-slate-400 font-mono tracking-tighter">NIK: {{ $item->nik }}</div>
                                @endif
                                <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-[9px] font-black text-blue-700 border border-blue-100 uppercase tracking-widest">
                                    <i class="far fa-calendar-alt opacity-50"></i>
                                    {{ $item->tanggal_terima ? $item->tanggal_terima->format('d M Y') : '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-6 align-top min-w-[300px]">
                                <div class="mb-2">
                                    <span class="text-[9px] font-black text-cyan-700 bg-cyan-50 border border-cyan-200 px-2 py-0.5 rounded uppercase tracking-wider">{{ $item->kategori_laporan }}</span>
                                </div>
                                <div class="font-bold text-slate-700 text-xs leading-relaxed line-clamp-2 italic">
                                    "{{ $item->uraian_pengaduan }}"
                                </div>
                                <div class="mt-2 text-[10px]">
                                    <span class="text-slate-400 font-black uppercase text-[8px] tracking-widest mr-1">Terlapor:</span>
                                    <span class="text-red-600 font-bold uppercase">{{ $item->nama_terlapor ?? 'Tidak Diketahui' }}</span>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100/80 flex items-center justify-start gap-3">
                                    <div class="flex items-center gap-2 bg-slate-50 px-2.5 py-1.5 rounded-xl border border-slate-200 shadow-sm">
                                        <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-black text-[9px] shadow-inner border border-blue-200">
                                            {{ substr($item->user->name ?? 'S', 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] font-bold text-slate-700 max-w-[100px] truncate leading-none">{{ $item->user->name ?? 'Sistem' }}</span>
                                            <span class="text-[8px] font-black text-slate-400 tracking-widest mt-0.5">{{ $item->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                @if($item->status_laporan == 'menunggu')
                                <div class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 text-slate-500 text-[9px] font-black uppercase tracking-widest border border-slate-200 animate-pulse">
                                    MENUNGGU
                                </div>
                                @elseif($item->status_laporan == 'proses')
                                <div class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-widest border border-blue-100">
                                    DIPROSES
                                </div>
                                @else
                                <div class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest border border-emerald-100">
                                    SELESAI
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
                                $currentStatus = strtolower($item->status_verifikasi ?? 'pending');
                                $theme = $statusColor[$currentStatus] ?? 'bg-slate-50 text-slate-600 border-slate-200';
                                @endphp

                                @if(auth()->user()->isAdmin())
                                <button wire:click="openStatusModal({{ $item->id }})"
                                    class="inline-flex items-center justify-between gap-2 w-32 py-2 px-3 rounded-xl text-[9px] font-black uppercase tracking-widest border shadow-sm {{ $theme }} hover:shadow-md transition-all cursor-pointer">
                                    <span class="truncate">{{ $item->status_verifikasi ?? 'PENDING' }}</span>
                                    <i class="fas fa-caret-down opacity-50"></i>
                                </button>
                                @else
                                <div class="inline-flex items-center justify-center gap-2 w-32 py-2 px-3 rounded-xl text-[9px] font-black uppercase tracking-widest border {{ $theme }}">
                                    <span>{{ $item->status_verifikasi ?? 'PENDING' }}</span>
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('cetak.lapdu.satuan', $item->id) }}" target="_blank"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-800 hover:border-slate-800 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-print text-xs"></i>
                                    </a>
                                    <button wire:click="edit({{ $item->id }})"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>
                                    @if(auth()->user()->isAdmin())
                                    <button wire:confirm="Hapus pengaduan ini?" wire:click="delete({{ $item->id }})"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm">
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
                                    <i class="fas fa-inbox text-3xl opacity-20"></i>
                                    <span>Belum ada data pengaduan masuk.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-100 bg-slate-50/30">
                {{ $lapdus->links() }}
            </div>
        </div>
        @endif

        {{-- ============================================================== --}}
        {{-- FORM MODAL INPUT / EDIT                                        --}}
        {{-- ============================================================== --}}
        @if($showForm)
        <div x-transition class="bg-white rounded-[2.5rem] shadow-2xl shadow-cyan-600/10 border border-slate-100 overflow-hidden mb-12 relative animate-fade-in-up">

            <div class="bg-slate-900 px-8 py-5 border-b-4 border-cyan-500 flex justify-between items-center">
                <div class="flex items-center gap-3 text-white">
                    <i class="fas {{ $isEditMode ? 'fa-edit' : 'fa-plus-circle' }} text-cyan-400"></i>
                    <h3 class="font-black text-sm uppercase tracking-widest">{{ $isEditMode ? 'Edit Pengaduan' : 'Input Pengaduan Baru' }}</h3>
                </div>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white rounded-full transition"><i class="fas fa-times"></i></button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 md:p-10 space-y-8 bg-slate-50/30">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Pelapor / Instansi</label>
                        <input wire:model="nama_pelapor" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm placeholder-slate-300 text-sm">
                        @error('nama_pelapor') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">NIK (KTP)</label>
                            <input wire:model="nik" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">No. HP / WA</label>
                            <input wire:model="no_hp_pelapor" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Terlapor</label>
                            <input wire:model="nama_terlapor" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm placeholder-slate-300 text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Kategori</label>
                                <div class="relative">
                                    <select wire:model="kategori_laporan" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm appearance-none text-sm cursor-pointer">
                                        <option value="">-- Pilih --</option>
                                        <option value="Korupsi">Tindak Pidana Korupsi</option>
                                        <option value="Pegawai">Penyalahgunaan Wewenang</option>
                                        <option value="Umum">Tindak Pidana Umum</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tgl Laporan</label>
                                <input wire:model="tanggal_terima" type="date" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Uraian Pengaduan</label>
                        <textarea wire:model="uraian_pengaduan" rows="5" class="block w-full rounded-2xl bg-white border border-slate-200 text-slate-900 font-medium focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-4 px-5 shadow-sm placeholder-slate-300 text-sm leading-relaxed" placeholder="Jelaskan kronologi secara mendalam..."></textarea>
                        @error('uraian_pengaduan') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-200 pt-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Status Internal</label>
                            <div class="relative">
                                <select wire:model="status_laporan" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm appearance-none text-sm cursor-pointer">
                                    <option value="menunggu">Menunggu / Baru</option>
                                    <option value="proses">Sedang Diproses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 text-xs pointer-events-none"></i>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Ket. Tindak Lanjut</label>
                            <input wire:model="keterangan_tindak_lanjut" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 transition-all py-3 px-4 shadow-sm placeholder-slate-300 text-sm">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Bukti Dukung (PDF/IMG)</label>
                        <div class="flex items-center gap-4 p-4 border border-dashed border-slate-300 rounded-xl bg-white hover:border-cyan-400 transition-colors">
                            <div class="w-12 h-12 bg-slate-100 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400">
                                <i class="fas fa-upload text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <input wire:model="bukti_dukung" type="file" class="block w-full text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-black file:uppercase file:tracking-widest file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition cursor-pointer">
                                <p class="text-[9px] text-slate-400 mt-1 font-bold">MAX: 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-slate-200">
                    <button type="button" wire:click="closeModal" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 font-bold uppercase text-[10px] tracking-widest transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-cyan-600 text-white font-black uppercase text-[10px] tracking-widest shadow-lg shadow-cyan-500/30 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>{{ $isEditMode ? 'Simpan Perubahan' : 'Kirim Laporan' }}</span>
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
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest">Verifikasi Laporan</h3>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Validasi status laporan pengaduan ini.</p>
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