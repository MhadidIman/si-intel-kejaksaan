<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Peta Kerawanan Wilayah</h2>
                <p class="text-sm text-orange-400 mt-1">Monitoring Potensi Konflik, IPO, dan Kerawanan Sosial.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('cetak.kerawanan') }}" target="_blank" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition border border-gray-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Cetak Rekap</span>
                </a>

                @if(!$showForm)
                <button wire:click="create" class="bg-orange-600 hover:bg-orange-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-orange-900/50 transition border border-orange-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Input Titik Rawan</span>
                </button>
                @endif
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-orange-900/80 backdrop-blur-sm border-l-4 border-orange-500 text-orange-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-orange-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Analisa Kerawanan Wilayah</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Kecamatan</label>
                            <input wire:model="kecamatan" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition">
                            @error('kecamatan') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Desa / Kelurahan</label>
                            <input wire:model="desa" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition">
                            @error('desa') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Jenis Ancaman / Kerawanan</label>
                        <input wire:model="jenis_ancaman" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition" placeholder="Sengketa Lahan / Aliran Sesat / Konflik Sosial">
                        @error('jenis_ancaman') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Tokoh Kunci (Provokator/Tokoh Masyarakat)</label>
                        <input wire:model="tokoh_kunci" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition">
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Tingkat Kerawanan</label>
                        <select wire:model="tingkat_rawan" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="tinggi">Tinggi (Merah)</option>
                            <option value="sedang">Sedang (Kuning)</option>
                            <option value="rendah">Rendah (Hijau)</option>
                        </select>
                        @error('tingkat_rawan') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Deskripsi Singkat / Potensi Konflik</label>
                        <textarea wire:model="deskripsi_singkat" rows="4" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition"></textarea>
                        @error('deskripsi_singkat') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 transition font-medium">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-orange-600 hover:bg-orange-500 text-white font-bold shadow-lg shadow-orange-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">

            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-orange-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Kecamatan / Jenis Ancaman...">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4">Jenis Ancaman</th>
                            <th class="px-6 py-4">Tingkat</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($kerawanans as $item)
                        <tr class="hover:bg-white/5 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $item->kecamatan }}</div>
                                <div class="text-xs text-gray-500">Desa: {{ $item->desa }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $item->jenis_ancaman }}</td>
                            <td class="px-6 py-4">
                                @if($item->tingkat_rawan == 'tinggi')
                                <span class="bg-red-500/10 text-red-400 px-3 py-1 rounded-full text-xs border border-red-500/20 font-bold animate-pulse">TINGGI</span>
                                @elseif($item->tingkat_rawan == 'sedang')
                                <span class="bg-yellow-500/10 text-yellow-400 px-3 py-1 rounded-full text-xs border border-yellow-500/20 font-bold">SEDANG</span>
                                @else
                                <span class="bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full text-xs border border-emerald-500/20 font-bold">RENDAH</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs max-w-xs truncate" title="{{ $item->deskripsi_singkat }}">
                                {{ $item->deskripsi_singkat }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('cetak.kerawanan.satuan', $item->id) }}" target="_blank" class="p-2 rounded-lg text-yellow-400 hover:bg-yellow-500/10 transition" title="Cetak Analisa">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})" class="p-2 rounded-lg text-blue-400 hover:bg-blue-500/10 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <button wire:confirm="Hapus data kerawanan ini?" wire:click="delete({{ $item->id }})" class="p-2 rounded-lg text-red-400 hover:bg-red-500/10 transition">
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
                                Data titik rawan tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-white/10 bg-white/5">
                {{ $kerawanans->links() }}
            </div>
        </div>
        @endif
    </div>
</div>