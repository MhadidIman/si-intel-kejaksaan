<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Laporan Informasi Harian (LAPINHAR)</h2>

                    @if(!$showForm)
                    <button wire:click="create" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Buat Laporan Baru
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <h3 class="text-lg font-semibold mb-4">{{ $isEditMode ? 'Edit Laporan' : 'Input Laporan Baru' }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Surat (R-..)</label>
                            <input wire:model="nomor_surat" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('nomor_surat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Surat</label>
                            <input wire:model="tanggal_surat" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('tanggal_surat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sumber Informasi</label>
                            <input wire:model="sumber_informasi" type="text" placeholder="Misal: Masyarakat / Cepu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('sumber_informasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bidang</label>
                            <select wire:model="bidang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Bidang...</option>
                                <option value="Ideologi">Ideologi</option>
                                <option value="Politik">Politik</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Sosial Budaya">Sosial Budaya</option>
                                <option value="Hankam">Hankam</option>
                            </select>
                            @error('bidang') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Uraian Peristiwa</label>
                        <textarea wire:model="peristiwa" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        @error('peristiwa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Pendapat/Analisa Intelijen</label>
                        <textarea wire:model="pendapat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        @error('pendapat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end mt-4 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Laporan' }}
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari berdasarkan nomor atau peristiwa..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-50 text-gray-700 uppercase">
                            <tr>
                                <th class="px-6 py-3">No. Surat</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Peristiwa</th>
                                <th class="px-6 py-3">Bidang</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lapinhars as $data)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $data->nomor_surat }}</td>
                                <td class="px-6 py-4">{{ $data->tanggal_surat->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ Str::limit($data->peristiwa, 50) }}</td>
                                <td class="px-6 py-4">{{ $data->bidang }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ strtoupper($data->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <button wire:click="edit({{ $data->id }})" class="text-blue-600 hover:text-blue-900 font-bold">Edit</button>
                                    <button wire:confirm="Yakin ingin menghapus data ini?" wire:click="delete({{ $data->id }})" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data laporan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $lapinhars->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>