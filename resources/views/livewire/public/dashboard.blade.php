<?php

use App\Models\Lapdu;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    // Deklarasikan variabel agar bisa diakses oleh view
    public $laporans;
    public $totalLaporan = 0;
    public $laporanSelesai = 0;
    public $laporanProses = 0;

    public function mount()
    {
        // 1. SATPAM: Jika yang akses BUKAN masyarakat (Petugas/Admin), tendang ke portal internal
        if (auth()->user()->role !== 'masyarakat') {
            $this->redirectRoute('dashboard', navigate: true);
            return;
        }

        // 2. Ambil data pengaduan berdasarkan nama user (masyarakat) yang login
        $data = Lapdu::where('nama_pelapor', auth()->user()->name)
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Masukkan data ke variabel publik
        $this->laporans = $data;
        $this->totalLaporan = $data->count();
        $this->laporanSelesai = $data->where('status_laporan', 'selesai')->count();
        $this->laporanProses = $data->whereIn('status_laporan', ['diproses', 'tindak_lanjut', 'menunggu'])->count();
    }
}; ?>

<div class="min-h-screen bg-slate-50 font-sans pb-20 selection:bg-emerald-500 selection:text-white">

    {{-- HEADER / WELCOME BANNER --}}
    <div class="bg-emerald-600 pt-8 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden flex items-center justify-end opacity-10 pointer-events-none">
            <i class="fas fa-balance-scale text-[15rem] text-white transform rotate-12 translate-x-20"></i>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-4 mb-2">
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-white text-xl border border-white/30 backdrop-blur-sm shadow-inner">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-emerald-100 text-sm font-bold tracking-wide">Selamat Datang di Portal Layanan,</p>
                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">{{ auth()->user()->name }}</h1>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20">

        {{-- STATISTIK KARTU (QUICK STATS) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-slate-100 flex items-center gap-5 hover:-translate-y-1 transition-transform">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Laporan Saya</p>
                    <p class="text-3xl font-black text-slate-800">{{ $totalLaporan }}</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-slate-100 flex items-center gap-5 hover:-translate-y-1 transition-transform">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fas fa-sync fa-spin-hover"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Sedang Diproses</p>
                    <p class="text-3xl font-black text-slate-800">{{ $laporanProses }}</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-slate-100 flex items-center gap-5 hover:-translate-y-1 transition-transform">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Selesai Ditindaklanjuti</p>
                    <p class="text-3xl font-black text-slate-800">{{ $laporanSelesai }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: TINDAKAN CEPAT --}}
            <div class="space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-3 mb-5">Aksi Cepat</h3>

                    <a href="{{ route('publik.lapor') }}" wire:navigate class="w-full mb-3 px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center"><i class="fas fa-plus"></i></div>
                            <span class="font-bold text-sm">Buat Pengaduan Baru</span>
                        </div>
                        <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('publik.riwayat') }}" wire:navigate class="w-full px-6 py-4 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-2xl transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-500"><i class="fas fa-history"></i></div>
                            <span class="font-bold text-sm">Lihat Semua Riwayat</span>
                        </div>
                        <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            {{-- KOLOM KANAN: RIWAYAT TERKINI --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">
                            <i class="fas fa-clock text-emerald-500 mr-2"></i> Pengaduan Terkini Anda
                        </h3>
                    </div>

                    <div class="p-0 flex-1">
                        @if($laporans->isEmpty())
                        <div class="flex flex-col items-center justify-center h-full py-16 px-4 text-center">
                            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-4 border-4 border-white shadow-sm">
                                <i class="fas fa-folder-open text-4xl text-slate-300"></i>
                            </div>
                            <h4 class="text-lg font-black text-slate-700 mb-1">Belum Ada Pengaduan</h4>
                            <p class="text-xs text-slate-500">Anda belum mengirimkan laporan apapun.</p>
                        </div>
                        @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-white text-[10px] uppercase tracking-widest text-slate-400 border-b border-slate-100">
                                        <th class="p-4 font-black">Nomor Tiket</th>
                                        <th class="p-4 font-black">Kategori</th>
                                        <th class="p-4 font-black text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @foreach($laporans->take(5) as $laporan)
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/80 transition-colors group">
                                        <td class="p-4 font-black text-slate-700">{{ $laporan->nomor_tiket }}</td>
                                        <td class="p-4 font-bold text-slate-800">{{ ucwords(str_replace('_', ' ', $laporan->kategori_laporan)) }}</td>
                                        <td class="p-4 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-600 border border-slate-200">
                                                {{ ucfirst($laporan->status_laporan) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>