<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — SIFORAL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 min-h-screen flex flex-col items-center justify-center py-8">

    <div class="w-full max-w-sm">

        {{-- Header --}}
        <div class="bg-white rounded-t-xl px-8 pt-8 pb-4 flex flex-col items-center border-b-4 border-[#1B5E20]">
            <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo Kampus" class="h-16 mb-3" onerror="this.style.display='none'">
            <p class="text-xs text-gray-500 uppercase tracking-widest text-center leading-tight">Sekolah Tinggi Agama Islam</p>
            <p class="text-2xl font-extrabold text-[#8B7355] tracking-wide text-center">STAIMAS</p>
            <p class="text-xs text-gray-500 tracking-[0.3em] text-center mb-2">W O N O G I R I</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-b-xl shadow-xl px-8 pb-8 pt-6">

            <h2 class="text-base font-bold text-gray-700 mb-1">Reset Password Alumni</h2>
            <p class="text-xs text-gray-400 mb-5">Password minimal 6 karakter yang berisi kombinasi huruf dan angka.</p>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-300 text-red-600 rounded px-3 py-2 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-300 text-green-700 rounded px-3 py-2 text-xs">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('lupa-password.post') }}" novalidate class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs text-gray-500 mb-1">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM"
                        class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] bg-gray-50">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] bg-gray-50">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Password Baru</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter"
                        class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] bg-gray-50">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Ulangi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                        class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] bg-gray-50">
                </div>

                <div class="flex justify-end pt-1">
                    <button type="submit"
                        class="bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold px-8 py-2.5 rounded transition">
                        Reset
                    </button>
                </div>
            </form>

            <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                <a href="{{ route('login') }}" class="text-xs text-[#1B5E20] hover:underline">&larr; Kembali ke Login</a>
            </div>
        </div>

        <p class="text-center text-xs text-gray-500 mt-4">
            Copyright &copy; {{ date('Y') }} <strong>STAIMAS Wonogiri</strong>. All Rights Reserved.
        </p>
    </div>

</body>
</html>
