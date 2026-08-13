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
    <script>
        // Check local storage for theme preference or system preference
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="font-sans antialiased text-slate-800 dark:text-slate-200 dark:bg-slate-900 transition-colors duration-300">
    <div class="min-h-screen bg-slate-50 dark:bg-slate-900 transition-colors duration-300">

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

    {{-- SWEETALERT2 & GLOBAL WIRE:CONFIRM OVERRIDE --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.directive('confirm', ({ el, directive, component, cleanup }) => {
                let content = directive.expression;
                
                let onClick = e => {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: content || 'Apakah Anda yakin ingin melanjutkan tindakan ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: '<i class="fas fa-check mr-2"></i> Ya, Lanjutkan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            popup: 'rounded-[2rem] border border-slate-100 shadow-2xl',
                            confirmButton: 'rounded-xl px-6 py-2.5 font-black uppercase tracking-wider text-xs',
                            cancelButton: 'rounded-xl px-6 py-2.5 font-black uppercase tracking-wider text-xs border border-slate-200'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            el.removeEventListener('click', onClick, true);
                            el.click();
                            el.addEventListener('click', onClick, true);
                        }
                    });
                };
                
                el.addEventListener('click', onClick, true);
                
                cleanup(() => {
                    el.removeEventListener('click', onClick, true);
                });
            });
        });
    </script>
    <script>
        function toggleTheme() {
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            
            if(themeToggleDarkIcon) themeToggleDarkIcon.classList.toggle('hidden');
            if(themeToggleLightIcon) themeToggleLightIcon.classList.toggle('hidden');

            var themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
            var themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

            if(themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.toggle('hidden');
            if(themeToggleLightIconMobile) themeToggleLightIconMobile.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var isDark = localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
            
            document.querySelectorAll('.theme-toggle-dark-icon').forEach(function(el) {
                if(isDark) el.classList.add('hidden');
                else el.classList.remove('hidden');
            });
            
            document.querySelectorAll('.theme-toggle-light-icon').forEach(function(el) {
                if(isDark) el.classList.remove('hidden');
                else el.classList.add('hidden');
            });
        });
        
        document.addEventListener('livewire:navigated', function() {
            var isDark = localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
            
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            
            document.querySelectorAll('.theme-toggle-dark-icon').forEach(function(el) {
                if(isDark) el.classList.add('hidden');
                else el.classList.remove('hidden');
            });
            
            document.querySelectorAll('.theme-toggle-light-icon').forEach(function(el) {
                if(isDark) el.classList.remove('hidden');
                else el.classList.add('hidden');
            });
        });
    </script>
</body>

</html>