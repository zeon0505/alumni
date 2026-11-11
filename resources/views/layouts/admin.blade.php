<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'IKAMAS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] min-h-screen text-slate-800 antialiased flex flex-col">

    {{-- ── Top Navigation Bar ── --}}
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-30 shadow-xs">
        <div class="flex items-center justify-between px-4 sm:px-6 py-2.5">
            {{-- Hamburger (mobile) + Logo --}}
            <div class="flex items-center gap-3">
                <button id="admin-sidebar-toggle" class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50 transition" aria-label="Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo STAIMAS" class="h-9 w-auto object-contain" onerror="this.style.display='none'">
                </a>
                <div class="hidden sm:flex items-center pl-1">
                    <div class="h-5 w-px bg-slate-200 mr-3"></div>
                    <span class="text-[11px] font-bold bg-emerald-50 text-[#1B5E20] border border-emerald-200/80 px-2.5 py-1 rounded-full uppercase tracking-wider">
                        Panel Admin
                    </span>
                </div>
            </div>

            {{-- Right: Admin Info & Quick Logout --}}
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="w-7 h-7 rounded-full bg-[#1B5E20] text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="hidden sm:block text-left pr-1">
                        <p class="text-xs font-bold text-slate-800 leading-tight">{{ Auth::guard('admin')->user()->name }}</p>
                        <p class="text-[10px] text-emerald-700 font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Online
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100/80 border border-red-200 px-3 py-2 rounded-xl font-semibold transition inline-flex items-center gap-1.5 shadow-xs" title="Keluar dari sistem">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- ── Mobile Overlay ── --}}
    <div id="admin-sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-20 hidden lg:hidden" onclick="toggleAdminSidebar(false)"></div>

    {{-- ── Body Container ── --}}
    <div class="flex flex-1">

        {{-- ── Modern Clean Sidebar ── --}}
        <aside id="admin-sidebar"
               class="fixed lg:sticky top-[57px] left-0 h-[calc(100vh-57px)] w-64 bg-white border-r border-slate-200/80 flex flex-col z-20 shrink-0
                      -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out shadow-xl lg:shadow-none">

            <div class="p-4 border-b border-slate-100 flex items-center justify-between lg:hidden">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Navigasi Admin</span>
                <button onclick="toggleAdminSidebar(false)" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col flex-1 overflow-y-auto p-3.5 gap-6">
                @php
                    $isDash   = request()->routeIs('admin.dashboard');
                    $isAlumni = request()->routeIs('admin.alumni*');
                    $isKues   = request()->routeIs('admin.kuesioner*');
                    $alumniCount = \App\Models\Alumni::count();
                    $kuesCount   = \App\Models\Kuesioner::where('aktif', true)->count();
                @endphp

                {{-- Group: Menu Utama --}}
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">Menu Utama</p>

                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}" onclick="toggleAdminSidebar(false)"
                       class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition
                              {{ $isDash ? 'bg-[#1B5E20] text-white shadow-sm shadow-[#1B5E20]/25' : 'text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50/60' }}">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg {{ $isDash ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-[#1B5E20]' }} flex items-center justify-center shrink-0 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                            </span>
                            <span>Dashboard</span>
                        </div>
                    </a>

                    {{-- Data Alumni --}}
                    <a href="{{ route('admin.alumni.index') }}" onclick="toggleAdminSidebar(false)"
                       class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition
                              {{ $isAlumni ? 'bg-[#1B5E20] text-white shadow-sm shadow-[#1B5E20]/25' : 'text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50/60' }}">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg {{ $isAlumni ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-[#1B5E20]' }} flex items-center justify-center shrink-0 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </span>
                            <span>Data Alumni</span>
                        </div>
                        @if ($alumniCount > 0)
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full {{ $isAlumni ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600 group-hover:bg-emerald-100 group-hover:text-[#1B5E20]' }}">
                                {{ $alumniCount }}
                            </span>
                        @endif
                    </a>

                    {{-- Kuesioner --}}
                    <a href="{{ route('admin.kuesioner.index') }}" onclick="toggleAdminSidebar(false)"
                       class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition
                              {{ $isKues ? 'bg-[#1B5E20] text-white shadow-sm shadow-[#1B5E20]/25' : 'text-slate-600 hover:text-[#1B5E20] hover:bg-emerald-50/60' }}">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg {{ $isKues ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-[#1B5E20]' }} flex items-center justify-center shrink-0 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </span>
                            <span>Tracer Study</span>
                        </div>
                        @if ($kuesCount > 0)
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $isKues ? 'bg-emerald-400/30 text-emerald-100' : 'bg-emerald-100 text-emerald-800' }}">
                                Aktif
                            </span>
                        @endif
                    </a>
                </div>

                {{-- Group: Akses Cepat --}}
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">Pintasan</p>
                    <a href="{{ route('admin.kuesioner.create') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs text-slate-500 hover:text-[#1B5E20] hover:bg-slate-50 transition font-medium">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Buat Kuesioner</span>
                    </a>
                    <a href="{{ route('login') }}" target="_blank" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs text-slate-500 hover:text-[#1B5E20] hover:bg-slate-50 transition font-medium">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>Lihat Portal Alumni</span>
                    </a>
                </div>

                {{-- Bottom Admin Card --}}
                <div class="mt-auto pt-4 border-t border-slate-100">
                    <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-[#1B5E20] text-white flex items-center justify-center font-bold text-xs shadow-xs">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::guard('admin')->user()->name }}</p>
                            <p class="text-[10px] text-slate-400 truncate">{{ Auth::guard('admin')->user()->email }}</p>
                        </div>
                    </div>
                    <div class="px-2 pt-2 text-[10px] text-slate-400 text-center">
                        IKAMAS &copy; {{ date('Y') }} STAIMAS
                    </div>
                </div>
            </nav>
        </aside>

        {{-- ── Main Content Area ── --}}
        <main class="flex-1 min-w-0 p-4 sm:p-6 lg:p-8">
            @if (session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-4 py-3 text-sm flex items-center gap-2.5 shadow-xs">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('info'))
                <div class="mb-5 bg-sky-50 border border-sky-200 text-sky-800 rounded-2xl px-4 py-3 text-sm flex items-center gap-2.5 shadow-xs">
                    <svg class="w-5 h-5 text-sky-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('info') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- Script sidebar mobile --}}
    <script>
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('admin-sidebar-overlay');
        const toggleBtn = document.getElementById('admin-sidebar-toggle');

        function toggleAdminSidebar(show) {
            if (show) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                const isOpen = !sidebar.classList.contains('-translate-x-full');
                toggleAdminSidebar(!isOpen);
            });
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
