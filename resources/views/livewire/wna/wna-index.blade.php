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
                        <h2 class="text-2xl font-bold text-gray-800">Pengawasan Orang Asing (WNA)</h2>
                        <p class="text-xs text-gray-500">Data TIMPORA</p>
                    </div>

                    @if(!$showForm)
                    <button wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Input WNA
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap (Sesuai Paspor)</label>
                            <input wire:model="nama_lengkap" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Paspor</label>
                            <input wire:model="nomor_paspor" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm uppercase">
                            @error('nomor_paspor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kebangsaan</label>
                            <input wire:model="kebangsaan" type="text" placeholder="Contoh: China, USA, India" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="p-3 bg-yellow-50 rounded border border-yellow-200">
                            <label class="block text-sm font-bold text-yellow-800">Berlaku Sampai (Expired Date)</label>
                            <input wire:model="masa_berlaku_izin_tinggal" type="date" class="mt-1 block w-full rounded-md border-yellow-400 shadow-sm">
                            @error('masa_berlaku_izin_tinggal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tujuan Kunjungan</label>
                            <select wire:model="tujuan_kunjungan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih...</option>
                                <option value="Wisata">Wisata</option>
                                <option value="Bekerja (TKA)">Bekerja (TKA)</option>
                                <option value="Sosial Budaya">Sosial Budaya</option>
                                <option value="Keluarga">Kunjungan Keluarga</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sponsor / Penjamin</label>
                            <input wire:model="sponsor" type="text" placeholder="Nama PT atau Perorangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat Menginap</label>
                            <textarea wire:model="alamat_menginap" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Paspor / Dokumen</label>
                            @if ($foto_dokumen)
                            <img src="{{ $foto_dokumen->temporaryUrl() }}" class="h-24 rounded border mb-2">
                            @elseif ($foto_lama)
                            <img src="{{ asset('storage/'.$foto_lama) }}" class="h-24 rounded border mb-2">
                            @endif
                            <input wire:model="foto_dokumen" type="file" class="text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Simpan Data
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari Nama / Paspor / Negara..." class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="overflow-x-auto border rounded-lg shadow-sm">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-100 text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-3">Nama / Kebangsaan</th>
                                <th class="px-4 py-3">Paspor</th>
                                <th class="px-4 py-3">Sponsor & Tujuan</th>
                                <th class="px-4 py-3">Izin Tinggal</th>
                                <th class="px-4 py-3">Foto</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wnas as $wna)
                            <tr class="border-b hover:bg-gray-50 {{ $wna->is_overstay ? 'bg-red-50' : 'bg-white' }}">
                                <td class="px-4 py-3">
                                    <div class="font-bold text-gray-900">{{ $wna->nama_lengkap }}</div>
                                    <div class="text-xs">{{ $wna->kebangsaan }}</div>
                                </td>
                                <td class="px-4 py-3 font-mono text-gray-700">
                                    {{ $wna->nomor_paspor }}
                                </td>
                                <td class="px-4 py-3">
                                    <div>{{ $wna->tujuan_kunjungan }}</div>
                                    <div class="text-xs text-gray-400">{{ $wna->sponsor ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-semibold {{ $wna->is_overstay ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $wna->masa_berlaku_izin_tinggal->format('d M Y') }}
                                    </div>
                                    @if($wna->is_overstay)
                                    <span class="text-xs bg-red-200 text-red-800 px-1 rounded">OVERSTAY</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($wna->foto_dokumen)
                                    <a href="{{ asset('storage/'.$wna->foto_dokumen) }}" target="_blank" class="text-blue-500 underline text-xs">Lihat</a>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center space-x-1">
                                    <button wire:click="edit({{ $wna->id }})" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</button>
                                    <button wire:confirm="Hapus data WNA ini?" wire:click="delete({{ $wna->id }})" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada data WNA.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $wnas->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>