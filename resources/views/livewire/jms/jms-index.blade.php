<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Jaksa Masuk Sekolah (JMS)</h2>
                        <p class="text-xs text-gray-500">Laporan Kegiatan Penyuluhan Hukum</p>
                    </div>

                    @if(!$showForm)
                    <button wire:click="create" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Tambah Kegiatan
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                            <input wire:model="nama_sekolah" type="text" placeholder="SMAN..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500">
                            @error('nama_sekolah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                            <input wire:model="tanggal_kegiatan" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('tanggal_kegiatan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Materi Penyuluhan</label>
                            <input wire:model="materi" type="text" placeholder="Misal: Bahaya Narkoba & Bullying" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('materi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah Siswa (Audiens)</label>
                            <input wire:model="jumlah_siswa" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Jaksa / Pemateri</label>
                            <input wire:model="nama_jaksa" type="text" placeholder="Pisahkan dengan koma jika banyak" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Keterangan / Catatan</label>
                            <textarea wire:model="keterangan" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dokumentasi Foto</label>
                            @if ($foto_kegiatan)
                            <img src="{{ $foto_kegiatan->temporaryUrl() }}" class="h-40 rounded border mb-2 object-cover">
                            @elseif ($foto_lama)
                            <img src="{{ asset('storage/'.$foto_lama) }}" class="h-40 rounded border mb-2 object-cover">
                            @endif
                            <input wire:model="foto_kegiatan" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <div wire:loading wire:target="foto_kegiatan" class="text-xs text-gray-500 mt-1">Mengupload...</div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded">
                            Simpan Laporan
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari Sekolah / Materi..." class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($activities as $item)
                    <div class="bg-white border rounded-xl shadow-sm hover:shadow-md transition duration-200 overflow-hidden flex flex-col">

                        <div class="h-48 w-full bg-gray-200 relative">
                            @if($item->foto_kegiatan)
                            <img src="{{ asset('storage/'.$item->foto_kegiatan) }}" class="w-full h-full object-cover">
                            @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <span class="text-sm">Tidak ada foto</span>
                            </div>
                            @endif
                            <div class="absolute top-2 right-2 bg-orange-600 text-white text-xs font-bold px-2 py-1 rounded">
                                {{ $item->tanggal_kegiatan->format('d M Y') }}
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->nama_sekolah }}</h3>
                            <p class="text-sm text-orange-600 font-semibold mb-2">{{ $item->materi }}</p>

                            <div class="text-xs text-gray-500 space-y-1 mb-4 flex-1">
                                <p><span class="font-semibold">Siswa:</span> {{ $item->jumlah_siswa }} Orang</p>
                                <p><span class="font-semibold">Jaksa:</span> {{ Str::limit($item->nama_jaksa, 30) }}</p>
                            </div>

                            <div class="flex justify-between items-center pt-3 border-t">
                                <button wire:click="edit({{ $item->id }})" class="text-blue-600 text-sm font-bold hover:underline">Edit</button>
                                <button wire:confirm="Hapus laporan ini?" wire:click="delete({{ $item->id }})" class="text-red-600 text-sm font-bold hover:underline">Hapus</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-10 text-gray-500">
                        Belum ada laporan kegiatan JMS.
                    </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $activities->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>