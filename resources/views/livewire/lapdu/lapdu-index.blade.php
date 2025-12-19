<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Pengaduan Masyarakat</h2>
                <p class="text-sm text-emerald-400 mt-1">Administrasi Laporan Pengaduan (LAPDU) Intelijen.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('cetak.lapdu') }}" target="_blank" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition border border-gray-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Cetak Rekap</span>
                </a>

                @if(!$showForm)
                <button wire:click="create" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-emerald-900/50 transition border border-emerald-500/50 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Input Lapdu Baru</span>
                </button>
                @endif
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-emerald-900/80 backdrop-blur-sm border-l-4 border-emerald-500 text-emerald-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-emerald-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 p-8 text-white">
            <h3 class="font-bold text-lg mb-6 border-b border-white/10 pb-4">{{ $isEditMode ? 'Edit Data Pengaduan' : 'Form Pengaduan Masyarakat Baru' }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Nomor Surat</label>
                        <input wire:model="nomor_surat" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition shadow-inner">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Nama Pelapor</label>
                        <input wire:model="nama_pelapor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition" placeholder="Bisa Anonim">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Pihak Terlapor</label>
                        <input wire:model="terlapor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition">
                        @error('terlapor') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Terima</label>
                        <input wire:model="tanggal_terima" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition">
                        @error('tanggal_terima') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Status Lapdu</label>
                        <select wire:model="status" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition">
                            <option value="masuk">Laporan Masuk</option>
                            <option value="telaah">Dalam Telaah</option>
                            <option value="lid">Penyelidikan (LID)</option>
                            <option value="arsipkan">Diarsipkan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">No. HP Pelapor</label>
                        <input wire:model="no_hp_pelapor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition">
                    </div>
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 mt-2">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Uraian Pengaduan</label>
                        <textarea wire:model="uraian_pengaduan" rows="4" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-emerald-500 transition"></textarea>
                        @error('uraian_pengaduan') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-emerald-400 mb-1">Disposisi Pimpinan (Opsional)</label>
                        <textarea wire:model="disposisi_pimpinan" rows="4" class="block w-full rounded-lg bg-emerald-900/20 border-emerald-500/30 text-white focus:border-emerald-500 transition" placeholder="Instruksi Kasi Intel / Kajari..."></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Laporan' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-emerald-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Pelapor atau Terlapor...">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Tgl Terima</th>
                            <th class="px-6 py-4">Pelapor</th>
                            <th class="px-6 py-4">Pihak Terlapor</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($lapdus as $item)
                        <tr class="hover:bg-white/5 transition duration-150">
                            <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($item->tanggal_terima)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $item->nama_pelapor ?? 'Anonim' }}</div>
                                <div class="text-xs text-gray-500">{{ $item->no_hp_pelapor }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-emerald-400">{{ $item->terlapor }}</td>
                            <td class="px-6 py-4 text-xs">
                                <span class="px-2 py-1 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 uppercase font-bold">{{ $item->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="{{ route('cetak.lapdu.satuan', $item->id) }}" target="_blank" class="p-2 text-yellow-400 hover:bg-yellow-500/10 rounded-lg shadow"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg></a>
                                <button wire:click="edit({{ $item->id }})" class="p-2 text-blue-400 hover:bg-blue-500/10 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg></button>
                                <button wire:confirm="Hapus data ini?" wire:click="delete({{ $item->id }})" class="p-2 text-red-400 hover:bg-red-500/10 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">Belum ada data pengaduan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 border-t border-white/10">{{ $lapdus->links() }}</div>
        </div>
        @endif
    </div>
</div>