<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SI-INTEL | Kejaksaan RI</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" type="image/png" href="{{ asset('img/logo-kejaksaan.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-900 antialiased bg-[#f8fafc] overflow-x-hidden">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-100 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-20 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob animation-delay-4000"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 px-4">

        <div class="mb-8 text-center mt-10 sm:mt-0">
            <a href="/" wire:navigate class="inline-block group">
                <div class="bg-white/50 p-4 rounded-3xl border border-white/50 shadow-xl backdrop-blur-sm group-hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('img/logo-kejaksaan.png') }}" class="w-24 h-24 object-contain drop-shadow-md">
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-4xl mt-2 px-8 py-10 bg-transparent sm:bg-white sm:shadow-[0_20px_50px_rgba(0,0,0,0.05)] sm:border-2 border-slate-50 overflow-hidden sm:rounded-[2.5rem] relative">

            <div class="hidden sm:block absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600"></div>

            {{ $slot }}

        </div>

        <div class="mt-8 mb-10 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} Kejaksaan Negeri Banjarmasin. Satya Adhi Wicaksana.
            </p>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>

</html>