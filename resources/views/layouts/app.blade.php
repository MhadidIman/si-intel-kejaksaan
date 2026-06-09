<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SI-INTEL | Kejaksaan RI</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased text-slate-800">
    <div class="min-h-screen bg-slate-50">

        {{-- ========================================================== --}}
        {{-- LOGIKA PINTAR PEMISAH NAVBAR (JANGAN DIHAPUS)              --}}
        {{-- ========================================================== --}}
        @if(auth()->check() && auth()->user()->role === 'masyarakat')
        {{-- Jika Masyarakat, panggil Navbar Publik (Terang) --}}
        <livewire:layout.navigation-publik />
        @else
        {{-- Jika Petugas/Admin, panggil Navbar Internal (Gelap) --}}
        <livewire:layout.navigation />
        @endif
        {{-- ========================================================== --}}

        @if (isset($header))
        <header class="bg-white shadow-sm border-b border-slate-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>