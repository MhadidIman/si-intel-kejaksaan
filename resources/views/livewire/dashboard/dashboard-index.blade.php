<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        {{-- ============================================================== --}}
        {{-- HEADER: COMMAND CENTER EXECUTIVE                               --}}
        {{-- ============================================================== --}}
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-12 shadow-2xl border-b-4 border-emerald-500 group">

            <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/20 blur-[100px] rounded-full pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-500/10 blur-[100px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">

                <div class="space-y-5 text-center md:text-left flex-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-widest border border-emerald-500/30 backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Sistem Monitoring Aktif
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tighter drop-shadow-md">
                        SI-INTEL <span class="text-emerald-400">KEJAKSAAN</span>
                    </h1>

                    <p class="text-sm md:text-base text-slate-300 font-medium max-w-2xl leading-relaxed">
                        Otoritas Manajemen Bank Data Intelijen Terpusat Kejaksaan Republik Indonesia. Memantau, menganalisis, dan melaporkan secara *real-time*.
                    </p>

                    <div class="pt-4 flex flex-wrap justify-center md:justify-start gap-4">
                        <div class="px-5 py-2.5 rounded-2xl bg-slate-800/50 border border-slate-700 backdrop-blur-sm flex items-center gap-3 shadow-inner">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                                <i class="fas fa-user-shield text-lg"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[9px] uppercase tracking-widest text-emerald-400 font-black">ID Petugas</p>
                                <p class="text-white font-bold text-sm tracking-wide">{{ auth()->user()->name }}</p>
                            </div>
                        </div>

                        <div class="px-5 py-2.5 rounded-2xl bg-slate-800/50 border border-slate-700 backdrop-blur-sm flex items-center gap-3 shadow-inner">
                            <div class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <i class="fas fa-clock text-lg"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[9px] uppercase tracking-widest text-blue-400 font-black">Waktu Sistem</p>
                                <p class="text-white font-bold text-sm tracking-wide">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block relative shrink-0">
                    <div class="absolute inset-0 bg-emerald-500/20 blur-[50px] rounded-full"></div>
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="relative h-48 w-48 object-contain drop-shadow-2xl group-hover:scale-105 transition duration-700 ease-out">
                </div>
            </div>
        </div>

        {{-- ============================================================== --}}
        {{-- METRIK UTAMA (4 KOTAK)                                         --}}
        {{-- ============================================================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Card: DPO --}}
            <div class="bg-red-600 rounded-3xl p-7 shadow-xl shadow-red-600/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-user-secret"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-red-100 uppercase tracking-[0.2em] mb-1">Buronan (DPO)</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_dpo_buron ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-user-secret text-xl"></i></div>
                </div>
                <div class="relative z-10 py-1.5 px-3 bg-white/10 rounded-lg border border-white/20 w-fit backdrop-blur-sm">
                    <span class="text-[9px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Pencarian Aktif
                    </span>
                </div>
            </div>

            {{-- Card: Kerawanan --}}
            <div class="bg-orange-500 rounded-3xl p-7 shadow-xl shadow-orange-500/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-orange-50 uppercase tracking-[0.2em] mb-1">Rawan Tinggi</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_rawan_tinggi ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-map-marker-alt text-xl"></i></div>
                </div>
                <div class="relative z-10 py-1.5 px-3 bg-white/10 rounded-lg border border-white/20 w-fit backdrop-blur-sm">
                    <span class="text-[9px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span> Perlu Atensi
                    </span>
                </div>
            </div>

            {{-- Card: WNA --}}
            <div class="bg-blue-600 rounded-3xl p-7 shadow-xl shadow-blue-600/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-globe-americas"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-blue-50 uppercase tracking-[0.2em] mb-1">WNA Overstay</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_wna_overstay ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-passport text-xl"></i></div>
                </div>
                <div class="relative z-10 py-1.5 px-3 bg-white/10 rounded-lg border border-white/20 w-fit backdrop-blur-sm">
                    <span class="text-[9px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span> Giat Timpora
                    </span>
                </div>
            </div>

            {{-- Card: Lapdu --}}
            <div class="bg-emerald-600 rounded-3xl p-7 shadow-xl shadow-emerald-600/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-envelope-open-text"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-emerald-50 uppercase tracking-[0.2em] mb-1">Lapdu Masuk</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_lapdu_masuk ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-inbox text-xl"></i></div>
                </div>
                <div class="relative z-10 py-1.5 px-3 bg-white/10 rounded-lg border border-white/20 w-fit backdrop-blur-sm">
                    <span class="text-[9px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span> Menunggu Disposisi
                    </span>
                </div>
            </div>

        </div>

        {{-- ============================================================== --}}
        {{-- BAGIAN UTAMA (KIRI: SHORTCUT, TABEL, GRAFIK | KANAN: SIGNAL)   --}}
        {{-- ============================================================== --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            {{-- KIRI (2/3) --}}
            <div class="xl:col-span-2 space-y-8">

                {{-- SHORTCUT ACTIONS --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('lapinhar.index') }}" wire:navigate class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 hover:border-emerald-200 transition-all duration-300 flex flex-col items-center justify-center gap-3 h-36">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 border border-emerald-100"><i class="fas fa-file-signature text-xl"></i></div>
                        <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest group-hover:text-emerald-700">Buat Lapinhar</span>
                    </a>
                    <a href="{{ route('dpo.index') }}" wire:navigate class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-red-500/10 hover:border-red-200 transition-all duration-300 flex flex-col items-center justify-center gap-3 h-36">
                        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 border border-red-100"><i class="fas fa-user-plus text-xl"></i></div>
                        <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest group-hover:text-red-700">Input DPO</span>
                    </a>
                    <a href="{{ route('kerawanan.index') }}" wire:navigate class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-orange-500/10 hover:border-orange-200 transition-all duration-300 flex flex-col items-center justify-center gap-3 h-36">
                        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 border border-orange-100"><i class="fas fa-map-marked-alt text-xl"></i></div>
                        <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest group-hover:text-orange-700">Peta Rawan</span>
                    </a>
                    <a href="{{ route('pam-sdo.index') }}" wire:navigate class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 hover:border-blue-200 transition-all duration-300 flex flex-col items-center justify-center gap-3 h-36">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 border border-blue-100"><i class="fas fa-shield-alt text-xl"></i></div>
                        <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest group-hover:text-blue-700">PAM SDO</span>
                    </a>
                </div>

                {{-- TABEL LAPINHAR TERBARU --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-3">
                            <span class="w-1.5 h-5 bg-emerald-500 rounded-full"></span> Laporan Informasi Terkini
                        </h3>
                        <a href="{{ route('lapinhar.index') }}" wire:navigate class="text-[10px] font-black uppercase tracking-widest text-emerald-600 hover:text-emerald-800 transition">Semua Laporan &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-white text-slate-400 uppercase text-[9px] font-black tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4">Registrasi</th>
                                    <th class="px-6 py-4">Substansi Peristiwa</th>
                                    <th class="px-6 py-4 text-right">Klasifikasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($recent_lapinhars as $item)
                                <tr class="hover:bg-slate-50/80 transition group cursor-pointer">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm">
                                                <i class="fas fa-file-contract text-[10px]"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-bold text-slate-700 text-xs">{{ $item->tanggal_surat ? $item->tanggal_surat->format('d/m/Y') : '-' }}</span>
                                                <span class="text-[9px] text-slate-400 font-mono tracking-wide mt-0.5">{{ $item->nomor_surat ?? 'No Reg' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-xs text-slate-600 font-medium line-clamp-1 italic max-w-sm">"{{ $item->peristiwa }}"</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="px-2 py-1 rounded-md bg-slate-100 text-slate-600 text-[9px] font-black uppercase tracking-wider border border-slate-200">{{ $item->bidang }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 text-center text-slate-400 text-sm italic font-medium">Belum ada data laporan terbaru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- GRAFIK STATISTIK --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-3">
                            <i class="fas fa-chart-line text-blue-500"></i> Tren Laporan & Pengaduan
                        </h3>
                        <div class="px-2 py-1 bg-white border border-slate-200 rounded text-[9px] font-bold text-slate-500 uppercase tracking-widest shadow-sm">
                            6 Bulan Terakhir
                        </div>
                    </div>
                    <div class="p-6 relative h-[300px]">
                        <canvas id="reportsChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- KANAN (1/3) --}}
            <div class="space-y-8">

                {{-- SIGNAL LAPDU (MONITOR PENGADUAN) --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col h-[550px]">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between shrink-0">
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-satellite-dish text-emerald-500"></i> Signal Lapdu
                        </h3>
                        <span class="px-2 py-1 bg-red-50 text-red-600 border border-red-100 text-[9px] font-black rounded uppercase tracking-widest animate-pulse">Live</span>
                    </div>

                    <div class="flex-1 overflow-y-auto divide-y divide-slate-50 custom-scrollbar p-2">
                        @forelse($recent_lapdus as $lapdu)
                        <div class="p-4 hover:bg-slate-50 transition group cursor-pointer border-l-4 border-transparent hover:border-emerald-500 rounded-xl mb-1">
                            <div class="flex gap-4 items-start">
                                <div class="shrink-0">
                                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300 shadow-sm">
                                        <i class="fas fa-envelope-open-text text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-center mb-1.5">
                                        <span class="text-[8px] font-black text-emerald-700 bg-emerald-100/50 border border-emerald-200 px-2 py-0.5 rounded uppercase tracking-widest">{{ $lapdu->status_laporan }}</span>
                                        <span class="text-[9px] font-bold text-slate-400">
                                            {{ $lapdu->tanggal_terima ? $lapdu->tanggal_terima->format('d/m/y') : ($lapdu->created_at ? $lapdu->created_at->format('d/m/y') : '-') }}
                                        </span>
                                    </div>
                                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight truncate group-hover:text-emerald-700 transition" title="{{ $lapdu->nama_terlapor ?? 'TIDAK DIKETAHUI' }}">
                                        {{ $lapdu->nama_terlapor ?? 'TERLAPOR TIDAK DIKETAHUI' }}
                                    </h4>
                                    <p class="text-[11px] text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                        "{{ $lapdu->uraian_pengaduan }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="h-full flex flex-col items-center justify-center text-slate-300 p-6 text-center">
                            <i class="fas fa-inbox text-4xl mb-3 opacity-20"></i>
                            <p class="text-xs font-bold uppercase tracking-widest">Belum ada pengaduan.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="p-4 bg-white border-t border-slate-100 shrink-0">
                        <a href="{{ route('lapdu.index') }}" wire:navigate class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-600 transition-colors shadow-md">
                            Kelola Pengaduan <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- QUOTE / SEMBOYAN --}}
                <div class="bg-slate-900 rounded-3xl p-8 shadow-xl relative overflow-hidden text-center group border border-slate-800">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-32 h-32 bg-amber-500/20 rounded-full blur-2xl group-hover:bg-amber-500/30 transition duration-700"></div>
                    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 bg-emerald-500/20 rounded-full blur-2xl group-hover:bg-emerald-500/30 transition duration-700"></div>

                    <div class="relative z-10">
                        <div class="text-amber-500/30 text-3xl mb-3"><i class="fas fa-balance-scale"></i></div>
                        <h4 class="font-black text-lg text-amber-400 mb-3 tracking-[0.25em] uppercase">SATYA ADHI WICAKSANA</h4>
                        <div class="w-10 h-0.5 bg-amber-500/50 mx-auto mb-4"></div>
                        <p class="text-xs text-slate-300 font-medium leading-relaxed italic">
                            "Setia, bijaksana, dan bertanggung jawab dalam menjalankan tugas penegakan hukum."
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Styling khusus scrollbar untuk div signal lapdu */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
            background: #94a3b8;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:navigated', function() {
            const ctx = document.getElementById('reportsChart');
            if (ctx) {
                // Styling premium untuk font di Chart
                Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
                Chart.defaults.color = '#64748b'; // slate-500

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                                label: 'Laporan Informasi (LI)',
                                data: @json($chartLapinhar),
                                borderColor: '#10b981', // Emerald 500
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                borderWidth: 2.5,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: '#10b981',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            },
                            {
                                label: 'Pengaduan (Lapdu)',
                                data: @json($chartLapdu),
                                borderColor: '#3b82f6', // Blue 500
                                backgroundColor: 'transparent',
                                borderWidth: 2.5,
                                tension: 0.4,
                                borderDash: [5, 5],
                                pointBackgroundColor: '#fff',
                                pointBorderColor: '#3b82f6',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        size: 11,
                                        weight: '600'
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.9)', // slate-900
                                titleFont: {
                                    size: 13,
                                    weight: '800'
                                },
                                bodyFont: {
                                    size: 12,
                                    weight: '500'
                                },
                                padding: 12,
                                cornerRadius: 8,
                                displayColors: true,
                                boxPadding: 6
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#f1f5f9',
                                    drawBorder: false
                                }, // slate-100
                                border: {
                                    display: false
                                },
                                ticks: {
                                    stepSize: 1,
                                    padding: 10,
                                    font: {
                                        weight: '500'
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                border: {
                                    display: false
                                },
                                ticks: {
                                    padding: 10,
                                    font: {
                                        weight: '600'
                                    }
                                }
                            }
                        },
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                    }
                });
            }
        });
    </script>
</div>