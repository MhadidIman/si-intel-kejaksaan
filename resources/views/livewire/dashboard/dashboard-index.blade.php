<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        {{-- HEADER: COMMAND CENTER --}}
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
        {{-- SYSTEM ALERTS (NOTIFIKASI PREDIKTIF INTELIJEN)                 --}}
        {{-- ============================================================== --}}
        @if(count($system_alerts) > 0)
        <div class="space-y-4">
            @foreach($system_alerts as $alert)
            @php
            $theme = [
            'danger' => 'bg-red-50 border-red-500 text-red-800 icon-bg-red-100 icon-text-red-600',
            'warning' => 'bg-amber-50 border-amber-500 text-amber-800 icon-bg-amber-100 icon-text-amber-600',
            'info' => 'bg-blue-50 border-blue-500 text-blue-800 icon-bg-blue-100 icon-text-blue-600',
            ][$alert['type']];

            $classes = explode(' ', $theme);
            @endphp

            <div class="{{ $classes[0] }} border-l-4 {{ $classes[1] }} p-4 sm:p-5 rounded-r-2xl shadow-md flex items-start gap-4 animate-fade-in-down">
                <div class="shrink-0 mt-1">
                    <div class="w-10 h-10 rounded-full {{ $classes[3] }} {{ $classes[4] }} flex items-center justify-center animate-pulse">
                        <i class="fas {{ $alert['icon'] }} text-lg"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-black {{ $classes[2] }} uppercase tracking-widest">{{ $alert['title'] }}</h3>
                    <p class="mt-1 text-xs font-medium text-slate-600 leading-relaxed">{{ $alert['message'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- METRIK UTAMA --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-red-600 rounded-3xl p-7 shadow-xl shadow-red-600/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-user-secret"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-red-100 uppercase tracking-[0.2em] mb-1">Buronan (DPO)</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_dpo_buron ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-user-secret text-xl"></i></div>
                </div>
            </div>

            <div class="bg-orange-500 rounded-3xl p-7 shadow-xl shadow-orange-500/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-orange-50 uppercase tracking-[0.2em] mb-1">Rawan Tinggi</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_rawan_tinggi ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-map-marker-alt text-xl"></i></div>
                </div>
            </div>

            <div class="bg-blue-600 rounded-3xl p-7 shadow-xl shadow-blue-600/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-globe-americas"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-blue-50 uppercase tracking-[0.2em] mb-1">WNA Overstay</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_wna_overstay ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-passport text-xl"></i></div>
                </div>
            </div>

            <div class="bg-emerald-600 rounded-3xl p-7 shadow-xl shadow-emerald-600/20 flex flex-col justify-between h-44 relative overflow-hidden group hover:-translate-y-1.5 transition-all duration-300">
                <div class="absolute -right-6 -top-6 opacity-20 text-white text-8xl transform rotate-12 group-hover:scale-110 transition duration-500"><i class="fas fa-envelope-open-text"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-emerald-50 uppercase tracking-[0.2em] mb-1">Lapdu Masuk</p>
                        <p class="text-5xl font-black text-white tracking-tighter drop-shadow-md">{{ $total_lapdu_masuk ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-white backdrop-blur-md border border-white/20 shadow-inner"><i class="fas fa-inbox text-xl"></i></div>
                </div>
            </div>
        </div>

        {{-- DASHBOARD INTELIJEN PREDIKTIF (PETA & HEATMAP) --}}
        <div wire:ignore class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative z-0">
            <div class="px-8 py-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center bg-slate-50/50 gap-4">
                <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    Heatmap & Prediksi Wilayah Rawan (GIS)
                </h3>
                <div class="flex gap-4 text-[10px] font-black uppercase tracking-widest text-slate-500 bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-red-500"></span> Tinggi</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span> Sedang</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Rendah</span>
                </div>
            </div>
            <div class="p-3 bg-slate-50">
                <div id="prediktifMap" class="w-full h-[450px] rounded-[1.5rem] shadow-inner border border-slate-200 z-10"></div>
            </div>
        </div>

        {{-- BAGIAN BAWAH (SHORTCUT DIHILANGKAN, GRAFIK SEJAJAR) --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            {{-- KIRI: GRAFIK STATISTIK TREN --}}
            <div class="xl:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col h-[600px]">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 shrink-0">
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-3">
                            <i class="fas fa-chart-line text-blue-500"></i> Statistik Tren Tindak Pidana & Laporan
                        </h3>
                    </div>
                    <div class="p-6 relative flex-1">
                        <canvas id="reportsChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- KANAN: SIGNAL LAPDU --}}
            <div class="space-y-8">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col h-[600px]">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between shrink-0">
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-satellite-dish text-emerald-500"></i> Signal Lapdu
                        </h3>
                        <span class="px-2 py-1 bg-red-50 text-red-600 border border-red-100 text-[9px] font-black rounded uppercase tracking-widest animate-pulse">Live</span>
                    </div>

                    <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                        @forelse($recent_lapdus as $lapdu)
                        <div class="p-4 hover:bg-slate-50 border-l-4 border-transparent hover:border-emerald-500 rounded-xl mb-1">
                            <div class="flex gap-4 items-start">
                                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <i class="fas fa-envelope-open-text text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-slate-800 uppercase truncate">{{ $lapdu->nama_terlapor ?? 'TIDAK DIKETAHUI' }}</h4>
                                    <p class="text-[11px] text-slate-500 mt-1 line-clamp-2">"{{ $lapdu->uraian_pengaduan }}"</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-6 text-center text-slate-400 italic text-xs">Belum ada pengaduan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- SCROLLBAR STYLE --}}
        <style>
            .custom-scrollbar::-webkit-scrollbar {
                width: 4px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }
        </style>

        {{-- LEAFLET & CHART JS SCRIPTS --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('livewire:navigated', function() {
                // INIT CHART TREN PENGADUAN & DPO
                const ctx = document.getElementById('reportsChart');
                if (ctx) {
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($chartLabels),
                            datasets: [{
                                    label: 'Lapinhar',
                                    data: @json($chartLapinhar),
                                    borderColor: '#10b981',
                                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                    fill: true,
                                    tension: 0.4
                                },
                                {
                                    label: 'Lapdu',
                                    data: @json($chartLapdu),
                                    borderColor: '#3b82f6',
                                    borderDash: [5, 5],
                                    tension: 0.4
                                },
                                {
                                    label: 'DPO / Tindak Pidana',
                                    data: @json($chartDpo),
                                    borderColor: '#ef4444',
                                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                    fill: true,
                                    tension: 0.4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                }

                // INIT GIS & HEATMAP
                if (document.getElementById('prediktifMap')) {
                    var container = L.DomUtil.get('prediktifMap');
                    if (container != null) {
                        container._leaflet_id = null;
                    }

                    var map = L.map('prediktifMap').setView([-3.316694, 114.590111], 12);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap Kejaksaan'
                    }).addTo(map);

                    var kerawananData = @json($peta_kerawanan);
                    var heatPoints = [];

                    kerawananData.forEach(function(item) {
                        if (item.latitude && item.longitude) {
                            var lat = parseFloat(item.latitude);
                            var lng = parseFloat(item.longitude);

                            var intensity = parseFloat(item.skor_spk) / 100;
                            heatPoints.push([lat, lng, intensity]);

                            var color = item.tingkat_rawan == 'tinggi' ? '#ef4444' : (item.tingkat_rawan == 'sedang' ? '#f97316' : '#10b981');

                            var circle = L.circleMarker([lat, lng], {
                                color: color,
                                fillColor: color,
                                fillOpacity: 0.8,
                                radius: 8,
                                weight: 2
                            }).addTo(map);

                            circle.bindPopup(`
                            <div style="min-width: 220px; font-family: sans-serif;">
                                <div style="font-weight: 900; font-size: 13px; text-transform: uppercase; color: #1e293b; margin-bottom: 4px;">${item.kecamatan}</div>
                                <div style="font-size: 11px; color: #64748b; margin-bottom: 10px; line-height: 1.4;">${item.potensi_ancaman}</div>
                                <div style="font-size: 10px; font-weight: 800; background: ${color}20; color: ${color}; padding: 6px 10px; border-radius: 6px; border: 1px solid ${color}40; display: inline-block;">
                                    SKOR SPK: ${item.skor_spk} | ${item.tingkat_rawan.toUpperCase()}
                                </div>
                            </div>
                        `);
                        }
                    });

                    if (heatPoints.length > 0) {
                        L.heatLayer(heatPoints, {
                            radius: 35,
                            blur: 25,
                            maxZoom: 12,
                            gradient: {
                                0.4: 'blue',
                                0.6: 'cyan',
                                0.7: 'lime',
                                0.8: 'yellow',
                                1.0: 'red'
                            }
                        }).addTo(map);
                    }
                }
            });
        </script>
    </div> {{-- / CONTAINER MAX-WIDTH --}}
</div> {{-- / ROOT DIV (HANYA ADA 1 TAG INI SEBAGAI PARENT) --}}