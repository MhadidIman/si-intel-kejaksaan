<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SI-INTEL | Kejaksaan RI</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" type="image/png" href="{{ asset('img/logo-kejaksaan.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 bg-[#f8fafc] flex flex-col min-h-screen overflow-x-hidden">
    @if(auth()->check() && auth()->user()->role === 'masyarakat')
    <livewire:layout.navigation-publik />
    @else
    <livewire:layout.navigation />
    @endif

    <main class="flex-1 w-full relative pt-6 pb-12">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 mt-auto py-6 shadow-inner w-full">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} Kejaksaan Republik Indonesia.
            </p>
            <p class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-tighter">Sistem Informasi Intelijen Terpadu</p>
        </div>
    </footer>

</body>

</html>