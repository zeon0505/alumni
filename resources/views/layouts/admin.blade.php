<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'SIFORAL')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Top bar --}}
    <header class="bg-[#1B5E20] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="Logo" class="h-9 w-auto" onerror="this.style.display='none'">
                <div>
                    <p class="text-xs text-green-200 uppercase tracking-widest">Panel Admin</p>
                    <p class="font-bold text-sm leading-tight">SIFORAL — STAIMAS Wonogiri</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-green-100">{{ Auth::guard('admin')->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-xs bg-white text-[#1B5E20] font-semibold px-3 py-1.5 rounded hover:bg-green-50 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-6 flex gap-6">

        {{-- Sidebar --}}
        <aside class="w-52 shrink-0">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="bg-[#1B5E20] text-white text-sm font-semibold px-4 py-3">Menu Admin</div>
                <nav class="py-1">
                    @php
                        $isOn = fn(string $name) => request()->routeIs($name)
                            ? 'bg-green-50 text-[#1B5E20] font-semibold border-l-4 border-[#1B5E20]'
                            : 'text-gray-700';
                    @endphp
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm hover:bg-green-50 hover:text-[#1B5E20] transition {{ $isOn('admin.dashboard') }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.alumni.index') }}" class="block px-4 py-2.5 text-sm hover:bg-green-50 hover:text-[#1B5E20] transition {{ request()->routeIs('admin.alumni*') ? 'bg-green-50 text-[#1B5E20] font-semibold border-l-4 border-[#1B5E20]' : 'text-gray-700' }}">
                        Data Alumni
                    </a>
                    <a href="{{ route('admin.kuesioner.index') }}" class="block px-4 py-2.5 text-sm hover:bg-green-50 hover:text-[#1B5E20] transition {{ request()->routeIs('admin.kuesioner*') ? 'bg-green-50 text-[#1B5E20] font-semibold border-l-4 border-[#1B5E20]' : 'text-gray-700' }}">
                        Kuesioner
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        {{-- Content --}}
        <main class="flex-1 min-w-0">
            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-300 text-green-800 rounded-lg px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="mb-4 bg-blue-50 border border-blue-300 text-blue-800 rounded-lg px-4 py-3 text-sm">{{ session('info') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
