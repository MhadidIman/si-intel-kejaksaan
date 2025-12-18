<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Data Ormas & PAKEM</h2>
                <p class="text-sm text-purple-400 mt-1">Organisasi Kemasyarakatan & Aliran Kepercayaan.</p>
            </div>

            @if(!$showForm)
            <button wire:click="create" class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-purple-900/50 transition border border-purple-500/50 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Input Data Baru</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-purple-900/80 backdrop-blur-sm border-l-4 border-purple-500 text-purple-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-purple-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Data Ormas</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Nama Organisasi</label>
                        <input wire:model="nama_organisasi" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition placeholder-gray-600" placeholder="Nama Ormas / Yayasan">
                        @error('nama_organisasi') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Ketua / Pimpinan</label>
                        <input wire:model="ketua" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition">
                        @error('ketua') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Nomor Legalitas</label>
                            <input wire:model="nomor_legalitas" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition" placeholder="SKT / AHU">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Jumlah Anggota</label>
                            <input wire:model="jumlah_anggota" type="number" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition">
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Bentuk Organisasi</label>
                            <select wire:model="bentuk_organisasi" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition">
                                <option value="">-- Pilih --</option>
                                <option value="Ormas">Ormas</option>
                                <option value="LSM">LSM</option>
                                <option value="Yayasan">Yayasan</option>
                                <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                            </select>
                            @error('bentuk_organisasi') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Status Pantauan</label>
                            <select wire:model="status" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition">
                                <option value="aktif">Aktif</option>
                                <option value="vakum">Vakum</option>
                                <option value="diawasi">Dalam Pengawasan</option>
                                <option value="dilarang">Dilarang</option>
                            </select>
                            @error('status') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Kegiatan Terakhir</label>
                        <input wire:model="kegiatan_terakhir" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition" placeholder="Contoh: Bakti Sosial / Demo">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Alamat Sekretariat</label>
                        <textarea wire:model="alamat_sekretariat" rows="2" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-purple-500 transition"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-bold shadow-lg shadow-purple-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">

            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-purple-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Nama Organisasi / Ketua...">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Nama Organisasi</th>
                            <th class="px-6 py-4">Pimpinan & Legalitas</th>
                            <th class="px-6 py-4">Bentuk</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($ormas as $item)
                        <tr class="hover:bg-white/5 transition duration-150 group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-lg group-hover:text-purple-400 transition">{{ $item->nama_organisasi }}</div>
                                @if($item->alamat_sekretariat)
                                <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $item->alamat_sekretariat }}</div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-white">{{ $item->ketua }}</div>
                                <div class="text-xs text-gray-500 font-mono mt-1">
                                    {{ $item->nomor_legalitas ?? 'Belum ada legalitas' }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm">{{ $item->bentuk_organisasi }}</span>
                                @if($item->jumlah_anggota > 0)
                                <div class="text-[10px] text-gray-400 mt-1">{{ $item->jumlah_anggota }} Anggota</div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if($item->status == 'diawasi')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-500/10 text-orange-400 border border-orange-500/20 animate-pulse">
                                    ⚠ DIAWASI
                                </span>
                                @elseif($item->status == 'dilarang')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-500/10 text-red-400 border border-red-500/20">
                                    🚫 DILARANG
                                </span>
                                @elseif($item->status == 'vakum')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-700/50 text-gray-400 border border-white/10">
                                    VAKUM
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    AKTIF
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $item->id }})" class="p-2 rounded-lg text-blue-400 hover:bg-blue-500/10 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button wire:confirm="Hapus data organisasi ini?" wire:click="delete({{ $item->id }})" class="p-2 rounded-lg text-red-400 hover:bg-red-500/10 transition" title="Hapus">
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
                                Belum ada data Ormas yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-white/10 bg-white/5">
                {{ $ormas->links() }}
            </div>
        </div>
        @endif
    </div>
</div>