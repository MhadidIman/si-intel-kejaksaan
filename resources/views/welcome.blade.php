<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PENGADUAN PUBLIK | Kejaksaan RI</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="icon" type="image/png" href="{{ asset('img/logo-kejaksaan.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Animasi Mengambang Lembut */
        @keyframes float-light {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Animasi Lingkaran Radar */
        @keyframes ping-slow {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }

            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        .animate-float-light {
            animation: float-light 6s ease-in-out infinite;
        }

        .animate-ping-slow {
            animation: ping-slow 3s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        /* Background Pattern Titik Halus */
        .bg-dots {
            background-image: radial-gradient(rgba(16, 185, 129, 0.2) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>

<body class="antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white overflow-x-hidden text-slate-800">

    {{-- Elemen Background Dekoratif --}}
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden bg-dots">
        <div class="absolute -top-[10%] -right-[20%] md:-top-[20%] md:-right-[10%] w-[400px] md:w-[700px] h-[400px] md:h-[700px] bg-emerald-400/20 rounded-full filter blur-[80px] md:blur-[100px]"></div>
        <div class="absolute top-[50%] -left-[20%] md:top-[40%] md:-left-[10%] w-[300px] md:w-[500px] h-[300px] md:h-[500px] bg-amber-300/10 rounded-full filter blur-[80px] md:blur-[100px]"></div>
    </div>

    {{-- NAVBAR ATAS KHUSUS PUBLIK --}}
    <nav class="fixed top-0 w-full z-50 px-4 md:px-6 py-3 md:py-4 border-b border-slate-200 bg-white/80 backdrop-blur-xl shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-3">

            {{-- Logo Navbar Responsif --}}
            <div class="flex items-center gap-2 md:gap-3 group cursor-pointer flex-1 min-w-0">
                <div class="bg-white p-1.5 md:p-2 rounded-lg md:rounded-xl border border-slate-100 shadow-sm shrink-0">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-7 md:h-10 w-auto object-contain transition-transform group-hover:scale-105">
                </div>
                <div class="flex flex-col leading-none min-w-0">
                    <span class="font-black text-slate-900 tracking-widest text-sm md:text-xl truncate">SI-INTEL</span>
                    <span class="text-[6px] md:text-[9px] font-black text-emerald-600 uppercase tracking-[0.1em] md:tracking-[0.3em] mt-0.5 md:mt-1 truncate">
                        Kejaksaan RI
                    </span>
                </div>
            </div>

            {{-- Tombol Kanan --}}
            <div class="flex items-center gap-2 sm:gap-6 shrink-0">
                {{-- Lacak Laporan (Hanya di layar besar) --}}
                @if(!auth()->check() || auth()->user()->role === 'masyarakat')
                <a href="{{ route('publik.riwayat') }}" class="hidden lg:inline-flex items-center text-xs font-black text-slate-500 hover:text-emerald-600 uppercase tracking-widest transition-colors gap-2 bg-slate-100 hover:bg-emerald-50 px-5 py-2.5 rounded-full">
                    <i class="fas fa-magnifying-glass"></i> Lacak Laporan
                </a>
                @endif

                {{-- CEK STATUS LOGIN & ROLE --}}
                @auth
                @if(auth()->user()->role === 'masyarakat')
                <a href="{{ route('publik.dashboard') }}" class="inline-flex items-center text-[10px] md:text-xs font-black text-emerald-600 bg-emerald-100 hover:bg-emerald-200 uppercase tracking-widest transition-colors gap-1.5 md:gap-2 px-3 md:px-5 py-2 md:py-2.5 rounded-full shrink-0">
                    <i class="fas fa-user-circle"></i>
                    <span class="hidden sm:inline">Portal Saya</span>
                    <span class="sm:hidden">Portal</span>
                </a>
                @else
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[10px] md:text-xs font-black text-slate-800 bg-amber-400 hover:bg-amber-500 uppercase tracking-widest transition-colors gap-1.5 md:gap-2 px-3 md:px-5 py-2 md:py-2.5 rounded-full shadow-sm shrink-0">
                    <i class="fas fa-shield-halved"></i> Internal
                </a>
                @endif
                @else
                <a href="{{ route('publik.login') }}" class="inline-flex items-center text-[10px] md:text-xs font-black text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 hover:text-emerald-600 uppercase tracking-widest transition-colors gap-1.5 md:gap-2 px-3 md:px-5 py-2 md:py-2.5 rounded-full shadow-sm shrink-0">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- KONTEN HERO UTAMA --}}
    <div class="relative min-h-screen flex items-center pt-24 md:pt-32 pb-12">
        <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-6 w-full grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">

            {{-- KOLOM KANAN (GAMBAR / ILUSTRASI DITARUH KE ATAS DI LAYAR HP) --}}
            <div class="relative order-1 lg:order-2 flex justify-center items-center py-6 md:py-10 lg:py-0">
                {{-- Efek Radar Belakang Logo (Ukuran disesuaikan untuk HP) --}}
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="w-40 h-40 md:w-64 md:h-64 border border-emerald-300/50 rounded-full animate-ping-slow"></div>
                    <div class="absolute w-56 h-56 md:w-96 md:h-96 border border-emerald-200/30 rounded-full animate-ping-slow" style="animation-delay: 1s;"></div>
                    <div class="absolute w-72 h-72 md:w-[500px] md:h-[500px] border border-emerald-100/20 rounded-full"></div>
                </div>

                {{-- Logo Kejaksaan --}}
                <div class="relative z-10 p-5 md:p-8 bg-white/50 backdrop-blur-xl rounded-full shadow-[0_20px_50px_rgba(16,185,129,0.15)] border border-white">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="relative h-40 sm:h-52 md:h-64 lg:h-80 w-auto object-contain animate-float-light drop-shadow-2xl">
                </div>
            </div>

            {{-- KOLOM KIRI (TEKS & TOMBOL ADA DI BAWAH PADA LAYAR HP) --}}
            <div class="text-center lg:text-left order-2 lg:order-1 mt-4 md:mt-0">

                <div class="inline-flex items-center gap-2 md:gap-3 px-4 md:px-5 py-1.5 md:py-2 rounded-full bg-emerald-100/80 border border-emerald-200 text-emerald-700 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] mb-6 md:mb-8 shadow-sm backdrop-blur-sm">
                    <span class="flex h-2 md:h-2.5 w-2 md:w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 md:h-2.5 w-2 md:w-2.5 bg-emerald-600"></span>
                    </span>
                    Portal Layanan Publik Terpadu
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter mb-4 md:mb-6 leading-[1.15] md:leading-[1.1]">
                    Layanan Cepat <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Pengaduan Masyarakat</span>
                </h1>

                <p class="text-sm md:text-lg text-slate-600 font-medium mb-8 md:mb-10 leading-relaxed max-w-xl mx-auto lg:mx-0 px-2 md:px-0">
                    Kawal penegakan hukum bersama kami. Laporkan indikasi pelanggaran hukum, tindak pidana korupsi, atau aliran menyimpang secara <span class="font-bold text-emerald-600">Aman</span>, <span class="font-bold text-emerald-600">Mudah</span>, dan <span class="font-bold text-emerald-600">Rahasia</span>.
                </p>

                {{-- TOMBOL CALL TO ACTION --}}
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center lg:justify-start items-center">

                    @auth
                    @if(auth()->user()->role === 'masyarakat')
                    <a href="{{ route('publik.lapor') }}" class="w-full sm:w-auto px-6 md:px-8 py-3.5 md:py-4 bg-emerald-600 rounded-xl md:rounded-2xl text-white font-black text-xs md:text-sm uppercase tracking-[0.1em] shadow-xl shadow-emerald-600/30 hover:bg-emerald-700 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-3">
                        <i class="fas fa-bullhorn text-base md:text-lg"></i> Buat Pengaduan
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-6 md:px-8 py-3.5 md:py-4 bg-slate-800 rounded-xl md:rounded-2xl text-amber-400 font-black text-xs md:text-sm uppercase tracking-[0.1em] shadow-xl shadow-slate-800/30 hover:bg-slate-900 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-3">
                        <i class="fas fa-chart-pie text-base md:text-lg"></i> Dashboard Intel
                    </a>
                    @endif
                    @else
                    <a href="{{ route('publik.login') }}" class="w-full sm:w-auto px-6 md:px-8 py-3.5 md:py-4 bg-emerald-600 rounded-xl md:rounded-2xl text-white font-black text-xs md:text-sm uppercase tracking-[0.1em] shadow-xl shadow-emerald-600/30 hover:bg-emerald-700 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-3">
                        <i class="fas fa-bullhorn text-base md:text-lg"></i> Buat Pengaduan
                    </a>
                    @endauth
                </div>

                <div class="mt-8 md:mt-10 flex flex-wrap items-center justify-center lg:justify-start gap-4 md:gap-6 text-[10px] md:text-xs font-bold text-slate-500">
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <i class="fas fa-user-secret text-emerald-500 text-sm md:text-base"></i> Identitas Dirahasiakan
                    </div>
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <i class="fas fa-bolt text-amber-500 text-sm md:text-base"></i> Respons Cepat
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- FOOTER LIGHT MODE --}}
    <footer class="relative z-10 border-t border-slate-200 bg-white py-8 md:py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-6">
                <div class="flex items-center gap-3 md:gap-4 flex-col sm:flex-row">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-8 md:h-10 opacity-80 grayscale hover:grayscale-0 transition-all">
                    <div class="text-center sm:text-left">
                        <p class="text-[10px] md:text-xs text-slate-800 font-bold uppercase tracking-widest">
                            Kejaksaan Negeri Banjarmasin
                        </p>
                        <p class="text-[8px] md:text-[10px] text-slate-500 font-medium mt-1">Sistem Informasi Intelijen Terpadu (SI-INTEL) &copy; {{ date('Y') }}</p>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-[9px] md:text-[10px] text-emerald-600 font-black uppercase tracking-[0.1em] md:tracking-[0.2em] bg-emerald-50 px-3 md:px-4 py-1.5 md:py-2 rounded-full inline-block">
                        Melayani Masyarakat Sepenuh Hati
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>