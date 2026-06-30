<div class="min-h-screen bg-slate-50 font-sans pb-24 selection:bg-emerald-500 selection:text-white">

    {{-- BANNER ATAS --}}
    <div class="bg-emerald-700 pt-10 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden flex items-center justify-end opacity-10 pointer-events-none">
            <i class="fas fa-shield-alt text-[20rem] text-white transform rotate-12 translate-x-20"></i>
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-800/50 text-emerald-100 text-[10px] font-black uppercase tracking-widest mb-4 backdrop-blur-sm border border-emerald-500/30">
                <i class="fas fa-lock"></i> Secured & Classified
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                Formulir Pengaduan Masyarakat
            </h1>
            <p class="text-emerald-100 text-sm max-w-2xl leading-relaxed mx-auto sm:mx-0">
                Lengkapi formulir di bawah ini dengan data yang valid dan dapat dipertanggungjawabkan. Kami menjamin kerahasiaan identitas Anda sesuai undang-undang perlindungan saksi/pelapor.
            </p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">

        @if($nomorTiket)
        {{-- TAMPILAN SUKSES (SETELAH SUBMIT) --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-emerald-900/5 border border-emerald-100 p-8 sm:p-12 text-center transform transition-all">
            <div class="w-24 h-24 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-4xl mx-auto mb-6 shadow-inner">
                <i class="fas fa-check-double"></i>
            </div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight mb-2">Laporan Berhasil Terkirim!</h2>
            <p class="text-slate-500 mb-8 max-w-lg mx-auto">Pengaduan Anda telah masuk ke dalam sistem Intelijen Kejaksaan dan sedang mengantre untuk diverifikasi oleh petugas.</p>

            <div class="bg-slate-50 border border-slate-200 p-6 rounded-2xl max-w-md mx-auto mb-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-emerald-500"></div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nomor Tiket Anda</p>
                <p class="text-2xl font-mono font-black text-emerald-700 tracking-widest">{{ $nomorTiket }}</p>
            </div>

            <a href="{{ route('publik.riwayat') }}" wire:navigate class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-black text-sm uppercase tracking-wider transition shadow-lg hover:-translate-y-0.5">
                <i class="fas fa-search-location text-emerald-400"></i> Lacak Status Laporan
            </a>
        </div>
        @else
        {{-- FORMULIR PENGADUAN --}}
        <form wire:submit="kirimLaporan" class="space-y-6">

            {{-- CARD 1: IDENTITAS PELAPOR --}}
            <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shadow-inner"><i class="fas fa-user-shield text-sm"></i></div>
                    <div>
                        <h3 class="font-black text-slate-800">Bagian I: Identitas Pelapor</h3>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Data Diri & Proteksi Keamanan</p>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-6">
                    {{-- Fitur Anonimitas --}}
                    <div class="bg-purple-50 border border-purple-200 p-4 rounded-2xl">
                        <label class="flex items-start cursor-pointer group">
                            <div class="flex items-center h-5">
                                <input wire:model.live="is_anonim" type="checkbox" class="w-5 h-5 text-purple-600 bg-white border-purple-300 rounded focus:ring-purple-500 focus:ring-2 transition cursor-pointer">
                            </div>
                            <div class="ml-3 text-sm">
                                <span class="font-black text-purple-900 block mb-0.5 group-hover:text-purple-700 transition">Sembunyikan Identitas Saya (Lapor Sebagai Anonim)</span>
                                <span class="text-purple-700 text-xs font-medium">Sistem tidak akan menampilkan nama dan KTP Anda pada lembar laporan petugas operasional lapangan.</span>
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">NIK / No. KTP <span class="text-red-500">*</span></label>
                            <input wire:model="nik" type="text" maxlength="16"
                                {{ Auth::user()->nik ? 'readonly' : '' }}
                                class="w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm font-mono transition {{ Auth::user()->nik ? 'bg-slate-200 text-slate-500 cursor-not-allowed' : 'bg-slate-50' }}"
                                placeholder="16 Digit NIK Anda">
                            @error('nik') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Alamat Email <span class="text-red-500">*</span></label>
                            <input wire:model="email_pelapor" type="email"
                                {{ Auth::user()->email ? 'readonly' : '' }}
                                class="w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm font-mono transition {{ Auth::user()->email ? 'bg-slate-200 text-slate-500 cursor-not-allowed' : 'bg-slate-50' }}"
                                placeholder="email@contoh.com">
                            @error('email_pelapor') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Nomor HP/WhatsApp Aktif <span class="text-red-500">*</span></label>
                            {{-- Ubah type="text" menjadi type="number" di bawah ini --}}
                            <input wire:model="no_hp_pelapor" type="number" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm font-mono transition" placeholder="08xxxxxxxxxx">
                            @error('no_hp_pelapor') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Tempat Lahir</label>
                            <input wire:model="tempat_lahir" type="text" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm transition" placeholder="Kota/Kabupaten">
                            @error('tempat_lahir') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Tanggal Lahir</label>
                            <input wire:model="tanggal_lahir" type="date" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm transition">
                            @error('tanggal_lahir') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Jenis Kelamin</label>
                            <select wire:model="jenis_kelamin" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm transition">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Pekerjaan/Profesi</label>
                            <input wire:model="pekerjaan" type="text" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm transition" placeholder="Contoh: Wiraswasta">
                            @error('pekerjaan') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- UPLOAD FOTO KTP --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Upload Foto KTP (Untuk Validasi) @if(!$is_anonim) <span class="text-red-500">*</span> @endif</label>
                            <div class="w-full relative border-2 border-dashed border-slate-300 rounded-2xl p-4 text-center hover:bg-slate-50 hover:border-emerald-500 transition-colors cursor-pointer" onclick="document.getElementById('ktp-upload').click()">
                                <input id="ktp-upload" wire:model="foto_ktp" type="file" class="hidden" accept="image/png, image/jpeg, image/jpg">

                                <div wire:loading.remove wire:target="foto_ktp">
                                    @if($foto_ktp)
                                    <img src="{{ $foto_ktp->temporaryUrl() }}" class="h-32 object-contain mx-auto rounded-lg mb-2 shadow-sm border border-slate-200">
                                    <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-widest mt-1">Foto KTP Terpilih</p>
                                    @else
                                    <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center text-xl mx-auto mb-2 shadow-inner"><i class="fas fa-id-card"></i></div>
                                    <p class="text-xs font-bold text-slate-700">Klik untuk mengunggah foto KTP</p>
                                    <p class="text-[10px] text-slate-400 font-bold mt-1">Format: JPG, JPEG, PNG (Maks 5MB)</p>
                                    @endif
                                </div>

                                <div wire:loading wire:target="foto_ktp" class="w-full py-4">
                                    <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center text-xl mx-auto mb-2 shadow-inner"><i class="fas fa-spinner fa-spin"></i></div>
                                    <p class="text-xs font-bold text-slate-700">Memproses gambar KTP...</p>
                                </div>
                            </div>
                            @error('foto_ktp') <span class="text-[10px] text-red-500 font-bold mt-1 block text-center">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Alamat Domisili <span class="text-red-500">*</span></label>
                            <textarea wire:model="alamat_pelapor" rows="2" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl text-sm transition" placeholder="Tulis alamat lengkap Anda saat ini..."></textarea>
                            @error('alamat_pelapor') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 2: IDENTITAS TERLAPOR --}}
            <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center shadow-inner"><i class="fas fa-user-ninja text-sm"></i></div>
                    <div>
                        <h3 class="font-black text-slate-800">Bagian II: Pihak Terlapor</h3>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Orang / Pejabat / Pihak yang Diduga Melanggar</p>
                    </div>
                </div>

                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap Terlapor <span class="text-red-500">*</span></label>
                        <input wire:model="nama_terlapor" type="text" class="w-full bg-slate-50 border-slate-200 focus:border-red-400 focus:ring-red-400 rounded-xl text-sm transition" placeholder="Nama asli atau inisial yang jelas">
                        @error('nama_terlapor') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Jabatan / Instansi <span class="text-red-500">*</span></label>
                        <input wire:model="jabatan_terlapor" type="text" class="w-full bg-slate-50 border-slate-200 focus:border-red-400 focus:ring-red-400 rounded-xl text-sm transition" placeholder="Contoh: Kepala Desa X / Pegawai Dinas Y">
                        @error('jabatan_terlapor') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Nomor Kontak Terlapor <span class="text-slate-400">(Opsional)</span></label>
                        <input wire:model="kontak_terlapor" type="text" class="w-full bg-slate-50 border-slate-200 focus:border-red-400 focus:ring-red-400 rounded-xl text-sm font-mono transition" placeholder="Jika diketahui">
                        @error('kontak_terlapor') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Alamat / Lokasi Kantor Terlapor <span class="text-slate-400">(Opsional)</span></label>
                        <textarea wire:model="alamat_terlapor" rows="2" class="w-full bg-slate-50 border-slate-200 focus:border-red-400 focus:ring-red-400 rounded-xl text-sm transition" placeholder="Tempat terlapor bekerja atau berdomisili..."></textarea>
                        @error('alamat_terlapor') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- CARD 3: SUBSTANSI KASUS (5W+1H) --}}
            <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shadow-inner"><i class="fas fa-gavel text-sm"></i></div>
                    <div>
                        <h3 class="font-black text-slate-800">Bagian III: Uraian Pengaduan (5W+1H)</h3>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Kronologi, Tempat, dan Waktu Peristiwa</p>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Kategori Dugaan Pelanggaran <span class="text-red-500">*</span></label>
                            <select wire:model="kategori_laporan" class="w-full bg-slate-50 border-slate-200 focus:border-amber-500 focus:ring-amber-500 rounded-xl text-sm transition">
                                <option value="">-- Pilih Klasifikasi Kasus --</option>
                                <option value="tipikor">Tindak Pidana Korupsi (Tipikor)</option>
                                <option value="pungli_gratifikasi">Penyalahgunaan Wewenang / Pungli / Gratifikasi</option>
                                <option value="mafia_tanah">Mafia Tanah / Mafia Pelabuhan</option>
                                <option value="aliran_sesat">Aliran Kepercayaan Menyimpang / Pakem</option>
                                <option value="ancaman_ideologi">Ancaman Ketertiban Umum / Ideologi</option>
                                <option value="pelanggaran_hukum_lain">Pelanggaran Hukum Lainnya</option>
                            </select>
                            @error('kategori_laporan') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Judul Laporan / Perkara <span class="text-red-500">*</span></label>
                            <input wire:model="judul_laporan" type="text" class="w-full bg-slate-50 border-slate-200 focus:border-amber-500 focus:ring-amber-500 rounded-xl text-sm transition" placeholder="Cth: Dugaan Korupsi Proyek Jembatan Desa X">
                            @error('judul_laporan') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Waktu Kejadian (Tempus) <span class="text-red-500">*</span></label>
                            <input wire:model="waktu_kejadian" type="date" class="w-full bg-slate-50 border-slate-200 focus:border-amber-500 focus:ring-amber-500 rounded-xl text-sm transition">
                            @error('waktu_kejadian') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Lokasi Kejadian (Locus) <span class="text-red-500">*</span></label>
                            <input wire:model="tempat_kejadian" type="text" class="w-full bg-slate-50 border-slate-200 focus:border-amber-500 focus:ring-amber-500 rounded-xl text-sm transition" placeholder="Cth: Kantor Kecamatan X / Proyek Jalan Y">
                            @error('tempat_kejadian') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">Uraian Kronologi Lengkap <span class="text-red-500">*</span></label>
                            <textarea wire:model="uraian_pengaduan" rows="5" class="w-full bg-slate-50 border-slate-200 focus:border-amber-500 focus:ring-amber-500 rounded-xl text-sm transition" placeholder="Ceritakan kronologi kejadian secara rinci: Bagaimana hal tersebut terjadi? Siapa saja yang terlibat? Mengapa hal tersebut Anda curigai melanggar hukum?"></textarea>
                            @error('uraian_pengaduan') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 4: BUKTI & DISCLAIMER --}}
            <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shadow-inner"><i class="fas fa-file-invoice text-sm"></i></div>
                    <div>
                        <h3 class="font-black text-slate-800">Bagian IV: Bukti Dukung & Deklarasi</h3>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Lampirkan Bukti Awal & Pernyataan Hukum</p>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-8">
                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-3">Upload Bukti Dokumen/Media Tambahan <span class="text-red-500">*</span></label>

                        <div class="w-full relative border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:bg-slate-50 hover:border-emerald-500 transition-colors cursor-pointer" onclick="document.getElementById('file-upload').click()">
                            <input id="file-upload" wire:model="bukti_dukung" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png,.mp4,.mp3">

                            <div wire:loading.remove wire:target="bukti_dukung">
                                @if($bukti_dukung)
                                <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-3 shadow-inner"><i class="fas fa-file-check"></i></div>
                                <p class="text-sm font-bold text-slate-800 truncate px-4">{{ $bukti_dukung->getClientOriginalName() }}</p>
                                <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-widest mt-1">Berkas Berhasil Dipilih</p>
                                @else
                                <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-3 shadow-inner"><i class="fas fa-cloud-upload-alt"></i></div>
                                <p class="text-sm font-bold text-slate-700">Klik di sini untuk mengunggah file bukti tambahan</p>
                                <p class="text-[10px] text-slate-400 font-bold mt-1">Format: PDF, JPG, PNG, MP4, MP3 (Maksimal 10MB)</p>
                                @endif
                            </div>

                            <div wire:loading wire:target="bukti_dukung" class="w-full">
                                <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-3 shadow-inner"><i class="fas fa-spinner fa-spin"></i></div>
                                <p class="text-sm font-bold text-slate-700">Sedang memproses berkas...</p>
                            </div>
                        </div>
                        @error('bukti_dukung') <span class="text-[10px] text-red-500 font-bold mt-2 block text-center">{{ $message }}</span> @enderror
                    </div>

                    <div class="bg-slate-50 border border-slate-200 p-5 rounded-2xl">
                        <label class="flex items-start cursor-pointer group">
                            <div class="flex items-center h-5">
                                <input wire:model="disclaimer" type="checkbox" class="w-5 h-5 text-emerald-600 bg-white border-slate-300 rounded focus:ring-emerald-500 focus:ring-2 transition cursor-pointer">
                            </div>
                            <div class="ml-3 text-xs">
                                <span class="font-black text-slate-800 block mb-1 uppercase tracking-wider group-hover:text-emerald-700 transition">Pernyataan Tanggung Jawab Hukum <span class="text-red-500">*</span></span>
                                <span class="text-slate-600 font-medium leading-relaxed">
                                    Dengan mencentang kotak ini, saya menyatakan bahwa seluruh informasi dan bukti yang saya lampirkan adalah <strong>BENAR</strong>. Apabila di kemudian hari terbukti laporan ini adalah fiktif/fitnah, saya bersedia mempertanggungjawabkannya sesuai dengan ketentuan hukum yang berlaku.
                                </span>
                            </div>
                        </label>
                        @error('disclaimer') <span class="text-[10px] text-red-500 font-bold mt-2 block ml-8">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- TOMBOL KIRIM --}}
            <div class="flex justify-end pt-4">
                <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-black text-sm uppercase tracking-wider transition-all shadow-xl shadow-emerald-600/30 hover:-translate-y-1 flex items-center justify-center gap-3">
                    <span wire:loading.remove wire:target="kirimLaporan"><i class="fas fa-paper-plane text-lg"></i> Kirim Laporan Resmi</span>
                    <span wire:loading wire:target="kirimLaporan"><i class="fas fa-circle-notch fa-spin text-lg"></i> Mengenkripsi Data...</span>
                </button>
            </div>
        </form>
        @endif
    </div>

    {{-- ========================================== --}}
    {{-- PUSAT BANTUAN & FAQ (HELPDESK) --}}
    {{-- ========================================== --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-12 animate-fade-in-up relative z-20">
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header Helpdesk --}}
            <div class="bg-slate-900 px-8 py-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-b-4 border-blue-500 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-500/20 blur-3xl rounded-full"></div>
                <div class="relative z-10">
                    <h2 class="text-2xl md:text-3xl font-black text-white tracking-wide flex items-center gap-3">
                        <i class="fas fa-headset text-blue-400"></i> Pusat Bantuan & Informasi
                    </h2>
                    <p class="text-slate-400 text-sm md:text-base mt-2">Layanan bantuan, FAQ, dan kontak resmi Kejaksaan untuk pelaporan langsung.</p>
                </div>
            </div>

            <div class="p-8 md:p-10 grid grid-cols-1 lg:grid-cols-2 gap-12 bg-slate-50/50">

                {{-- KIRI: FAQ (Frequently Asked Questions) --}}
                <div class="space-y-6">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest border-b-2 border-emerald-500 pb-2 inline-block">
                        <i class="fas fa-question-circle text-emerald-500 mr-2"></i> F.A.Q
                    </h3>

                    <div class="space-y-4">
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-300 hover:shadow-md transition duration-300">
                            <h4 class="font-bold text-slate-800 text-sm flex items-start gap-2">
                                <i class="fas fa-user-shield text-emerald-500 mt-0.5"></i>
                                Apakah identitas saya aman?
                            </h4>
                            <p class="text-sm text-slate-500 mt-2 leading-relaxed ml-6">
                                Tentu. Kami menjamin kerahasiaan identitas pelapor (Whistleblower) sepenuhnya. Data Anda dienkripsi dan hanya dapat diakses oleh petugas intelijen berwenang.
                            </p>
                        </div>

                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-300 hover:shadow-md transition duration-300">
                            <h4 class="font-bold text-slate-800 text-sm flex items-start gap-2">
                                <i class="fas fa-clock text-emerald-500 mt-0.5"></i>
                                Berapa lama laporan diproses?
                            </h4>
                            <p class="text-sm text-slate-500 mt-2 leading-relaxed ml-6">
                                Laporan yang masuk akan ditelaah maksimal 2x24 jam hari kerja. Anda dapat memantau perkembangannya melalui menu "Cek Laporan" menggunakan Kode Tiket Anda.
                            </p>
                        </div>

                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-300 hover:shadow-md transition duration-300">
                            <h4 class="font-bold text-slate-800 text-sm flex items-start gap-2">
                                <i class="fas fa-file-alt text-emerald-500 mt-0.5"></i>
                                Bukti apa yang harus dilampirkan?
                            </h4>
                            <p class="text-sm text-slate-500 mt-2 leading-relaxed ml-6">
                                Anda dapat melampirkan foto, dokumen (PDF), rekaman, atau bukti lain yang relevan dengan pelanggaran. Semakin lengkap bukti, semakin cepat laporan ditindaklanjuti.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- KANAN: KONTAK ALTERNATIF --}}
                <div class="space-y-6">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest border-b-2 border-blue-500 pb-2 inline-block">
                        <i class="fas fa-phone-alt text-blue-500 mr-2"></i> Kontak Alternatif
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Jika Anda mengalami kesulitan menggunakan formulir online, Anda juga dapat menyampaikan laporan melalui jalur komunikasi resmi kami di bawah ini:
                    </p>

                    <div class="space-y-4 mt-2">
                        <div class="flex items-start gap-4 p-5 bg-emerald-50 rounded-2xl border border-emerald-100 hover:bg-emerald-100 transition duration-300">
                            <div class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-lg shadow-emerald-500/30">
                                <i class="fab fa-whatsapp text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Hotline / WhatsApp</h4>
                                <p class="text-emerald-700 font-black text-lg tracking-wide mt-1">0812-XXXX-XXXX</p>
                                <p class="text-xs text-slate-500 font-medium mt-1">Layanan 24 Jam (Hanya Chat)</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-5 bg-blue-50 rounded-2xl border border-blue-100 hover:bg-blue-100 transition duration-300">
                            <div class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center shrink-0 shadow-lg shadow-blue-500/30">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Email Dinas Resmi</h4>
                                <p class="text-blue-700 font-bold mt-1">pengaduan@kejaksaan.go.id</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-5 bg-orange-50 rounded-2xl border border-orange-100 hover:bg-orange-100 transition duration-300">
                            <div class="w-12 h-12 rounded-full bg-orange-500 text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Alamat Kantor</h4>
                                <p class="text-sm text-slate-700 mt-2 leading-relaxed font-medium">
                                    Pelayanan Terpadu Satu Pintu (PTSP) Kejaksaan Negeri<br>
                                    Jl. Brigjen H. Hasan Basri No.3, Banjarmasin, Kalimantan Selatan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>