<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">PAM SDO</h2>
                <p class="text-sm text-cyan-400 mt-1">Pengamanan Sumber Daya Organisasi (Personil, Materiil, Dokumen).</p>
            </div>
            @if(!$showForm)
            <button wire:click="create" class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-cyan-900/50 transition border border-cyan-500/50 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Buat Laporan PAM</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-cyan-900/80 backdrop-blur-sm border-l-4 border-cyan-500 text-cyan-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-cyan-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form PAM SDO</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Laporan</label>
                        <input wire:model="tanggal_laporan" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition">
                        @error('tanggal_laporan') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Kategori Pengamanan</label>
                        <select wire:model="kategori" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition">
                            <option value="">-- Pilih --</option>
                            <option value="Personil">Personil</option>
                            <option value="Materiil">Materiil</option>
                            <option value="Dokumen">Dokumen</option>
                        </select>
                        @error('kategori') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Target (Nama/Aset)</label>
                        <input wire:model="target" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition" placeholder="Contoh: Jaksa Fulan / Gedung Arsip">
                        @error('target') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">NIP / Nomor Identitas (Opsional)</label>
                        <input wire:model="nip_atau_nomor" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition" placeholder="NIP / NRP / No. Registrasi Aset">
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Status</label>
                        <select wire:model="status" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition">
                            <option value="lid">Penyelidikan</option>
                            <option value="proses">Proses Pengamanan</option>
                            <option value="aman">Aman / Terkendali</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        @error('status') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Uraian Masalah / Ancaman</label>
                        <textarea wire:model="uraian_masalah" rows="2" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition"></textarea>
                        @error('uraian_masalah') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Tindakan Pengamanan</label>
                        <textarea wire:model="tindakan_pam" rows="2" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Keterangan Tambahan</label>
                        <input wire:model="keterangan" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-cyan-500 transition">
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-cyan-600 hover:bg-cyan-500 text-white font-bold shadow-lg shadow-cyan-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Laporan' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
            <div class="p-5 border-b border-white/10 bg-white/5">
                <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-cyan-500 transition text-sm py-2.5 placeholder-gray-500" placeholder="Cari Target / Masalah...">
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-white/10">
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Target & NIP</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Uraian Masalah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($pamSdos as $item)
                        <tr class="hover:bg-white/5 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->tanggal_laporan->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $item->target }}</div>
                                <div class="text-xs text-gray-500">{{ $item->nip_atau_nomor ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">{{ $item->kategori }}</td>
                            <td class="px-6 py-4 text-xs">{{ Str::limit($item->uraian_masalah, 40) }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-cyan-500/10 text-cyan-400 px-2 py-1 rounded text-xs border border-cyan-500/20 uppercase font-bold">{{ $item->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $item->id }})" class="text-blue-400 hover:text-blue-300">Edit</button>
                                    <button wire:confirm="Hapus?" wire:click="delete({{ $item->id }})" class="text-red-400 hover:text-red-300">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Tidak ada data PAM SDO.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 border-t border-white/10 bg-white/5">{{ $pamSdos->links() }}</div>
        </div>
        @endif
    </div>
</div>