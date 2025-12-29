<div class="py-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">

            <div class="flex items-center gap-5">

                <div class="bg-blue-50 p-3 rounded-2xl border border-blue-100 shadow-sm transition-transform hover:scale-105 duration-500">

                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-12 w-12 object-contain" alt="Logo">

                </div>

                <div class="relative">

                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">

                        Pengawasan <span class="text-blue-600">ORANG ASING (WNA)</span>

                    </h2>

                    <p class="text-[10px] text-slate-500 mt-1 font-black tracking-[0.2em] uppercase flex items-center gap-2">

                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse shadow-[0_0_8px_rgba(59,130,246,0.6)]"></span>

                        Data Warga Negara Asing & Izin Tinggal

                    </p>

                </div>

            </div>



            <div class="flex flex-col sm:flex-row gap-3">

                <a href="{{ route('cetak.wna') }}" target="_blank" class="group bg-white hover:bg-slate-50 text-slate-600 font-black py-3 px-6 rounded-xl shadow-sm border-2 border-slate-200 transition-all flex items-center gap-3 text-[10px] uppercase tracking-widest">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-slate-400 group-hover:text-slate-600">

                        <path fill-rule="evenodd" d="M7.875 1.5a.75.75 0 01.75.75v2.25h6.75a.75.75 0 01.75.75v3h3a3 3 0 013 3v9a3 3 0 01-3 3h-18a3 3 0 01-3-3v-9a3 3 0 013-3h3v-3a.75.75 0 01.75-.75h6.75zM6 6v3.75h12V6H6zM3.75 12a.75.75 0 01.75-.75h15a.75.75 0 01.75.75v6a.75.75 0 01-.75.75h-15a.75.75 0 01-.75-.75v-6z" clip-rule="evenodd" />

                    </svg>

                    <span>Cetak Rekap</span>

                </a>



                @if(!$showForm)

                <button wire:click="create" class="group relative overflow-hidden bg-blue-600 hover:bg-blue-700 text-white font-black py-3 px-8 rounded-xl shadow-lg shadow-blue-200 border-2 border-blue-500 transition-all flex items-center gap-3 text-[10px] uppercase tracking-widest">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">

                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />

                    </svg>

                    <span>Input WNA Baru</span>

                </button>

                @endif

            </div>

        </div>

        @if (session()->has('message'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r shadow-sm flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <span class="font-bold text-sm">{{ session('message') }}</span>
        </div>
        @endif

        @if(!$showForm)

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button wire:click="$set('filterStatus', '')" class="p-4 rounded-2xl border transition-all duration-200 text-left group {{ $filterStatus == '' ? 'bg-slate-800 text-white border-slate-900 shadow-lg' : 'bg-white border-slate-100 hover:border-slate-300' }}">
                <div class="text-[10px] font-black uppercase tracking-widest opacity-60">Total Data</div>
                <div class="text-2xl font-black mt-1">{{ \App\Models\Wna::count() }}</div>
            </button>

            <button wire:click="$set('filterStatus', 'overstay')" class="p-4 rounded-2xl border transition-all duration-200 text-left group {{ $filterStatus == 'overstay' ? 'bg-red-600 text-white border-red-700 shadow-lg shadow-red-200' : 'bg-white border-slate-100 hover:border-red-200' }}">
                <div class="flex justify-between items-start">
                    <div class="text-[10px] font-black uppercase tracking-widest opacity-80 {{ $filterStatus == 'overstay' ? 'text-white' : 'text-red-600' }}">Overstay</div>
                    <i class="fas fa-exclamation-circle {{ $filterStatus == 'overstay' ? 'text-white' : 'text-red-500' }}"></i>
                </div>
                <div class="text-2xl font-black mt-1 {{ $filterStatus == 'overstay' ? 'text-white' : 'text-red-600' }}">{{ $countOverstay }}</div>
            </button>

            <button wire:click="$set('filterStatus', 'warning')" class="p-4 rounded-2xl border transition-all duration-200 text-left group {{ $filterStatus == 'warning' ? 'bg-amber-500 text-white border-amber-600 shadow-lg shadow-amber-200' : 'bg-white border-slate-100 hover:border-amber-200' }}">
                <div class="flex justify-between items-start">
                    <div class="text-[10px] font-black uppercase tracking-widest opacity-80 {{ $filterStatus == 'warning' ? 'text-white' : 'text-amber-600' }}">Warning (H-30)</div>
                    <i class="fas fa-bell {{ $filterStatus == 'warning' ? 'text-white' : 'text-amber-500' }}"></i>
                </div>
                <div class="text-2xl font-black mt-1 {{ $filterStatus == 'warning' ? 'text-white' : 'text-amber-600' }}">{{ $countWarning }}</div>
            </button>

            <div class="p-1">
                <div class="relative h-full">
                    <input wire:model.live="search" type="text" class="w-full h-full rounded-2xl border-slate-200 bg-white text-sm font-bold text-slate-700 focus:border-blue-500 focus:ring-0 placeholder-slate-400 pl-10" placeholder="Cari Paspor / Nama...">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Identitas WNA</th>
                            <th class="px-6 py-4">Status Izin Tinggal</th>
                            <th class="px-6 py-4">Tujuan & Sponsor</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm">
                        @forelse($wnas as $wna)
                        <tr class="hover:bg-slate-50/80 transition duration-300">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-black text-xs border border-blue-100 uppercase">
                                        {{ substr($wna->kebangsaan, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 uppercase">{{ $wna->nama_lengkap }}</p>
                                        <p class="text-xs text-slate-400 font-mono mt-0.5">PASPOR: {{ $wna->nomor_paspor }}</p>
                                        <p class="text-[10px] text-slate-400 mt-0.5 uppercase">{{ $wna->kebangsaan }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                $tglExp = \Carbon\Carbon::parse($wna->masa_berlaku_izin_tinggal)->startOfDay();
                                $today = \Carbon\Carbon::now()->startOfDay();
                                $diff = $today->diffInDays($tglExp, false); // False agar hasil negatif jika lewat
                                @endphp

                                <div class="mb-1">
                                    @if($diff < 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-100 text-red-700 text-[10px] font-black uppercase tracking-wide border border-red-200">
                                        <i class="fas fa-exclamation-circle"></i> OVERSTAY {{ abs($diff) }} HARI
                                        </span>
                                        @elseif($diff <= 30)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 text-[10px] font-black uppercase tracking-wide border border-amber-200">
                                            <i class="fas fa-clock"></i> Sisa {{ $diff }} Hari
                                            </span>
                                            @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-wide border border-emerald-200">
                                                <i class="fas fa-check-circle"></i> Aman
                                            </span>
                                            @endif
                                </div>
                                <p class="text-xs font-bold text-slate-600">
                                    Berlaku s/d: {{ $tglExp->format('d M Y') }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700 text-xs uppercase">{{ $wna->tujuan_kunjungan }}</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">Sponsor: {{ $wna->sponsor ?? '-' }}</p>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('cetak.wna.satuan', $wna->id) }}" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-800 hover:text-white transition shadow-sm border border-slate-200" title="Cetak">
                                        <i class="fas fa-print text-xs"></i>
                                    </a>
                                    <button wire:click="edit({{ $wna->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm border border-blue-100" title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </button>
                                    <button wire:confirm="Hapus data WNA ini?" wire:click="delete({{ $wna->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100" title="Hapus">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">Tidak ada data WNA ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-50">
                {{ $wnas->links() }}
            </div>
        </div>
        @endif

        @if($showForm)
        <div class="bg-white rounded-[2rem] shadow-lg border border-blue-100 overflow-hidden max-w-4xl mx-auto animate-fade-in-up">
            <div class="bg-blue-50 px-8 py-6 border-b border-blue-100 flex justify-between items-center">
                <h3 class="font-black text-blue-900 text-lg uppercase tracking-widest italic">
                    {{ $isEditMode ? 'Edit Data WNA' : 'Input Data Orang Asing' }}
                </h3>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-white rounded-full text-slate-400 hover:text-red-500 shadow-sm transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nama Lengkap</label>
                        <input wire:model="nama_lengkap" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-blue-500 focus:ring-0">
                        @error('nama_lengkap') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nomor Paspor</label>
                        <input wire:model="nomor_paspor" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-blue-500 focus:ring-0 uppercase">
                        @error('nomor_paspor') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Kebangsaan</label>
                        <input wire:model="kebangsaan" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-blue-500 focus:ring-0 uppercase">
                    </div>
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Tanggal Tiba</label>
                        <input wire:model="tanggal_tiba" type="date" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-blue-500 focus:ring-0">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-red-500 uppercase tracking-widest">Masa Berlaku Izin s/d</label>
                        <input wire:model="masa_berlaku_izin_tinggal" type="date" class="w-full rounded-xl border-red-200 bg-red-50 font-bold text-red-700 focus:border-red-500 focus:ring-0">
                        @error('masa_berlaku_izin_tinggal') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Tujuan Kunjungan</label>
                        <select wire:model="tujuan_kunjungan" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-blue-500 focus:ring-0">
                            <option value="">Pilih Tujuan...</option>
                            <option value="Wisata">Wisata</option>
                            <option value="Bekerja">Bekerja (TKA)</option>
                            <option value="Pendidikan">Pendidikan / Studi</option>
                            <option value="Keluarga">Kunjungan Keluarga</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('tujuan_kunjungan') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Sponsor / Penjamin</label>
                        <input wire:model="sponsor" type="text" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-blue-500 focus:ring-0">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Alamat Menginap</label>
                    <textarea wire:model="alamat_menginap" rows="2" class="w-full rounded-xl border-slate-200 font-bold text-slate-700 focus:border-blue-500 focus:ring-0"></textarea>
                    @error('alamat_menginap') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Foto Dokumen (Paspor/KITAS)</label>
                    <input wire:model="foto_dokumen" type="file" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                    @if ($foto_dokumen)
                    <span class="text-[10px] text-emerald-600 font-bold mt-1 block">File terpilih: {{ $foto_dokumen->getClientOriginalName() }}</span>
                    @endif
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-50">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-blue-600 text-white font-bold text-xs uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-200 transition hover:-translate-y-1">Simpan Data</button>
                </div>
            </form>
        </div>
        @endif

    </div>
</div>