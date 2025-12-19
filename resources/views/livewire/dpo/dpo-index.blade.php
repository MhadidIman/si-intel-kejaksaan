<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Data Buronan (DPO)</h2>
                <p class="text-sm text-red-400 mt-1">Daftar Pencarian Orang Tindak Pidana.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('cetak.dpo') }}" target="_blank" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition border border-gray-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Cetak Rekap</span>
                </a>

                @if(!$showForm)
                <button wire:click="create" class="bg-red-600 hover:bg-red-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-red-900/50 transition border border-red-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Input DPO Baru</span>
                </button>
                @endif
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-red-900/80 backdrop-blur-sm border-l-4 border-red-500 text-red-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-red-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Data DPO</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Nama Lengkap</label>
                        <input wire:model="nama_lengkap" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-red-500 focus:ring-red-500 transition shadow-inner placeholder-gray-600" placeholder="Nama Buronan">
                        @error('nama_lengkap') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Tempat Lahir</label>
                            <input wire:model="tempat_lahir" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-red-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Lahir</label>
                            <input wire:model="tanggal_lahir" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-red-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Kasus Posisi</label>
                        <textarea wire:model="kasus" rows="3" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-red-500 transition placeholder-gray-600" placeholder="Jelaskan kasusnya..."></textarea>
                        @error('kasus') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Status Hukum</label>
                            <select wire:model="status_hukum" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-red-500 transition">
                                <option value="">-- Pilih --</option>
                                <option value="Tersangka">Tersangka</option>
                                <option value="Terdakwa">Terdakwa</option>
                                <option value="Terpidana">Terpidana</option>
                                <option value="Saksi">Saksi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Status Pencarian</label>
                            <select wire:model="status_pencarian" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-red-500 transition">
                                <option value="buron">Masih Buron</option>
                                <option value="tertangkap">Sudah Tertangkap</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Ciri-ciri Fisik</label>
                        <input wire:model="ciri_fisik" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-red-500 transition placeholder-gray-600" placeholder="Tinggi, warna kulit, tanda khusus...">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Foto DPO</label>
                        <div class="flex items-center gap-4">
                            @if ($foto)
                            <img src="{{ $foto->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-lg border border-white/20">
                            @elseif ($foto_lama)
                            <img src="{{ asset('storage/' . $foto_lama) }}" class="w-16 h-16 object-cover rounded-lg border border-white/20">
                            @else
                            <div class="w-16 h-16 bg-white/5 rounded-lg border border-white/10 flex items-center justify-center text-gray-500 text-xs">No Img</div>
                            @endif

                            <input wire:model="foto" type="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-500 transition cursor-pointer">
                        </div>
                        <div wire:loading wire:target="foto" class="text-xs text-yellow-400 mt-1">Mengupload foto...</div>
                        @error('foto') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-red-600 hover:bg-red-500 text-white font-bold shadow-lg shadow-red-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data DPO' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-red-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Nama DPO / Kasus...">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Foto</th>
                            <th class="px-6 py-4">Identitas</th>
                            <th class="px-6 py-4">Kasus</th>
                            <th class="px-6 py-4">Status Hukum</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($dpos as $item)
                        <tr class="hover:bg-white/5 transition duration-150 group">
                            <td class="px-6 py-4">
                                @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-12 h-12 rounded-full object-cover border-2 border-white/10 group-hover:border-red-500 transition">
                                @else
                                <div class="w-12 h-12 rounded-full bg-red-900/30 flex items-center justify-center text-red-500 font-bold border border-white/5">
                                    ?
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-lg">{{ $item->nama_lengkap }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ $item->tempat_lahir ?? '-' }},
                                    {{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d M Y') : '-' }}
                                </div>
                                @if($item->ciri_fisik)
                                <div class="text-[10px] text-gray-400 italic mt-1 line-clamp-1">"{{ $item->ciri_fisik }}"</div>
                                @endif
                            </td>

                            <td class="px-6 py-4 max-w-xs truncate" title="{{ $item->kasus }}">
                                {{ $item->kasus }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="bg-gray-700/50 text-gray-300 px-2 py-1 rounded text-xs border border-white/10">
                                    {{ $item->status_hukum }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if($item->status_pencarian == 'buron')
                                <span class="bg-red-500/10 text-red-400 px-3 py-1 rounded-full text-xs border border-red-500/20 font-bold animate-pulse flex items-center gap-1 w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> BURON
                                </span>
                                @else
                                <span class="bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full text-xs border border-emerald-500/20 font-bold flex items-center gap-1 w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> TERTANGKAP
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('cetak.dpo.satuan', $item->id) }}" target="_blank" class="p-2 rounded-lg text-yellow-400 hover:bg-yellow-500/10 transition" title="Cetak Biodata">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.5 2-2 2h-1m6 0c1.5 0 2-1.116 2-2V5a2 2 0 00-2-2H9a2 2 0 00-2 2v1h-1"></path>
                                        </svg>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})" class="p-2 rounded-lg text-blue-400 hover:bg-blue-500/10 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button wire:confirm="Hapus data DPO ini?" wire:click="delete({{ $item->id }})" class="p-2 rounded-lg text-red-400 hover:bg-red-500/10 transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 italic">
                                Belum ada data DPO yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-white/10 bg-white/5">
                {{ $dpos->links() }}
            </div>
        </div>
        @endif
    </div>
</div>