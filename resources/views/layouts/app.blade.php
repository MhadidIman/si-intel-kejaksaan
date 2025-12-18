<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Si-Intel Kejaksaan') }}</title>

    <linkpreconnect href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            #nprogress .bar {
                background: #F59E0B !important;
                /* Gold */
                height: 3px !important;
                z-index: 9999;
            }

            #nprogress .spinner-icon {
                border-top-color: #F59E0B !important;
                border-left-color: #F59E0B !important;
            }

            html {
                scrollbar-gutter: stable;
            }
        </style>
</head>

<body class="font-sans antialiased bg-slate-50 text-gray-900 relative">

    <div class="fixed inset-0 -z-10 h-full w-full bg-slate-50 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:24px_24px]">
        <div class="absolute left-0 right-0 top-0 -z-10 m-auto h-[350px] w-[350px] rounded-full bg-emerald-500 opacity-10 blur-[120px]"></div>
    </div>

    <div class="min-h-screen flex flex-col relative">

        <div class="sticky top-0 z-50 shadow-sm">
            <livewire:layout.navigation />
        </div>

        @if (isset($header))
        <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 relative z-10">
            <div class="max-w-screen-2xl mx-auto py-6 px-4 sm:px-6 lg:px-10">
                {{ $header }}
            </div>
        </header>
        @endif

        <main class="flex-1 relative">
            {{ $slot }}
        </main>

        <footer class="bg-white/50 border-t border-gray-200 mt-auto py-6 backdrop-blur-sm">
            <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
                <div>
                    &copy; {{ date('Y') }} Kejaksaan Republik Indonesia.
                </div>
                <div>
                    Satya Adhi Wicaksana
                </div>
            </div>
        </footer>
    </div>
</body>

</html>