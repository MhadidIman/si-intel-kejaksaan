<div class="py-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="flex items-center gap-5">
                <div class="bg-cyan-50 p-3 rounded-2xl border border-cyan-100 shadow-sm transition-transform hover:scale-105 duration-500">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-12 w-12 object-contain" alt="Logo">
                </div>
                <div class="relative">
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">
                        Layanan <span class="text-cyan-600">PENGADUAN (LAPDU)</span>
                    </h2>
                    <p class="text-[10px] text-slate-500 mt-1 font-black tracking-[0.2em] uppercase flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse shadow-[0_0_8px_rgba(8,145,178,0.6)]"></span>
                        Pos Pelayanan Hukum & Pengaduan Masyarakat
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('cetak.lapdu') }}" target="_blank" class="group bg-white hover:bg-slate-50 text-slate-600 font-black py-3 px-6 rounded-xl shadow-sm border-2 border-slate-200 transition-all flex items-center gap-3 text-[10px] uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-slate-400 group-hover:text-slate-600">
                        <path fill-rule="evenodd" d="M7.875 1.5a.75.75 0 01.75.75v2.25h6.75a.75.75 0 01.75.75v3h3a3 3 0 013 3v9a3 3 0 01-3 3h-18a3 3 0 01-3-3v-9a3 3 0 013-3h3v-3a.75.75 0 01.75-.75h6.75zM6 6v3.75h12V6H6zM3.75 12a.75.75 0 01.75-.75h15a.75.75 0 01.75.75v6a.75.75 0 01-.75.75h-15a.75.75 0 01-.75-.75v-6z" clip-rule="evenodd" />
                    </svg>
                    <span>Cetak Rekap</span>
                </a>

                @if(!$showForm)
                <button wire:click="create" class="group relative overflow-hidden bg-cyan-600 hover:bg-cyan-700 text-white font-black py-3 px-8 rounded-xl shadow-lg shadow-cyan-200 border-2 border-cyan-500 transition-all flex items-center gap-3 text-[10px] uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span>Buat Pengaduan</span>
                </button>
                @endif
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-cyan-50 border-2 border-cyan-200 text-cyan-800 px-6 py-4 rounded-xl shadow-sm mb-6 flex items-center justify-between text-xs font-black uppercase tracking-widest">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-cyan-500">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
            <button @click="show = false" class="text-lg hover:text-cyan-500">&times;</button>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-white rounded-[2.5rem] shadow-sm border-2 border-slate-100 overflow-hidden w-full">
            <div class="p-6 border-b-2 border-slate-50 bg-slate-50/40 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-1/2 group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-cyan-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-12 block w-full rounded-xl border-2 border-slate-200 bg-white text-slate-900 font-bold focus:border-cyan-500 focus:ring-cyan-500/20 py-3 shadow-sm text-sm transition-all" placeholder="Cari Nama Pelapor / Terlapor...">
                </div>
                <div class="px-5 py-2 bg-white rounded-xl border-2 border-cyan-100 shadow-sm whitespace-nowrap">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        Total Laporan: <span class="text-cyan-600 text-base font-black ml-1">{{ $lapdus->total() }}</span>
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 text-[10px] uppercase font-black border-b-2 border-slate-100 italic tracking-widest whitespace-nowrap">
                            <th class="px-6 py-6 w-20 text-center">Bukti</th>
                            <th class="px-6 py-6">Identitas Pelapor</th>
                            <th class="px-6 py-6 w-1/3">Uraian Pengaduan</th>
                            <th class="px-6 py-6 text-center">Status Laporan</th>
                            <th class="px-6 py-6 text-center">Verifikasi</th>
                            <th class="px-6 py-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-slate-50 text-slate-900">
                        @foreach($lapdus as $item)
                        <tr class="hover:bg-cyan-50/20 transition duration-300">
                            <td class="px-6 py-6 text-center align-top">
                                @if($item->bukti_dukung)
                                <a href="{{ asset('storage/' . $item->bukti_dukung) }}" target="_blank" class="inline-flex items-center justify-center w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl border-2 border-cyan-100 hover:scale-110 transition shadow-sm" title="Lihat Bukti">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM12.75 12a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V18a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V12z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                @else
                                <div class="w-12 h-12 bg-slate-100 rounded-xl border-2 border-slate-200 flex items-center justify-center text-slate-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 align-top">
                                <div class="font-black text-slate-900 text-sm uppercase tracking-tight">{{ $item->nama_pelapor }}</div>
                                <div class="text-[10px] text-slate-500 font-bold mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-cyan-400">
                                        <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 5.25V4.5z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $item->no_hp ?? '-' }}
                                </div>
                                @if($item->nik)
                                <div class="mt-2 text-[9px] text-slate-400 font-mono tracking-wider bg-slate-50 px-2 py-1 rounded inline-block border border-slate-100">
                                    NIK: {{ $item->nik }}
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 align-top min-w-[200px]">
                                <div class="mb-2">
                                    <span class="text-[9px] font-bold text-white bg-cyan-500 px-2 py-0.5 rounded uppercase">{{ $item->kategori_laporan }}</span>
                                </div>
                                <div class="text-xs text-slate-700 font-bold leading-relaxed line-clamp-2">
                                    "{{ $item->uraian_pengaduan }}"
                                </div>
                                <div class="mt-2 text-[10px] text-slate-500 italic">
                                    <span class="font-bold not-italic text-slate-600">Terlapor:</span> {{ $item->nama_terlapor ?? 'Tidak Diketahui' }}
                                </div>
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                @if($item->status_laporan == 'menunggu')
                                <div class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-slate-500 text-[9px] font-black uppercase tracking-wider animate-pulse">
                                    MENUNGGU
                                </div>
                                @elseif($item->status_laporan == 'proses')
                                <div class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-orange-50 border border-orange-200 text-orange-600 text-[9px] font-black uppercase tracking-wider">
                                    DIPROSES
                                </div>
                                @else
                                <div class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-600 text-[9px] font-black uppercase tracking-wider">
                                    SELESAI
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                @php
                                $statusColor = [
                                'pending' => 'bg-amber-100 text-amber-900 border-amber-500',
                                'disetujui' => 'bg-emerald-100 text-emerald-900 border-emerald-500',
                                'ditolak' => 'bg-red-100 text-red-900 border-red-500'
                                ];
                                $currentStatus = strtolower($item->status_verifikasi ?? 'pending');
                                $theme = $statusColor[$currentStatus] ?? 'bg-slate-100 text-slate-900 border-slate-400';
                                @endphp

                                @if(auth()->user()->isAdmin())
                                <button wire:click="openStatusModal({{ $item->id }})"
                                    class="inline-flex items-center justify-between gap-3 w-40 py-2.5 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest border-2 shadow-sm {{ $theme }} hover:scale-105 transition-transform hover:shadow-md cursor-pointer" title="Klik untuk verifikasi">
                                    <span class="truncate">{{ $item->status_verifikasi ?? 'PENDING' }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 opacity-50">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                </button>
                                @else
                                <div class="inline-flex items-center justify-center gap-2 w-40 py-2.5 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest border-2 {{ $theme }}">
                                    <span>{{ $item->status_verifikasi ?? 'PENDING' }}</span>
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('cetak.lapdu.satuan', $item->id) }}" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-amber-200 bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition-all shadow-sm group">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 group-hover:scale-110 transition-transform">
                                            <path fill-rule="evenodd" d="M7.875 1.5a.75.75 0 01.75.75v2.25h6.75a.75.75 0 01.75.75v3h3a3 3 0 013 3v9a3 3 0 01-3 3h-18a3 3 0 01-3-3v-9a3 3 0 013-3h3v-3a.75.75 0 01.75-.75h6.75zM6 6v3.75h12V6H6zM3.75 12a.75.75 0 01.75-.75h15a.75.75 0 01.75.75v6a.75.75 0 01-.75.75h-15a.75.75 0 01-.75-.75v-6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <button wire:click="edit({{ $item->id }})" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-blue-200 bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all shadow-sm group">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 group-hover:scale-110 transition-transform">
                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </button>
                                    <button wire:confirm="Hapus laporan ini?" wire:click="delete({{ $item->id }})" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-red-200 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm group">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 group-hover:scale-110 transition-transform">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t-2 border-slate-50 bg-slate-50/50">{{ $lapdus->links() }}</div>
        </div>
        @endif

        @if($showForm)
        <div x-transition class="bg-white rounded-[2.5rem] shadow-2xl border-2 border-cyan-100 overflow-hidden mb-12 relative">
            <div class="bg-cyan-50 px-8 py-6 border-b-2 border-cyan-100 flex justify-between items-center">
                <h3 class="font-black text-cyan-900 text-base uppercase tracking-widest italic">Input Laporan Pengaduan</h3>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-white border-2 border-slate-200 text-slate-400 hover:text-red-600 rounded-full shadow-md transition">&times;</button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 md:p-10 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Pelapor</label>
                        <input wire:model="nama_pelapor" type="text" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm placeholder-slate-400 text-sm">
                        @error('nama_pelapor') <span class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">NIK (Opsional)</label>
                            <input wire:model="nik" type="text" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">No. HP / WA</label>
                            <input wire:model="no_hp" type="text" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm text-sm">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Terlapor</label>
                            <input wire:model="nama_terlapor" type="text" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm placeholder-slate-400 text-sm" placeholder="Nama Instansi / Orang">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Kategori</label>
                            <select wire:model="kategori_laporan" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm text-sm cursor-pointer">
                                <option value="">-- Pilih --</option>
                                <option value="Korupsi">Tindak Pidana Korupsi</option>
                                <option value="Pegawai">Penyalahgunaan Wewenang</option>
                                <option value="Umum">Tindak Pidana Umum</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('kategori_laporan') <span class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Uraian Pengaduan</label>
                        <textarea wire:model="uraian_pengaduan" rows="4" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-medium focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm placeholder-slate-400 text-sm" placeholder="Jelaskan kronologi kejadian..."></textarea>
                        @error('uraian_pengaduan') <span class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Status Laporan</label>
                            <select wire:model="status_laporan" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm text-sm">
                                <option value="menunggu">Menunggu Disposisi</option>
                                <option value="proses">Sedang Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Keterangan Tindak Lanjut</label>
                            <input wire:model="keterangan_tindak_lanjut" type="text" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-cyan-500 focus:bg-white transition-all py-3 px-4 shadow-sm placeholder-slate-400 text-sm">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Upload Bukti Dukung (PDF/IMG)</label>
                        <div class="flex items-center gap-6 p-4 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50">
                            <div class="w-16 h-16 bg-slate-200 rounded-xl border-2 border-slate-300 flex items-center justify-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                    <path fill-rule="evenodd" d="M18.97 3.659a2.25 2.25 0 00-3.182 0l-10.94 10.94a3.75 3.75 0 105.304 5.303l7.693-7.693a.75.75 0 011.06 1.06l-7.693 7.693a5.25 5.25 0 11-7.424-7.424l10.939-10.94a3.75 3.75 0 115.303 5.304L9.097 18.835l-.008.008-.007.007-.002.002-.003.002A2.25 2.25 0 015.91 15.66l7.81-7.81a.75.75 0 011.061 1.06l-7.81 7.81a.75.75 0 001.054 1.068L18.97 6.84a2.25 2.25 0 000-3.182z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <input wire:model="bukti_dukung" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-cyan-600 file:text-white hover:file:bg-cyan-700 transition cursor-pointer">
                                <p class="text-[9px] text-slate-400 mt-2 font-bold">Max 5MB.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 rounded-xl border-2 border-slate-200 text-slate-500 hover:bg-slate-50 font-black uppercase text-[10px] tracking-widest transition">Batal</button>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-cyan-600 text-white font-black uppercase text-[10px] tracking-widest shadow-lg shadow-cyan-200 border-2 border-cyan-500 hover:bg-cyan-700 hover:shadow-xl hover:-translate-y-1 transition transform flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                        </svg>
                        <span>{{ $isEditMode ? 'Simpan' : 'Kirim Laporan' }}</span>
                    </button>
                </div>
            </form>
        </div>
        @endif

        @if($showStatusModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4 transition-opacity">
            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl border-2 border-white p-6 relative animate-fade-in-up">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                            <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 11.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest">Verifikasi Laporan</h3>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Validasi status laporan pengaduan ini.</p>
                </div>

                <div class="space-y-3">
                    <button wire:click="updateStatus('disetujui')" class="w-full py-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase text-xs tracking-widest shadow-lg transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                        Setujui Laporan
                    </button>
                    <button wire:click="updateStatus('ditolak')" class="w-full py-4 rounded-xl bg-red-500 hover:bg-red-600 text-white font-black uppercase text-xs tracking-widest shadow-lg transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                        </svg>
                        Tolak Laporan
                    </button>
                    <button wire:click="updateStatus('pending')" class="w-full py-4 rounded-xl bg-amber-400 hover:bg-amber-500 text-white font-black uppercase text-xs tracking-widest shadow-lg transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                        Kembalikan ke Pending
                    </button>
                </div>

                <button wire:click="closeStatusModal" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

    </div>
</div>