<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator — IKAMAS STAIMAS Wonogiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-slate-50 via-slate-100 to-emerald-50/30 min-h-screen flex flex-col items-center justify-center p-4 antialiased text-slate-800">

    <div class="w-full max-w-md">

        {{-- Brand / Header --}}
        <div class="text-center mb-6">
            <div class="inline-flex p-3 bg-white rounded-2xl shadow-sm border border-slate-100 mb-3">
                <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo STAIMAS" class="h-16 w-auto object-contain" onerror="this.style.display='none'">
            </div>
            <p class="text-[11px] text-slate-400 font-semibold uppercase tracking-widest">Sekolah Tinggi Agama Islam</p>
            <h2 class="text-2xl font-extrabold text-[#8B7355] tracking-wide">STAIMAS WONOGIRI</h2>
            <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-[#1B5E20] border border-emerald-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                PANEL ADMINISTRATOR
            </div>
        </div>

        {{-- Main Login Card --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-6 sm:p-8">
            <div class="mb-6 text-center">
                <h1 class="text-lg sm:text-xl font-bold text-slate-800">Autentikasi Admin</h1>
                <p class="text-xs text-slate-500 mt-1">Silakan masukkan email dan kata sandi administrator</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-xs sm:text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Administrator</label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@gmail.com"
                            autocomplete="email"
                            required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition"
                        >
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="••••••••••••"
                            autocomplete="current-password"
                            required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-10 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition"
                        >
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        <button type="button" onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" name="remember" class="rounded text-[#1B5E20] focus:ring-[#1B5E20] w-4 h-4">
                        <span>Ingat saya</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#1B5E20] hover:bg-[#154a18] text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition shadow-sm flex items-center justify-center gap-2">
                        <span>Masuk ke Panel Admin</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-6 text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} STAIMAS Wonogiri. All rights reserved.</p>
            <p class="mt-1">
                <a href="{{ route('login') }}" class="text-slate-400 hover:text-[#1B5E20] hover:underline transition">
                    &larr; Kembali ke Login Portal Alumni
                </a>
            </p>
        </div>

    </div>

    <script>
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>
