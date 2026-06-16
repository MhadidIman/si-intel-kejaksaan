<div class="py-10 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">

        {{-- HEADER EXECUTIVE: TEMA SLATE-CYAN --}}
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl border-b-4 border-cyan-500 group">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-cyan-500/20 blur-[100px] rounded-full pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-900/40 blur-[100px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-3 shadow-[0_0_30px_rgba(6,182,212,0.3)] shrink-0">
                        <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-full h-full object-contain" alt="Logo Kejaksaan">
                    </div>
                    <div>
                        <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight drop-shadow-md">
                            Layanan <span class="text-cyan-400">PENGADUAN</span> Masuk
                        </h2>
                        <p class="text-xs text-slate-300 font-medium mt-2 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                            Pos Pelayanan Hukum & Pengaduan Masyarakat
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="{{ route('cetak.lapdu') }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/50 border border-slate-600 text-slate-300 hover:text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 text-xs uppercase tracking-widest backdrop-blur-sm">
                        <i class="fas fa-print text-sm"></i>
                        <span>Cetak Rekap</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if (session()->has('message'))
        <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl shadow-sm flex items-center justify-between text-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('message') }}</span>
            </div>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl shadow-sm flex items-center justify-between text-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif

        {{-- BAGIAN FILTER & TABEL --}}
        <div class="bg-white p-6 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="flex flex-col sm:flex-row w-full justify-between items-center gap-4">
                <div class="relative flex-1 w-full sm:max-w-md group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-cyan-500 transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </div>
                    <input wire:model.live="search" type="text" placeholder="Cari nomor tiket, nama terlapor..." class="block w-full rounded-xl border-slate-200 bg-white text-slate-800 font-medium focus:border-cyan-500 focus:ring-cyan-500/20 py-3 shadow-sm text-sm transition-all pl-11">
                </div>

                <div class="px-5 py-2.5 bg-slate-50 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Filter:</span>
                    <select wire:model.live="filterStatus" class="text-sm font-bold bg-transparent border-none focus:ring-0 p-0 text-slate-700 cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="menunggu">Menunggu Verifikasi</option>
                        <option value="diproses">Sedang Diproses</option>
                        <option value="tindak_lanjut">Tindak Lanjut Intelijen</option>
                        <option value="selesai">Selesai Ditinjau</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Tabel Data Standard --}}
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden w-full">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase font-black tracking-widest border-b border-slate-100">
                            <th class="px-6 py-5">Nomor Tiket</th>
                            <th class="px-6 py-5">Identitas Pelapor</th>
                            <th class="px-6 py-5">Substansi Laporan</th>
                            <th class="px-6 py-5">Pihak Terlapor</th>
                            <th class="px-6 py-5 text-center">Status Laporan</th>
                            <th class="px-6 py-5 text-center">Aksi Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 text-sm font-medium">
                        @forelse($lapdus as $item)
                        <tr class="hover:bg-slate-50/70 transition duration-200">
                            <td class="px-6 py-5 font-mono font-bold text-slate-900 text-xs">{{ $item->nomor_tiket }}</td>
                            <td class="px-6 py-5">
                                @if($item->is_anonim)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-purple-50 text-purple-700 border border-purple-200">
                                    <i class="fas fa-user-secret"></i> Anonim
                                </span>
                                @else
                                <div class="font-black text-slate-800 text-sm">{{ $item->nama_pelapor }}</div>
                                <div class="text-[10px] text-slate-400 font-mono mt-0.5">NIK: {{ substr($item->nik, 0, 6) }}**********</div>
                                @endif
                            </td>
                            <td class="px-6 py-5 max-w-xs">
                                <div class="font-bold text-slate-800 truncate">{{ $item->judul_laporan }}</div>
                                <div class="text-[10px] text-emerald-600 font-bold uppercase tracking-wider mt-1">{{ str_replace('_', ' ', $item->kategori_laporan) }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="font-bold text-slate-800 text-sm">{{ $item->nama_terlapor }}</div>
                                <div class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $item->jabatan_terlapor }}</div>
                            </td>
                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                @if($item->status_laporan === 'menunggu')
                                <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-600 border border-slate-200">Menunggu</span>
                                @elseif($item->status_laporan === 'diproses')
                                <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-blue-100 text-blue-700 border border-blue-200">Diproses</span>
                                @elseif($item->status_laporan === 'tindak_lanjut')
                                <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-amber-100 text-amber-700 border border-amber-200">Tindak Lanjut</span>
                                @elseif($item->status_laporan === 'selesai')
                                <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-emerald-100 text-emerald-700 border border-emerald-200">Selesai</span>
                                @else
                                <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-red-100 text-red-700 border border-red-200">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                <button wire:click="bukaDetail({{ $item->id }})" class="px-4 py-2 bg-slate-800 hover:bg-cyan-600 text-white rounded-xl font-bold text-[11px] transition inline-flex items-center gap-2 shadow-sm uppercase tracking-wider">
                                    <i class="fas fa-eye text-[10px]"></i> Periksa Rincian
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400 font-medium italic">
                                <i class="fas fa-inbox text-3xl mb-3 opacity-30"></i>
                                <p>Tidak ada data laporan pengaduan masuk.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($lapdus->hasPages())
            <div class="p-6 border-t border-slate-100 bg-slate-50/50links">
                {{ $lapdus->links() }}
            </div>
            @endif
        </div>
    </div>

    {{-- MODAL DETAIL KASUS --}}
    @if($showDetailModal && $selectedLapdu)
    <div class="fixed inset-0 z-[150] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity" wire:click="tutupDetail"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-slate-200">

                <div class="px-8 py-5 bg-slate-900 text-white flex justify-between items-center border-b-4 border-cyan-500">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-shield-halved text-cyan-400 text-lg"></i>
                        <div>
                            <h3 class="font-black text-sm tracking-tight" id="modal-title">Telaah Berkas Pengaduan: {{ $selectedLapdu->nomor_tiket }}</h3>
                            <p class="text-[10px] text-slate-400 mt-0.5 uppercase tracking-widest font-bold">Klasifikasi: Classified Intelijen Kejaksaan</p>
                        </div>
                    </div>
                    <button wire:click="tutupDetail" class="w-8 h-8 flex items-center justify-center bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white rounded-full transition">
                        <i class="fas fa-times text-base"></i>
                    </button>
                </div>

                <div class="p-8 space-y-8 max-h-[70vh] overflow-y-auto custom-scrollbar bg-slate-50/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- BLOK 1: IDENTITAS PELAPOR --}}
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                            <h4 class="text-[11px] font-black uppercase tracking-wider text-slate-400 border-b pb-3 flex items-center gap-2">
                                <i class="fas fa-user-shield text-slate-500"></i> Bagian I: Identitas Pelapor
                            </h4>
                            @if($selectedLapdu->is_anonim)
                            <div class="p-3.5 bg-purple-50 border border-purple-200 rounded-xl text-purple-800 text-xs font-bold mb-2">
                                <i class="fas fa-user-secret mr-1.5"></i> Pelapor Memilih Anonim. Jaga kerahasiaan identitas sesuai ketentuan.
                            </div>
                            @endif
                            <div class="grid grid-cols-3 gap-y-3 text-xs">
                                <div class="text-slate-400 font-bold">Nama</div>
                                <div class="col-span-2 text-slate-800 font-black">: {{ $selectedLapdu->nama_pelapor }}</div>
                                <div class="text-slate-400 font-bold">NIK</div>
                                <div class="col-span-2 text-slate-800 font-mono font-bold">: {{ $selectedLapdu->nik }}</div>
                                <div class="text-slate-400 font-bold">Kontak</div>
                                <div class="col-span-2 text-slate-800 font-bold">: {{ $selectedLapdu->no_hp_pelapor }}</div>
                                <div class="text-slate-400 font-bold">Alamat</div>
                                <div class="col-span-2 text-slate-800 font-bold leading-relaxed">: {{ $selectedLapdu->alamat_pelapor }}</div>
                            </div>
                        </div>

                        {{-- BLOK 2: IDENTITAS TERLAPOR --}}
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                            <h4 class="text-[11px] font-black uppercase tracking-wider text-slate-400 border-b pb-3 flex items-center gap-2">
                                <i class="fas fa-user-ninja text-slate-500"></i> Bagian II: Pihak Terlapor
                            </h4>
                            <div class="grid grid-cols-3 gap-y-3 text-xs">
                                <div class="text-slate-400 font-bold">Nama Terlapor</div>
                                <div class="col-span-2 text-red-700 font-black">: {{ $selectedLapdu->nama_terlapor }}</div>
                                <div class="text-slate-400 font-bold">Jabatan</div>
                                <div class="col-span-2 text-slate-800 font-bold">: {{ $selectedLapdu->jabatan_terlapor }}</div>
                                <div class="text-slate-400 font-bold">Kontak</div>
                                <div class="col-span-2 text-slate-800 font-bold">: {{ $selectedLapdu->kontak_terlapor ?? '-' }}</div>
                                <div class="text-slate-400 font-bold">Alamat</div>
                                <div class="col-span-2 text-slate-800 font-bold leading-relaxed">: {{ $selectedLapdu->alamat_terlapor ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- BLOK 3: DETIL SUBSTANSI KASUS (5W + 1H) --}}
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-5">
                        <h4 class="text-[11px] font-black uppercase tracking-wider text-slate-400 border-b pb-3 flex items-center gap-2">
                            <i class="fas fa-gavel text-slate-500"></i> Bagian III: Materiil Pengaduan (5W+1H)
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs bg-slate-50 p-4 rounded-xl border border-slate-200">
                            <div>
                                <div class="text-slate-400 font-bold uppercase text-[9px] tracking-wider">Kategori Kasus</div>
                                <div class="text-red-700 font-black mt-0.5 uppercase tracking-wide">{{ str_replace('_', ' ', $selectedLapdu->kategori_laporan) }}</div>
                            </div>
                            <div>
                                <div class="text-slate-400 font-bold uppercase text-[9px] tracking-wider">Waktu (Tempus)</div>
                                <div class="text-slate-800 font-bold mt-0.5">{{ date('d F Y', strtotime($selectedLapdu->waktu_kejadian)) }}</div>
                            </div>
                            <div>
                                <div class="text-slate-400 font-bold uppercase text-[9px] tracking-wider">Lokasi (Locus)</div>
                                <div class="text-slate-800 font-bold mt-0.5">{{ $selectedLapdu->tempat_kejadian }}</div>
                            </div>
                        </div>
                        <div class="text-xs pt-1">
                            <div class="text-slate-400 font-bold uppercase text-[9px] tracking-wider mb-1.5">Judul Perkara</div>
                            <div class="text-slate-800 font-black text-sm bg-slate-50 px-4 py-3 rounded-xl border border-slate-100">{{ $selectedLapdu->judul_laporan }}</div>
                        </div>
                        <div class="text-xs">
                            <div class="text-slate-400 font-bold uppercase text-[9px] tracking-wider mb-1.5">Uraian Kronologi Fakta</div>
                            <div class="text-slate-700 leading-relaxed bg-slate-50 p-5 rounded-xl border border-slate-100 font-medium whitespace-pre-line text-xs">
                                {{ $selectedLapdu->uraian_pengaduan }}
                            </div>
                        </div>
                    </div>

                    {{-- BLOK 4: BUKTI DUKUNG --}}
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                        <h4 class="text-[11px] font-black uppercase tracking-wider text-slate-400 border-b pb-3 flex items-center gap-2">
                            <i class="fas fa-paperclip text-slate-500"></i> Bagian IV: Dokumen Alat Bukti
                        </h4>
                        <div class="flex items-center justify-between bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <div class="flex items-center gap-3.5 text-xs">
                                <div class="w-10 h-10 bg-cyan-100 text-cyan-600 rounded-lg flex items-center justify-center text-lg shadow-inner"><i class="fas fa-file-contract"></i></div>
                                <div>
                                    <div class="font-bold text-slate-800">Berkas Lampiran Pengaduan</div>
                                    <div class="text-[10px] text-slate-400 font-mono mt-0.5">Format Terverifikasi Dokumen/Media</div>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $selectedLapdu->bukti_dukung) }}" target="_blank" class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-sm flex items-center gap-2">
                                <i class="fas fa-download"></i> Unduh Berkas
                            </a>
                        </div>
                    </div>

                    {{-- BLOK 5: TINDAKAN SPRINTUG (BARU) --}}
                    <div class="bg-slate-900 p-6 rounded-2xl border border-slate-700 shadow-xl space-y-4 relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-cyan-500/10 blur-[50px] rounded-full pointer-events-none"></div>

                        <h4 class="text-[11px] font-black uppercase tracking-wider text-cyan-400 border-b border-slate-700 pb-3 flex items-center gap-2 relative z-10">
                            <i class="fas fa-file-signature text-cyan-500"></i> Bagian V: Penerbitan Sprintug (Operasional)
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nomor Sprintug</label>
                                <input wire:model="nomor_sprintug" type="text" class="w-full bg-slate-800 border-slate-600 text-white rounded-xl text-xs focus:ring-cyan-500 focus:border-cyan-500 placeholder-slate-500" placeholder="Contoh: PRINT-01/X.Y.Z/...">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Terbit</label>
                                <input wire:model="tanggal_sprintug" type="date" class="w-full bg-slate-800 border-slate-600 text-white rounded-xl text-xs focus:ring-cyan-500 focus:border-cyan-500 style-color-scheme-dark">
                            </div>
                        </div>
                        <div class="flex justify-end pt-2 relative z-10">
                            <button wire:click="simpanSprintug" class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-cyan-500/30 flex items-center gap-2">
                                <i class="fas fa-paper-plane"></i> Simpan Sprintug & Proses Laporan
                            </button>
                        </div>
                    </div>

                </div>

                {{-- Kontrol Aksi Tambahan & Disposisi Dokumen --}}
                <div class="px-8 py-5 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        @if(auth()->user()->isAdmin())
                        <button wire:click="eliminasiLapdu({{ $selectedLapdu->id }})" onclick="confirm('Yakin hapus arsip permanen?') || event.stopImmediatePropagation()" class="px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 rounded-xl font-bold text-[10px] uppercase tracking-wider transition">
                            <i class="fas fa-trash-alt mr-1.5"></i> Hapus Arsip
                        </button>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-2 justify-end">
                        <button wire:click="perbaruiStatus({{ $selectedLapdu->id }}, 'menunggu')" class="px-3.5 py-2.5 text-[10px] font-black uppercase tracking-wider rounded-xl border transition {{ $selectedLapdu->status_laporan === 'menunggu' ? 'bg-slate-200 border-slate-400 text-slate-800 font-semibold' : 'bg-white border-slate-200 hover:bg-slate-100 text-slate-600' }}">
                            Menunggu
                        </button>
                        <button wire:click="perbaruiStatus({{ $selectedLapdu->id }}, 'tindak_lanjut')" class="px-3.5 py-2.5 text-[10px] font-black uppercase tracking-wider rounded-xl border transition {{ $selectedLapdu->status_laporan === 'tindak_lanjut' ? 'bg-amber-100 border-amber-400 text-amber-800 font-semibold' : 'bg-white border-slate-200 hover:bg-slate-100 text-slate-600' }}">
                            Tindak Lanjut Ops
                        </button>
                        <button wire:click="perbaruiStatus({{ $selectedLapdu->id }}, 'selesai')" class="px-3.5 py-2.5 text-[10px] font-black uppercase tracking-wider rounded-xl border transition {{ $selectedLapdu->status_laporan === 'selesai' ? 'bg-emerald-100 border-emerald-400 text-emerald-800 font-semibold' : 'bg-white border-slate-200 hover:bg-slate-100 text-slate-600' }}">
                            Selesai / Arsip
                        </button>
                        <button wire:click="perbaruiStatus({{ $selectedLapdu->id }}, 'ditolak')" class="px-3.5 py-2.5 text-[10px] font-black uppercase tracking-wider rounded-xl border transition {{ $selectedLapdu->status_laporan === 'ditolak' ? 'bg-red-100 border-red-400 text-red-800 font-semibold' : 'bg-white border-slate-200 hover:bg-slate-100 text-slate-600' }}">
                            Ditolak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        .style-color-scheme-dark {
            color-scheme: dark;
        }
    </style>
</div>