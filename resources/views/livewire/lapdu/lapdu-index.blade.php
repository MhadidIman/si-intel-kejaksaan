<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Pengaduan Masyarakat</h2>
                <p class="text-sm text-teal-400 mt-1">Laporan Pengaduan (Lapdu).</p>
            </div>
            @if(!$showForm)
            <button wire:click="create" class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-teal-900/50 transition border border-teal-500/50 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Catat Pengaduan</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-teal-900/80 backdrop-blur-sm border-l-4 border-teal-500 text-teal-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-teal-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Lapdu</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Nomor Surat</label>
                    <input wire:model="nomor_surat" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Terima</label>
                    <input wire:model="tanggal_terima" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition">
                    @error('tanggal_terima') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Nama Pelapor (Opsional)</label>
                    <input wire:model="nama_pelapor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition" placeholder="NN (Anonim) jika kosong">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">No. HP Pelapor</label>
                    <input wire:model="no_hp_pelapor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Pihak Terlapor</label>
                    <input wire:model="terlapor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition">
                    @error('terlapor') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Status Laporan</label>
                    <select wire:model="status" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition">
                        <option value="masuk">Baru Masuk</option>
                        <option value="telaah">Sedang Ditelaah</option>
                        <option value="lid">Tahap Penyelidikan</option>
                        <option value="arsipkan">Diarsipkan</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Uraian Singkat Pengaduan</label>
                    <textarea wire:model="uraian_pengaduan" rows="3" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition"></textarea>
                    @error('uraian_pengaduan') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Disposisi Pimpinan</label>
                    <input wire:model="disposisi_pimpinan" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-teal-500 transition">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-300 mb-1">Bukti Pendukung (PDF/Gambar)</label>
                    <div class="flex flex-col gap-2">
                        <input wire:model="bukti_pendukung" type="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-600 file:text-white hover:file:bg-teal-500 cursor-pointer">
                        <div wire:loading wire:target="bukti_pendukung" class="text-xs text-teal-400">Sedang mengupload...</div>

                        @if($bukti_lama)
                        <div class="text-xs text-gray-400 bg-white/5 p-2 rounded-lg border border-white/10 inline-block w-fit">
                            File Tersimpan:
                            <a href="{{ asset('storage/'.$bukti_lama) }}" target="_blank" class="text-teal-400 font-bold underline hover:text-teal-300 ml-1">Lihat / Download</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-teal-600 hover:bg-teal-500 text-white font-bold shadow-lg shadow-teal-900/50 transition">
                    {{ $isEditMode ? 'Simpan Data' : 'Simpan Data' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-teal-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Pelapor / Terlapor...">
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Tanggal & No Surat</th>
                            <th class="px-6 py-4">Terlapor</th>
                            <th class="px-6 py-4">Pelapor</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($lapdus as $item)
                        <tr class="hover:bg-white/5 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-white">{{ \Carbon\Carbon::parse($item->tanggal_terima)->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500 font-mono mt-1">{{ $item->nomor_surat ?? 'Tanpa Nomor' }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">{{ $item->terlapor }}</td>
                            <td class="px-6 py-4">
                                {{ $item->nama_pelapor ?? 'NN' }}
                                @if($item->no_hp_pelapor) <div class="text-xs text-gray-500">{{ $item->no_hp_pelapor }}</div> @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-teal-500/10 text-teal-400 px-2 py-1 rounded text-xs border border-teal-500/20 uppercase font-bold">{{ $item->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $item->id }})" class="text-blue-400 hover:text-blue-300">Edit</button>
                                    @if($item->bukti_pendukung)
                                    <a href="{{ asset('storage/'.$item->bukti_pendukung) }}" target="_blank" class="text-teal-400 hover:text-teal-300">File</a>
                                    @endif
                                    <button wire:confirm="Hapus?" wire:click="delete({{ $item->id }})" class="text-red-400 hover:text-red-300">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada pengaduan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 border-t border-white/10 bg-white/5">{{ $lapdus->links() }}</div>
        </div>
        @endif
    </div>
</div>