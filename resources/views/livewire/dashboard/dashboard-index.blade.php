<div>
    <div class="py-10 bg-slate-50 dark:bg-slate-900/50 dark:bg-slate-900 min-h-screen font-sans transition-colors duration-300">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10 relative">

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

        {{-- RENDER KOMPONEN BERDASARKAN ROLE --}}
        <div>
            @if(auth()->user()->role === 'admin')
                @livewire('dashboard.dashboard-admin')
            @elseif(auth()->user()->role === 'staff')
                @livewire('dashboard.dashboard-staff')
            @else
                <div class="p-8 text-center text-red-500 font-bold bg-white rounded-3xl shadow-sm border border-red-100">
                    Akses Dashboard tidak dikenali untuk role Anda.
                </div>
            @endif
        </div>

        {{-- SCROLLBAR STYLE & DEPENDENCIES --}}
        <style>
            .custom-scrollbar::-webkit-scrollbar {
                width: 4px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }
        </style>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </div>
</div>
</div>