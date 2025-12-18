<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Peta Kerawanan</h2>
                <p class="text-sm text-orange-400 mt-1">Pemetaan Potensi Ancaman Wilayah.</p>
            </div>
            @if(!$showForm)
            <button wire:click="create" class="bg-orange-600 hover:bg-orange-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-orange-900/50 transition border border-orange-500/50 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Input Titik Rawan</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-orange-900/80 backdrop-blur-sm border-l-4 border-orange-500 text-orange-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-orange-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Data Kerawanan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Jenis Ancaman</label>
                    <input wire:model="jenis_ancaman" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition" placeholder="Sengketa Lahan / Radikalisme">
                    @error('jenis_ancaman') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Tokoh Kunci / Target</label>
                    <input wire:model="tokoh_kunci" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Tingkat Kerawanan</label>
                    <select wire:model="tingkat_rawan" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition">
                        <option value="rendah">Rendah (Hijau)</option>
                        <option value="sedang">Sedang (Kuning)</option>
                        <option value="tinggi">Tinggi (Merah)</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Deskripsi Singkat</label>
                    <textarea wire:model="deskripsi_singkat" rows="3" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-orange-500 transition"></textarea>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-orange-600 hover:bg-orange-500 text-white font-bold shadow-lg shadow-orange-900/50 transition">
                    {{ $isEditMode ? 'Simpan Data' : 'Simpan Data' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-orange-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Wilayah / Ancaman...">
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Wilayah</th>
                            <th class="px-6 py-4">Ancaman & Tokoh</th>
                            <th class="px-6 py-4">Tingkat</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($kerawanans as $item)
                        <tr class="hover:bg-white/5 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $item->desa }}</div>
                                <div class="text-xs text-gray-500">Kec. {{ $item->kecamatan }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-orange-400">{{ $item->jenis_ancaman }}</div>
                                @if($item->tokoh_kunci)
                                <div class="text-xs text-gray-500 mt-1">Target: {{ $item->tokoh_kunci }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($item->tingkat_rawan == 'tinggi')
                                <span class="text-red-500 font-bold border border-red-500/50 px-2 py-1 rounded bg-red-500/10">TINGGI</span>
                                @elseif($item->tingkat_rawan == 'sedang')
                                <span class="text-yellow-500 font-bold border border-yellow-500/50 px-2 py-1 rounded bg-yellow-500/10">SEDANG</span>
                                @else
                                <span class="text-emerald-500 font-bold border border-emerald-500/50 px-2 py-1 rounded bg-emerald-500/10">RENDAH</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-400 max-w-xs truncate">{{ $item->deskripsi_singkat }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $item->id }})" class="text-blue-400 hover:text-blue-300">Edit</button>
                                    <button wire:confirm="Hapus?" wire:click="delete({{ $item->id }})" class="text-red-400 hover:text-red-300">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada data kerawanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 border-t border-white/10 bg-white/5">{{ $kerawanans->links() }}</div>
        </div>
        @endif
    </div>
</div>