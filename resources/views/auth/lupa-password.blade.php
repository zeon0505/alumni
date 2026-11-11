<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Alumni — IKAMAS STAIMAS Wonogiri</title>
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
            <p class="text-xs text-[#1B5E20] font-bold tracking-wider mt-1 uppercase">Ikatan Alumni STAIMAS (IKAMAS)</p>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-6 sm:p-8">
            <div class="mb-6 text-center">
                <h1 class="text-lg sm:text-xl font-bold text-slate-800">Reset Password</h1>
                <p class="text-xs text-slate-500 mt-1">Verifikasi identitas dengan NIM dan tanggal lahir terdaftar</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-xs sm:text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('lupa-password.post') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Induk Mahasiswa (NIM)</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 21202011001" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password Baru</label>
                    <input type="password" name="password" id="reset-password" placeholder="Minimal 6 karakter" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Ulangi Password Baru</label>
                    <input type="password" name="password_confirmation" id="reset-password-confirm" placeholder="Ulangi password baru" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#1B5E20] hover:bg-[#154a18] text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition shadow-sm flex items-center justify-center gap-2">
                        <span>Simpan Password Baru</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-100 text-center text-xs text-slate-500">
                Sudah ingat password?
                <a href="{{ route('login') }}" class="text-[#1B5E20] font-semibold hover:underline">Kembali ke login</a>
            </div>
        </div>

        <div class="text-center mt-6 text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} STAIMAS Wonogiri. All rights reserved.</p>
        </div>

    </div>

</body>
</html>
