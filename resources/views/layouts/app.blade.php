<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Si-Intel Kejaksaan') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Loading Bar Emas */
        #nprogress .bar {
            background: #F59E0B !important;
            height: 3px !important;
            z-index: 9999;
            box-shadow: 0 0 10px #F59E0B, 0 0 5px #F59E0B;
        }

        #nprogress .spinner-icon {
            border-top-color: #F59E0B !important;
            border-left-color: #F59E0B !important;
        }

        /* Scrollbar Hijau */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
            /* Slate 900 */
        }

        ::-webkit-scrollbar-thumb {
            background: #10B981;
            /* Emerald 500 */
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }

        html {
            scrollbar-gutter: stable;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-100 relative">

    <div class="fixed inset-0 -z-10 h-full w-full bg-slate-900">
        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop"
            alt="Background Intel"
            class="h-full w-full object-cover opacity-40">

        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/80 via-emerald-950/80 to-slate-900/80"></div>

        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-yellow-500/20 rounded-full mix-blend-screen filter blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-500/20 rounded-full mix-blend-screen filter blur-[100px]"></div>
    </div>

    <div class="min-h-screen flex flex-col relative">

        @persist('navigation')
        <div class="sticky top-0 z-50 shadow-2xl shadow-black/20">
            <livewire:layout.navigation />
        </div>
        @endpersist

        @if (isset($header))
        <header class="bg-white/10 backdrop-blur-md shadow-sm border-b border-white/10 relative z-10">
            <div class="max-w-screen-2xl mx-auto py-6 px-4 sm:px-6 lg:px-10">
                {{ $header }}
            </div>
        </header>
        @endif

        <main class="flex-1 relative">
            {{ $slot }}
        </main>

        <footer class="bg-black/20 border-t border-white/5 mt-auto py-6 backdrop-blur-sm text-gray-400">
            <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 flex flex-col md:flex-row justify-between items-center text-xs">
                <div>
                    &copy; {{ date('Y') }} Kejaksaan Republik Indonesia.
                </div>
                <div class="flex gap-4 font-semibold tracking-widest uppercase text-gray-500">
                    <span>Divisi Intelijen</span>
                    <span>•</span>
                    <span>Satya Adhi Wicaksana</span>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>