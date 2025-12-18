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
                        <h2 class="text-2xl font-bold text-gray-800">Data ORMAS & PAKEM</h2>
                        <p class="text-xs text-gray-500">Monitoring Organisasi & Aliran Kepercayaan</p>
                    </div>

                    @if(!$showForm)
                    <button wire:click="create" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Tambah Data
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Organisasi / Aliran</label>
                            <input wire:model="nama_organisasi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500">
                            @error('nama_organisasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ketua / Pimpinan</label>
                            <input wire:model="ketua" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('ketua') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bentuk Organisasi</label>
                            <select wire:model="bentuk_organisasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih...</option>
                                <option value="Ormas">Ormas</option>
                                <option value="LSM">LSM</option>
                                <option value="Yayasan">Yayasan</option>
                                <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                <option value="Komunitas">Komunitas</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Pemantauan</label>
                            <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="aktif">Aktif (Aman)</option>
                                <option value="vakum">Vakum (Tidak Ada Giat)</option>
                                <option value="diawasi">DIAWASI (Rawan)</option>
                                <option value="dilarang">DILARANG (Ilegal)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Legalitas (SKT/AHU)</label>
                            <input wire:model="nomor_legalitas" type="text" placeholder="No. SKT..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Perkiraan Jumlah Anggota</label>
                            <input wire:model="jumlah_anggota" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat Sekretariat</label>
                            <textarea wire:model="alamat_sekretariat" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Fokus Kegiatan Terakhir</label>
                            <textarea wire:model="kegiatan_terakhir" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                            Simpan Data
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari Ormas / Ketua..." class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="overflow-x-auto border rounded-lg shadow-sm">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-100 text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-3">Nama Organisasi</th>
                                <th class="px-4 py-3">Bentuk</th>
                                <th class="px-4 py-3">Ketua & Kontak</th>
                                <th class="px-4 py-3">Legalitas</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_ormas as $ormas)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="font-bold text-gray-900">{{ $ormas->nama_organisasi }}</div>
                                    <div class="text-xs text-gray-500">Anggota: {{ $ormas->jumlah_anggota }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">{{ $ormas->bentuk_organisasi }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div>{{ $ormas->ketua }}</div>
                                    <div class="text-xs text-gray-400 truncate w-32" title="{{ $ormas->alamat_sekretariat }}">{{ $ormas->alamat_sekretariat }}</div>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{ $ormas->nomor_legalitas ?? 'Tidak Ada' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                    $color = 'gray';
                                    if($ormas->status == 'aktif') $color = 'green';
                                    if($ormas->status == 'diawasi') $color = 'yellow';
                                    if($ormas->status == 'dilarang') $color = 'red';
                                    @endphp
                                    <span class="bg-{{ $color }}-100 text-{{ $color }}-800 text-xs font-bold px-2.5 py-0.5 rounded uppercase">
                                        {{ $ormas->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center space-x-1">
                                    <button wire:click="edit({{ $ormas->id }})" class="text-blue-600 font-bold hover:underline text-xs">Edit</button>
                                    <button wire:confirm="Hapus data ini?" wire:click="delete({{ $ormas->id }})" class="text-red-600 font-bold hover:underline text-xs">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada data Ormas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $data_ormas->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>