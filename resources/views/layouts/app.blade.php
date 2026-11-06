<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIFORAL — @yield('title', 'Sistem Informasi Alumni')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] min-h-screen text-slate-800 antialiased flex flex-col">

    {{-- ── Header ── --}}
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-30 shadow-xs">
        <div class="flex items-center justify-between px-4 sm:px-6 py-2.5">
            {{-- Hamburger (mobile) + Logo --}}
            <div class="flex items-center gap-3">
                <button id="sidebar-toggle" class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50 transition" aria-label="Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo STAIMAS" class="h-9 w-auto object-contain" onerror="this.style.display='none'">
                </a>
                <div class="hidden sm:flex items-center pl-1">
                    <div class="h-5 w-px bg-slate-200 mr-3"></div>
                    <span class="text-[11px] font-bold bg-emerald-50 text-[#1B5E20] border border-emerald-200/80 px-2.5 py-1 rounded-full uppercase tracking-wider">
                        Portal Alumni
                    </span>
                </div>
            </div>

            {{-- Right Section: Alumni Info & Logout --}}
            <div class="flex items-center gap-3">
                @if (Auth::guard('alumni')->check())
                    <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200/70">
                        <div class="w-7 h-7 rounded-full bg-emerald-100 text-[#1B5E20] flex items-center justify-center text-xs font-bold ring-1 ring-emerald-200">
                            {{ strtoupper(substr(Auth::guard('alumni')->user()->name, 0, 2)) }}
                        </div>
                        <div class="hidden sm:block text-left pr-1">
                            <p class="text-xs font-bold text-slate-800 leading-tight truncate max-w-[140px]">
                                {{ Auth::guard('alumni')->user()->name }}
                            </p>
                            <p class="text-[10px] text-slate-400 font-mono">
                                {{ Auth::guard('alumni')->user()->nim }}
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100/80 border border-red-200 px-3 py-2 rounded-xl font-semibold transition inline-flex items-center gap-1.5 shadow-xs" title="Keluar dari sistem">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </header>

    {{-- ── Overlay mobile ── --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-20 hidden lg:hidden" onclick="closeSidebar()"></div>

    {{-- ── Layout body ── --}}
    <div class="flex flex-1">

        {{-- ── Modern Clean Sidebar ── --}}
        <aside id="sidebar"
               class="fixed lg:sticky top-[57px] left-0 h-[calc(100vh-57px)] w-64 bg-white border-r border-slate-200/80 flex flex-col z-20 shrink-0
                      -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out shadow-xl lg:shadow-none">

            <div class="p-4 border-b border-slate-100 flex items-center justify-between lg:hidden">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Navigasi Alumni</span>
                <button onclick="closeSidebar()" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col flex-1 overflow-y-auto p-3.5 gap-6">
                @php
                    $isProfile   = request()->routeIs('dashboard', 'profile.edit', 'data-akademik.edit');
                    $isKarir     = request()->routeIs('karir*');
                    $isKuisioner = request()->routeIs('kuisioner*');
                @endphp

                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">Menu Alumni</p>

                    <a href="{{ route('dashboard') }}" onclick="closeSidebar()"
                       class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition
                              {{ $isProfile ? 'bg-[#1B5E20] text-white shadow-sm shadow-[#1B5E20]/25' : 'text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50/60' }}">
                        <span class="w-8 h-8 rounded-lg {{ $isProfile ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-[#1B5E20]' }} flex items-center justify-center shrink-0 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <span>Profil Saya</span>
                    </a>

                    <a href="{{ route('karir') }}" onclick="closeSidebar()"
                       class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition
                              {{ $isKarir ? 'bg-[#1B5E20] text-white shadow-sm shadow-[#1B5E20]/25' : 'text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50/60' }}">
                        <span class="w-8 h-8 rounded-lg {{ $isKarir ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-[#1B5E20]' }} flex items-center justify-center shrink-0 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <span>Perjalanan Karir</span>
                    </a>

                    <a href="{{ route('kuisioner') }}" onclick="closeSidebar()"
                       class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition
                              {{ $isKuisioner ? 'bg-[#1B5E20] text-white shadow-sm shadow-[#1B5E20]/25' : 'text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50/60' }}">
                        <span class="w-8 h-8 rounded-lg {{ $isKuisioner ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-[#1B5E20]' }} flex items-center justify-center shrink-0 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </span>
                        <span>Kuisioner Tracer</span>
                    </a>
                </div>

                {{-- Bottom Profile Card --}}
                @if (Auth::guard('alumni')->check())
                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#1B5E20] text-white flex items-center justify-center font-bold text-xs shadow-xs">
                                {{ strtoupper(substr(Auth::guard('alumni')->user()->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::guard('alumni')->user()->name }}</p>
                                <p class="text-[10px] text-slate-400 font-mono truncate">{{ Auth::guard('alumni')->user()->nim }}</p>
                            </div>
                        </div>
                        <div class="px-2 pt-2 text-[10px] text-slate-400 text-center">
                            SIFORAL &copy; {{ date('Y') }} STAIMAS
                        </div>
                    </div>
                @endif
            </nav>
        </aside>

        {{-- ── Main content ── --}}
        <div class="flex-1 min-w-0 flex flex-col">

            {{-- Flash notifications --}}
            <div class="px-4 sm:px-6 lg:px-8 pt-4">
                @if (session('success'))
                    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-4 py-3 text-sm flex items-center gap-2.5 shadow-xs">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('info'))
                    <div class="mb-4 bg-sky-50 border border-sky-200 text-sky-800 rounded-2xl px-4 py-3 text-sm flex items-center gap-2.5 shadow-xs">
                        <svg class="w-5 h-5 text-sky-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('info') }}</span>
                    </div>
                @endif
            </div>

            <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        const toggle   = document.getElementById('sidebar-toggle');

        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
        }

        function closeSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        // Anti-bfcache: force reload on browser back/forward
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>
