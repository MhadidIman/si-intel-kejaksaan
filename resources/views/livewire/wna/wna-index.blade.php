<div class="py-10 bg-slate-50 dark:bg-slate-900/50 dark:bg-slate-900 transition-colors duration-300 min-h-screen font-sans">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        {{-- ============================================================== --}}
        {{-- HEADER: TEMA EXECUTIVE SLATE-PURPLE                            --}}
        {{-- ============================================================== --}}
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl border-b-4 border-purple-500 group">

            <div class="absolute -top-24 -right-24 w-96 h-96 bg-purple-500/20 blur-[100px] rounded-full pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-500/10 blur-[100px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">

                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-3 shadow-[0_0_30px_rgba(168,85,247,0.3)] shrink-0">
                        <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-full h-full object-contain" alt="Logo Kejaksaan">
                    </div>
                    <div>
                        <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight drop-shadow-md">
                            Pengawasan <span class="text-purple-400">WNA</span>
                        </h2>
                        <p class="text-xs text-slate-300 font-medium mt-2 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse shadow-[0_0_8px_rgba(192,132,252,0.8)]"></span>
                            Pemantauan Warga Negara Asing (TIMPORA)
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="{{ route('cetak.wna') }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/50 border border-slate-600 text-slate-300 hover:text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 text-xs uppercase tracking-widest backdrop-blur-sm">
                        <i class="fas fa-print text-sm"></i>
                        <span>Cetak Rekap</span>
                    </a>

                    @if(!$showForm)
                    <button wire:click="create" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-black py-3 px-8 rounded-xl shadow-lg shadow-purple-600/30 transition-all duration-300 text-xs uppercase tracking-widest transform hover:-translate-y-1 border border-purple-500">
                        <i class="fas fa-user-plus text-sm"></i>
                        <span>Input Data WNA</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between gap-3 animate-fade-in-down">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 rounded-full text-purple-600"><i class="fas fa-check"></i></div>
                <span class="font-bold text-purple-800 text-sm tracking-wide">{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-purple-500 hover:text-purple-700 transition"><i class="fas fa-times"></i></button>
        </div>
        @endif

        {{-- ============================================================== --}}
        {{-- TABEL DATA (TAMPILAN BERSIH & MODERN)                          --}}
        {{-- ============================================================== --}}
        @if(!$showForm)
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 dark:border-slate-700 overflow-hidden w-full">

            {{-- Toolbar Filter & Pencarian --}}
            <div class="p-6 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:max-w-md group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-purple-500 transition-colors">
                        <i class="fas fa-search"></i>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-11 block w-full rounded-xl border-slate-200 bg-white text-slate-800 dark:text-slate-100 font-medium focus:border-purple-500 focus:ring-purple-500/20 py-3 shadow-sm text-sm transition-all" placeholder="Cari Nama WNA, Kebangsaan atau Paspor...">
                </div>
                <div class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 shadow-sm flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        Total WNA: <span class="text-purple-600 text-base ml-1">{{ $wnas->total() }}</span>
                    </span>
                </div>
            </div>

            {{-- Tabel Pembungkus --}}
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white text-slate-400 text-[10px] uppercase font-black tracking-widest border-b-2 border-slate-100 dark:border-slate-700">
                            <th class="px-6 py-5 text-center w-24">Dokumen</th>
                            <th class="px-6 py-5 w-1/4">Identitas WNA</th>
                            <th class="px-6 py-5 w-1/4">Kunjungan & Izin</th>
                            <th class="px-6 py-5">Sponsor & Alamat</th>
                            <th class="px-6 py-5 text-center">Verifikasi</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-800 dark:text-slate-100">
                        @forelse($wnas as $item)
                        <tr class="hover:bg-slate-50 dark:bg-slate-900/50/80 transition duration-200 group">

                            <td class="px-6 py-6 text-center align-top">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden border border-slate-200 shadow-sm mx-auto group-hover:border-purple-300 transition-colors">
                                    @if($item->foto_dokumen && in_array(pathinfo($item->foto_dokumen, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
                                    <img src="{{ asset('storage/' . $item->foto_dokumen) }}" class="w-full h-full object-cover">
                                    @elseif($item->foto_dokumen && pathinfo($item->foto_dokumen, PATHINFO_EXTENSION) == 'pdf')
                                    <a href="{{ asset('storage/' . $item->foto_dokumen) }}" target="_blank" class="w-full h-full bg-purple-50 flex items-center justify-center text-purple-600 hover:bg-purple-100 transition" title="Lihat PDF">
                                        <i class="fas fa-file-pdf text-xl"></i>
                                    </a>
                                    @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                        <i class="fas fa-passport text-xl"></i>
                                    </div>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-6 align-top whitespace-nowrap">
                                <div class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-tight">{{ $item->nama_lengkap }}</div>
                                <div class="text-[10px] text-slate-500 font-bold mt-1.5 uppercase">
                                    <i class="fas fa-id-card text-slate-400 mr-1"></i> Paspor: <span class="text-slate-800 dark:text-slate-100 font-mono">{{ $item->nomor_paspor }}</span>
                                </div>
                                <span class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-purple-50 text-[9px] font-black text-purple-700 border border-purple-200 uppercase tracking-widest">
                                    <i class="fas fa-globe-asia opacity-50"></i>
                                    {{ $item->kebangsaan }}
                                </span>
                            </td>

                            <td class="px-6 py-6 align-top">
                                <div class="font-bold text-slate-700 text-xs leading-relaxed uppercase mb-3 line-clamp-2" title="{{ $item->tujuan_kunjungan }}">
                                    {{ $item->tujuan_kunjungan }}
                                </div>

                                <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100 dark:border-slate-700">
                                    <div>
                                        <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Tgl Tiba</div>
                                        <div class="text-[10px] font-bold text-slate-700">
                                            <i class="far fa-calendar-check text-slate-400 mr-1"></i> {{ $item->tanggal_tiba ? $item->tanggal_tiba->format('d/m/Y') : '-' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Izin Tinggal Exp</div>
                                        <div class="text-[10px] font-black text-purple-600">
                                            <i class="far fa-calendar-times opacity-50 mr-1"></i> {{ $item->masa_berlaku_izin_tinggal ? $item->masa_berlaku_izin_tinggal->format('d/m/Y') : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6 align-top min-w-[250px]">
                                <div class="font-bold text-slate-700 text-xs leading-relaxed uppercase mb-2">
                                    <span class="text-[9px] font-black text-slate-400 block mb-0.5">Sponsor:</span>
                                    <i class="fas fa-building text-slate-300 mr-1 text-[10px]"></i> {{ $item->sponsor ?? '-' }}
                                </div>
                                <div class="text-[10px] text-slate-500 italic border-l-2 border-slate-200 pl-2 line-clamp-2" title="{{ $item->alamat_menginap }}">
                                    {{ $item->alamat_menginap }}
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-700/80 flex items-center justify-end gap-3">
                                    <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-900/50 px-2.5 py-1.5 rounded-xl border border-slate-200 shadow-sm" title="Diinput pada: {{ $item->created_at->format('d M Y, H:i') }}">
                                        <div class="w-6 h-6 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-black text-[9px] shadow-inner border border-purple-200">
                                            {{ substr($item->user->name ?? 'S', 0, 1) }}
                                        </div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-[9px] font-bold text-slate-700 max-w-[100px] truncate leading-none">{{ $item->user->name ?? 'Sistem' }}</span>
                                            <span class="text-[8px] font-black text-slate-400 flex items-center gap-1 tracking-widest mt-0.5">
                                                <i class="far fa-clock"></i> {{ $item->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                @php
                                $statusColor = [
                                'pending' => 'bg-amber-50 text-amber-600 border-amber-200 animate-pulse',
                                'disetujui' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                'ditolak' => 'bg-red-50 text-red-600 border-red-200'
                                ];
                                $iconStatus = [
                                'pending' => 'fa-hourglass-half',
                                'disetujui' => 'fa-check-circle',
                                'ditolak' => 'fa-times-circle'
                                ];
                                $currentStatus = strtolower($item->status_verifikasi ?? 'pending');
                                $theme = $statusColor[$currentStatus] ?? 'bg-slate-50 dark:bg-slate-900/50 text-slate-600 dark:text-slate-300 border-slate-200';
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
                                    <a href="{{ route('cetak.wna.satuan', $item->id) }}" target="_blank"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 dark:text-slate-300 hover:bg-slate-800 hover:border-slate-800 hover:text-white transition-all shadow-sm"
                                        title="Cetak Laporan">
                                        <i class="fas fa-print text-xs"></i>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                                        title="Edit Data">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>

                                    @if(auth()->user()->isAdmin())
                                    <button wire:click="confirmDelete({{ $item->id ?? $user->id ?? $selectedLapdu->id ?? $dpo->id }})"
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
                                    <i class="fas fa-passport text-3xl opacity-20"></i>
                                    <span>Belum ada rekaman data WNA.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50/30">
                {{ $wnas->links() }}
            </div>
        </div>
        @endif

        {{-- ============================================================== --}}
        {{-- FORM MODAL INPUT / EDIT                                        --}}
        {{-- ============================================================== --}}
        @if($showForm)
        <div x-transition class="bg-white rounded-[2.5rem] shadow-2xl shadow-purple-600/10 border border-slate-100 dark:border-slate-700 overflow-hidden mb-12 relative animate-fade-in-up">

            <div class="bg-slate-900 px-8 py-5 border-b-4 border-purple-600 flex justify-between items-center">
                <div class="flex items-center gap-3 text-white">
                    <i class="fas {{ $isEditMode ? 'fa-edit' : 'fa-user-plus' }} text-purple-400"></i>
                    <h3 class="font-black text-sm uppercase tracking-widest">{{ $isEditMode ? 'Edit Data WNA' : 'Input Data WNA Baru' }}</h3>
                </div>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white rounded-full transition"><i class="fas fa-times"></i></button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 md:p-10 space-y-8 bg-slate-50 dark:bg-slate-900/50/30">

                <div class="space-y-4">
                    <h4 class="text-sm font-black text-purple-600 uppercase tracking-widest border-b border-purple-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-id-badge text-purple-400"></i> I. Identitas WNA
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2 col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input wire:model="nama_lengkap" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 dark:text-white font-bold focus:border-purple-500 focus:ring-purple-500/20 transition-all py-3 px-4 shadow-sm placeholder-slate-300 text-sm">
                            @error('nama_lengkap') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Kebangsaan</label>
                            <input wire:model="kebangsaan" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 dark:text-white font-bold focus:border-purple-500 focus:ring-purple-500/20 transition-all py-3 px-4 shadow-sm text-sm placeholder-slate-300" placeholder="Contoh: Malaysia">
                            @error('kebangsaan') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <h4 class="text-sm font-black text-purple-600 uppercase tracking-widest border-b border-purple-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-passport text-purple-400"></i> II. Dokumen Imigrasi
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nomor Paspor</label>
                                <input wire:model="nomor_paspor" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 dark:text-white font-bold focus:border-purple-500 focus:ring-purple-500/20 transition-all py-3 px-4 shadow-sm text-sm" placeholder="No. Paspor">
                                @error('nomor_paspor') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tanggal Tiba di RI</label>
                                    <input wire:model="tanggal_tiba" type="date" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 dark:text-white font-bold focus:border-purple-500 focus:ring-purple-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Batas Izin Tinggal</label>
                                    <input wire:model="masa_berlaku_izin_tinggal" type="date" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 dark:text-white font-bold focus:border-purple-500 focus:ring-purple-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                                    @error('masa_berlaku_izin_tinggal') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <h4 class="text-sm font-black text-purple-600 uppercase tracking-widest border-b border-purple-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-building text-purple-400"></i> III. Aktivitas & Alamat
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tujuan Kunjungan</label>
                                <textarea wire:model="tujuan_kunjungan" rows="3" class="block w-full rounded-2xl bg-white border border-slate-200 text-slate-900 dark:text-white font-medium focus:border-purple-500 focus:ring-purple-500/20 transition-all py-4 px-5 shadow-sm placeholder-slate-300 text-sm" placeholder="Contoh: Bekerja di PT. XYZ, Tenaga Ahli, Wisata..."></textarea>
                                @error('tujuan_kunjungan') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Sponsor / Penjamin</label>
                                <input wire:model="sponsor" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 dark:text-white font-bold focus:border-purple-500 focus:ring-purple-500/20 transition-all py-3 px-4 shadow-sm placeholder-slate-300 text-sm" placeholder="Nama Perusahaan / Perorangan penjamin">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Alamat Tinggal / Menginap</label>
                            <textarea wire:model="alamat_menginap" rows="7" class="block w-full rounded-2xl bg-white border border-slate-200 text-slate-900 dark:text-white font-medium focus:border-purple-500 focus:ring-purple-500/20 transition-all py-4 px-5 shadow-sm placeholder-slate-300 text-sm leading-relaxed" placeholder="Alamat lengkap selama di Indonesia..."></textarea>
                            @error('alamat_menginap') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <h4 class="text-sm font-black text-purple-600 uppercase tracking-widest border-b border-purple-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-file-upload text-purple-400"></i> IV. Berkas Lampiran
                    </h4>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Upload Foto / Scan Dokumen (PDF/JPG)</label>
                        <div class="flex items-center gap-4 p-4 border border-dashed border-slate-300 rounded-xl bg-white hover:border-purple-400 transition-colors">
                            @if ($foto_dokumen || $foto_dokumen_lama)
                            <div class="w-12 h-12 bg-purple-100 rounded-xl border border-purple-300 flex items-center justify-center text-purple-600 shadow-sm">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            @else
                            <div class="w-12 h-12 bg-slate-100 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300">
                                <i class="fas fa-file-upload text-xl"></i>
                            </div>
                            @endif
                            <input wire:model="foto_dokumen" type="file" class="block w-full text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-black file:uppercase file:tracking-widest file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition cursor-pointer">
                        </div>
                        @error('foto_dokumen') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-slate-200">
                    <button type="button" wire:click="closeModal" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-600 dark:text-slate-300 hover:bg-slate-100 font-bold uppercase text-[10px] tracking-widest transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-purple-600 text-white font-black uppercase text-[10px] tracking-widest shadow-lg shadow-purple-500/30 hover:bg-purple-700 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>{{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data WNA' }}</span>
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
            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl p-8 relative animate-fade-in-up border border-slate-100 dark:border-slate-700">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-slate-50 dark:bg-slate-900/50 text-slate-700 border-2 border-slate-100 dark:border-slate-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <i class="fas fa-clipboard-check text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 dark:text-slate-100 uppercase tracking-widest">Verifikasi Data</h3>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Validasi status data WNA ini.</p>
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

                <button wire:click="closeStatusModal" class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif
        {{-- ============================================================== --}}
        {{-- MODAL HAPUS DATA                                               --}}
        {{-- ============================================================== --}}
        @if($isDeleteOpen)
        <div class="fixed inset-0 z-[110] flex items-center justify-center bg-slate-900/80 backdrop-blur-sm p-4 transition-opacity">
            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl p-8 relative animate-fade-in-up border border-slate-100 dark:border-slate-700 text-center">

                <div class="w-20 h-20 bg-red-50 text-red-500 border-4 border-red-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <i class="fas fa-exclamation-triangle text-3xl animate-pulse"></i>
                </div>

                <h3 class="text-xl font-black text-slate-800 dark:text-slate-100 uppercase tracking-widest mb-2">Hapus Data?</h3>
                <p class="text-xs text-slate-500 font-medium leading-relaxed mb-8">Data ini akan dihapus secara permanen dan tidak dapat dikembalikan. Lanjutkan?</p>

                <div class="flex flex-col gap-3">
                    <button wire:click="delete" class="w-full py-3.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-black uppercase text-xs tracking-widest transition-all shadow-lg shadow-red-500/30 flex items-center justify-center gap-2">
                        <i class="fas fa-trash-alt"></i> Ya, Hapus Permanen
                    </button>
                    <button wire:click="$set('isDeleteOpen', false)" class="w-full py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold uppercase text-xs tracking-widest transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>