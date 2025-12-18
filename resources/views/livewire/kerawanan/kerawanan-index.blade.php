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
                        <h2 class="text-2xl font-bold text-gray-800">Peta Kerawanan (Ipoleksosbudhankam)</h2>
                        <p class="text-xs text-gray-500">Pemetaan Potensi Konflik Wilayah</p>
                    </div>

                    @if(!$showForm)
                    <button wire:click="create" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Petakan Wilayah
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <input wire:model="kecamatan" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                            @error('kecamatan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Desa / Kelurahan</label>
                            <input wire:model="desa" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('desa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Ancaman / Potensi Konflik</label>
                            <input wire:model="jenis_ancaman" type="text" placeholder="Misal: Sengketa Lahan, Radikalisme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tingkat Kerawanan</label>
                            <select wire:model="tingkat_rawan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="rendah">RENDAH (Aman)</option>
                                <option value="sedang">SEDANG (Waspada)</option>
                                <option value="tinggi">TINGGI (Bahaya/Konflik)</option>
                            </select>
                            @error('tingkat_rawan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Tokoh Kunci / Provokator / Penggerak</label>
                            <input wire:model="tokoh_kunci" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                            <textarea wire:model="deskripsi_singkat" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            Simpan Data
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari Wilayah..." class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse($data_peta as $peta)
                    @php
                    $bg = 'bg-green-100 border-green-200';
                    $text = 'text-green-800';
                    $icon = '🟢';
                    if($peta->tingkat_rawan == 'sedang') {
                    $bg = 'bg-yellow-100 border-yellow-200';
                    $text = 'text-yellow-800';
                    $icon = '🟡';
                    }
                    if($peta->tingkat_rawan == 'tinggi') {
                    $bg = 'bg-red-100 border-red-200';
                    $text = 'text-red-800';
                    $icon = '🔴';
                    }
                    @endphp

                    <div class="{{ $bg }} border-2 p-4 rounded-lg shadow-sm relative hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-900 text-lg">{{ $peta->desa }}</h3>
                            <span class="text-xl">{{ $icon }}</span>
                        </div>
                        <p class="text-xs text-gray-600 uppercase font-semibold mb-2">Kec: {{ $peta->kecamatan }}</p>

                        <div class="bg-white/60 p-2 rounded text-sm mb-3">
                            <p class="font-semibold text-gray-800">{{ $peta->jenis_ancaman }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ Str::limit($peta->deskripsi_singkat, 40) }}</p>
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            <span class="text-xs font-bold {{ $text }} uppercase">{{ $peta->tingkat_rawan }}</span>
                            <div class="space-x-2">
                                <button wire:click="edit({{ $peta->id }})" class="text-blue-600 text-xs font-bold hover:underline">Edit</button>
                                <button wire:confirm="Hapus?" wire:click="delete({{ $peta->id }})" class="text-red-600 text-xs font-bold hover:underline">Hapus</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-4 text-center py-10 text-gray-500">
                        Belum ada data pemetaan wilayah.
                    </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $data_peta->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>