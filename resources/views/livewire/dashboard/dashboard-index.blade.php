<div class="py-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        <div class="relative overflow-hidden bg-white rounded-[2.5rem] p-8 md:p-12 shadow-[0_20px_50px_rgba(0,0,0,0.05)] border-b-4 border-emerald-600">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-50 blur-[100px] rounded-full"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="space-y-4 text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-black uppercase tracking-widest border border-emerald-100">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-600"></span>
                        </span>
                        Sistem Monitoring Aktif
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 leading-tight tracking-tighter italic">
                        SI-INTEL <span class="text-emerald-600">KEJAKSAAN</span>
                    </h1>
                    <p class="text-lg text-slate-500 font-medium max-w-xl italic">
                        "Otoritas Manajemen Bank Data Intelijen Terpusat Kejaksaan Republik Indonesia."
                    </p>

                    <div class="pt-4 flex flex-wrap justify-center md:justify-start gap-4">
                        <div class="px-6 py-3 rounded-2xl bg-slate-50 border border-slate-200 flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-200">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-slate-400 font-black">Petugas</p>
                                <p class="text-slate-700 font-bold">{{ auth()->user()->name }}</p>
                            </div>
                        </div>
                        <div class="px-6 py-3 rounded-2xl bg-slate-50 border border-slate-200 flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-200">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-slate-400 font-black">Hari Tugas</p>
                                <p class="text-slate-700 font-bold">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block relative group">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="relative h-56 w-56 object-contain drop-shadow-2xl group-hover:scale-105 transition duration-700">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card Merah: DPO --}}
            <div class="bg-red-600 rounded-[2rem] p-7 shadow-xl shadow-red-200 flex flex-col justify-between h-48 relative overflow-hidden group hover:-translate-y-2 transition duration-500">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-8xl transform rotate-12 group-hover:rotate-0 transition duration-700">
                    <i class="fas fa-user-secret"></i>
                </div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-black text-red-100 uppercase tracking-[0.2em]">Buronan (DPO)</p>
                        <p class="text-6xl font-black text-white mt-1 tracking-tighter">{{ $total_dpo_buron }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/30">
                        <i class="fas fa-user-secret text-2xl"></i>
                    </div>
                </div>
                <div class="relative z-10 py-1.5 px-4 bg-white/10 rounded-xl border border-white/20 w-fit">
                    <span class="text-[10px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span> Pencarian Aktif
                    </span>
                </div>
            </div>

            {{-- Card Oranye: Kerawanan --}}
            <div class="bg-orange-500 rounded-[2rem] p-7 shadow-xl shadow-orange-200 flex flex-col justify-between h-48 relative overflow-hidden group hover:-translate-y-2 transition duration-500">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-8xl transform rotate-12 group-hover:rotate-0 transition duration-700">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-black text-orange-50 uppercase tracking-[0.2em]">Rawan Tinggi</p>
                        <p class="text-6xl font-black text-white mt-1 tracking-tighter">{{ $total_rawan_tinggi }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/30">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                    </div>
                </div>
                <div class="relative z-10 py-1.5 px-4 bg-white/10 rounded-xl border border-white/20 w-fit">
                    <span class="text-[10px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-white"></span> Perlu Atensi
                    </span>
                </div>
            </div>

            {{-- Card Biru: WNA --}}
            <div class="bg-blue-600 rounded-[2rem] p-7 shadow-xl shadow-blue-200 flex flex-col justify-between h-48 relative overflow-hidden group hover:-translate-y-2 transition duration-500">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-8xl transform rotate-12 group-hover:rotate-0 transition duration-700">
                    <i class="fas fa-globe-americas"></i>
                </div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-black text-blue-50 uppercase tracking-[0.2em]">WNA Overstay</p>
                        <p class="text-6xl font-black text-white mt-1 tracking-tighter">{{ $total_wna_overstay }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/30">
                        <i class="fas fa-passport text-2xl"></i>
                    </div>
                </div>
                <div class="relative z-10 py-1.5 px-4 bg-white/10 rounded-xl border border-white/20 w-fit">
                    <span class="text-[10px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-white"></span> Giat Timpora
                    </span>
                </div>
            </div>

            {{-- Card Hijau: Lapdu --}}
            <div class="bg-emerald-600 rounded-[2rem] p-7 shadow-xl shadow-emerald-200 flex flex-col justify-between h-48 relative overflow-hidden group hover:-translate-y-2 transition duration-500">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-8xl transform rotate-12 group-hover:rotate-0 transition duration-700">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-black text-emerald-50 uppercase tracking-[0.2em]">Lapdu Masuk</p>
                        <p class="text-6xl font-black text-white mt-1 tracking-tighter">{{ $total_lapdu_masuk }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/30">
                        <i class="fas fa-inbox text-2xl"></i>
                    </div>
                </div>
                <div class="relative z-10 py-1.5 px-4 bg-white/10 rounded-xl border border-white/20 w-fit">
                    <span class="text-[10px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-white"></span> Menunggu Disposisi
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('lapinhar.index') }}" wire:navigate class="group bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg hover:border-emerald-500 transition-all duration-500 text-center flex flex-col items-center justify-center gap-3 h-40">
                        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-500 border border-emerald-100">
                            <i class="fas fa-file-signature text-2xl"></i>
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Buat Lapinhar</span>
                    </a>
                    <a href="{{ route('dpo.index') }}" wire:navigate class="group bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg hover:border-red-500 transition-all duration-500 text-center flex flex-col items-center justify-center gap-3 h-40">
                        <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-500 border border-red-100">
                            <i class="fas fa-user-plus text-2xl"></i>
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Input DPO</span>
                    </a>
                    <a href="{{ route('kerawanan.index') }}" wire:navigate class="group bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg hover:border-orange-500 transition-all duration-500 text-center flex flex-col items-center justify-center gap-3 h-40">
                        <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-500 border border-orange-100">
                            <i class="fas fa-map-marked-alt text-2xl"></i>
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Peta Rawan</span>
                    </a>
                    <a href="{{ route('pam-sdo.index') }}" wire:navigate class="group bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-500 transition-all duration-500 text-center flex flex-col items-center justify-center gap-3 h-40">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-500 border border-blue-100">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">PAM SDO</span>
                    </a>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-black text-slate-800 text-base uppercase tracking-widest italic flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-emerald-600 rounded-full"></span> Laporan Informasi Terkini
                        </h3>
                        <a href="{{ route('lapinhar.index') }}" wire:navigate class="text-[10px] font-black uppercase tracking-widest text-emerald-700 hover:underline">Semua Laporan &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-slate-400 uppercase text-[10px] font-black tracking-widest border-b border-gray-100">
                                <tr>
                                    <th class="px-8 py-5">Registrasi</th>
                                    <th class="px-8 py-5">Substansi Peristiwa</th>
                                    <th class="px-8 py-5 text-right">Klasifikasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recent_lapinhars as $item)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-8 py-5 font-bold text-slate-700">
                                        {{ $item->tanggal_surat ? $item->tanggal_surat->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-8 py-5 text-slate-600 font-medium line-clamp-1 italic">{{ $item->peristiwa }}</td>
                                    <td class="px-8 py-5 text-right">
                                        <span class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-[10px] font-black border border-emerald-100">{{ $item->bidang }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-10 text-center text-slate-400 italic">Belum ada data.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
                        <h3 class="font-black text-slate-800 text-base uppercase tracking-widest italic">Signal Lapdu</h3>
                        <span class="px-2 py-1 bg-red-100 text-red-600 text-[9px] font-black rounded uppercase animate-pulse">Live Monitor</span>
                    </div>
                    <div class="divide-y divide-gray-50 max-h-[480px] overflow-y-auto">
                        @forelse($recent_lapdus as $lapdu)
                        <div class="p-8 hover:bg-slate-50 transition group cursor-pointer border-l-4 border-transparent hover:border-emerald-600">
                            <div class="flex justify-between items-start mb-4">
                                {{-- PERBAIKAN: status -> status_laporan --}}
                                <span class="text-[9px] font-black text-white bg-emerald-600 px-3 py-1 rounded-full uppercase">{{ $lapdu->status_laporan }}</span>

                                {{-- PERBAIKAN UTAMA: Tambahkan pengecekan null pada tanggal_terima atau gunakan created_at --}}
                                <span class="text-[10px] font-mono text-slate-400">
                                    {{ $lapdu->tanggal_terima ? $lapdu->tanggal_terima->format('d.m.Y') : ($lapdu->created_at ? $lapdu->created_at->format('d.m.Y') : '-') }}
                                </span>
                            </div>

                            {{-- PERBAIKAN: terlapor -> nama_terlapor --}}
                            <p class="text-sm font-black text-slate-800 mb-2 group-hover:text-emerald-700 transition uppercase">Terlapor: {{ $lapdu->nama_terlapor ?? 'N/A' }}</p>
                            <p class="text-xs text-slate-500 leading-relaxed italic line-clamp-2">"{{ $lapdu->uraian_pengaduan }}"</p>
                        </div>
                        @empty
                        <div class="p-10 text-center text-slate-300 italic">Belum ada laporan masuk.</div>
                        @endforelse
                    </div>
                    <div class="p-6 bg-slate-50 border-t border-gray-100">
                        <a href="{{ route('lapdu.index') }}" wire:navigate class="w-full inline-block px-6 py-3 font-black text-center text-emerald-700 uppercase tracking-widest border-2 border-emerald-600 rounded-2xl hover:bg-emerald-600 hover:text-white transition-all duration-300 text-xs italic">
                            Kelola Pengaduan
                        </a>
                    </div>
                </div>

                {{-- Motto --}}
                <div class="bg-slate-900 rounded-[2.5rem] p-10 shadow-xl relative overflow-hidden text-center">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-amber-500 rounded-full opacity-10 blur-xl"></div>
                    <h4 class="font-black text-2xl text-amber-400 mb-4 tracking-[0.3em] uppercase italic">SATYA ADHI WICAKSANA</h4>
                    <div class="w-12 h-0.5 bg-amber-400/30 mx-auto mb-6"></div>
                    <p class="text-sm text-slate-300 font-medium leading-loose italic">
                        "Setia, bijaksana, dan bertanggung jawab dalam menjalankan tugas penegakan hukum."
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>