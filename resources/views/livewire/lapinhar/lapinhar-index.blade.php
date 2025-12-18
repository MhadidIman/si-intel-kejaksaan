<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Data LAPINHAR</h2>
                <p class="text-sm text-emerald-400 mt-1">Laporan Informasi Harian Bidang Intelijen.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('cetak.lapinhar') }}" target="_blank" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition border border-gray-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Rekap Laporan</span>
                </a>

                @if(!$showForm)
                <button wire:click="create" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-emerald-900/50 transition border border-emerald-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Input Laporan Baru</span>
                </button>
                @endif
            </div>
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
                    <input wire:model="nomor_surat" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition shadow-inner">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Surat</label>
                    <input wire:model="tanggal_surat" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition shadow-inner">
                    @error('tanggal_surat') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Bidang</label>
                    <select wire:model="bidang" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition shadow-inner">
                        <option value="">-- Pilih Bidang --</option>
                        <option value="Ipoleksosbudhankam">Ipoleksosbudhankam</option>
                        <option value="Hukum">Hukum</option>
                        <option value="Keamanan">Keamanan</option>
                    </select>
                    @error('bidang') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Sumber Informasi</label>
                    <input wire:model="sumber_informasi" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition shadow-inner" placeholder="Misal: Masyarakat / Penugasan">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Peristiwa / Fakta</label>
                    <textarea wire:model="peristiwa" rows="3" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition shadow-inner" placeholder="Uraikan fakta kejadian..."></textarea>
                    @error('peristiwa') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Pendapat / Analisa Intelijen</label>
                    <textarea wire:model="pendapat" rows="3" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition shadow-inner" placeholder="Analisa dan prediksi kedepan..."></textarea>
                    @error('pendapat') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-emerald-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Peristiwa...">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Peristiwa / Laporan</th>
                            <th class="px-6 py-4">Bidang</th>
                            <th class="px-6 py-4">Pendapat / Analisa</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($lapinhars as $item)
                        <tr class="hover:bg-white/5 transition duration-150 group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="font-bold text-white">{{ $item->tanggal_surat->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500 font-mono mt-1">{{ $item->nomor_surat ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-white max-w-xs truncate" title="{{ $item->peristiwa }}">
                                {{ $item->peristiwa }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-emerald-500/10 text-emerald-400 px-2 py-1 rounded text-xs border border-emerald-500/20 font-bold">
                                    {{ $item->bidang }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-400 max-w-xs truncate">
                                {{ $item->pendapat }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('cetak.lapinhar.satuan', $item->id) }}" target="_blank" class="p-2 rounded-lg text-yellow-400 hover:bg-yellow-500/10 transition" title="Cetak Surat Laporan">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})" class="p-2 rounded-lg text-blue-400 hover:bg-blue-500/10 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <button wire:confirm="Hapus data ini?" wire:click="delete({{ $item->id }})" class="p-2 rounded-lg text-red-400 hover:bg-red-500/10 transition" title="Hapus">
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
                                Belum ada data laporan yang tercatat.
                            </td>
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