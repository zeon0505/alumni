<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SIFORAL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 min-h-screen flex flex-col items-center justify-center py-8">

    <div class="w-full max-w-sm">
        {{-- Logo / Header --}}
        <div class="bg-white rounded-t-xl px-8 pt-8 pb-4 flex flex-col items-center border-b-4 border-[#1B5E20]">
            <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo Kampus" class="h-16 mb-3" onerror="this.style.display='none'">
            <p class="text-xs text-gray-500 uppercase tracking-widest text-center leading-tight">Sekolah Tinggi Agama Islam</p>
            <p class="text-2xl font-extrabold text-[#8B7355] tracking-wide text-center">STAIMAS</p>
            <p class="text-xs text-gray-500 tracking-[0.3em] text-center mb-2">W O N O G I R I</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-b-xl shadow-xl px-8 pb-8 pt-6">
            <h1 class="text-center text-[#1B5E20] font-bold text-xl mb-4">SISTEM INFORMASI ALUMNI</h1>

            <div class="bg-[#1B5E20] text-white text-center py-2.5 rounded-md mb-6 text-sm font-medium">
                Login Page
            </div>

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-300 text-green-800 rounded px-3 py-2 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf

                {{-- NIM --}}
                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-1">Username (NIP/NIM)</label>
                    <div class="relative">
                        <input
                            type="text"
                            name="nim"
                            value="{{ old('nim') }}"
                            placeholder="Masukkan NIM"
                            autocomplete="username"
                            class="w-full bg-gray-50 border {{ $errors->has('nim') ? 'border-red-400' : 'border-gray-200' }} rounded px-3 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]"
                        >
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>
                    @error('nim')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-2">
                    <div class="flex justify-between mb-1">
                        <label class="text-sm text-gray-600">Password</label>
                        <a href="{{ route('lupa-password') }}" class="text-sm text-[#1B5E20] hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="••••••••••"
                            autocomplete="current-password"
                            class="w-full bg-gray-50 border {{ $errors->has('nim') ? 'border-red-400' : 'border-gray-200' }} rounded px-3 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]"
                        >
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>
                </div>

                {{-- Show Password --}}
                <div class="flex justify-end mb-5">
                    <label class="flex items-center gap-1.5 text-xs text-gray-500 cursor-pointer">
                        <input type="checkbox" id="show-password" class="rounded" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'">
                        Show Password
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <a href="https://bit.ly/BukuPanduanDevalumni" target="_blank" class="text-sm text-[#1B5E20] hover:underline">
                        Panduan Penggunaan
                    </a>
                    <button type="submit" class="bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold px-6 py-2.5 rounded transition">
                        LOGIN
                    </button>
                </div>
            </form>

            {{-- Daftar --}}
            <div class="mt-5 pt-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#1B5E20] font-semibold hover:underline">Daftar di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-xs text-gray-500 mt-5">
            Copyright &copy; {{ date('Y') }} <strong>STAIMAS Wonogiri</strong>. All Rights Reserved.
        </p>
    </div>

</body>
</html>
