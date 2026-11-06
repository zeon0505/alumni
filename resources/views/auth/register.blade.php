<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun Alumni — SIFORAL STAIMAS Wonogiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-slate-50 via-slate-100 to-emerald-50/30 min-h-screen flex flex-col items-center justify-center p-4 antialiased text-slate-800">

    <div class="w-full max-w-md my-8">

        {{-- Brand / Header --}}
        <div class="text-center mb-6">
            <div class="inline-flex p-3 bg-white rounded-2xl shadow-sm border border-slate-100 mb-3">
                <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo STAIMAS" class="h-16 w-auto object-contain" onerror="this.style.display='none'">
            </div>
            <p class="text-[11px] text-slate-400 font-semibold uppercase tracking-widest">Sekolah Tinggi Agama Islam</p>
            <h2 class="text-2xl font-extrabold text-[#8B7355] tracking-wide">STAIMAS WONOGIRI</h2>
            <p class="text-xs text-[#1B5E20] font-bold tracking-wider mt-1 uppercase">Sistem Informasi Alumni (SIFORAL)</p>
        </div>

        {{-- Main Register Card --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-6 sm:p-8">
            <div class="mb-6 text-center">
                <h1 class="text-lg sm:text-xl font-bold text-slate-800">Daftar Akun Alumni</h1>
                <p class="text-xs text-slate-500 mt-1">Lengkapi data berikut untuk membuat akun alumni</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-xs">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>• {{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
                @csrf

                {{-- NIM --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Induk Mahasiswa (NIM) <span class="text-red-500">*</span></label>
                    <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 21202011001" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap (Sesuai Ijazah) <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email Aktif <span class="text-red-500">*</span></label>
                    <input type="email" name="email_pribadi" value="{{ old('email_pribadi') }}" placeholder="nama@email.com" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                {{-- Password & Confirmation --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" id="reg-password" placeholder="Min. 6 karakter" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Ulangi Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="reg-password-confirm" placeholder="Ulangi password" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="flex justify-end pt-0.5">
                    <label class="flex items-center gap-1.5 text-xs text-slate-500 cursor-pointer">
                        <input type="checkbox" onchange="const t = this.checked ? 'text' : 'password'; document.getElementById('reg-password').type = t; document.getElementById('reg-password-confirm').type = t;" class="rounded text-[#1B5E20] focus:ring-[#1B5E20] w-3.5 h-3.5">
                        <span>Lihat password</span>
                    </label>
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#1B5E20] hover:bg-[#154a18] text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition shadow-sm flex items-center justify-center gap-2">
                        <span>Daftarkan Akun</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-100 text-center text-xs text-slate-500">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-[#1B5E20] font-semibold hover:underline">Masuk di sini</a>
            </div>
        </div>

        <div class="text-center mt-6 text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} STAIMAS Wonogiri. All rights reserved.</p>
        </div>

    </div>

</body>
</html>
