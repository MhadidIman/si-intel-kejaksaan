<div class="py-8">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-8">

        <div class="relative bg-gradient-to-r from-emerald-900 to-emerald-700 rounded-3xl p-8 md:p-10 shadow-xl overflow-hidden text-white">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="space-y-2">
                    <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Si-Intelijen Kejaksaan</h1>
                    <p class="text-lg md:text-xl text-emerald-100 opacity-90">Sistem Informasi Manajemen Bank Data Intelijen.</p>

                    <div class="pt-4 flex flex-wrap gap-3 text-base md:text-lg font-medium">
                        <span class="bg-emerald-800/60 px-4 py-2 rounded-xl border border-emerald-500 backdrop-blur-sm shadow-sm flex items-center gap-2">
                            👋 Hai, {{ auth()->user()->name }}
                        </span>
                        <span class="bg-emerald-800/60 px-4 py-2 rounded-xl border border-emerald-500 backdrop-blur-sm shadow-sm flex items-center gap-2">
                            📅 {{ now()->isoFormat('dddd, D MMMM Y') }}
                        </span>
                    </div>
                </div>
                <div class="hidden md:block opacity-10 transform scale-150 translate-x-10 translate-y-4">
                    <svg class="h-48 w-48" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L1 21h22L12 2zm0 3.516L20.297 19H3.703L12 5.516zM11 16h2v2h-2v-2zm0-5h2v4h-2v-4z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow-md p-6 border-l-8 border-red-500 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between h-40">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Buronan (DPO)</p>
                        <p class="text-5xl font-black text-gray-800 mt-2">{{ $total_dpo_buron }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-xl text-red-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-red-600 font-bold text-sm flex items-center gap-1">
                    <span>⚠️ Pencarian Aktif</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border-l-8 border-orange-500 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between h-40">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Rawan Tinggi</p>
                        <p class="text-5xl font-black text-gray-800 mt-2">{{ $total_rawan_tinggi }}</p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-xl text-orange-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-orange-600 font-bold text-sm flex items-center gap-1">
                    <span>🔥 Perlu Atensi</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border-l-8 border-blue-500 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between h-40">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">WNA Overstay</p>
                        <p class="text-5xl font-black text-gray-800 mt-2">{{ $total_wna_overstay }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-blue-600 font-bold text-sm flex items-center gap-1">
                    <span>🌏 TIMPORA</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border-l-8 border-emerald-500 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between h-40">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Lapdu Baru</p>
                        <p class="text-5xl font-black text-gray-800 mt-2">{{ $total_lapdu_masuk }}</p>
                    </div>
                    <div class="p-3 bg-emerald-100 rounded-xl text-emerald-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-emerald-600 font-bold text-sm flex items-center gap-1">
                    <span>📩 Menunggu Disposisi</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <a href="{{ route('lapinhar.index') }}" wire:navigate class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg hover:bg-emerald-50 transition text-center group border border-gray-100 flex flex-col items-center justify-center h-40">
                        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-base font-bold text-gray-700 group-hover:text-emerald-700">Buat Lapinhar</span>
                    </a>
                    <a href="{{ route('dpo.index') }}" wire:navigate class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg hover:bg-red-50 transition text-center group border border-gray-100 flex flex-col items-center justify-center h-40">
                        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <span class="text-base font-bold text-gray-700 group-hover:text-red-700">Input DPO</span>
                    </a>
                    <a href="{{ route('kerawanan.index') }}" wire:navigate class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg hover:bg-orange-50 transition text-center group border border-gray-100 flex flex-col items-center justify-center h-40">
                        <div class="w-16 h-16 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <span class="text-base font-bold text-gray-700 group-hover:text-orange-700">Peta Rawan</span>
                    </a>
                    <a href="{{ route('pam-sdo.index') }}" wire:navigate class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg hover:bg-blue-50 transition text-center group border border-gray-100 flex flex-col items-center justify-center h-40">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <span class="text-base font-bold text-gray-700 group-hover:text-blue-700">PAM SDO</span>
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 text-lg">Laporan Informasi Terkini</h3>
                        <a href="{{ route('lapinhar.index') }}" wire:navigate class="text-sm text-emerald-600 font-bold hover:underline">Lihat Semua Data &rarr;</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-500">
                            <thead class="bg-white text-gray-700 uppercase text-sm border-b font-bold tracking-wider">
                                <tr>
                                    <th class="px-8 py-5">Tanggal</th>
                                    <th class="px-8 py-5">Peristiwa</th>
                                    <th class="px-8 py-5">Bidang</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-base">
                                @forelse($recent_lapinhars as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-8 py-5 whitespace-nowrap text-gray-500">{{ $item->tanggal_surat->format('d/m/Y') }}</td>
                                    <td class="px-8 py-5 font-semibold text-gray-800">{{ Str::limit($item->peristiwa, 50) }}</td>
                                    <td class="px-8 py-5">
                                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium border border-gray-200">{{ $item->bidang }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-8 text-center text-gray-400 italic">Belum ada data laporan masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                        <h3 class="font-bold text-gray-800 text-lg">Pengaduan (Lapdu)</h3>
                        <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded animate-pulse">Live</span>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($recent_lapdus as $lapdu)
                        <div class="p-6 hover:bg-gray-50 transition group cursor-pointer">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-white bg-gray-800 px-2 py-1 rounded uppercase tracking-wide">{{ $lapdu->status }}</span>
                                <span class="text-xs font-medium text-gray-400">{{ $lapdu->tanggal_terima->format('d M Y') }}</span>
                            </div>
                            <p class="text-base font-bold text-gray-800 mb-1 group-hover:text-emerald-700 transition">Terlapor: {{ $lapdu->terlapor }}</p>
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $lapdu->uraian_pengaduan }}</p>
                        </div>
                        @empty
                        <div class="p-10 text-center text-sm text-gray-400 italic">
                            Tidak ada pengaduan baru yang masuk.
                        </div>
                        @endforelse
                    </div>
                    <div class="p-4 bg-gray-50 text-center border-t border-gray-100">
                        <a href="{{ route('lapdu.index') }}" wire:navigate class="block w-full bg-white border border-gray-300 text-gray-700 font-bold py-2 rounded-lg hover:bg-gray-50 hover:text-emerald-600 transition shadow-sm">
                            Kelola Pengaduan
                        </a>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-slate-800 to-black rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="font-black text-2xl text-yellow-500 mb-3 tracking-widest border-b border-gray-700 pb-3 inline-block">SATYA ADHI WICAKSANA</h4>
                        <p class="text-lg text-gray-300 italic leading-relaxed">"Setia, bijaksana, dan bertanggung jawab dalam menjalankan tugas penegakan hukum."</p>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-yellow-500 rounded-full opacity-20 blur-xl"></div>
                </div>
            </div>

        </div>
    </div>
</div>