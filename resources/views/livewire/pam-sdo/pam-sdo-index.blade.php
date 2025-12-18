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
                        <h2 class="text-2xl font-bold text-gray-800">PAM SDO</h2>
                        <p class="text-xs text-gray-500">Pengamanan Sumber Daya Organisasi (Internal)</p>
                    </div>

                    @if(!$showForm)
                    <button wire:click="create" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Laporan PAM Baru
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Laporan</label>
                            <input wire:model="tanggal_laporan" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('tanggal_laporan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori Objek</label>
                            <select wire:model="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih...</option>
                                <option value="Personil">Personil (Jaksa/Pegawai)</option>
                                <option value="Materiil">Materiil (Aset/Gedung/Kendaraan)</option>
                                <option value="Dokumen">Dokumen Rahasia</option>
                            </select>
                            @error('kategori') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Target / Nama Objek</label>
                            <input wire:model="target" type="text" placeholder="Nama Pegawai atau Barang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('target') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIP / Nomor Aset</label>
                            <input wire:model="nip_atau_nomor" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Uraian Masalah / Ancaman</label>
                            <textarea wire:model="uraian_masalah" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('uraian_masalah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Tindakan Pengamanan</label>
                            <textarea wire:model="tindakan_pam" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Keterangan Tambahan</label>
                            <input wire:model="keterangan" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Penyelesaian</label>
                            <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="lid">Penyelidikan (LID)</option>
                                <option value="proses">Dalam Proses</option>
                                <option value="aman">AMAN (Tidak Terbukti)</option>
                                <option value="selesai">SELESAI (Ditindak)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded">
                            Simpan Data
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari Target / Masalah..." class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="overflow-x-auto border rounded-lg shadow-sm">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-100 text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Target (Objek)</th>
                                <th class="px-4 py-3">Masalah & Tindakan</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_pam as $item)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ $item->tanggal_laporan->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-bold text-gray-900">{{ $item->target }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->kategori }} | {{ $item->nip_atau_nomor ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-red-600 font-semibold text-xs mb-1">Masalah: {{ Str::limit($item->uraian_masalah, 50) }}</div>
                                    <div class="text-gray-500 text-xs">Tindakan: {{ Str::limit($item->tindakan_pam, 50) }}</div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                    $badges = [
                                    'lid' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'LID'],
                                    'proses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'label' => 'PROSES'],
                                    'aman' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'AMAN'],
                                    'selesai' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'label' => 'SELESAI'],
                                    ];
                                    $badge = $badges[$item->status];
                                    @endphp
                                    <span class="{{ $badge['bg'] }} {{ $badge['text'] }} text-xs font-bold px-2.5 py-0.5 rounded">
                                        {{ $badge['label'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center space-x-1">
                                    <button wire:click="edit({{ $item->id }})" class="text-blue-600 hover:text-blue-900 font-bold text-xs">Edit</button>
                                    <button wire:confirm="Hapus data ini?" wire:click="delete({{ $item->id }})" class="text-red-600 hover:text-red-900 font-bold text-xs">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada data PAM SDO.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $data_pam->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>