<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-INTEL Kejaksaan</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animasi Kustom */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes breathe {

            0%,
            100% {
                filter: drop-shadow(0 0 10px rgba(16, 185, 129, 0.2));
                transform: scale(1);
            }

            50% {
                filter: drop-shadow(0 0 25px rgba(16, 185, 129, 0.5));
                transform: scale(1.02);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-breathe {
            animation: breathe 4s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        /* Grid Pattern Background */
        .bg-grid-slate-900 {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(148, 163, 184, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.1) 1px, transparent 1px);
        }
    </style>
</head>

<body class="antialiased bg-slate-50 font-sans selection:bg-emerald-500 selection:text-white overflow-x-hidden relative">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0 bg-grid-slate-900 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))]"></div>

        <div class="absolute top-0 -left-4 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-amber-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-20 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <nav class="fixed top-0 w-full z-50 px-6 py-4 transition-all duration-300 backdrop-blur-md border-b border-white/50 bg-white/30">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-white/80 p-1.5 rounded-lg shadow-sm backdrop-blur-sm border border-emerald-100">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="h-8 w-auto">
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-black text-slate-800 tracking-widest text-lg">SI-INTEL</span>
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-[0.2em]">Kejaksaan Negeri</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="group inline-flex items-center gap-2 px-5 py-2 rounded-full bg-emerald-600 text-white font-bold text-xs uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 hover:shadow-emerald-300 transform hover:-translate-y-0.5">
                    Dashboard
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
                @else
                <a href="{{ route('login') }}" class="group inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white text-slate-700 font-bold text-xs uppercase tracking-widest border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 transition-all shadow-sm hover:shadow-md">
                    <i class="fas fa-lock text-emerald-500 opacity-60 group-hover:opacity-100"></i>
                    Login Petugas
                </a>
                @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="relative min-h-screen flex items-center justify-center pt-20 pb-10">
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">

            <div class="flex flex-col items-center text-center">

                <div class="mb-6 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-widest shadow-sm animate-fade-in-up">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Sistem Monitoring & Pelaporan Terintegrasi
                </div>

                <div class="mb-8 relative animate-fade-in-up delay-100">
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-400 to-amber-300 rounded-full blur-2xl opacity-20 animate-pulse"></div>
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="relative h-48 w-auto object-contain drop-shadow-2xl animate-breathe">
                </div>

                <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter mb-6 leading-tight animate-fade-in-up delay-200">
                    SISTEM INFORMASI <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-500 to-emerald-700 drop-shadow-sm">INTELIJEN KEJAKSAAN</span>
                </h1>

                <p class="text-lg text-slate-500 font-medium max-w-2xl mx-auto mb-10 leading-relaxed animate-fade-in-up delay-300">
                    Platform digitalisasi manajemen data intelijen untuk mendukung penegakan hukum yang <span class="text-emerald-600 font-bold">Modern</span>, <span class="text-emerald-600 font-bold">Cepat</span>, dan <span class="text-emerald-600 font-bold">Akurat</span>.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 w-full justify-center animate-fade-in-up delay-300">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="group relative px-8 py-4 bg-slate-900 rounded-2xl text-white font-black text-sm uppercase tracking-widest shadow-2xl shadow-slate-400/50 hover:bg-emerald-600 hover:shadow-emerald-500/40 hover:-translate-y-1 transition-all duration-300">
                        <span class="flex items-center justify-center gap-3">
                            <i class="fas fa-tachometer-alt"></i> Masuk Dashboard
                        </span>
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="group relative px-8 py-4 bg-emerald-600 rounded-2xl text-white font-black text-sm uppercase tracking-widest shadow-2xl shadow-emerald-400/40 hover:bg-emerald-700 hover:shadow-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                        <span class="flex items-center justify-center gap-3">
                            Akses Sistem <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </a>
                    @endauth
                    @endif
                </div>

                <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-6 w-full animate-fade-in-up delay-300">
                    <div class="p-6 bg-white/60 backdrop-blur-sm rounded-3xl border border-white/50 shadow-lg hover:shadow-xl hover:bg-white hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4 class="font-black text-slate-800 text-lg mb-1">Terpusat</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bank Data Digital</p>
                    </div>

                    <div class="p-6 bg-white/60 backdrop-blur-sm rounded-3xl border border-white/50 shadow-lg hover:shadow-xl hover:bg-white hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4 class="font-black text-slate-800 text-lg mb-1">Realtime</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Monitoring 24/7</p>
                    </div>

                    <div class="p-6 bg-white/60 backdrop-blur-sm rounded-3xl border border-white/50 shadow-lg hover:shadow-xl hover:bg-white hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-4 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="font-black text-slate-800 text-lg mb-1">Aman</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Enkripsi Data</p>
                    </div>

                    <div class="p-6 bg-white/60 backdrop-blur-sm rounded-3xl border border-white/50 shadow-lg hover:shadow-xl hover:bg-white hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="font-black text-slate-800 text-lg mb-1">Valid</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akurasi Tinggi</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="relative z-10 bg-white/50 backdrop-blur-md border-t border-slate-200 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">
                    &copy; {{ date('Y') }} Kejaksaan Negeri. All Rights Reserved.
                </p>
                <div class="flex gap-6 text-slate-400">
                    <span class="text-[10px] font-black uppercase tracking-widest hover:text-emerald-600 cursor-pointer transition">Satya</span>
                    <span class="text-[10px] font-black uppercase tracking-widest hover:text-emerald-600 cursor-pointer transition">Adhi</span>
                    <span class="text-[10px] font-black uppercase tracking-widest hover:text-emerald-600 cursor-pointer transition">Wicaksana</span>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>