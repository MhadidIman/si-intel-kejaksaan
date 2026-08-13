<div>
    <div class="w-full">
        {{-- SYSTEM ALERTS (THREAT RADAR) --}}
        @if(count($system_alerts) > 0)
        <div class="space-y-4 mb-10">
            @foreach($system_alerts as $alert)
            @php
                $classes = match($alert['type']) {
                    'danger' => ['bg-red-500/10 border-red-500/50 text-red-700', 'bg-red-500 text-white shadow-red-500/30'],
                    'warning' => ['bg-amber-500/10 border-amber-500/50 text-amber-800', 'bg-amber-500 text-white shadow-amber-500/30'],
                    'info' => ['bg-blue-500/10 border-blue-500/50 text-blue-700', 'bg-blue-500 text-white shadow-blue-500/30'],
                    default => ['bg-slate-500/10 border-slate-500/50 text-slate-700', 'bg-slate-500 text-white shadow-slate-500/30']
                };
            @endphp
            <div class="{{ $classes[0] }} border backdrop-blur-sm p-4 rounded-2xl flex items-start gap-4 shadow-sm animate-pulse-slow">
                <div class="shrink-0 mt-1">
                    <div class="w-10 h-10 rounded-full {{ $classes[1] }} flex items-center justify-center shadow-lg">
                        <i class="fas {{ $alert['icon'] }} text-lg"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-black text-sm uppercase tracking-wider mb-1">{{ $alert['title'] }}</h3>
                    <p class="text-sm font-medium opacity-90">{{ $alert['message'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- EXECUTIVE METRICS GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            {{-- LAPDU MENUNGGU --}}
            <div class="bg-blue-600 rounded-3xl p-6 shadow-xl shadow-blue-600/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-envelope-open-text"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-blue-100 uppercase tracking-widest mb-1">Lapdu Menunggu</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $total_lapdu_masuk ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-envelope-open-text"></i></div>
                </div>
            </div>

            {{-- DPO BURON --}}
            <div class="bg-red-600 rounded-3xl p-6 shadow-xl shadow-red-600/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-user-secret"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-red-100 uppercase tracking-widest mb-1">DPO (Buron)</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $total_dpo_buron ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-user-secret"></i></div>
                </div>
            </div>

            {{-- WNA OVERSTAY --}}
            <div class="bg-amber-500 rounded-3xl p-6 shadow-xl shadow-amber-500/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-passport"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-amber-50 uppercase tracking-widest mb-1">WNA Overstay</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $total_wna_overstay ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-passport"></i></div>
                </div>
            </div>

            {{-- ORMAS DIAWASI --}}
            <div class="bg-purple-600 rounded-3xl p-6 shadow-xl shadow-purple-600/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-users-slash"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-purple-100 uppercase tracking-widest mb-1">Ormas Diawasi</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $total_ormas_diawasi ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-users-slash"></i></div>
                </div>
            </div>
        </div>

        {{-- KOLOM TENGAH: APPROVAL CENTER & PETA KERAWANAN --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-10">
            {{-- APPROVAL CENTER --}}
            <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 dark:border-slate-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-black text-slate-800 dark:text-slate-100 dark:text-white tracking-tight flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                            <i class="fas fa-clipboard-check text-xl"></i>
                        </div>
                        Pusat Persetujuan (Approval Center)
                    </h3>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full">{{ $pending_approvals->count() }} Menunggu</span>
                </div>
                <div class="space-y-4">
                    @forelse($pending_approvals as $approval)
                    <div class="p-4 bg-slate-50 dark:bg-slate-900/50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700 dark:border-slate-700 hover:border-indigo-300 hover:shadow-md transition group">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-4 items-center">
                                <div class="w-12 h-12 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 transition">
                                    <i class="fas fa-file-signature text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">{{ $approval->type }}</p>
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100 dark:text-white">{{ $approval->title }}</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Oleh: <strong>{{ $approval->user_name }}</strong> &bull; {{ \Carbon\Carbon::parse($approval->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="{{ $approval->route }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-500/30 transition">
                                Tinjau
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10 text-slate-400">
                        <i class="fas fa-check-circle text-4xl mb-3 text-emerald-400"></i>
                        <p class="text-sm font-bold">Semua laporan telah diproses.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- DASHBOARD INTELIJEN PREDIKTIF (PETA & HEATMAP) --}}
            <div wire:ignore class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden border border-slate-100 dark:border-slate-700 dark:border-slate-700 flex flex-col">
                <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-700 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="text-lg font-black text-slate-800 dark:text-slate-100 dark:text-white tracking-tight flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="fas fa-map-marked-alt text-xl"></i>
                        </div>
                        Peta Kerawanan (GIS)
                    </h3>
                </div>
                <div class="p-3 bg-slate-50 dark:bg-slate-900/50 dark:bg-slate-900/50">
                    <div id="prediktifMapAdmin" class="w-full h-[350px] rounded-2xl border border-slate-200 dark:border-slate-700 z-10 relative"></div>
                </div>
            </div>
        </div>

        {{-- KOLOM BAWAH: GRAFIK & LEADERBOARD --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-10">
            {{-- KIRI: GRAFIK TREN DATA --}}
            <div class="xl:col-span-2 space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 dark:border-slate-700 flex flex-col h-full min-h-[400px]">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-100 dark:text-white tracking-tight flex items-center gap-3">
                            <i class="fas fa-chart-area text-indigo-500 text-xl"></i> Tren Volume Data Intelijen
                        </h3>
                    </div>
                    <div class="p-6 relative flex-1">
                        <canvas id="reportsChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- KANAN: STAFF PERFORMANCE LEADERBOARD --}}
            <div class="space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 dark:border-slate-700 h-full flex flex-col">
                    <div class="flex justify-between items-center mb-6 border-b border-slate-100 dark:border-slate-700 dark:border-slate-700 pb-4">
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-100 dark:text-white tracking-tight flex items-center gap-3">
                            <i class="fas fa-trophy text-amber-500 text-xl"></i> Peringkat Kinerja Staf
                        </h3>
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Bulan Ini</span>
                    </div>

                    <div class="flex-1 overflow-y-auto custom-scrollbar pr-2 space-y-4">
                        @foreach($staff_performance as $index => $staff)
                        <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-slate-700 transition border border-transparent hover:border-slate-100 dark:border-slate-700 dark:hover:border-slate-600">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white shadow-md
                                    @if($index == 0) bg-amber-400 shadow-amber-400/30
                                    @elseif($index == 1) bg-slate-300 shadow-slate-300/30
                                    @elseif($index == 2) bg-amber-700 shadow-amber-700/30
                                    @else bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-300 shadow-none
                                    @endif">
                                    #{{ $index + 1 }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100 dark:text-white">{{ $staff->name }}</h4>
                                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">{{ $staff->jabatan ?? 'Staf' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-lg font-black text-indigo-600">{{ $staff->total_reports }}</span>
                                <p class="text-[9px] uppercase tracking-widest text-slate-400 font-bold">Laporan</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- POPUP NOTIFIKASI LAPDU (ALPINE.JS) --}}
        <div x-data="{ show: false, title: '', message: '' }"
            x-on:lapdu-masuk.window="show = true; title = $event.detail.title; message = $event.detail.message; setTimeout(() => show = false, 6000)"
            class="fixed bottom-8 right-8 z-[100]"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-10"
            style="display: none;">
            
            <div class="bg-emerald-600 text-white rounded-2xl shadow-2xl p-4 flex items-start gap-4 max-w-sm border-2 border-white/20">
                <div class="bg-white/20 w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fas fa-bell text-xl"></i>
                </div>
                <div>
                    <p class="font-black text-sm uppercase tracking-wider mb-1" x-text="title"></p>
                    <p class="text-sm opacity-90 leading-tight" x-text="message"></p>
                </div>
                <button @click="show = false" class="text-white/50 hover:text-white transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('livewire:navigated', function() {
                // 1. INIT CHART TREN VOLUME Laporan
                const ctxReports = document.getElementById('reportsChart');
                if (ctxReports) {
                    new Chart(ctxReports, {
                        type: 'line',
                        data: {
                            labels: @json($chartLabels),
                            datasets: [
                                {
                                    label: 'Lapinhar',
                                    data: @json($chartLapinhar),
                                    borderColor: '#10b981', // Emerald 500
                                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                    borderWidth: 3,
                                    tension: 0.4,
                                    fill: true,
                                    pointBackgroundColor: '#10b981',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointRadius: 4,
                                },
                                {
                                    label: 'Lapsus',
                                    data: @json($chartLapsus),
                                    borderColor: '#4f46e5', // Indigo 600
                                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                    borderWidth: 3,
                                    tension: 0.4,
                                    fill: true,
                                    pointBackgroundColor: '#4f46e5',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointRadius: 4,
                                },
                                {
                                    label: 'Lapdu',
                                    data: @json($chartLapdu),
                                    borderColor: '#f59e0b', // Amber 500
                                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                    borderWidth: 3,
                                    tension: 0.4,
                                    fill: true,
                                    pointBackgroundColor: '#f59e0b',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointRadius: 4,
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        font: {
                                            family: "'Inter', sans-serif",
                                            weight: 'bold'
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f1f5f9',
                                        drawBorder: false,
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false,
                                    }
                                }
                            }
                        }
                    });
                }

                // 2. INIT LEAFLET MAP
                const mapEl = document.getElementById('prediktifMapAdmin');
                if (mapEl && typeof L !== 'undefined') {
                    // Cek apakah peta sudah diinisialisasi
                    if (window.adminMap) {
                        window.adminMap.remove();
                    }
                    
                    const map = L.map('prediktifMapAdmin').setView([-3.316694, 114.590111], 12); // Default Banjarmasin
                    window.adminMap = map;

                    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                        attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
                    }).addTo(map);

                    const kerawananData = @json($peta_kerawanan);
                    const heatData = [];

                    kerawananData.forEach(item => {
                        if (item.latitude && item.longitude) {
                            let intensity = 0.3;
                            let color = '#22c55e'; // Rendah

                            if (item.tingkat_rawan === 'tinggi') {
                                intensity = 1.0;
                                color = '#ef4444'; // Tinggi
                            } else if (item.tingkat_rawan === 'sedang') {
                                intensity = 0.6;
                                color = '#f59e0b'; // Sedang
                            }

                            // Kumpulkan data untuk heatmap (Lat, Lng, Intensity)
                            if (typeof L.heatLayer !== 'undefined') {
                                heatData.push([parseFloat(item.latitude), parseFloat(item.longitude), intensity]);
                            }

                            // Tambahkan Marker Biasa
                            L.circleMarker([item.latitude, item.longitude], {
                                radius: 8,
                                fillColor: color,
                                color: '#ffffff',
                                weight: 2,
                                opacity: 1,
                                fillOpacity: 0.8
                            }).bindPopup(`
                                <div style="font-family: Inter, sans-serif; min-width: 200px;">
                                    <h4 style="font-weight: 800; font-size: 14px; margin-bottom: 5px;">${item.kecamatan}</h4>
                                    <p style="font-size: 12px; margin: 0; color: #64748b;">Potensi Ancaman:</p>
                                    <p style="font-size: 13px; font-weight: 600; margin: 2px 0 10px 0;">${item.potensi_ancaman}</p>
                                    <span style="display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; background-color: ${color}; color: white; text-transform: uppercase;">Rawan ${item.tingkat_rawan}</span>
                                </div>
                            `).addTo(map);
                        }
                    });

                    // Render Heatmap Jika Library Tersedia
                    if (heatData.length > 0 && typeof L.heatLayer !== 'undefined') {
                        L.heatLayer(heatData, {
                            radius: 35,
                            blur: 25,
                            maxZoom: 15,
                            gradient: {
                                0.4: 'green',
                                0.6: 'yellow',
                                1.0: 'red'
                            }
                        }).addTo(map);
                    }
                }
            });
        </script>
    </div>
</div>
