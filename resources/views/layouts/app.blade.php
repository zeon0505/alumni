<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIFORAL — @yield('title', 'Sistem Informasi Alumni')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- ── Header ── --}}
    <header class="bg-white border-b-2 border-[#1B5E20] sticky top-0 z-30">
        <div class="flex items-center justify-between px-3 py-2">
            {{-- Hamburger (mobile) + Logo --}}
            <div class="flex items-center gap-2">
                <button id="sidebar-toggle" class="lg:hidden p-1.5 rounded text-[#1B5E20] hover:bg-green-50 transition" aria-label="Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                <div class="leading-tight hidden sm:block">
                    <p class="text-[9px] text-gray-400 uppercase tracking-widest">Sekolah Tinggi Agama Islam</p>
                    <p class="text-sm font-extrabold text-[#8B7355] tracking-wide">STAIMAS WONOGIRI</p>
                </div>
            </div>
            {{-- Judul sistem --}}
            <p class="text-[#1B5E20] font-bold text-xs sm:text-base tracking-wide text-right leading-tight">
                SISTEM INFORMASI<br class="sm:hidden"> ALUMNI
            </p>
        </div>
    </header>

    {{-- ── Overlay mobile --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden lg:hidden" onclick="closeSidebar()"></div>

    {{-- ── Layout body ── --}}
    <div class="flex">

        {{-- ── Sidebar ── --}}
        <aside id="sidebar"
               class="fixed lg:sticky top-[53px] left-0 h-[calc(100vh-53px)] w-52 bg-[#1B5E20] flex flex-col z-20 flex-shrink-0
                      -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out">

            <div class="px-4 py-3 border-b border-green-700 flex items-center justify-between">
                <p class="text-white text-xs font-bold uppercase tracking-wider">Menu Navigasi</p>
                <button onclick="closeSidebar()" class="lg:hidden text-green-300 hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col flex-1 overflow-y-auto py-1">
                @php
                    $isProfile   = request()->routeIs('dashboard', 'profile.edit', 'data-akademik.edit');
                    $isKarir     = request()->routeIs('karir*');
                    $isKuisioner = request()->routeIs('kuisioner*');
                @endphp

                <a href="{{ route('dashboard') }}" onclick="closeSidebar()"
                   class="flex items-center gap-3 px-4 py-3 text-sm transition
                          {{ $isProfile ? 'bg-white text-[#1B5E20] font-semibold' : 'text-white hover:bg-green-700' }}">
                    <span class="w-7 h-7 rounded-full {{ $isProfile ? 'bg-[#1B5E20]' : 'bg-green-700' }} flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    Profile
                </a>

                <a href="{{ route('karir') }}" onclick="closeSidebar()"
                   class="flex items-center gap-3 px-4 py-3 text-sm transition
                          {{ $isKarir ? 'bg-white text-[#1B5E20] font-semibold' : 'text-white hover:bg-green-700' }}">
                    <span class="w-7 h-7 rounded-full {{ $isKarir ? 'bg-[#1B5E20]' : 'bg-green-700' }} flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    Perjalanan Karir
                </a>

                <a href="{{ route('kuisioner') }}" onclick="closeSidebar()"
                   class="flex items-center gap-3 px-4 py-3 text-sm transition
                          {{ $isKuisioner ? 'bg-white text-[#1B5E20] font-semibold' : 'text-white hover:bg-green-700' }}">
                    <span class="w-7 h-7 rounded-full {{ $isKuisioner ? 'bg-[#1B5E20]' : 'bg-green-700' }} flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </span>
                    Kuisioner
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 w-full px-4 py-3 text-sm text-white hover:bg-green-700 transition">
                        <span class="w-7 h-7 rounded-full bg-green-700 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </span>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        {{-- ── Main content ── --}}
        <div class="flex-1 min-w-0 flex flex-col">

            {{-- Flash --}}
            <div class="px-3 pt-3">
                @if (session('success'))
                    <div class="mb-2 bg-green-50 border border-green-300 text-green-800 rounded px-3 py-2 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('info'))
                    <div class="mb-2 bg-blue-50 border border-blue-300 text-blue-800 rounded px-3 py-2 text-xs">
                        {{ session('info') }}
                    </div>
                @endif
            </div>

            <main class="flex-1 px-3 pb-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        const toggle   = document.getElementById('sidebar-toggle');

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        function closeSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
