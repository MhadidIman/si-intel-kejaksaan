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
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Pencarian Orang (DPO)</h2>
                    @if(!$showForm)
                    <button wire:click="create" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Tambah Buronan
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input wire:model="nama_lengkap" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input wire:model="tempat_lahir" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input wire:model="tanggal_lahir" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ciri-ciri Fisik</label>
                                <textarea wire:model="ciri_fisik" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kasus / Perkara</label>
                                <input wire:model="kasus" type="text" placeholder="Contoh: Tipikor Dana Desa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                @error('kasus') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Hukum</label>
                                <select wire:model="status_hukum" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Pilih Status...</option>
                                    <option value="Tersangka">Tersangka</option>
                                    <option value="Terdakwa">Terdakwa</option>
                                    <option value="Terpidana">Terpidana</option>
                                    <option value="Saksi">Saksi Kunci</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Pencarian</label>
                                <select wire:model="status_pencarian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="buron">BURON (Belum Tertangkap)</option>
                                    <option value="tertangkap">SUDAH TERTANGKAP</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto DPO</label>

                                @if ($foto)
                                <img src="{{ $foto->temporaryUrl() }}" class="w-32 h-32 object-cover rounded border mb-2">
                                @elseif ($foto_lama)
                                <img src="{{ asset('storage/'.$foto_lama) }}" class="w-32 h-32 object-cover rounded border mb-2">
                                @endif

                                <input wire:model="foto" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                                <div wire:loading wire:target="foto" class="text-sm text-gray-500 mt-1">Mengupload foto...</div>
                                @error('foto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Data DPO' }}
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari DPO..." class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @forelse($dpos as $dpo)
                    <div class="border rounded-lg p-4 bg-gray-50 flex flex-col items-center text-center shadow-sm relative overflow-hidden">

                        @if($dpo->status_pencarian == 'buron')
                        <div class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">DPO</div>
                        @else
                        <div class="absolute top-0 right-0 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">TERTANGKAP</div>
                        @endif

                        @if($dpo->foto)
                        <img src="{{ asset('storage/'.$dpo->foto) }}" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow mb-3">
                        @else
                        <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center mb-3 text-gray-500">No Foto</div>
                        @endif

                        <h3 class="font-bold text-gray-900">{{ $dpo->nama_lengkap }}</h3>
                        <p class="text-xs text-gray-500 mb-2">{{ $dpo->kasus }}</p>

                        <div class="text-xs text-left w-full bg-white p-2 rounded border mb-3">
                            <p><strong>Status:</strong> {{ $dpo->status_hukum }}</p>
                            <p><strong>Ciri:</strong> {{ Str::limit($dpo->ciri_fisik, 30) }}</p>
                        </div>

                        <div class="space-x-2">
                            <button wire:click="edit({{ $dpo->id }})" class="text-blue-600 text-sm font-bold">Edit</button>
                            <button wire:confirm="Hapus data DPO ini?" wire:click="delete({{ $dpo->id }})" class="text-red-600 text-sm font-bold">Hapus</button>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-4 text-center py-10 text-gray-500">
                        Belum ada data DPO.
                    </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $dpos->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>