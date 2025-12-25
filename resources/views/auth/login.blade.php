<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0a0a0a] relative overflow-hidden">

        <div class="absolute top-0 -left-4 w-72 h-72 bg-emerald-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden sm:rounded-3xl z-10">

            <div class="flex flex-col items-center mb-10">
                <div class="p-4 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 mb-4">
                    <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-black text-white tracking-wider uppercase">SI-INTELIJEN</h1>
                <p class="text-emerald-500 text-xs font-bold tracking-widest mt-1">REPUBLIK INDONESIA</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-emerald-500 uppercase tracking-widest mb-2">Username / Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="block w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 placeholder-gray-600"
                        placeholder="admin@kejaksaan.go.id">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-emerald-500 uppercase tracking-widest mb-2">Password Access</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-black/40 border-white/10 text-emerald-600 shadow-sm focus:ring-emerald-500 focus:ring-offset-black" name="remember">
                        <span class="ms-2 text-sm text-gray-400">{{ __('Ingat saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))

                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-xl shadow-lg shadow-emerald-900/40 transition duration-300 transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2 uppercase tracking-widest text-sm">
                        <span>Akses Sistem</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em]">Sistem Informasi Intelijen Negara &copy; {{ date('Y') }}</p>
            </div>
        </div>

        <div class="mt-8 z-10">
            <div class="flex items-center gap-4 text-gray-600 text-xs uppercase tracking-widest opacity-50">
                <span>End-to-End Encryption</span>
                <span class="w-1 h-1 bg-gray-600 rounded-full"></span>
                <span>Authorized Only</span>
            </div>
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
</x-guest-layout>