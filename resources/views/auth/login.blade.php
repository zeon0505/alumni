<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Alumni — SIFORAL STAIMAS Wonogiri</title>
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
            <p class="text-xs text-[#1B5E20] font-bold tracking-wider mt-1 uppercase">Sistem Informasi Alumni (SIFORAL)</p>
        </div>

        {{-- Main Login Card --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-6 sm:p-8">
            <div class="mb-6 text-center">
                <h1 class="text-lg sm:text-xl font-bold text-slate-800">Masuk ke Portal Alumni</h1>
                <p class="text-xs text-slate-500 mt-1">Gunakan Nomor Induk Mahasiswa (NIM) dan password Anda</p>
            </div>

            {{-- Flash Alert --}}
            @if (session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-xs sm:text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-xs sm:text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf

                {{-- NIM --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Induk Mahasiswa (NIM)</label>
                    <div class="relative">
                        <input
                            type="text"
                            name="nim"
                            value="{{ old('nim') }}"
                            placeholder="Contoh: 21202011001"
                            autocomplete="username"
                            required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition"
                        >
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-semibold text-slate-700">Password</label>
                        <a href="{{ route('lupa-password') }}" class="text-xs text-[#1B5E20] hover:underline font-medium">Lupa Password?</a>
                    </div>
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

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#1B5E20] hover:bg-[#154a18] text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition shadow-sm flex items-center justify-center gap-2">
                        <span>Masuk Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>

            {{-- Link Register & Panduan --}}
            <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <p class="text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#1B5E20] font-semibold hover:underline">Daftar di sini</a>
                </p>
                <a href="https://bit.ly/BukuPanduanDevalumni" target="_blank" class="text-slate-400 hover:text-slate-600 inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Panduan
                </a>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-6 text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} STAIMAS Wonogiri. All rights reserved.</p>
            <p class="mt-1">
                <a href="{{ route('admin.login') }}" class="text-slate-400 hover:text-[#1B5E20] hover:underline transition">
                    Masuk sebagai Administrator &rarr;
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
