<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-INTEL Internal | Kejaksaan RI</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="icon" type="image/png" href="{{ asset('img/logo-kejaksaan.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes glow {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .bg-glow {
            animation: glow 8s ease-in-out infinite;
        }

        .bg-grid-premium {
            background-size: 50px 50px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }
    </style>
</head>

<body class="antialiased bg-slate-950 selection:bg-emerald-500 selection:text-white overflow-x-hidden">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0 bg-grid-premium"></div>
        <div class="absolute top-0 -left-20 w-[500px] h-[500px] bg-emerald-600/20 rounded-full filter blur-[120px] bg-glow"></div>
        <div class="absolute bottom-0 -right-20 w-[500px] h-[500px] bg-blue-600/10 rounded-full filter blur-[120px] bg-glow" style="animation-delay: -4s"></div>
    </div>

    {{-- NAVBAR ATAS KHUSUS INTERNAL --}}
    <nav class="fixed top-0 w-full z-50 px-6 py-5 border-b border-white/10 bg-slate-950/40 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="bg-white/10 p-2 rounded-xl border border-white/20 shadow-xl">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-10 w-auto object-contain">
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-black text-white tracking-widest text-xl">SI-INTEL</span>
                    <span class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.3em] mt-1">INTERNAL SECURITY</span>
                </div>
            </div>
        </div>
    </nav>

    {{-- KONTEN HERO --}}
    <div class="relative min-h-screen flex items-center justify-center pt-24 pb-12">
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full text-center">

            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-slate-300 text-[10px] font-black uppercase tracking-[0.2em] mb-10 backdrop-blur-sm">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
                Restricted Access Only
            </div>

            <div class="mb-10 relative">
                <div class="absolute inset-0 bg-emerald-500/20 blur-[100px] rounded-full scale-150"></div>
                <img src="{{ asset('img/logo-kejaksaan.png') }}" class="relative h-56 w-auto mx-auto object-contain drop-shadow-[0_0_50px_rgba(16,185,129,0.4)] animate-float">
            </div>

            <h1 class="text-5xl md:text-8xl font-black text-white tracking-tighter mb-8 leading-[0.9]">
                SISTEM INFORMASI <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-500 italic">INTELIJEN TERPADU</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-400 font-medium max-w-3xl mx-auto mb-12 leading-relaxed">
                Platform digitalisasi eksklusif untuk manajemen data intelijen strategis guna mendukung penegakan hukum yang
                <span class="text-emerald-400 font-bold border-b border-emerald-400/30">Cepat</span>,
                <span class="text-emerald-400 font-bold border-b border-emerald-400/30">Tepat</span>, dan
                <span class="text-emerald-400 font-bold border-b border-emerald-400/30">Akurat</span>.
            </p>

            {{-- TOMBOL CALL TO ACTION (PINTAR & ANTI-BENTROK) --}}
            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                @auth
                @if(auth()->user()->role === 'masyarakat')
                {{-- Mencegah Masyarakat masuk ke Dashboard Internal --}}
                <div class="flex flex-col items-center">
                    <span class="text-amber-400 text-[10px] font-black uppercase tracking-widest mb-3 bg-amber-400/10 px-4 py-1.5 rounded-full border border-amber-400/20">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Sesi Masyarakat Sedang Aktif
                    </span>
                    <a href="{{ route('publik.dashboard') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 border border-slate-700 rounded-2xl text-slate-300 font-black text-sm uppercase tracking-[0.1em] shadow-xl hover:bg-slate-700 hover:text-white hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                        Kembali ke Portal Publik <i class="fas fa-external-link-alt text-lg"></i>
                    </a>
                </div>
                @else
                {{-- Jika murni Petugas yang sedang login --}}
                <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-10 py-5 bg-emerald-600 rounded-2xl text-white font-black text-sm uppercase tracking-[0.1em] shadow-2xl shadow-emerald-900/50 hover:bg-emerald-500 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                    Masuk Ke Dashboard <i class="fas fa-arrow-right text-lg"></i>
                </a>
                @endif
                @else
                {{-- Jika belum ada sesi login sama sekali --}}
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-5 bg-emerald-600 rounded-2xl text-white font-black text-sm uppercase tracking-[0.1em] shadow-2xl shadow-emerald-900/50 hover:bg-emerald-500 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                    Akses Portal Intelijen <i class="fas fa-shield-halved text-lg"></i>
                </a>
                @endauth
            </div>

            <div class="mt-8 text-slate-500 text-[10px] font-bold uppercase tracking-widest flex items-center justify-center gap-2">
                <i class="fas fa-lock text-emerald-500"></i> Encrypted Connection (Internal Use Only)
            </div>

            {{-- FITUR HIGHLIGHTS --}}
            <div class="mt-24 grid grid-cols-2 lg:grid-cols-4 gap-6 text-left">
                <div class="p-8 bg-white/5 rounded-3xl border border-white/10 backdrop-blur-md group hover:bg-white/10 transition-all duration-500">
                    <div class="w-12 h-12 bg-emerald-500/20 text-emerald-400 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-database"></i>
                    </div>
                    <h4 class="text-white font-black text-lg mb-2">Centralized</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Penyimpanan bank data intelijen terpusat dan terstruktur.</p>
                </div>

                <div class="p-8 bg-white/5 rounded-3xl border border-white/10 backdrop-blur-md group hover:bg-white/10 transition-all duration-500">
                    <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-blue-500 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4 class="text-white font-black text-lg mb-2">Real-Time</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Monitoring pergerakan informasi hukum secara aktual.</p>
                </div>

                <div class="p-8 bg-white/5 rounded-3xl border border-white/10 backdrop-blur-md group hover:bg-white/10 transition-all duration-500">
                    <div class="w-12 h-12 bg-amber-500/20 text-amber-400 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <h4 class="text-white font-black text-lg mb-2">Classified</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Keamanan data berlapis untuk menjaga kerahasiaan informasi.</p>
                </div>

                <div class="p-8 bg-white/5 rounded-3xl border border-white/10 backdrop-blur-md group hover:bg-white/10 transition-all duration-500">
                    <div class="w-12 h-12 bg-purple-500/20 text-purple-400 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-purple-500 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h4 class="text-white font-black text-lg mb-2">Reporting</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Sistem pelaporan otomatis yang siap dipublikasikan.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="relative z-10 border-t border-white/10 py-12 bg-slate-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left">
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mb-2">
                        &copy; {{ date('Y') }} Kejaksaan Negeri. Dikembangkan untuk Keperluan Penegakan Hukum.
                    </p>
                    <p class="text-[10px] text-slate-600 font-medium">Sistem Informasi Intelijen Terpadu (SI-INTEL) | Internal Use Only</p>
                </div>

                <div class="flex gap-8">
                    <div class="text-center group">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] group-hover:text-emerald-500 transition-colors">SATYA</p>
                        <div class="w-full h-0.5 bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </div>
                    <div class="text-center group">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] group-hover:text-emerald-500 transition-colors">ADHI</p>
                        <div class="w-full h-0.5 bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </div>
                    <div class="text-center group">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] group-hover:text-emerald-500 transition-colors">WICAKSANA</p>
                        <div class="w-full h-0.5 bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>