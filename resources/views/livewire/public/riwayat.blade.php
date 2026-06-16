<?php

use App\Models\Lapdu;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.public')] class extends Component // <-- Layout diubah ke public
{
    public $laporans;

    public function mount()
    {
        // =========================================================================
        // SATPAM (GUARD): Tolak petugas masuk ke halaman riwayat publik
        // =========================================================================
        if (auth()->user()->role !== 'masyarakat') {
            $this->redirectRoute('dashboard', navigate: true);
            return;
        }

        // Mengambil semua riwayat laporan khusus masyarakat yang sedang login
        $this->laporans = Lapdu::where('nama_pelapor', auth()->user()->name)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}; ?>

<div class="min-h-screen bg-slate-50 font-sans pb-24 selection:bg-emerald-500 selection:text-white">

    {{-- BANNER ATAS --}}
    <div class="bg-slate-900 border-b-4 border-emerald-500 pt-12 pb-24 relative overflow-hidden">
        {{-- Efek Dekoratif --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 blur-[80px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-10 left-10 w-40 h-40 bg-blue-500/10 blur-[50px] rounded-full pointer-events-none"></div>
        <div class="absolute inset-0 overflow-hidden flex items-center justify-end opacity-5 pointer-events-none">
            <i class="fas fa-search-location text-[20rem] text-white transform rotate-12 translate-x-20"></i>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800 border border-slate-700 text-slate-300 text-[10px] font-black uppercase tracking-widest mb-4 shadow-inner">
                <i class="fas fa-user-check text-emerald-400"></i> Portal Transparansi Publik
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3">
                Lacak <span class="text-emerald-400">Status Laporan</span>
            </h1>
            <p class="text-slate-400 text-sm max-w-xl leading-relaxed mx-auto sm:mx-0">
                Pantau perkembangan dan transparansi penanganan pengaduan Anda secara real-time. Informasi diperbarui langsung oleh tim Intelijen lapangan.
            </p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20 space-y-6">

        {{-- INFO BAR --}}
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shadow-inner">
                    <i class="fas fa-folder-open text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pengaduan</p>
                    <p class="text-lg font-black text-slate-800 leading-none mt-0.5">{{ $laporans->count() }} Laporan</p>
                </div>
            </div>
            <a href="{{ route('publik.lapor') }}" wire:navigate class="hidden sm:inline-flex px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-md shadow-emerald-600/20 items-center gap-2">
                <i class="fas fa-plus"></i> Lapor Baru
            </a>
        </div>

        {{-- DAFTAR KARTU LAPORAN --}}
        @if($laporans->isEmpty())
        {{-- Tampilan jika riwayat kosong --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 flex flex-col items-center justify-center py-20 px-4 text-center">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-5 border border-slate-200 shadow-inner">
                <i class="fas fa-box-open text-4xl text-slate-300"></i>
            </div>
            <h4 class="text-xl font-black text-slate-800 mb-2 tracking-tight">Belum Ada Riwayat Laporan</h4>
            <p class="text-sm text-slate-500 max-w-sm mb-8 leading-relaxed">Semua pengaduan yang Anda kirimkan ke SI-INTEL akan tercatat dan dapat dilacak progresnya melalui halaman ini.</p>
            <a href="{{ route('publik.lapor') }}" wire:navigate class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all shadow-lg hover:-translate-y-0.5 flex items-center gap-2">
                <i class="fas fa-shield-alt text-emerald-400"></i> Buat Pengaduan Sekarang
            </a>
        </div>
        @else

        <div class="space-y-6">
            @foreach($laporans as $laporan)
            {{-- KARTU INDIVIDU LAPORAN --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden hover:border-emerald-200 transition-colors duration-300">

                {{-- Bagian Atas Kartu (Info) --}}
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
                        <div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-500 border border-slate-200 mb-3">
                                <i class="fas fa-hashtag"></i> TIKET: <span class="font-mono text-slate-800">{{ $laporan->nomor_tiket }}</span>
                            </div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight leading-snug max-w-lg">
                                {{ $laporan->judul_laporan }}
                            </h3>
                            <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mt-1.5">
                                {{ ucwords(str_replace('_', ' ', $laporan->kategori_laporan)) }}
                            </p>
                        </div>
                        <div class="text-left sm:text-right shrink-0">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal Kirim</p>
                            <p class="text-sm font-bold text-slate-700 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                                <i class="far fa-calendar-alt text-slate-400 mr-1.5"></i> {{ $laporan->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-sm text-slate-600 font-medium bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <i class="fas fa-user-ninja text-slate-400"></i>
                        <span><strong class="text-slate-800">Terlapor:</strong> {{ $laporan->nama_terlapor }} ({{ $laporan->jabatan_terlapor }})</span>
                    </div>
                </div>

                {{-- Bagian Bawah Kartu (Status Progress Bar) --}}
                <div class="bg-slate-50/80 px-6 py-5 sm:px-8 border-t border-slate-100">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Progress Penanganan:</p>

                    @php
                    // Logika Penentuan Progress
                    $status = $laporan->status_laporan;
                    $step1 = true; // Selalu aktif karena sudah masuk
                    $step2 = in_array($status, ['diproses', 'tindak_lanjut', 'selesai']);
                    $step3 = $status === 'selesai';
                    $isRejected = $status === 'ditolak';
                    @endphp

                    @if($isRejected)
                    {{-- Tampilan Jika Ditolak --}}
                    <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                        <i class="fas fa-times-circle text-2xl"></i>
                        <div>
                            <h4 class="font-black text-sm uppercase tracking-wide">Laporan Ditolak</h4>
                            <p class="text-xs font-medium mt-0.5">Laporan Anda tidak memenuhi syarat formil/materil untuk ditindaklanjuti.</p>
                        </div>
                    </div>
                    @else
                    {{-- Visualisasi Garis Waktu (Timeline) --}}
                    <div class="relative flex items-center justify-between w-full max-w-2xl">
                        {{-- Garis Background --}}
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1.5 bg-slate-200 rounded-full z-0"></div>

                        {{-- Garis Aktif --}}
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1.5 bg-emerald-500 rounded-full z-0 transition-all duration-1000"
                            style="width: {{ $step3 ? '100%' : ($step2 ? '50%' : '0%') }}"></div>

                        {{-- Titik 1: Menunggu --}}
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shadow-sm transition-colors {{ $step1 ? 'bg-emerald-500 text-white border-2 border-emerald-200' : 'bg-white text-slate-300 border-2 border-slate-200' }}">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-wider {{ $step1 ? 'text-slate-800' : 'text-slate-400' }}">Diterima</span>
                        </div>

                        {{-- Titik 2: Diproses --}}
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shadow-sm transition-colors {{ $step2 ? 'bg-emerald-500 text-white border-2 border-emerald-200' : 'bg-white text-slate-300 border-2 border-slate-200' }}">
                                @if($step2 && !$step3)
                                <i class="fas fa-sync fa-spin"></i>
                                @else
                                <i class="fas fa-search"></i>
                                @endif
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-wider {{ $step2 ? 'text-slate-800' : 'text-slate-400' }}">Telaah Intelijen</span>
                        </div>

                        {{-- Titik 3: Selesai --}}
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shadow-sm transition-colors {{ $step3 ? 'bg-emerald-500 text-white border-2 border-emerald-200' : 'bg-white text-slate-300 border-2 border-slate-200' }}">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-wider {{ $step3 ? 'text-slate-800' : 'text-slate-400' }}">Selesai</span>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
        @endif

        {{-- Tombol Lapor Mobile --}}
        <div class="block sm:hidden mt-6">
            <a href="{{ route('publik.lapor') }}" wire:navigate class="w-full flex justify-center items-center px-5 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-sm uppercase tracking-wider rounded-2xl transition shadow-lg shadow-emerald-600/30 gap-2">
                <i class="fas fa-plus"></i> Buat Laporan Baru
            </a>
        </div>

    </div>
</div>