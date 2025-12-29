<div class="py-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="flex items-center gap-5">
                <div class="bg-emerald-50 p-3 rounded-2xl border border-emerald-100 shadow-sm transition-transform hover:scale-105 duration-500">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-12 w-12 object-contain" alt="Logo Kejaksaan">
                </div>
                <div class="relative">
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">
                        Data <span class="text-emerald-700">LAPINHAR</span>
                    </h2>
                    <p class="text-[10px] text-slate-500 mt-1 font-black tracking-[0.2em] uppercase flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.6)]"></span>
                        Sistem Informasi Laporan Intelijen
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('cetak.lapinhar') }}" target="_blank" class="group bg-white hover:bg-slate-50 text-slate-600 font-black py-3 px-6 rounded-xl shadow-sm border-2 border-slate-200 transition-all flex items-center gap-3 text-[10px] uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-slate-400 group-hover:text-slate-600">
                        <path fill-rule="evenodd" d="M7.875 1.5a.75.75 0 01.75.75v2.25h6.75a.75.75 0 01.75.75v3h3a3 3 0 013 3v9a3 3 0 01-3 3h-18a3 3 0 01-3-3v-9a3 3 0 013-3h3v-3a.75.75 0 01.75-.75h6.75zM6 6v3.75h12V6H6zM3.75 12a.75.75 0 01.75-.75h15a.75.75 0 01.75.75v6a.75.75 0 01-.75.75h-15a.75.75 0 01-.75-.75v-6z" clip-rule="evenodd" />
                    </svg>
                    <span>Cetak Rekap</span>
                </a>

                @if(!$showForm)
                <button wire:click="create" class="group relative overflow-hidden bg-emerald-600 hover:bg-emerald-700 text-white font-black py-3 px-8 rounded-xl shadow-lg border-2 border-emerald-500 transition-all duration-300 flex items-center gap-3 text-[10px] uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span>Input Laporan Baru</span>
                </button>
                @endif
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-emerald-600 border-2 border-emerald-400 text-white px-6 py-4 rounded-xl shadow-xl mb-6 flex items-center justify-between text-xs font-black uppercase tracking-widest">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
            <button @click="show = false" class="text-lg hover:text-emerald-200">&times;</button>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-white rounded-[2.5rem] shadow-sm border-2 border-slate-100 overflow-hidden w-full">
            <div class="p-6 border-b-2 border-slate-50 bg-slate-50/40 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-1/2 group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-12 block w-full rounded-xl border-2 border-slate-200 bg-white text-slate-900 font-bold focus:border-emerald-600 py-3 shadow-sm text-sm transition-all" placeholder="Cari peristiwa atau nomor surat...">
                </div>
                <div class="px-5 py-2 bg-white rounded-xl border-2 border-emerald-100 shadow-sm whitespace-nowrap">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        Total Record: <span class="text-emerald-600 text-base font-black ml-1">{{ $lapinhars->total() }}</span>
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 text-[10px] uppercase font-black border-b-2 border-slate-100 italic tracking-widest whitespace-nowrap">
                            <th class="px-6 py-6 w-1/4">Registrasi</th>
                            <th class="px-6 py-6 w-1/3">Substansi Laporan</th>
                            <th class="px-6 py-6 text-center">Status Verifikasi</th>
                            <th class="px-6 py-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-slate-50 text-slate-900">
                        @foreach($lapinhars as $item)
                        <tr class="hover:bg-emerald-50/30 transition duration-300">
                            <td class="px-6 py-6 whitespace-nowrap align-top">
                                <div class="font-black text-slate-900 text-xs uppercase">{{ $item->tanggal_surat->format('d M Y') }}</div>
                                <div class="text-[10px] text-emerald-600 font-mono font-bold mt-1 tracking-tighter">{{ $item->nomor_surat ?? 'UNREGISTERED' }}</div>
                                <div class="mt-2 inline-flex items-center gap-1 px-2 py-1 rounded-md bg-slate-100 text-[9px] font-bold text-slate-500 border border-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-slate-400">
                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $item->sumber_informasi }}
                                </div>
                            </td>

                            <td class="px-6 py-6 align-top min-w-[300px]">
                                <div class="font-black text-slate-800 text-xs uppercase tracking-tight leading-relaxed break-words whitespace-normal">
                                    {{ $item->peristiwa }}
                                </div>
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="text-[9px] font-bold text-white bg-slate-400 px-2 py-0.5 rounded uppercase">{{ $item->bidang }}</span>
                                    @if($item->status == 'rahasia')
                                    <span class="text-[9px] font-bold text-white bg-red-500 px-2 py-0.5 rounded uppercase flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-2.5 h-2.5">
                                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                                        </svg>
                                        Rahasia
                                    </span>
                                    @else
                                    <span class="text-[9px] font-bold text-white bg-blue-400 px-2 py-0.5 rounded uppercase">Biasa</span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                @php
                                $statusColor = [
                                'pending' => 'bg-amber-100 text-amber-900 border-amber-500',
                                'disetujui' => 'bg-emerald-100 text-emerald-900 border-emerald-500',
                                'ditolak' => 'bg-red-100 text-red-900 border-red-500'
                                ];
                                $currentStatus = strtolower($item->status_verifikasi);
                                $theme = $statusColor[$currentStatus] ?? 'bg-slate-100 text-slate-900 border-slate-400';
                                @endphp

                                @if(auth()->user()->isAdmin())
                                <button wire:click="openStatusModal({{ $item->id }})"
                                    class="inline-flex items-center justify-between gap-3 w-40 py-2.5 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest border-2 shadow-sm {{ $theme }} hover:scale-105 transition-transform hover:shadow-md cursor-pointer" title="Klik untuk verifikasi">
                                    <span class="truncate">{{ $item->status_verifikasi }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 opacity-50">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                </button>
                                @else
                                <div class="inline-flex items-center justify-center gap-2 w-40 py-2.5 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest border-2 {{ $theme }}">
                                    <span>{{ $item->status_verifikasi }}</span>
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-6 text-center align-top whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('cetak.lapinhar.satuan', $item->id) }}" target="_blank"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-amber-200 bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition-all shadow-sm group"
                                        title="Cetak Laporan">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 group-hover:scale-110 transition-transform">
                                            <path fill-rule="evenodd" d="M7.875 1.5a.75.75 0 01.75.75v2.25h6.75a.75.75 0 01.75.75v3h3a3 3 0 013 3v9a3 3 0 01-3 3h-18a3 3 0 01-3-3v-9a3 3 0 013-3h3v-3a.75.75 0 01.75-.75h6.75zM6 6v3.75h12V6H6zM3.75 12a.75.75 0 01.75-.75h15a.75.75 0 01.75.75v6a.75.75 0 01-.75.75h-15a.75.75 0 01-.75-.75v-6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <button wire:click="edit({{ $item->id }})"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-blue-200 bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all shadow-sm group"
                                        title="Edit Data">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 group-hover:scale-110 transition-transform">
                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </button>

                                    <button wire:confirm="Hapus data ini secara permanen?" wire:click="delete({{ $item->id }})"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-red-200 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm group"
                                        title="Hapus Data">
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

            <div class="p-6 border-t-2 border-slate-50 bg-slate-50/50">
                {{ $lapinhars->links() }}
            </div>
        </div>
        @endif

        @if($showForm)
        <div x-transition class="bg-white rounded-[2.5rem] shadow-2xl border-2 border-emerald-100 overflow-hidden mb-12 relative">
            <div class="bg-emerald-50 px-8 py-6 border-b-2 border-emerald-100 flex justify-between items-center">
                <h3 class="font-black text-emerald-900 text-base uppercase tracking-widest italic">Input Laporan Intelijen</h3>
                <button wire:click="closeModal" class="w-8 h-8 flex items-center justify-center bg-white border-2 border-slate-200 text-slate-400 hover:text-red-600 rounded-full shadow-md transition">&times;</button>
            </div>

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8 md:p-10 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nomor Surat / Nota Dinas</label>
                        <input wire:model="nomor_surat" type="text" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-emerald-500 focus:bg-white transition-all py-3 px-4 shadow-sm placeholder-slate-400 text-sm" placeholder="Contoh: R-01/L.1/Dek.3/12/2025">
                        @error('nomor_surat') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tanggal Peristiwa / Surat</label>
                        <input wire:model="tanggal_surat" type="date" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-emerald-500 focus:bg-white transition-all py-3 px-4 shadow-sm text-sm">
                        @error('tanggal_surat') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Klasifikasi Bidang</label>
                        <div class="relative">
                            <select wire:model="bidang" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-emerald-500 focus:bg-white transition-all py-3 px-4 shadow-sm appearance-none text-sm cursor-pointer">
                                <option value="">-- Pilih Bidang --</option>
                                <option value="Ipoleksosbudhankam">IPOLEKSOSBUDHANKAM</option>
                                <option value="Hukum">HUKUM</option>
                                <option value="Keamanan">KEAMANAN</option>
                                <option value="Keamanan">KEUANGAN DAN EKONOMI</option>
                                <option value="Keamanan">SOSIAL KEBUDAYAAN</option>
                                <option value="Keamanan">KEMASYARAKATAN</option>
                                <option value="Keamanan">POLITIK DAN PEMERINTAH</option>
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 absolute right-4 top-4 text-slate-400 pointer-events-none">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        @error('bidang') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Sifat / Status Keamanan</label>
                        <div class="relative">
                            <select wire:model="status" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-emerald-500 focus:bg-white transition-all py-3 px-4 shadow-sm appearance-none text-sm cursor-pointer">
                                <option value="rahasia">RAHASIA</option>
                                <option value="biasa">BIASA</option>
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 absolute right-4 top-4 text-slate-400 pointer-events-none">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        @error('status') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Sumber Informasi</label>
                        <div class="relative">
                            <select wire:model="sumber_informasi" class="block w-full rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-bold focus:border-emerald-500 focus:bg-white transition-all py-3 px-4 shadow-sm appearance-none text-sm cursor-pointer">
                                <option value="">-- Pilih Sumber --</option>
                                <option value="Laporan Masyarakat">Laporan Masyarakat</option>
                                <option value="Media Massa/Sosial">Media Massa / Sosial</option>
                                <option value="Instansi Pemerintah/Swasta">Instansi Pemerintah/Swasta</option>
                                <option value="Pengamatan Lapangan">Pengamatan Lapangan (Surveillance)</option>
                                <option value="Jaringan/Informan">Jaringan / Informan (Cepu)</option>
                                <option value="Laporan Pengaduan (Lapdu)">Laporan Pengaduan (Lapdu)</option>
                                <option value="Sumber Terbuka Lainnya">Sumber Terbuka Lainnya</option>
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 absolute right-4 top-4 text-slate-400 pointer-events-none">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        @error('sumber_informasi') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Uraian Peristiwa / Fakta-Fakta</label>
                    <textarea wire:model="peristiwa" rows="5" class="block w-full rounded-2xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-medium focus:border-emerald-500 focus:bg-white transition-all py-3 px-4 shadow-sm placeholder-slate-400 text-sm" placeholder="Jelaskan detail peristiwa secara kronologis..."></textarea>
                    @error('peristiwa') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Pendapat / Analisa Intelijen</label>
                    <textarea wire:model="pendapat" rows="4" class="block w-full rounded-2xl bg-slate-50 border-2 border-slate-200 text-slate-900 font-medium focus:border-emerald-500 focus:bg-white transition-all py-3 px-4 shadow-sm placeholder-slate-400 text-sm" placeholder="Berikan analisa, prediksi, dan rekomendasi langkah..."></textarea>
                    @error('pendapat') <span class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 rounded-xl border-2 border-slate-200 text-slate-500 hover:bg-slate-50 font-black uppercase text-[10px] tracking-widest transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-emerald-600 text-white font-black uppercase text-[10px] tracking-widest shadow-lg shadow-emerald-200 border-2 border-emerald-500 hover:bg-emerald-700 hover:shadow-xl hover:-translate-y-1 transition transform flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                        </svg>
                        <span>{{ $isEditMode ? 'Simpan Perubahan' : 'Kirim Laporan' }}</span>
                    </button>
                </div>
            </form>
        </div>
        @endif

        @if($showStatusModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4 transition-opacity">
            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl border-2 border-white p-6 relative animate-fade-in-up">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                            <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 11.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest">Verifikasi Laporan</h3>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Tentukan status untuk laporan ini. Tindakan ini akan tercatat oleh sistem.</p>
                </div>

                <div class="space-y-3">
                    <button wire:click="updateStatus('disetujui')" class="w-full py-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase text-xs tracking-widest shadow-lg shadow-emerald-200 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                        Setujui Laporan
                    </button>

                    <button wire:click="updateStatus('ditolak')" class="w-full py-4 rounded-xl bg-red-500 hover:bg-red-600 text-white font-black uppercase text-xs tracking-widest shadow-lg shadow-red-200 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                        </svg>
                        Tolak Laporan
                    </button>

                    <button wire:click="updateStatus('pending')" class="w-full py-4 rounded-xl bg-amber-400 hover:bg-amber-500 text-white font-black uppercase text-xs tracking-widest shadow-lg shadow-amber-200 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                        Kembalikan ke Pending
                    </button>
                </div>

                <button wire:click="closeStatusModal" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

    </div>
</div>