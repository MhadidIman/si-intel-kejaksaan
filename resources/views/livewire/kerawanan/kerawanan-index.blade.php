<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        {{-- HEADER --}}
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl border-b-4 border-indigo-500 group">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 blur-[100px] rounded-full pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-900/40 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-3 shadow-[0_0_30px_rgba(79,70,229,0.3)] shrink-0">
                        <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-full h-full object-contain" alt="Logo Kejaksaan">
                    </div>
                    <div>
                        <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight drop-shadow-md">
                            Peta <span class="text-indigo-400">KERAWANAN & SPK</span>
                        </h2>
                        <p class="text-xs text-slate-300 font-medium mt-2 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse shadow-[0_0_8px_rgba(129,140,248,0.8)]"></span>
                            Scoring Prioritas Ancaman (Metode SAW)
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    @if(!$showForm)
                    {{-- TOMBOL CETAK REKAP --}}
                    <a href="{{ route('cetak.kerawanan') }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-black py-3 px-6 rounded-xl shadow-lg shadow-emerald-600/30 transition-all duration-300 text-xs uppercase tracking-widest transform hover:-translate-y-1 border border-emerald-500">
                        <i class="fas fa-print text-sm"></i>
                        <span>Cetak Rekap</span>
                    </a>

                    <button wire:click="create" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-black py-3 px-8 rounded-xl shadow-lg shadow-indigo-600/30 transition-all duration-300 text-xs uppercase tracking-widest transform hover:-translate-y-1 border border-indigo-500">
                        <i class="fas fa-plus-circle text-sm"></i>
                        <span>Input Peta Baru</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between gap-3 animate-fade-in-down">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-100 rounded-full text-indigo-600"><i class="fas fa-check"></i></div>
                <span class="font-bold text-indigo-800 text-sm tracking-wide">{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-indigo-500 hover:text-indigo-700 transition"><i class="fas fa-times"></i></button>
        </div>
        @endif

        {{-- TABEL DATA --}}
        @if(!$showForm)
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden w-full">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:max-w-md group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <i class="fas fa-search-location"></i>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-11 block w-full rounded-xl border-slate-200 bg-white text-slate-800 font-medium focus:border-indigo-500 focus:ring-indigo-500/20 py-3 shadow-sm text-sm transition-all" placeholder="Cari Wilayah atau Potensi Ancaman...">
                </div>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white text-slate-400 text-[10px] uppercase font-black tracking-widest border-b-2 border-slate-100">
                            <th class="px-6 py-5 w-1/4">Wilayah & GIS</th>
                            <th class="px-6 py-5 w-1/3">Potensi Ancaman</th>
                            <th class="px-6 py-5 text-center">Tingkat Prioritas (SPK)</th>
                            <th class="px-6 py-5 text-center">Verifikasi</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-800">
                        @forelse($peta as $item)
                        <tr class="hover:bg-slate-50/80 transition duration-200 group">
                            <td class="px-6 py-6 align-top">
                                <div class="font-black text-slate-900 text-sm uppercase tracking-tight">{{ $item->kecamatan }}</div>
                                <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-indigo-50 text-[9px] font-black text-indigo-700 border border-indigo-200 uppercase tracking-widest">
                                    <i class="fas fa-layer-group opacity-50"></i> {{ $item->bidang }}
                                </div>
                                <div class="mt-2 text-[10px] text-slate-500 font-mono">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                    {{ $item->latitude ?? 'N/A' }}, {{ $item->longitude ?? 'N/A' }}
                                </div>
                            </td>

                            <td class="px-6 py-6 align-top min-w-[300px]">
                                <div class="font-bold text-slate-700 text-xs leading-relaxed line-clamp-3">"{{ $item->potensi_ancaman }}"</div>
                                <div class="mt-4 pt-3 border-t border-slate-100/80 flex items-center justify-start gap-3">
                                    <div class="flex items-center gap-2 bg-slate-50 px-2.5 py-1.5 rounded-xl border border-slate-200 shadow-sm">
                                        <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-black text-[9px] shadow-inner border border-indigo-200">
                                            {{ substr($item->user->name ?? 'S', 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] font-bold text-slate-700 max-w-[100px] truncate leading-none">{{ $item->user->name ?? 'Sistem' }}</span>
                                            <span class="text-[8px] font-black text-slate-400 tracking-widest mt-0.5">{{ $item->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6 align-middle min-w-[180px]">
                                @php
                                $theme = [
                                'tinggi' => ['text' => 'text-red-600', 'bg' => 'bg-red-500', 'badge' => 'bg-red-50 border-red-200 text-red-600'],
                                'sedang' => ['text' => 'text-orange-600', 'bg' => 'bg-orange-500', 'badge' => 'bg-orange-50 border-orange-200 text-orange-600'],
                                'rendah' => ['text' => 'text-emerald-600', 'bg' => 'bg-emerald-500', 'badge' => 'bg-emerald-50 border-emerald-200 text-emerald-600'],
                                ];
                                $t = $theme[$item->tingkat_rawan] ?? $theme['rendah'];
                                @endphp

                                <div class="flex flex-col gap-2">
                                    <div class="flex justify-between items-end">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Risk Index</span>
                                        <div class="text-right">
                                            <span class="text-xs font-black {{ $t['text'] }}">{{ number_format($item->skor_spk, 1) }}</span>
                                            <span class="text-[9px] font-bold text-slate-400">/ 100</span>
                                        </div>
                                    </div>

                                    {{-- Progress Bar --}}
                                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden shadow-inner">
                                        <div class="{{ $t['bg'] }} h-1.5 rounded-full transition-all duration-1000 ease-out" style="width: {{ $item->skor_spk }}%"></div>
                                    </div>

                                    {{-- Badge Status --}}
                                    <div class="mt-1 inline-flex items-center justify-center px-2 py-1 rounded border {{ $t['badge'] }} text-[8px] font-black uppercase tracking-widest w-fit shadow-sm">
                                        @if($item->tingkat_rawan == 'tinggi') <i class="fas fa-exclamation-triangle mr-1"></i> @endif
                                        {{ $item->tingkat_rawan }}
                                    </div>
                                </div>
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
                                <button wire:click="openStatusModal({{ $item->id }})" class="inline-flex items-center justify-between gap-2 w-32 py-2 px-3 rounded-xl text-[9px] font-black uppercase tracking-widest border shadow-sm {{ $theme }} hover:shadow-md transition-all cursor-pointer">
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
                                    {{-- TOMBOL CETAK SATUAN --}}
                                    <a href="{{ route('cetak.kerawanan.satuan', $item->id) }}" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all shadow-sm" title="Cetak Laporan Satuan">
                                        <i class="fas fa-file-pdf text-xs"></i>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="Edit Peta">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>

                                    @if(auth()->user()->isAdmin())
                                    <button wire:confirm="Hapus data pemetaan ini?" wire:click="delete({{ $item->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Hapus Data">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">Belum ada data pemetaan wilayah kerawanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-100 bg-slate-50/30">
                {{ $peta->links() }}
            </div>
        </div>
        @endif

        {{-- FORM MODAL INPUT / EDIT --}}
        @if($showForm)
        <div x-transition class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-600/10 border border-slate-100 overflow-hidden mb-12 relative animate-fade-in-up">

            <div class="bg-slate-900 px-8 py-5 border-b-4 border-indigo-500 flex justify-between items-center">
                <div class="flex items-center gap-3 text-white">
                    <i class="fas {{ $isEditMode ? 'fa-edit' : 'fa-plus-circle' }} text-indigo-400"></i>
                    <h3 class="font-black text-sm uppercase tracking-widest">{{ $isEditMode ? 'Edit Peta Kerawanan' : 'Input Peta Kerawanan Baru' }}</h3>
                </div>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white rounded-full transition"><i class="fas fa-times"></i></button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 md:p-10 space-y-8 bg-slate-50/30">

                {{-- Baris 1: Informasi Dasar --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Kecamatan / Wilayah</label>
                        <input wire:model="kecamatan" type="text" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-indigo-500 focus:ring-indigo-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                        @error('kecamatan') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Bidang (IPOLEKSOSBUDHANKAM)</label>
                        <select wire:model="bidang" class="block w-full rounded-xl bg-white border border-slate-200 text-slate-900 font-bold focus:border-indigo-500 focus:ring-indigo-500/20 transition-all py-3 px-4 shadow-sm text-sm">
                            <option value="">-- Pilih Bidang --</option>
                            <option value="Ideologi">Ideologi</option>
                            <option value="Politik">Politik</option>
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Sosial Budaya">Sosial Budaya</option>
                            <option value="Pertahanan & Keamanan">Pertahanan & Keamanan</option>
                        </select>
                        @error('bidang') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Baris 2: Potensi & Koordinat Peta --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Potensi Ancaman</label>
                        <textarea wire:model="potensi_ancaman" rows="4" class="block w-full rounded-2xl bg-white border border-slate-200 text-slate-900 font-medium focus:border-indigo-500 transition-all py-4 px-5 shadow-sm text-sm"></textarea>
                    </div>

                    <div class="space-y-4 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                        <label class="block text-xs font-black text-blue-800 uppercase tracking-widest"><i class="fas fa-map-marker-alt"></i> Titik Koordinat Peta (GIS)</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase">Latitude</label>
                                <input wire:model="latitude" type="text" placeholder="-3.316694" class="mt-1 block w-full rounded-xl border border-slate-200 py-2 px-3 text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase">Longitude</label>
                                <input wire:model="longitude" type="text" placeholder="114.590111" class="mt-1 block w-full rounded-xl border border-slate-200 py-2 px-3 text-sm">
                            </div>
                        </div>
                        <p class="text-[9px] text-slate-500 italic">*Format koordinat desimal (contoh: Banjarmasin -3.316, 114.590)</p>
                    </div>
                </div>

                {{-- Baris 3: Parameter SPK (Sistem Pendukung Keputusan) --}}
                <div class="bg-amber-50/50 p-6 rounded-2xl border border-amber-200 shadow-sm space-y-4">
                    <div class="border-b border-amber-200 pb-3 mb-4">
                        <h4 class="text-sm font-black text-amber-800 uppercase tracking-widest"><i class="fas fa-calculator"></i> Parameter Penilaian Prioritas (SPK SAW)</h4>
                        <p class="text-[10px] text-amber-600 font-medium mt-1">Sistem akan otomatis menghitung tingkat kerawanan berdasarkan skor 1 (Paling Rendah) sampai 10 (Paling Parah).</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1" title="Seberapa besar dampak kerusakan/kerugian yang ditimbulkan">Kriteria 1: Dampak (Bobot 40%)</label>
                            <input wire:model="kriteria_dampak" type="number" min="1" max="10" class="block w-full rounded-xl bg-white border border-amber-300 text-slate-900 font-bold focus:border-amber-500 focus:ring-amber-500/20 py-3 px-4 shadow-sm text-sm" placeholder="Nilai 1-10">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1" title="Seberapa besar kemungkinan ancaman ini terjadi">Kriteria 2: Probabilitas (Bobot 35%)</label>
                            <input wire:model="kriteria_probabilitas" type="number" min="1" max="10" class="block w-full rounded-xl bg-white border border-amber-300 text-slate-900 font-bold focus:border-amber-500 py-3 px-4 shadow-sm text-sm" placeholder="Nilai 1-10">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1" title="Seberapa cepat isu/ancaman ini membesar">Kriteria 3: Eskalasi (Bobot 25%)</label>
                            <input wire:model="kriteria_eskalasi" type="number" min="1" max="10" class="block w-full rounded-xl bg-white border border-amber-300 text-slate-900 font-bold focus:border-amber-500 py-3 px-4 shadow-sm text-sm" placeholder="Nilai 1-10">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-slate-200">
                    <button type="button" wire:click="closeModal" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 font-bold uppercase text-[10px] tracking-widest transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-indigo-600 text-white font-black uppercase text-[10px] tracking-widest shadow-lg shadow-indigo-500/30 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>{{ $isEditMode ? 'Simpan Perubahan' : 'Proses Analisis SPK' }}</span>
                    </button>
                </div>
            </form>
        </div>
        @endif

        {{-- MODAL VERIFIKASI --}}
        @if($showStatusModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 transition-opacity">
            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl p-8 relative animate-fade-in-up border border-slate-100">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-slate-50 text-slate-700 border-2 border-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <i class="fas fa-clipboard-check text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest">Verifikasi Peta</h3>
                </div>

                <div class="space-y-3">
                    <button wire:click="updateStatus('disetujui')" class="w-full py-3.5 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-200 hover:border-emerald-600 font-black uppercase text-xs tracking-widest transition-all">Setujui</button>
                    <button wire:click="updateStatus('ditolak')" class="w-full py-3.5 rounded-xl bg-red-50 hover:bg-red-600 text-red-700 hover:text-white border border-red-200 hover:border-red-600 font-black uppercase text-xs tracking-widest transition-all">Tolak</button>
                </div>
                <button wire:click="closeStatusModal" class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition"><i class="fas fa-times"></i></button>
            </div>
        </div>
        @endif

    </div>
</div>