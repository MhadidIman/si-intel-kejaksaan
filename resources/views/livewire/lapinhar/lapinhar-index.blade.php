<div class="py-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center gap-6">
                <div class="bg-emerald-50 p-4 rounded-3xl border border-emerald-100 shadow-sm transition-transform hover:scale-105 duration-500">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-14 w-14 object-contain" alt="Logo Kejaksaan">
                </div>
                <div class="relative">
                    <h2 class="text-4xl font-black text-slate-900 tracking-tighter italic uppercase">
                        Data <span class="text-emerald-700">LAPINHAR</span>
                    </h2>
                    <p class="text-[11px] text-slate-500 mt-1 font-black tracking-[0.2em] uppercase flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.6)]"></span>
                        Sistem Informasi Laporan Intelijen
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                @if(!$showForm)
                <button wire:click="create" class="group relative overflow-hidden bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 px-10 rounded-2xl shadow-lg border-2 border-emerald-500 transition-all duration-300 flex items-center gap-3 text-xs uppercase tracking-widest">
                    <i class="fas fa-plus-circle text-lg"></i>
                    <span>Input Laporan Baru</span>
                </button>
                @endif
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-emerald-600 border-2 border-emerald-400 text-white px-8 py-5 rounded-2xl shadow-xl mb-6 flex items-center justify-between text-xs font-black uppercase tracking-widest">
            <div class="flex items-center gap-4">
                <i class="fas fa-check-circle text-xl"></i>
                {{ session('message') }}
            </div>
            <button @click="show = false" class="text-xl">&times;</button>
        </div>
        @endif

        @if(!$showForm)
        <div class="bg-white rounded-[3rem] shadow-sm border-2 border-slate-100 overflow-hidden">
            <div class="p-8 border-b-2 border-slate-50 bg-slate-50/40 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="relative w-full md:w-[600px] group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-emerald-600">
                        <i class="fas fa-search"></i>
                    </div>
                    <input wire:model.live="search" type="text" class="pl-14 block w-full rounded-2xl border-2 border-slate-200 bg-white text-slate-900 font-bold focus:border-emerald-600 py-4 shadow-sm" placeholder="Cari peristiwa atau nomor surat...">
                </div>
                <div class="px-6 py-3 bg-white rounded-2xl border-2 border-emerald-100 shadow-sm">
                    <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest">
                        Total Record: <span class="text-emerald-600 text-lg font-black ml-1">{{ $lapinhars->total() }}</span>
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 text-[10px] uppercase font-black border-b-2 border-slate-100 italic tracking-widest">
                            <th class="px-10 py-8">Registrasi</th>
                            <th class="px-10 py-8">Substansi Laporan</th>
                            <th class="px-10 py-8 text-center">Status Verifikasi</th>
                            <th class="px-10 py-8 text-center">Opsi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-slate-50 text-slate-900">
                        @foreach($lapinhars as $item)
                        <tr class="hover:bg-emerald-50/30 transition duration-300">
                            <td class="px-10 py-8 whitespace-nowrap">
                                <div class="font-black text-slate-900 text-sm uppercase">{{ $item->tanggal_surat->format('d M Y') }}</div>
                                <div class="text-[10px] text-emerald-600 font-mono font-bold mt-1 tracking-tighter">{{ $item->nomor_surat ?? 'UNREGISTERED' }}</div>
                            </td>
                            <td class="px-10 py-8 max-w-md">
                                <div class="font-black text-slate-800 text-sm italic line-clamp-1 uppercase tracking-tight group-hover:text-emerald-700 transition" title="{{ $item->peristiwa }}">{{ $item->peristiwa }}</div>
                                <div class="text-[10px] text-slate-400 mt-1 font-bold italic line-clamp-1">{{ $item->bidang }}</div>
                            </td>

                            <td class="px-10 py-8 text-center">
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
                                <div class="relative inline-block text-left" x-data="{ open: false }">
                                    <button @click="open = !open" type="button"
                                        class="flex items-center justify-between gap-3 w-44 py-3 px-5 rounded-2xl text-[11px] font-black uppercase tracking-widest border-2 shadow-md {{ $theme }} hover:scale-105 transition-transform">
                                        <span class="truncate">{{ $item->status_verifikasi }}</span>
                                        <i class="fas fa-chevron-down text-[8px]"></i>
                                    </button>

                                    <div x-show="open" @click.away="open = false"
                                        class="absolute z-[99] mt-2 w-48 rounded-2xl bg-white shadow-2xl border-2 border-slate-100 overflow-hidden right-0 origin-top-right">
                                        <div class="p-2 space-y-1">
                                            <button wire:click="approve({{ $item->id }}); open = false" class="flex items-center w-full px-4 py-3 text-[10px] font-black text-emerald-800 hover:bg-emerald-600 hover:text-white rounded-xl gap-3 transition-colors">
                                                <i class="fas fa-check-circle"></i> SETUJUI
                                            </button>
                                            <button wire:click="reject({{ $item->id }}); open = false" class="flex items-center w-full px-4 py-3 text-[10px] font-black text-red-800 hover:bg-red-600 hover:text-white rounded-xl gap-3 transition-colors">
                                                <i class="fas fa-times-circle"></i> TOLAK
                                            </button>
                                            <button wire:click="setPending({{ $item->id }}); open = false" class="flex items-center w-full px-4 py-3 text-[10px] font-black text-amber-800 hover:bg-amber-500 hover:text-white rounded-xl gap-3 transition-colors border-t border-slate-100 pt-2">
                                                <i class="fas fa-history"></i> PENDINGKAN
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="inline-flex items-center justify-center gap-2 w-44 py-3 px-5 rounded-2xl text-[11px] font-black uppercase tracking-widest border-2 {{ $theme }}">
                                    <span>{{ $item->status_verifikasi }}</span>
                                </div>
                                @endif
                            </td>

                            <td class="px-10 py-8">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('cetak.lapinhar.satuan', $item->id) }}" target="_blank" class="flex items-center gap-2 px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-700 hover:bg-emerald-600 hover:text-white transition-all font-black text-[9px] uppercase shadow-sm">
                                        <i class="fas fa-print"></i> <span>Cetak</span>
                                    </a>
                                    <button wire:click="edit({{ $item->id }})" class="flex items-center gap-2 px-4 py-2.5 bg-blue-50 border-2 border-blue-200 rounded-xl text-blue-600 hover:bg-blue-600 hover:text-white transition-all font-black text-[9px] uppercase shadow-sm">
                                        <i class="fas fa-edit"></i> <span>Edit</span>
                                    </button>
                                    <button wire:confirm="Hapus permanen?" wire:click="delete({{ $item->id }})" class="flex items-center gap-2 px-4 py-2.5 bg-red-50 border-2 border-red-200 rounded-xl text-red-600 hover:bg-red-600 hover:text-white transition-all font-black text-[9px] uppercase shadow-sm">
                                        <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-8 border-t-2 border-slate-50 bg-slate-50/50">
                {{ $lapinhars->links() }}
            </div>
        </div>
        @endif

        @if($showForm)
        <div x-transition class="bg-white rounded-[3rem] shadow-2xl border-2 border-emerald-100 overflow-hidden mb-12 relative">
            <div class="bg-emerald-50 px-10 py-8 border-b-2 border-emerald-100 flex justify-between items-center">
                <h3 class="font-black text-emerald-900 text-lg uppercase tracking-widest italic">Input Laporan Intelijen</h3>
                <button wire:click="closeModal" class="p-3 bg-white border-2 border-slate-200 text-slate-400 hover:text-red-600 rounded-2xl shadow-md transition">&times;</button>
            </div>
            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-10 md:p-14 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest ml-1">Nomor Registrasi Surat</label>
                        <input wire:model="nomor_surat" type="text" class="block w-full rounded-2xl bg-slate-50 border-2 border-slate-100 text-slate-900 font-bold focus:border-emerald-600 focus:bg-white py-5 px-6 shadow-sm">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest ml-1">Tanggal Peristiwa</label>
                        <input wire:model="tanggal_surat" type="date" class="block w-full rounded-2xl bg-slate-50 border-2 border-slate-100 text-slate-900 font-bold focus:border-emerald-600 focus:bg-white py-5 px-6 shadow-sm">
                    </div>
                </div>
                <div class="flex justify-end space-x-6">
                    <button type="button" wire:click="closeModal" class="px-10 py-5 rounded-2xl border-2 border-slate-200 text-slate-600 font-black uppercase text-xs tracking-widest transition">Batal</button>
                    <button type="submit" class="px-14 py-5 rounded-2xl bg-emerald-600 text-white font-black uppercase text-xs tracking-widest shadow-xl border-2 border-emerald-500 hover:bg-emerald-700">Simpan Laporan</button>
                </div>
            </form>
        </div>
        @endif

    </div>
</div>