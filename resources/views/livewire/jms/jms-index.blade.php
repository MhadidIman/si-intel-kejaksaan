<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight">Jaksa Masuk Sekolah</h2>
                <p class="text-sm text-yellow-400 mt-1">Laporan Kegiatan Penerangan Hukum.</p>
            </div>
            @if(!$showForm)
            <button wire:click="create" class="bg-yellow-600 hover:bg-yellow-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-yellow-900/50 transition border border-yellow-500/50 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Input Kegiatan JMS</span>
            </button>
            @endif
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-yellow-900/80 backdrop-blur-sm border-l-4 border-yellow-500 text-yellow-100 px-4 py-3 rounded shadow-lg mb-6 flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-yellow-400 hover:text-white">&times;</button>
        </div>
        @endif

        @if($showForm)
        <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden mb-8 relative p-8">
            <h3 class="font-bold text-white text-lg mb-6 border-b border-white/10 pb-4">Form Kegiatan JMS</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Nama Sekolah</label>
                        <input wire:model="nama_sekolah" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-yellow-500 transition">
                        @error('nama_sekolah') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Tanggal Kegiatan</label>
                        <input wire:model="tanggal_kegiatan" type="date" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-yellow-500 transition">
                        @error('tanggal_kegiatan') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Materi Disampaikan</label>
                        <input wire:model="materi" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-yellow-500 transition" placeholder="Contoh: Bahaya Narkoba & Cyber Bullying">
                        @error('materi') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Jumlah Siswa</label>
                            <input wire:model="jumlah_siswa" type="number" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-yellow-500 transition">
                            @error('jumlah_siswa') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-1">Jaksa Pemateri</label>
                            <input wire:model="nama_jaksa" type="text" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-yellow-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Keterangan Lain</label>
                        <textarea wire:model="keterangan" rows="2" class="block w-full rounded-lg bg-black/40 border-white/10 text-white focus:border-yellow-500 transition"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Dokumentasi Foto</label>
                        <div class="flex items-center gap-4">
                            @if ($foto_kegiatan)
                            <img src="{{ $foto_kegiatan->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-lg border border-white/20">
                            @elseif ($foto_lama)
                            <img src="{{ asset('storage/' . $foto_lama) }}" class="w-16 h-16 object-cover rounded-lg border border-white/20">
                            @else
                            <div class="w-16 h-16 bg-white/5 rounded-lg border border-white/10 flex items-center justify-center text-gray-500 text-xs">No Img</div>
                            @endif
                            <input wire:model="foto_kegiatan" type="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-600 file:text-white hover:file:bg-yellow-500 cursor-pointer">
                        </div>
                        <div wire:loading wire:target="foto_kegiatan" class="text-xs text-yellow-400 mt-1">Mengupload...</div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3 pt-4 border-t border-white/10">
                <button wire:click="closeModal" class="px-5 py-2.5 rounded-lg border border-white/10 text-gray-300 hover:bg-white/5 font-medium transition">Batal</button>
                <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="px-5 py-2.5 rounded-lg bg-yellow-600 hover:bg-yellow-500 text-white font-bold shadow-lg shadow-yellow-900/50 transition">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Kegiatan' }}
                </button>
            </div>
        </div>
        @endif

        @if(!$showForm)
        <div class="mb-6">
            <input wire:model.live="search" type="text" class="block w-full md:w-96 rounded-lg border-white/10 bg-black/30 text-white focus:border-yellow-500 transition text-sm py-3 px-4 placeholder-gray-500" placeholder="Cari Sekolah atau Materi...">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($activities as $item)
            <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden hover:border-yellow-500/50 transition duration-300 group shadow-lg">
                <div class="h-48 overflow-hidden relative">
                    @if($item->foto_kegiatan)
                    <img src="{{ asset('storage/' . $item->foto_kegiatan) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                    <div class="w-full h-full bg-gray-800 flex items-center justify-center text-gray-600">
                        <span class="text-sm font-bold">Tidak ada foto</span>
                    </div>
                    @endif
                    <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-sm text-yellow-400 text-xs font-bold px-3 py-1 rounded-full border border-yellow-500/30">
                        {{ $item->tanggal_kegiatan->format('d M Y') }}
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-yellow-400 transition">{{ $item->nama_sekolah }}</h3>
                    <p class="text-sm text-gray-400 mb-4 line-clamp-2">{{ $item->materi }}</p>

                    <div class="flex justify-between items-center text-xs text-gray-500 border-t border-white/10 pt-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>{{ $item->jumlah_siswa }} Siswa</span>
                        </div>
                        <div class="flex gap-2">
                            <button wire:click="edit({{ $item->id }})" class="text-blue-400 hover:text-white font-bold">Edit</button>
                            <span class="text-gray-600">|</span>
                            <button wire:confirm="Hapus?" wire:click="delete({{ $item->id }})" class="text-red-400 hover:text-white font-bold">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-gray-500">
                Belum ada data kegiatan JMS.
            </div>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $activities->links() }}
        </div>
        @endif
    </div>
</div>