<div class="min-h-screen bg-slate-50 font-sans pb-20 selection:bg-red-500 selection:text-white">

    {{-- HEADER AUTHORITATIVE --}}
    <div class="bg-[#1a1a1a] border-b-4 border-[#e5a900] pt-12 pb-24 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden flex items-center justify-center opacity-5 pointer-events-none">
            <i class="fas fa-balance-scale text-9xl text-white transform -rotate-12 scale-150"></i>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="/" wire:navigate class="inline-flex items-center text-xs font-bold text-slate-400 hover:text-[#e5a900] transition mb-6 uppercase tracking-widest">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
            </a>

            <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 bg-red-600 text-white text-[10px] font-black uppercase tracking-widest rounded-sm shadow-sm">
                    Sistem Whistleblower
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-4">
                Formulir Pengaduan <span class="text-[#e5a900]">Masyarakat</span>
            </h1>
            <p class="text-slate-400 text-sm md:text-base max-w-2xl leading-relaxed">
                Kirimkan laporan dugaan tindak pidana, korupsi, atau pelanggaran disiplin ASN di wilayah hukum Kejaksaan Negeri Banjarmasin.
            </p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20">

        @if($nomorTiket)
        {{-- TAMPILAN SUKSES (TICKET RECEIPT) --}}
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl border border-slate-100 p-10 text-center animate-fade-in-down">
            <div class="w-20 h-20 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i class="fas fa-check-double text-4xl"></i>
            </div>
            <h2 class="text-3xl font-black text-slate-800 mb-2">Laporan Diterima!</h2>
            <p class="text-slate-500 mb-8">Laporan Anda telah dienkripsi dan masuk ke Command Center Intelijen.</p>

            <div class="bg-slate-900 border-l-4 border-[#e5a900] rounded-xl p-6 mb-8 relative overflow-hidden">
                <i class="fas fa-ticket-alt absolute -right-4 -bottom-4 text-6xl text-white/5 transform -rotate-12"></i>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Nomor Tiket Laporan Anda</p>
                <p class="text-3xl font-black text-[#e5a900] tracking-widest">{{ $nomorTiket }}</p>
            </div>

            <div class="bg-blue-50 text-blue-800 text-xs p-4 rounded-lg text-left font-medium mb-8 flex gap-3 items-start">
                <i class="fas fa-info-circle mt-0.5"></i>
                <p>Simpan nomor tiket di atas dengan baik. Anda akan membutuhkannya untuk melacak status penanganan laporan Anda di kemudian hari.</p>
            </div>

            <div class="flex gap-4 justify-center">
                <button wire:click="$set('nomorTiket', null)" class="px-6 py-3 rounded-lg font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition text-sm">
                    Buat Laporan Baru
                </button>
                <a href="{{ route('publik.lacak') }}" class="px-6 py-3 rounded-lg font-bold text-white bg-red-600 hover:bg-red-700 shadow-lg shadow-red-500/30 transition text-sm">
                    Lacak Laporan
                </a>
            </div>
        </div>

        @else
        {{-- TAMPILAN FORM (TWO-COLUMN LAYOUT) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- KOLOM KIRI: INFO & PANDUAN --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-3 mb-4 flex items-center">
                        <i class="fas fa-shield-alt text-red-600 mr-2 text-lg"></i> Jaminan Keamanan
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium mb-4">
                        Sistem ini dilindungi dengan enkripsi berlapis. <strong>Identitas Anda sebagai pelapor akan dirahasiakan</strong> dan hanya dapat diakses oleh petugas intelijen berwenang.
                    </p>
                    <ul class="space-y-3 text-xs font-bold text-slate-500">
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Data Pribadi Terlindungi</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Laporan Terkoneksi Command Center</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Pantauan Status Real-time</li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl shadow-xl border border-slate-700 p-6 text-white">
                    <h3 class="text-sm font-black text-[#e5a900] uppercase tracking-widest mb-2 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i> Hotline Darurat
                    </h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">
                        Untuk kondisi darurat yang membutuhkan penanganan segera, silakan hubungi tim piket kami:
                    </p>
                    <div class="bg-white/10 rounded-lg p-3 text-center border border-white/20">
                        <p class="text-lg font-black tracking-widest text-white">0812-3456-7890</p>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FORMULIR INPUT --}}
            <div class="lg:col-span-8">
                <form wire:submit="kirimLaporan" class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

                    <div class="p-6 sm:p-8 space-y-8">

                        {{-- BAGIAN 1: IDENTITAS --}}
                        <div>
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2 mb-4">
                                <i class="fas fa-user-circle mr-1"></i> 1. Identitas Pelapor
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Nama Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-user text-slate-400"></i></div>
                                        <input wire:model="nama_pelapor" type="text" placeholder="Nama sesuai KTP" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-red-500 focus:ring-red-500 text-sm font-medium transition">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">NIK KTP <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-id-card text-slate-400"></i></div>
                                        <input wire:model="nik" type="number" placeholder="16 Digit NIK" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-red-500 focus:ring-red-500 text-sm font-medium transition">
                                    </div>
                                    @error('nik') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fab fa-whatsapp text-slate-400"></i></div>
                                        <input wire:model="no_hp_pelapor" type="text" placeholder="Contoh: 08123456789" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-red-500 focus:ring-red-500 text-sm font-medium transition">
                                    </div>
                                    @error('no_hp_pelapor') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- BAGIAN 2: DETAIL LAPORAN --}}
                        <div>
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2 mb-4 mt-6">
                                <i class="fas fa-file-alt mr-1"></i> 2. Detail Pengaduan
                            </h4>
                            <div class="space-y-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Nama Pihak Terlapor <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-user-secret text-slate-400"></i></div>
                                            <input wire:model="nama_terlapor" type="text" placeholder="Nama oknum / instansi" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-red-500 focus:ring-red-500 text-sm font-medium transition">
                                        </div>
                                        @error('nama_terlapor') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Kategori Laporan <span class="text-red-500">*</span></label>
                                        <select wire:model="kategori_laporan" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-red-500 focus:ring-red-500 text-sm font-medium transition cursor-pointer">
                                            <option value="">-- Pilih Kategori Pelanggaran --</option>
                                            <option value="tindak_pidana">Tindak Pidana Umum</option>
                                            <option value="korupsi">Tindak Pidana Korupsi</option>
                                            <option value="pelanggaran_asn">Pelanggaran Disiplin ASN / Mafia Tanah</option>
                                        </select>
                                        @error('kategori_laporan') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Uraian Kejadian Secara Rinci <span class="text-red-500">*</span></label>
                                    <textarea wire:model="uraian_pengaduan" rows="5" placeholder="Ceritakan kronologi kejadian (Kapan, Di mana, Siapa yang terlibat, dan Bagaimana kejadiannya)..." class="w-full px-4 py-3 rounded-xl bg-slate-50 border-slate-200 focus:border-red-500 focus:ring-red-500 text-sm font-medium transition"></textarea>
                                    @error('uraian_pengaduan') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-[11px] font-black text-slate-600 uppercase mb-2">Upload Bukti Dukung (Foto/Dokumen PDF) <span class="text-red-500">*</span></label>
                                    <input wire:model="bukti_dukung" type="file" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition cursor-pointer border border-slate-200 rounded-xl bg-slate-50 p-1">
                                    <p class="text-[10px] text-slate-400 mt-2 font-medium"><i class="fas fa-info-circle"></i> Maksimal ukuran file 2MB. Format: JPG, PNG, atau PDF.</p>
                                    @error('bukti_dukung') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER / TOMBOL SUBMIT --}}
                    <div class="bg-slate-50 p-6 sm:px-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p class="text-xs text-slate-500 font-medium w-full sm:w-2/3 leading-relaxed">
                            Dengan menekan tombol kirim, Anda menyatakan bahwa informasi ini adalah benar dan dapat dipertanggungjawabkan.
                        </p>

                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-lg shadow-red-500/30 transition-all flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
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