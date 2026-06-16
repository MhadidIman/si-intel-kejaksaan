<?php

use function Livewire\Volt\layout;

// Pastikan memanggil layout publik yang sudah berisi Navbar
layout('layouts.public');
?>

<div class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-500 selection:text-white">

    {{-- 1. HERO SECTION (Wajah Utama Dashboard Publik) --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-900 via-emerald-800 to-slate-900">
        {{-- Tekstur & Ornamen Background --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="absolute -right-20 -bottom-20 opacity-5 pointer-events-none">
            <i class="fas fa-balance-scale text-[25rem] text-emerald-100 transform -rotate-12"></i>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-64 bg-emerald-500/20 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-emerald-900/60 border border-emerald-500/40 text-emerald-300 text-[10px] font-black tracking-widest uppercase mb-6 backdrop-blur-md shadow-inner">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Portal Layanan Masyarakat Terintegrasi
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight mb-6 drop-shadow-2xl leading-tight">
                Berani Lapor, <br class="hidden sm:block"> <span class="text-amber-400">Identitas Terlindungi.</span>
            </h2>

            <p class="text-emerald-100/90 text-sm md:text-base max-w-2xl mx-auto leading-relaxed mb-10 font-medium">
                Mari bersama awasi penegakan hukum dan pembangunan daerah. Laporkan indikasi Tindak Pidana Korupsi, Pungli, Mafia Tanah, dan ancaman ketertiban umum di wilayah hukum Banjarmasin.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('publik.lapor') }}" wire:navigate class="px-8 py-4 bg-amber-500 hover:bg-amber-400 text-slate-900 rounded-2xl font-black text-sm uppercase tracking-wider transition-all shadow-lg shadow-amber-500/30 hover:-translate-y-1 flex items-center justify-center gap-2 group">
                    <i class="fas fa-shield-alt group-hover:scale-110 transition-transform"></i> Buat Laporan Sekarang
                </a>
                <a href="#panduan" class="px-8 py-4 bg-emerald-800/50 hover:bg-emerald-700/80 text-white border border-emerald-500/50 rounded-2xl font-bold text-sm uppercase tracking-wider transition-all backdrop-blur-sm flex items-center justify-center gap-2">
                    <i class="fas fa-book-reader"></i> Baca Panduan
                </a>
            </div>
        </div>
    </section>

    {{-- 2. ALUR PENGADUAN (INFOGRAFIS INTERAKTIF) --}}
    <section id="panduan" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-100">Standar Operasional</span>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight uppercase mt-4">SOP & Alur Pengaduan</h3>
                <div class="w-24 h-1.5 bg-amber-500 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative mt-12">
                {{-- Garis Penghubung (Hanya Desktop) --}}
                <div class="hidden md:block absolute top-12 left-[12%] right-[12%] h-1 bg-slate-100 z-0 rounded-full"></div>

                {{-- Step 1 --}}
                <div class="relative z-10 text-center group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-slate-100 group-hover:border-blue-500 rounded-2xl rotate-3 group-hover:rotate-0 flex items-center justify-center text-3xl text-slate-400 group-hover:text-blue-500 shadow-xl shadow-slate-200/50 transition-all duration-300 mb-6">
                        <i class="fas fa-laptop-house"></i>
                    </div>
                    <h4 class="font-black text-slate-800 text-lg mb-2">1. Laporan Masuk</h4>
                    <p class="text-xs text-slate-500 leading-relaxed px-4 font-medium">Masyarakat mengirimkan laporan beserta bukti awal melalui portal SI-INTEL.</p>
                </div>

                {{-- Step 2 --}}
                <div class="relative z-10 text-center group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-slate-100 group-hover:border-amber-500 rounded-2xl -rotate-3 group-hover:rotate-0 flex items-center justify-center text-3xl text-slate-400 group-hover:text-amber-500 shadow-xl shadow-slate-200/50 transition-all duration-300 mb-6">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h4 class="font-black text-slate-800 text-lg mb-2">2. Verifikasi Data</h4>
                    <p class="text-xs text-slate-500 leading-relaxed px-4 font-medium">Admin Intelijen menelaah kelengkapan syarat formil dan materil pengaduan.</p>
                </div>

                {{-- Step 3 --}}
                <div class="relative z-10 text-center group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-slate-100 group-hover:border-purple-500 rounded-2xl rotate-3 group-hover:rotate-0 flex items-center justify-center text-3xl text-slate-400 group-hover:text-purple-500 shadow-xl shadow-slate-200/50 transition-all duration-300 mb-6">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <h4 class="font-black text-slate-800 text-lg mb-2">3. Telaahan Intelijen</h4>
                    <p class="text-xs text-slate-500 leading-relaxed px-4 font-medium">Penerbitan Surat Perintah Tugas (Sprintug) Operasi Intelijen oleh pimpinan.</p>
                </div>

                {{-- Step 4 --}}
                <div class="relative z-10 text-center group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-slate-100 group-hover:border-emerald-500 rounded-2xl -rotate-3 group-hover:rotate-0 flex items-center justify-center text-3xl text-slate-400 group-hover:text-emerald-500 shadow-xl shadow-slate-200/50 transition-all duration-300 mb-6">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h4 class="font-black text-slate-800 text-lg mb-2">4. Tindak Lanjut</h4>
                    <p class="text-xs text-slate-500 leading-relaxed px-4 font-medium">Penyerahan hasil operasi ke bidang tindak pidana khusus/umum atau instansi terkait.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. EDUKASI (SYARAT & PERLINDUNGAN HUKUM) --}}
    <section class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

                {{-- Syarat Formil & Materil --}}
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-slate-200/60">
                    <div class="flex items-center gap-5 mb-8 border-b border-slate-100 pb-6">
                        <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl shrink-0 shadow-inner border border-amber-200"><i class="fas fa-list-check"></i></div>
                        <div>
                            <h3 class="font-black text-slate-800 text-xl tracking-tight">Kriteria Kelayakan Laporan</h3>
                            <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold mt-1">Syarat Formil & Materil</p>
                        </div>
                    </div>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <div class="mt-1 shrink-0"><i class="fas fa-check-circle text-xl text-emerald-500 drop-shadow-sm"></i></div>
                            <div>
                                <strong class="text-sm font-black text-slate-800 block mb-1">Identitas Jelas (Formil)</strong>
                                <p class="text-xs text-slate-500 leading-relaxed font-medium">Pelapor mencantumkan NIK dan kontak yang dapat dihubungi. Identitas dijamin <strong>dirahasiakan sepenuhnya</strong> dalam laporan lapangan.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <div class="mt-1 shrink-0"><i class="fas fa-check-circle text-xl text-emerald-500 drop-shadow-sm"></i></div>
                            <div>
                                <strong class="text-sm font-black text-slate-800 block mb-1">Uraian Kejadian 5W+1H (Materil)</strong>
                                <p class="text-xs text-slate-500 leading-relaxed font-medium">Menjelaskan secara terperinci Siapa yang dilaporkan, Apa yang terjadi, Kapan, Di mana, Mengapa, dan Bagaimana modus operandi-nya.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <div class="mt-1 shrink-0"><i class="fas fa-check-circle text-xl text-emerald-500 drop-shadow-sm"></i></div>
                            <div>
                                <strong class="text-sm font-black text-slate-800 block mb-1">Alat Bukti Awal (Materil)</strong>
                                <p class="text-xs text-slate-500 leading-relaxed font-medium">Wajib melampirkan dokumen pendukung, foto, video, rekaman suara, atau kuitansi otentik yang menguatkan dugaan pelanggaran.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Dasar Hukum --}}
                <div class="bg-slate-900 rounded-[2rem] p-8 md:p-10 shadow-2xl relative overflow-hidden text-white border border-slate-800 group">
                    {{-- Efek Cahaya Latar --}}
                    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-emerald-500/20 blur-[100px] rounded-full pointer-events-none group-hover:bg-emerald-500/30 transition-colors duration-700"></div>
                    <div class="absolute -left-20 -top-20 w-60 h-60 bg-blue-500/10 blur-[80px] rounded-full pointer-events-none"></div>

                    <div class="flex items-center gap-5 mb-8 border-b border-slate-700/80 pb-6 relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-900/80 text-emerald-400 border border-emerald-700/50 flex items-center justify-center text-2xl shrink-0 backdrop-blur-sm"><i class="fas fa-user-shield"></i></div>
                        <div>
                            <h3 class="font-black text-white text-xl tracking-tight">Perlindungan Hukum Pelapor</h3>
                            <p class="text-[10px] text-emerald-400/80 uppercase tracking-widest font-bold mt-1">Dasar Bertindak Kejaksaan RI</p>
                        </div>
                    </div>

                    <div class="space-y-6 relative z-10">
                        <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 p-6 rounded-2xl relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-amber-500"></div>
                            <i class="fas fa-quote-left text-2xl text-slate-700 absolute right-6 bottom-4 opacity-50"></i>
                            <p class="text-sm text-slate-300 leading-relaxed font-medium mb-4 relative z-10">
                                "Saksi dan/atau Korban tidak dapat dituntut secara hukum, baik pidana maupun perdata atas kesaksian dan/atau laporan yang akan, sedang, atau telah diberikannya."
                            </p>
                            <footer class="text-[10px] font-black text-amber-400 uppercase tracking-widest relative z-10">— UU No. 13 Tahun 2006 (Pasal 10 ayat 1)</footer>
                        </div>

                        <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 p-6 rounded-2xl relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-blue-500"></div>
                            <i class="fas fa-quote-left text-2xl text-slate-700 absolute right-6 bottom-4 opacity-50"></i>
                            <p class="text-sm text-slate-300 leading-relaxed font-medium mb-4 relative z-10">
                                "Pemerintah memberikan penghargaan kepada anggota masyarakat yang telah berjasa membantu upaya pencegahan, pemberantasan, atau pengungkapan tindak pidana korupsi."
                            </p>
                            <footer class="text-[10px] font-black text-blue-400 uppercase tracking-widest relative z-10">— PP No. 43 Tahun 2018</footer>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER --}}
    <footer class="bg-white border-t border-slate-200 py-10 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">
            <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-12 opacity-40 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500 mb-5" alt="Logo Kejaksaan">
            <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">
                &copy; {{ date('Y') }} Seksi Intelijen Kejaksaan Negeri Banjarmasin.
            </p>
            <p class="text-[10px] text-slate-400 font-medium">Sistem Informasi Intelijen Terintegrasi (SI-INTEL) | Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>
</div>