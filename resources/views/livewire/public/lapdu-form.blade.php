<div class="bg-slate-50 font-sans pb-20 selection:bg-emerald-500 selection:text-white">

    {{-- KITA HAPUS NAVBAR MANUAL DI SINI KARENA SUDAH MENGGUNAKAN NAVBAR GLOBAL DARI LAYOUT --}}

    {{-- HEADER AUTHORITATIVE (CLEAN EMERALD THEME) --}}
    <div class="bg-slate-900 border-b-4 border-emerald-500 pt-10 pb-24 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden flex items-center justify-center opacity-5 pointer-events-none">
            <i class="fas fa-balance-scale text-9xl text-white transform -rotate-12 scale-150"></i>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center md:text-left">
            <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                <span class="px-3 py-1 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-sm shadow-sm">
                    Sistem Whistleblower
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-4">
                Formulir Pengaduan <span class="text-emerald-400">Masyarakat</span>
            </h1>
            <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto md:mx-0 leading-relaxed">
                Kirimkan laporan dugaan tindak pidana, korupsi, atau pelanggaran disiplin ASN secara aman. Identitas Anda dijamin kerahasiaannya oleh sistem.
            </p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20">

        @if($nomorTiket)
        {{-- TAMPILAN SUKSES (TICKET RECEIPT) --}}
        <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-2xl border border-slate-100 p-10 text-center animate-fade-in-down">
            <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i class="fas fa-check-double text-4xl"></i>
            </div>
            <h2 class="text-3xl font-black text-slate-800 mb-2">Laporan Berhasil Terkirim!</h2>
            <p class="text-slate-500 mb-8 font-medium">Data laporan Anda telah dienkripsi dan masuk ke Command Center Intelijen.</p>

            <div class="bg-slate-900 border-l-4 border-emerald-500 rounded-2xl p-6 mb-8 relative overflow-hidden shadow-xl">
                <i class="fas fa-ticket-alt absolute -right-4 -bottom-4 text-6xl text-white/5 transform -rotate-12"></i>
                <p class="text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-1">Nomor Tiket Laporan Anda</p>
                <p class="text-4xl font-black text-white tracking-widest">{{ $nomorTiket }}</p>
            </div>

            <div class="bg-blue-50 text-blue-800 text-xs p-4 rounded-xl text-left font-medium mb-8 flex gap-3 items-start border border-blue-100">
                <i class="fas fa-info-circle mt-0.5 text-blue-600 text-base"></i>
                <p>Pengaduan ini telah otomatis terhubung dengan akun Anda. Anda dapat memantau status penanganannya kapan saja melalui menu <strong>Riwayat & Proses</strong>.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button wire:click="$set('nomorTiket', null)" class="px-6 py-3.5 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition text-sm">
                    Buat Laporan Baru
                </button>
                <a href="{{ route('publik.riwayat') }}" class="px-6 py-3.5 rounded-xl font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-500/30 transition text-sm">
                    Lihat Riwayat Laporan
                </a>
            </div>
        </div>

        @else
        {{-- TAMPILAN FORM (TWO-COLUMN LAYOUT) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- KOLOM KIRI: INFO & PANDUAN --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-3 mb-4 flex items-center">
                        <i class="fas fa-shield-alt text-emerald-500 mr-2 text-lg"></i> Jaminan Keamanan
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium mb-5">
                        Sistem ini dilindungi dengan enkripsi berlapis. <strong>Identitas Anda sebagai pelapor otomatis dirahasiakan</strong> dan hanya dapat diakses oleh petugas intelijen berwenang.
                    </p>
                    <ul class="space-y-4 text-xs font-bold text-slate-500">
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600"><i class="fas fa-check"></i></div> Data Pribadi Terlindungi
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600"><i class="fas fa-check"></i></div> Terkoneksi Command Center
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600"><i class="fas fa-check"></i></div> Pantauan Status Real-time
                        </li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-emerald-900 to-slate-900 rounded-3xl shadow-xl border border-emerald-800 p-6 sm:p-8 text-white relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-10">
                        <i class="fas fa-phone-volume text-8xl"></i>
                    </div>
                    <h3 class="text-sm font-black text-emerald-400 uppercase tracking-widest mb-3 flex items-center relative z-10">
                        <i class="fas fa-headset mr-2 text-lg"></i> Hotline Darurat
                    </h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-5 relative z-10">
                        Untuk kondisi darurat yang membutuhkan penanganan/tindakan hukum dengan segera, silakan hubungi tim piket kami:
                    </p>
                    <div class="bg-white/10 rounded-xl p-4 text-center border border-white/20 backdrop-blur-sm relative z-10">
                        <p class="text-xl font-black tracking-widest text-white">0812-3456-7890</p>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FORMULIR INPUT --}}
            <div class="lg:col-span-8">
                <form wire:submit="kirimLaporan" class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

                    <div class="p-6 sm:p-8 md:p-10 space-y-8">

                        {{-- BAGIAN 1: IDENTITAS (Auto-filled & Input NIK/HP) --}}
                        <div>
                            <h4 class="text-xs font-black text-emerald-600 uppercase tracking-widest border-b border-slate-100 pb-3 mb-5">
                                <i class="fas fa-id-badge mr-1"></i> 1. Identitas Pelapor (Otomatis & Rahasia)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Nama Pelapor (Sesuai Akun)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-user-check text-emerald-500"></i></div>
                                        <input type="text" value="{{ auth()->user()->name }}" disabled class="w-full pl-10 pr-4 py-3 rounded-xl bg-emerald-50 border-emerald-100 text-emerald-700 text-sm font-bold cursor-not-allowed">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Email Pelapor</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-envelope-circle-check text-emerald-500"></i></div>
                                        <input type="email" value="{{ auth()->user()->email }}" disabled class="w-full pl-10 pr-4 py-3 rounded-xl bg-emerald-50 border-emerald-100 text-emerald-700 text-sm font-bold cursor-not-allowed">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">NIK KTP <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-id-card text-slate-400"></i></div>
                                        <input wire:model="nik" type="number" placeholder="16 Digit NIK" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm font-medium transition">
                                    </div>
                                    @error('nik') <span class="text-xs text-red-500 font-bold mt-1 block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fab fa-whatsapp text-slate-400"></i></div>
                                        <input wire:model="no_hp_pelapor" type="text" placeholder="Contoh: 08123456789" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm font-medium transition">
                                    </div>
                                    @error('no_hp_pelapor') <span class="text-xs text-red-500 font-bold mt-1 block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- BAGIAN 2: DETAIL LAPORAN --}}
                        <div>
                            <h4 class="text-xs font-black text-emerald-600 uppercase tracking-widest border-b border-slate-100 pb-3 mb-5 mt-8">
                                <i class="fas fa-file-alt mr-1"></i> 2. Detail Pengaduan
                            </h4>
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Nama Pihak Terlapor <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-user-secret text-slate-400"></i></div>
                                            <input wire:model="nama_terlapor" type="text" placeholder="Nama oknum / instansi" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm font-medium transition">
                                        </div>
                                        @error('nama_terlapor') <span class="text-xs text-red-500 font-bold mt-1 block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Kategori Laporan <span class="text-red-500">*</span></label>
                                        <select wire:model="kategori_laporan" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm font-medium transition cursor-pointer">
                                            <option value="">-- Pilih Kategori Pelanggaran --</option>
                                            <option value="tindak_pidana">Tindak Pidana Umum</option>
                                            <option value="korupsi">Tindak Pidana Korupsi</option>
                                            <option value="pelanggaran_asn">Pelanggaran Disiplin ASN / Mafia Tanah</option>
                                        </select>
                                        @error('kategori_laporan') <span class="text-xs text-red-500 font-bold mt-1 block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Uraian Kejadian Secara Rinci <span class="text-red-500">*</span></label>
                                    <textarea wire:model="uraian_pengaduan" rows="6" placeholder="Ceritakan kronologi kejadian (Kapan, Di mana, Siapa yang terlibat, dan Bagaimana kejadiannya)..." class="w-full px-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm font-medium transition"></textarea>
                                    @error('uraian_pengaduan') <span class="text-xs text-red-500 font-bold mt-1 block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                                </div>

                                <div class="bg-slate-50 p-5 border border-slate-200 rounded-2xl">
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-3">Upload Bukti Dukung (Foto/Dokumen PDF) <span class="text-red-500">*</span></label>
                                    <input wire:model="bukti_dukung" type="file" class="w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 transition cursor-pointer border border-dashed border-slate-300 rounded-xl bg-white p-2">
                                    <p class="text-[10px] text-slate-500 mt-3 font-medium"><i class="fas fa-info-circle text-emerald-500 mr-1"></i> Maksimal ukuran file 2MB. Format yang diizinkan: JPG, PNG, atau PDF.</p>
                                    @error('bukti_dukung') <span class="text-xs text-red-500 font-bold mt-2 block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER / TOMBOL SUBMIT --}}
                    <div class="bg-slate-50 p-6 sm:px-10 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-5">
                        <p class="text-xs text-slate-500 font-medium w-full sm:w-2/3 leading-relaxed">
                            <i class="fas fa-shield-check text-emerald-500 mr-1"></i> Dengan menekan tombol kirim, Anda menyatakan bahwa informasi ini adalah benar dan dapat dipertanggungjawabkan.
                        </p>

                        <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-emerald-600/30 transition-all flex items-center justify-center gap-2 transform hover:-translate-y-1">
                            <span wire:loading.remove wire:target="kirimLaporan">Kirim Laporan</span>
                            <span wire:loading wire:target="kirimLaporan">
                                <i class="fas fa-circle-notch fa-spin mr-2"></i> Mengirim...
                            </span>
                            <i wire:loading.remove wire:target="kirimLaporan" class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>