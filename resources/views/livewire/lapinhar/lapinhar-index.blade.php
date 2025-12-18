<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Data LAPINHAR</h2>
                <p class="text-sm text-emerald-400 mt-1">Laporan Informasi Harian Bidang Intelijen.</p>
            </div>

            @if(!$showForm)
            <button wire:click="create" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition border border-emerald-500/50 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Input Laporan Baru</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-emerald-900/80 backdrop-blur-sm border-l-4 border-emerald-500 text-emerald-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-emerald-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Input Lapinhar</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Nomor Surat</label>
                    <input wire:model="nomor_surat" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Surat</label>
                    <input wire:model="tanggal_surat" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition">
                    @error('tanggal_surat') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Bidang</label>
                    <select wire:model="bidang" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition">
                        <option value="">-- Pilih Bidang --</option>
                        <option value="Ipoleksosbudhankam">Ipoleksosbudhankam</option>
                        <option value="Hukum">Hukum</option>
                        <option value="Keamanan">Keamanan</option>
                    </select>
                    @error('bidang') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Sumber Informasi</label>
                    <input wire:model="sumber_informasi" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition" placeholder="Misal: Masyarakat / Penugasan">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Peristiwa / Fakta</label>
                    <textarea wire:model="peristiwa" rows="3" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition"></textarea>
                    @error('peristiwa') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Pendapat / Analisa Intelijen</label>
                    <textarea wire:model="pendapat" rows="3" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition"></textarea>
                    @error('pendapat') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg">Simpan Data</button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="pl-4 block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-emerald-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Peristiwa...">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Peristiwa / Laporan</th>
                            <th class="px-6 py-4">Bidang</th>
                            <th class="px-6 py-4">Pendapat</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($lapinhars as $item)
                        <tr class="hover:bg-white/5 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->tanggal_surat->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 font-bold text-white">{{ Str::limit($item->peristiwa, 50) }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-emerald-500/10 text-emerald-400 px-2 py-1 rounded text-xs border border-emerald-500/20">{{ $item->bidang }}</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">{{ Str::limit($item->pendapat, 30) }}</td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="edit({{ $item->id }})" class="text-blue-400 hover:text-blue-300 mr-2">Edit</button>
                                <button wire:confirm="Hapus data ini?" wire:click="delete({{ $item->id }})" class="text-red-400 hover:text-red-300">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data laporan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-white/10 bg-white/5">
                {{ $lapinhars->links() }}
            </div>
        </div>
        @endif
    </div>
</div>