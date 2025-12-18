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
                        <h2 class="text-2xl font-bold text-gray-800">Laporan Pengaduan (LAPDU)</h2>
                        <p class="text-xs text-gray-500">Rekapitulasi Pengaduan Masyarakat</p>
                    </div>

                    @if(!$showForm)
                    <button wire:click="create" class="bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-4 rounded shadow">
                        + Catat Pengaduan
                    </button>
                    @endif
                </div>

                @if($showForm)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Terima</label>
                            <input wire:model="tanggal_terima" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('tanggal_terima') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Surat (Jika Ada)</label>
                            <input wire:model="nomor_surat" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Pelapor</label>
                            <input wire:model="nama_pelapor" type="text" placeholder="Bisa dikosongkan (Anonim)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">No HP Pelapor</label>
                            <input wire:model="no_hp_pelapor" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pihak Terlapor (Objek)</label>
                            <input wire:model="terlapor" type="text" placeholder="Dinas / Pejabat / Swasta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('terlapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Laporan</label>
                            <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="masuk">Baru Masuk</option>
                                <option value="telaah">Sedang Ditelaah</option>
                                <option value="lid">Masuk LID (Penyelidikan)</option>
                                <option value="arsipkan">Diarsipkan (Kurang Bukti)</option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Uraian Singkat Pengaduan</label>
                            <textarea wire:model="uraian_pengaduan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('uraian_pengaduan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-1 md:col-span-2 bg-yellow-50 p-3 rounded border border-yellow-200">
                            <label class="block text-sm font-bold text-yellow-800">Disposisi Pimpinan / Petunjuk</label>
                            <textarea wire:model="disposisi_pimpinan" rows="2" placeholder="Isi instruksi dari Kasi Intel..." class="mt-1 block w-full rounded-md border-yellow-400 shadow-sm"></textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Bukti Pendukung (Foto/Dokumen)</label>
                            @if ($bukti_lama)
                            <div class="text-xs text-blue-600 mb-2">File saat ini ada (Klik edit untuk ganti)</div>
                            @endif
                            <input wire:model="bukti_pendukung" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="{{ $isEditMode ? 'update' : 'store' }}" class="bg-slate-700 hover:bg-slate-800 text-white px-4 py-2 rounded">
                            Simpan Data
                        </button>
                    </div>
                </div>
                @endif

                @if(!$showForm)
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Cari Pelapor / Terlapor..." class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="overflow-x-auto border rounded-lg shadow-sm">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-100 text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Pelapor & Terlapor</th>
                                <th class="px-4 py-3">Uraian & Disposisi</th>
                                <th class="px-4 py-3 text-center">Bukti</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporans as $item)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ $item->tanggal_terima->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-bold text-gray-900">P: {{ $item->nama_pelapor ?? 'Anonim' }}</div>
                                    <div class="text-red-600 font-semibold">T: {{ $item->terlapor }}</div>
                                    <div class="text-xs text-gray-400">{{ $item->nomor_surat ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3 w-1/3">
                                    <div class="mb-2 text-gray-800">{{ Str::limit($item->uraian_pengaduan, 50) }}</div>
                                    @if($item->disposisi_pimpinan)
                                    <div class="bg-yellow-100 text-yellow-800 p-1 rounded text-xs font-semibold">
                                        "{{ $item->disposisi_pimpinan }}"
                                    </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($item->bukti_pendukung)
                                    <a href="{{ asset('storage/'.$item->bukti_pendukung) }}" target="_blank" class="text-blue-500 hover:underline font-bold text-xs">Unduh</a>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                        {{ $item->status == 'masuk' ? 'bg-gray-200 text-gray-800' : '' }}
                                        {{ $item->status == 'telaah' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $item->status == 'lid' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $item->status == 'arsipkan' ? 'bg-green-100 text-green-800' : '' }}
                                    ">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center space-x-1">
                                    <button wire:click="edit({{ $item->id }})" class="text-blue-600 hover:text-blue-900 font-bold text-xs">Edit</button>
                                    <button wire:confirm="Hapus pengaduan ini?" wire:click="delete({{ $item->id }})" class="text-red-600 hover:text-red-900 font-bold text-xs">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada data pengaduan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $laporans->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>