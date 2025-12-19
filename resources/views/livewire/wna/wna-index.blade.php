<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Pengawasan Orang Asing</h2>
                <p class="text-sm text-blue-400 mt-1">Data Warga Negara Asing & Izin Tinggal.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('cetak.wna') }}" target="_blank" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition border border-gray-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Cetak Rekap</span>
                </a>

                @if(!$showForm)
                <button wire:click="create" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-900/50 transition border border-blue-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Input WNA Baru</span>
                </button>
                @endif
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-blue-900/80 backdrop-blur-sm border-l-4 border-blue-500 text-blue-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-blue-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Data WNA</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Nama Lengkap</label>
                        <input wire:model="nama_lengkap" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition shadow-inner">
                        @error('nama_lengkap') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Kebangsaan</label>
                            <input wire:model="kebangsaan" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition">
                            @error('kebangsaan') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Nomor Paspor</label>
                            <input wire:model="nomor_paspor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition">
                            @error('nomor_paspor') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Tiba</label>
                            <input wire:model="tanggal_tiba" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Izin Tinggal s/d</label>
                            <input wire:model="masa_berlaku_izin_tinggal" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition">
                            @error('masa_berlaku_izin_tinggal') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Tujuan Kunjungan</label>
                        <input wire:model="tujuan_kunjungan" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition" placeholder="Wisata / Kerja / Kunjungan">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Sponsor / Penjamin</label>
                        <input wire:model="sponsor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Alamat Menginap</label>
                        <textarea wire:model="alamat_menginap" rows="2" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-blue-500 transition"></textarea>
                        @error('alamat_menginap') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Foto / Dokumen (Paspor/KITAS)</label>
                        <div class="flex items-center gap-4">
                            @if ($foto_dokumen)
                            <img src="{{ $foto_dokumen->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-lg border border-white/20">
                            @elseif ($foto_lama)
                            <img src="{{ asset('storage/' . $foto_lama) }}" class="w-16 h-16 object-cover rounded-lg border border-white/20">
                            @else
                            <div class="w-16 h-16 bg-white/5 rounded-lg border border-white/10 flex items-center justify-center text-gray-500 text-xs">No Img</div>
                            @endif

                            <input wire:model="foto_dokumen" type="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500 transition cursor-pointer">
                        </div>
                        <div wire:loading wire:target="foto_dokumen" class="text-xs text-yellow-400 mt-1">Mengupload...</div>
                        @error('foto_dokumen') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold shadow-lg shadow-blue-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-blue-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Nama / Paspor...">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Dokumen</th>
                            <th class="px-6 py-4">Identitas & Paspor</th>
                            <th class="px-6 py-4">Asal & Tujuan</th>
                            <th class="px-6 py-4">Izin Tinggal</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($wnas as $item)
                        <tr class="hover:bg-white/5 transition duration-150 group">
                            <td class="px-6 py-4">
                                @if($item->foto_dokumen)
                                <img src="{{ asset('storage/' . $item->foto_dokumen) }}" class="w-12 h-12 rounded object-cover border border-white/10 group-hover:border-blue-500 transition">
                                @else
                                <div class="w-12 h-12 rounded bg-blue-900/30 flex items-center justify-center text-blue-500 font-bold border border-white/5">
                                    Doc
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-lg">{{ $item->nama_lengkap }}</div>
                                <div class="text-xs text-gray-400 font-mono tracking-wide">
                                    PASPOR: {{ $item->nomor_paspor }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-white">{{ $item->kebangsaan }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    Tujuan: {{ $item->tujuan_kunjungan }}
                                    @if($item->sponsor) <br> Sponsor: {{ $item->sponsor }} @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                $isOverstay = $item->masa_berlaku_izin_tinggal < now();
                                    $sisaHari=now()->diffInDays($item->masa_berlaku_izin_tinggal, false);
                                    @endphp

                                    @if($isOverstay)
                                    <div class="bg-red-500/20 text-red-400 px-3 py-1 rounded-lg border border-red-500/30 inline-block text-center">
                                        <div class="text-xs font-bold animate-pulse">OVERSTAY</div>
                                        <div class="text-[10px]">Exp: {{ $item->masa_berlaku_izin_tinggal->format('d/m/Y') }}</div>
                                    </div>
                                    @else
                                    <div class="text-emerald-400 font-bold">
                                        Valid
                                        <span class="text-xs text-gray-500 font-normal block">
                                            s/d {{ $item->masa_berlaku_izin_tinggal->format('d M Y') }}
                                        </span>
                                    </div>
                                    @if($sisaHari < 30)
                                        <span class="text-[10px] text-yellow-500">Warning: {{ $sisaHari }} hari lagi</span>
                                        @endif
                                        @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('cetak.wna.satuan', $item->id) }}" target="_blank" class="p-2 rounded-lg text-yellow-400 hover:bg-yellow-500/10 transition" title="Cetak Biodata">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.5 2-2 2h-1m6 0c1.5 0 2-1.116 2-2V5a2 2 0 00-2-2H9a2 2 0 00-2 2v1h-1"></path>
                                        </svg>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})" class="p-2 rounded-lg text-blue-400 hover:bg-blue-500/10 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button wire:confirm="Hapus data WNA ini?" wire:click="delete({{ $item->id }})" class="p-2 rounded-lg text-red-400 hover:bg-red-500/10 transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic">
                                Belum ada data WNA yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-white/10 bg-white/5">
                {{ $wnas->links() }}
            </div>
        </div>
        @endif
    </div>
</div>