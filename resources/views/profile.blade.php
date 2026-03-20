<x-app-layout>
    <div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- HEADER PROFIL --}}
            <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-12 shadow-2xl border-b-4 border-emerald-500 flex flex-col md:flex-row items-center gap-8 group">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/20 blur-[100px] rounded-full pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>

                <div class="w-32 h-32 rounded-full bg-slate-800 border-4 border-emerald-500/50 p-1 shrink-0 shadow-[0_0_30px_rgba(16,185,129,0.3)] relative z-10 overflow-hidden flex items-center justify-center text-emerald-500 font-black text-4xl">
                    @if(auth()->user()->foto_profile)
                    <img src="{{ asset('storage/' . auth()->user()->foto_profile) }}" class="w-full h-full object-cover rounded-full">
                    @else
                    {{ substr(auth()->user()->name, 0, 1) }}
                    @endif
                </div>

                <div class="relative z-10 text-center md:text-left flex-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-[10px] font-black uppercase tracking-widest border border-emerald-500/30 mb-3">
                        <i class="fas fa-id-badge"></i> ID Terverifikasi
                    </div>
                    <h2 class="text-3xl font-black text-white tracking-tight uppercase">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-emerald-400 font-bold mt-1 tracking-widest uppercase">{{ auth()->user()->jabatan ?? 'Petugas Intelijen' }} - {{ auth()->user()->satuan_kerja ?? 'Kejaksaan RI' }}</p>
                </div>
            </div>

            {{-- GRID KONTEN --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KOLOM KIRI: ID CARD (Read Only) --}}
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-full -z-10"></div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest mb-6 border-b border-slate-100 pb-4">
                            <i class="fas fa-file-contract text-emerald-500 mr-2"></i> Data Kepegawaian
                        </h3>

                        <div class="space-y-5">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Nomor Induk Pegawai (NIP)</p>
                                <p class="text-sm font-bold text-slate-800 mt-1">{{ auth()->user()->nip ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Pangkat / Golongan</p>
                                <p class="text-sm font-bold text-slate-800 mt-1">{{ auth()->user()->pangkat ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Otoritas Sistem</p>
                                <span class="inline-block mt-1 px-2 py-1 bg-slate-100 border border-slate-200 rounded text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                    ROLE: {{ auth()->user()->role }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-8 p-4 bg-amber-50 rounded-xl border border-amber-100 flex gap-3 items-start">
                            <i class="fas fa-info-circle text-amber-500 mt-0.5"></i>
                            <p class="text-[9px] font-bold text-amber-700 leading-relaxed uppercase tracking-widest">Data kepegawaian hanya dapat diubah oleh Administrator Sistem melalui menu Manajemen Personil.</p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: UPDATE FORM --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Form Update Profile (Email/Kontak) --}}
                    <div class="p-8 bg-white shadow-sm rounded-3xl border border-slate-100">
                        <div class="max-w-xl">
                            <livewire:profile.update-profile-information-form />
                        </div>
                    </div>

                    {{-- Form Update Password --}}
                    <div class="p-8 bg-white shadow-sm rounded-3xl border border-slate-100">
                        <div class="max-w-xl">
                            <livewire:profile.update-password-form />
                        </div>
                    </div>

                    {{-- Fitur Delete Account kita hapus dari sini karena sangat berbahaya untuk aplikasi pemerintah --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>