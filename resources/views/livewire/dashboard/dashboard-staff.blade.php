<div>
    <div class="w-full">
        {{-- ACTION REQUIRED (JIKA ADA LAPORAN DITOLAK) --}}
        @if($action_required->count() > 0)
        <div class="bg-red-500 rounded-3xl p-6 shadow-xl shadow-red-500/20 mb-8 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden group">
            <div class="absolute -right-10 -top-10 opacity-10 text-white text-9xl transform rotate-12"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="relative z-10 flex items-center gap-6">
                <div class="w-16 h-16 rounded-2xl bg-white text-red-600 flex items-center justify-center text-3xl shadow-lg shrink-0 animate-bounce">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <h3 class="text-xl font-black text-white tracking-wide mb-1">TINDAKAN DIPERLUKAN!</h3>
                    <p class="text-red-100 font-medium text-sm">Terdapat {{ $action_required->count() }} laporan Anda yang dikembalikan / ditolak oleh pimpinan. Segera perbaiki.</p>
                </div>
            </div>
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-3 w-full md:w-auto">
                @foreach($action_required as $req)
                <a href="{{ $req->route }}" class="bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl px-4 py-2 text-white transition flex justify-between items-center group/btn">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-red-100">{{ $req->type }}</span>
                        <p class="font-bold text-sm">{{ \Illuminate\Support\Str::limit($req->title, 20) }}</p>
                    </div>
                    <i class="fas fa-arrow-right text-sm opacity-50 group-hover/btn:opacity-100 group-hover/btn:translate-x-1 transition"></i>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- METRIK PRIBADI STAFF --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- LAPINHAR SAYA --}}
            <div class="bg-emerald-600 rounded-3xl p-6 shadow-xl shadow-emerald-600/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-file-alt"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-widest mb-1">Lapinhar Saya</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $staff_total_lapinhar ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-file-alt"></i></div>
                </div>
            </div>

            {{-- LAPSUS SAYA --}}
            <div class="bg-indigo-600 rounded-3xl p-6 shadow-xl shadow-indigo-600/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-file-shield"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-indigo-50 uppercase tracking-widest mb-1">Lapsus Saya</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $staff_total_lapsus ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-file-shield"></i></div>
                </div>
            </div>

            {{-- JMS SAYA --}}
            <div class="bg-amber-500 rounded-3xl p-6 shadow-xl shadow-amber-500/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-graduation-cap"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-amber-50 uppercase tracking-widest mb-1">JMS Saya</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $staff_total_jms ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-graduation-cap"></i></div>
                </div>
            </div>

            {{-- PAM SDO SAYA --}}
            <div class="bg-rose-600 rounded-3xl p-6 shadow-xl shadow-rose-600/20 flex flex-col justify-between h-36 relative overflow-hidden group hover:-translate-y-1 transition-all">
                <div class="absolute -right-4 -top-4 opacity-20 text-white text-7xl transform rotate-12 group-hover:scale-110 transition"><i class="fas fa-user-shield"></i></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-rose-50 uppercase tracking-widest mb-1">PAM SDO Saya</p>
                        <p class="text-4xl font-black text-white drop-shadow-md">{{ $staff_total_pam ?? 0 }}</p>
                    </div>
                    <div class="p-2.5 bg-white/20 rounded-xl text-white backdrop-blur-md shadow-inner"><i class="fas fa-user-shield"></i></div>
                </div>
            </div>
        </div>

        {{-- MEJA KERJA: UNIVERSAL QUICK ACCESS & ACTIVITY LOG --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-10">
            
            {{-- UNIVERSAL QUICK ACCESS (8 MENU) --}}
            <div class="xl:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 dark:border-slate-700">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-100 tracking-tight flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-500 flex items-center justify-center">
                                <i class="fas fa-th-large text-xl"></i>
                            </div>
                            Akses Pintas Terpadu
                        </h3>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('lapinhar.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-200 text-slate-600 dark:text-slate-300 hover:text-emerald-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-file-alt text-3xl mb-3 text-emerald-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Entri Lapinhar</span>
                        </a>
                        <a href="{{ route('lapsus.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-indigo-50 border border-slate-200 hover:border-indigo-200 text-slate-600 dark:text-slate-300 hover:text-indigo-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-file-shield text-3xl mb-3 text-indigo-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Entri Lapsus</span>
                        </a>
                        <a href="{{ route('dpo.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-red-50 border border-slate-200 hover:border-red-200 text-slate-600 dark:text-slate-300 hover:text-red-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-user-secret text-3xl mb-3 text-red-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Input DPO</span>
                        </a>
                        <a href="{{ route('wna.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-amber-50 border border-slate-200 hover:border-amber-200 text-slate-600 dark:text-slate-300 hover:text-amber-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-passport text-3xl mb-3 text-amber-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Pengawasan WNA</span>
                        </a>
                        <a href="{{ route('lapdu.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-blue-50 border border-slate-200 hover:border-blue-200 text-slate-600 dark:text-slate-300 hover:text-blue-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-envelope-open-text text-3xl mb-3 text-blue-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Investigasi Lapdu</span>
                        </a>
                        <a href="{{ route('ormas.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-purple-50 border border-slate-200 hover:border-purple-200 text-slate-600 dark:text-slate-300 hover:text-purple-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-users text-3xl mb-3 text-purple-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Data Ormas</span>
                        </a>
                        <a href="{{ route('jms.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-orange-50 border border-slate-200 hover:border-orange-200 text-slate-600 dark:text-slate-300 hover:text-orange-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-graduation-cap text-3xl mb-3 text-orange-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Giat JMS</span>
                        </a>
                        <a href="{{ route('pam-sdo.index') }}" class="bg-slate-50 dark:bg-slate-900/50 hover:bg-rose-50 border border-slate-200 hover:border-rose-200 text-slate-600 dark:text-slate-300 hover:text-rose-700 rounded-2xl p-5 transition flex flex-col items-center text-center group cursor-pointer h-28 justify-center">
                            <i class="fas fa-user-shield text-3xl mb-3 text-rose-500 group-hover:scale-110 transition duration-300"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Input PAM SDO</span>
                        </a>
                    </div>
                </div>

                {{-- PETA KERAWANAN KECIL --}}
                <div wire:ignore class="bg-white rounded-[2.5rem] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 dark:border-slate-700 flex flex-col relative overflow-hidden">
                    <h3 class="text-sm font-black text-slate-800 dark:text-slate-100 tracking-tight flex items-center gap-2 mb-4 z-10 relative">
                        <i class="fas fa-map-marked-alt text-emerald-500"></i> Pantauan GIS Wilayah
                    </h3>
                    <div class="h-[300px] w-full rounded-2xl overflow-hidden relative z-10 border border-slate-200">
                        <div id="prediktifMapStaff" class="w-full h-full"></div>
                    </div>
                </div>
            </div>

            {{-- ACTIVITY TIMELINE --}}
            <div class="space-y-8">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 dark:border-slate-700 h-full flex flex-col min-h-[500px]">
                    <div class="flex justify-between items-center mb-6 border-b border-slate-100 dark:border-slate-700 pb-4">
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-100 tracking-tight flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-slate-100 text-slate-500 flex items-center justify-center">
                                <i class="fas fa-history text-xl"></i>
                            </div>
                            Riwayat Aktivitas
                        </h3>
                        <button wire:click="confirmClear" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:bg-red-50 hover:text-red-500 transition flex items-center justify-center" title="Bersihkan Riwayat">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </div>

                    <div class="flex-1 relative">
                        <div class="absolute left-[19px] top-4 bottom-4 w-0.5 bg-slate-200 rounded-full"></div>
                        <div class="space-y-6 relative">
                            @forelse($my_activities as $log)
                            <div class="flex gap-4 relative">
                                <div class="w-10 h-10 rounded-full bg-white border-4 border-slate-100 dark:border-slate-700 flex items-center justify-center shrink-0 z-10 text-slate-400">
                                    <i class="fas fa-dot-circle text-xs"></i>
                                </div>
                                <div class="pt-2">
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-100 leading-tight">{{ $log->activity }}</p>
                                    <p class="text-[11px] text-slate-500 mt-1"><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-10 text-slate-400">
                                <i class="fas fa-history text-4xl mb-3 opacity-20"></i>
                                <p class="text-sm font-bold">Belum ada jejak aktivitas terkam.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.addEventListener('livewire:navigated', function() {
                // INIT LEAFLET MAP STAFF
                const mapElStaff = document.getElementById('prediktifMapStaff');
                if (mapElStaff && typeof L !== 'undefined') {
                    if (window.staffMap) {
                        window.staffMap.remove();
                    }
                    
                    const map = L.map('prediktifMapStaff').setView([-3.316694, 114.590111], 12);
                    window.staffMap = map;

                    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                        attribution: '&copy; OpenStreetMap'
                    }).addTo(map);

                    const kerawananData = @json($peta_kerawanan);
                    
                    kerawananData.forEach(item => {
                        if (item.latitude && item.longitude) {
                            let color = '#22c55e'; // Rendah

                            if (item.tingkat_rawan === 'tinggi') {
                                color = '#ef4444'; // Tinggi
                            } else if (item.tingkat_rawan === 'sedang') {
                                color = '#f59e0b'; // Sedang
                            }

                            L.circleMarker([item.latitude, item.longitude], {
                                radius: 6,
                                fillColor: color,
                                color: '#ffffff',
                                weight: 2,
                                opacity: 1,
                                fillOpacity: 0.8
                            }).addTo(map);
                        }
                    });
                }
            });
        </script>
    </div>

    {{-- MODAL HAPUS DATA --}}
    @if($isDeleteOpen)
    <div class="fixed inset-0 z-[110] flex items-center justify-center bg-slate-900/80 backdrop-blur-sm p-4 transition-opacity">
        <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl p-8 relative animate-fade-in-up border border-slate-100 dark:border-slate-700 text-center">

            <div class="w-20 h-20 bg-red-50 text-red-500 border-4 border-red-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i class="fas fa-eraser text-3xl animate-pulse"></i>
            </div>

            <h3 class="text-xl font-black text-slate-800 dark:text-slate-100 uppercase tracking-widest mb-2">Bersihkan Riwayat?</h3>
            <p class="text-xs text-slate-500 font-medium leading-relaxed mb-8">Seluruh jejak aktivitas Anda akan dihapus secara permanen. Lanjutkan?</p>

            <div class="flex flex-col gap-3">
                <button wire:click="clearActivityLog" class="w-full py-3.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-black uppercase text-xs tracking-widest transition-all shadow-lg shadow-red-500/30 flex items-center justify-center gap-2">
                    <i class="fas fa-trash-alt"></i> Ya, Bersihkan
                </button>
                <button wire:click="$set('isDeleteOpen', false)" class="w-full py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold uppercase text-xs tracking-widest transition-all">
                    Batal
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
