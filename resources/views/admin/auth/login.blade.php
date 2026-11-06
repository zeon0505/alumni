<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — SIFORAL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 min-h-screen flex flex-col items-center justify-center py-8">
    <div class="w-full max-w-sm">
        <div class="bg-white rounded-t-xl px-8 pt-8 pb-4 flex flex-col items-center border-b-4 border-[#1B5E20]">
            <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo" class="h-16 mb-3" onerror="this.style.display='none'">
            <p class="text-xs text-gray-500 uppercase tracking-widest text-center">Sekolah Tinggi Agama Islam</p>
            <p class="text-2xl font-extrabold text-[#8B7355] tracking-wide text-center">STAIMAS</p>
            <p class="text-xs text-gray-500 tracking-[0.3em] text-center mb-1">W O N O G I R I</p>
        </div>

        <div class="bg-white rounded-b-xl shadow-xl px-8 pb-8 pt-6">
            <h1 class="text-center text-[#1B5E20] font-bold text-xl mb-1">PANEL ADMIN</h1>
            <p class="text-center text-xs text-gray-400 mb-4">Sistem Informasi Alumni</p>

            <div class="bg-[#1B5E20] text-white text-center py-2.5 rounded-md mb-5 text-sm font-medium">
                Login Administrator
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-300 text-red-700 rounded px-3 py-2 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@staimas.ac.id"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
                <div class="mb-5">
                    <label class="block text-sm text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
                <button type="submit" class="w-full bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold py-2.5 rounded transition">
                    MASUK
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-gray-500 mt-4">
            Copyright &copy; {{ date('Y') }} <strong>STAIMAS Wonogiri</strong>. All Rights Reserved.
        </p>
    </div>
</body>
</html>
