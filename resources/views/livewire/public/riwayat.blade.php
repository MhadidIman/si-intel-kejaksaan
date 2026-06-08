<?php

use App\Models\Lapdu;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public $laporans;

    public function mount()
    {
        // Mengambil semua riwayat laporan khusus masyarakat yang sedang login
        $this->laporans = Lapdu::where('nama_pelapor', auth()->user()->name)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}; ?>

<div class="min-h-screen bg-slate-50 font-sans pb-20 selection:bg-emerald-500 selection:text-white">

    {{-- BANNER ATAS --}}
    <div class="bg-slate-900 border-b-4 border-emerald-500 pt-10 pb-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-3xl font-black text-white tracking-tight mb-2">
                Riwayat & <span class="text-emerald-400">Proses Pengaduan</span>
            </h1>
            <p class="text-slate-400 text-sm max-w-2xl leading-relaxed">
                Pantau status perkembangan dan transparansi penanganan laporan Anda secara real-time.
            </p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">

        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Daftar Laporan Anda</span>
                <span class="bg-emerald-100 text-emerald-700 py-1 px-3 rounded-full text-[10px] font-black uppercase tracking-wider">
                    Total: {{ $laporans->count() }} Laporan
                </span>
            </div>

            <div class="p-0">
                @if($laporans->isEmpty())
                {{-- Tampilan jika riwayat kosong --}}
                <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100 shadow-inner">
                        <i class="fas fa-history text-3xl text-slate-300"></i>
                    </div>
                    <h4 class="text-lg font-black text-slate-700 mb-1">Belum Ada Riwayat Laporan</h4>
                    <p class="text-sm text-slate-500 max-w-sm mb-6">Semua pengaduan yang Anda kirimkan ke SI-INTEL akan tercatat secara otomatis di halaman ini.</p>
                    <a href="{{ route('publik.lapor') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all shadow-md shadow-emerald-600/20">
                        Buat Pengaduan Sekarang
                    </a>
                </div>
                @else
                {{-- Tabel Riwayat Laporan --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-400 border-b border-slate-100">
                                <th class="p-4 font-black">Nomor Tiket</th>
                                <th class="p-4 font-black">Kategori Pelanggaran</th>
                                <th class="p-4 font-black">Pihak Terlapor</th>
                                <th class="p-4 font-black">Tanggal Kirim</th>
                                <th class="p-4 font-black text-center">Status Proses</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($laporans as $laporan)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors group">
                                <td class="p-4">
                                    <span class="font-black text-slate-800 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200 font-mono tracking-wider text-xs">{{ $laporan->nomor_tiket }}</span>
                                </td>
                                <td class="p-4 font-bold text-slate-700">
                                    {{ ucwords(str_replace('_', ' ', $laporan->kategori_laporan)) }}
                                </td>
                                <td class="p-4 text-slate-600 font-medium">
                                    <i class="fas fa-user-secret text-slate-400 mr-1.5"></i>{{ $laporan->nama_terlapor }}
                                </td>
                                <td class="p-4 text-slate-500 font-medium text-xs">
                                    {{ $laporan->created_at->format('d F Y, H:i') }} WIB
                                </td>
                                <td class="p-4 text-center">
                                    @if($laporan->status_laporan === 'menunggu')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-600 border border-slate-200">
                                        <i class="fas fa-hourglass-half"></i> Menunggu Verifikasi
                                    </span>
                                    @elseif(in_array($laporan->status_laporan, ['diproses', 'tindak_lanjut']))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-amber-100 text-amber-700 border border-amber-200">
                                        <i class="fas fa-sync fa-spin"></i> Sedang Diproses
                                    </span>
                                    @elseif($laporan->status_laporan === 'selesai')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        <i class="fas fa-check-circle"></i> Selesai Ditinjau
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-red-100 text-red-700 border border-red-200">
                                        <i class="fas fa-times-circle"></i> Laporan Ditolak
                                    </span>
                                    @endif
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