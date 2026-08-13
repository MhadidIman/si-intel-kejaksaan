<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-INTEL | Layanan Publik</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Check local storage for theme preference or system preference
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="font-sans antialiased text-slate-900 bg-slate-50 dark:text-slate-200 dark:bg-slate-900 transition-colors duration-300">

    @if (!request()->routeIs('verifikasi.dokumen'))

    <livewire:layout.navigation-publik />

    @endif

    {{-- KONTEN HALAMAN UTAMA --}}
    <main>
        {{ $slot }}
    </main>

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