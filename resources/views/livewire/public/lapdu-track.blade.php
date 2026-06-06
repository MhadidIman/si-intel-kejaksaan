<div class="max-w-md w-full bg-white rounded-[2rem] shadow-xl p-8 text-center">
    <h2 class="text-2xl font-black text-slate-800 mb-6">Lacak Laporan Anda</h2>
    
    <div class="space-y-4">
        <input wire:model="nomor_tiket" type="text" placeholder="Masukkan Nomor Tiket (Contoh: LAPDU-202605-XXXXX)" 
            class="w-full px-4 py-3 rounded-xl bg-slate-50 border-slate-200 text-center font-bold tracking-widest text-emerald-600 focus:border-emerald-500 focus:ring-emerald-500 transition">
        
        <button wire:click="cariLaporan" class="w-full py-3 rounded-xl font-bold text-white bg-slate-900 hover:bg-emerald-600 transition">
            Cek Status
        </button>
    </div>

    @if($error)
        <p class="mt-4 text-sm text-red-500 font-bold">{{ $error }}</p>
    @endif

    @if($hasilLaporan)
        <div class="mt-8 p-6 bg-slate-50 rounded-2xl border border-slate-200 text-left">
            <p class="text-[10px] font-black uppercase text-slate-400">Status Laporan</p>
            <span class="inline-block px-3 py-1 mt-1 rounded-full text-xs font-black uppercase 
                {{ $hasilLaporan->status_laporan == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                {{ $hasilLaporan->status_laporan }}
            </span>
            
            <p class="text-[10px] font-black uppercase text-slate-400 mt-4">Uraian</p>
            <p class="text-sm text-slate-700 mt-1 italic">"{{ $hasilLaporan->uraian_pengaduan }}"</p>
        </div>
    @endif
    
    <div class="mt-6">
        <a href="{{ route('publik.lapor') }}" class="text-sm font-bold text-slate-500 hover:underline">Kembali ke Form Lapor</a>
    </div>
</div>