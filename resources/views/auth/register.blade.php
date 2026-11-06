<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — SIFORAL</title>
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
            <h1 class="text-center text-[#1B5E20] font-bold text-xl mb-1">SISTEM INFORMASI ALUMNI</h1>

            <div class="bg-[#1B5E20] text-white text-center py-2.5 rounded-md mb-5 text-sm font-medium">
                Daftar Akun Alumni
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-300 text-red-600 rounded px-3 py-2 text-xs">
                    <ul class="space-y-0.5">
                        @foreach ($errors->all() as $err)
                            <li>• {{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" novalidate class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm text-gray-600 mb-1">NIM <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM"
                            class="w-full bg-gray-50 border {{ $errors->has('nim') ? 'border-red-400' : 'border-gray-200' }} rounded px-3 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama sesuai ijazah"
                        class="w-full bg-gray-50 border {{ $errors->has('name') ? 'border-red-400' : 'border-gray-200' }} rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email_pribadi" value="{{ old('email_pribadi') }}" placeholder="contoh@email.com"
                        class="w-full bg-gray-50 border {{ $errors->has('email_pribadi') ? 'border-red-400' : 'border-gray-200' }} rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" id="reg-password" placeholder="Minimal 6 karakter"
                        class="w-full bg-gray-50 border {{ $errors->has('password') ? 'border-red-400' : 'border-gray-200' }} rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>

                <div class="flex justify-end">
                    <label class="flex items-center gap-1.5 text-xs text-gray-500 cursor-pointer">
                        <input type="checkbox" onchange="document.getElementById('reg-password').type = this.checked ? 'text' : 'password'" class="rounded">
                        Tampilkan Password
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold py-2.5 rounded transition">
                    DAFTAR
                </button>
            </form>

            <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-[#1B5E20] font-semibold hover:underline">Login di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-xs text-gray-500 mt-5">
            Copyright &copy; {{ date('Y') }} <strong>STAIMAS Wonogiri</strong>. All Rights Reserved.
        </p>
    </div>

</body>
</html>
