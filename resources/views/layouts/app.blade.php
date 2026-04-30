<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TokoKu') }} - {{ $title ?? 'Dashboard' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        #sidebar {
            transform: translateX(-100%);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #sidebar.open { transform: translateX(0); }

        #overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease;
        }
        #overlay.open {
            opacity: 1;
            pointer-events: all;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    {{-- OVERLAY --}}
    <div id="overlay"
         class="fixed inset-0 bg-black/40 z-40 backdrop-blur-sm"
         onclick="closeSidebar()">
    </div>

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-72 bg-white z-50 shadow-2xl overflow-y-auto">

        {{-- Header User --}}
        <div class="bg-gradient-to-br from-[#2DC5A2] to-[#1FA88A] px-6 py-6 relative overflow-hidden">
            <div class="absolute -top-8 -right-8 w-28 h-28 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-6 right-10 w-20 h-20 bg-white/5 rounded-full"></div>

            <div class="relative flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-white/20 border-2 border-white/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 fill-white/90" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-bold text-base leading-tight truncate">{{ Auth::user()->name }}</p>
                    <p class="text-white/75 text-sm font-medium mt-0.5">Owner</p>
                </div>
                <button onclick="closeSidebar()" class="w-9 h-9 bg-white/15 hover:bg-white/25 rounded-xl flex items-center justify-center transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 stroke-white fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Last Update --}}
        <div class="flex items-center justify-between px-6 py-3 bg-teal-50 border-b border-gray-100">
            <span class="text-xs text-gray-400 font-medium">Update Data Terakhir</span>
            <button class="text-[#2DC5A2] hover:text-[#1FA88A] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
        </div>

        {{-- Misi Banner --}}
        <div class="mx-4 mt-4">
            <div class="flex items-center justify-between bg-[#2DC5A2] text-white px-4 py-3 rounded-xl cursor-pointer hover:bg-[#1FA88A] transition-colors">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm">Misi dapat hadiah</span>
                    <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-0.5 rounded-full">Baru!</span>
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="px-2 py-3 space-y-0.5">

            @php
                $menus = [
                    ['label' => 'Dashboard',            'url' => route('dashboard'),  'route' => 'dashboard', 'icon' => '<rect x="2" y="3" width="7" height="7"/><rect x="15" y="3" width="7" height="7"/><rect x="15" y="14" width="7" height="7"/><rect x="2" y="14" width="7" height="7"/>'],
                    ['label' => 'Manajemen',             'url' => '#',                'route' => 'manajemen', 'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                    ['label' => 'Transaksi Penjualan',  'url' => '#',                'route' => 'transaksi.penjualan', 'icon' => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>'],
                    ['label' => 'Pembelian Ke Supplier','url' => '#',                'route' => 'pembelian.supplier', 'icon' => '<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>'],
                    ['label' => 'Keuangan',              'url' => '#',                'route' => 'keuangan', 'icon' => '<rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>'],
                    ['label' => 'PPOB',                  'url' => '#',                'route' => 'ppob', 'icon' => '<rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>'],
                    ['label' => 'Laporan',               'url' => '#',                'route' => 'laporan', 'icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>'],
                ];
            @endphp

            @foreach ($menus as $menu)
                @php $active = request()->routeIs($menu['route']); @endphp
                <a href="{{ $menu['url'] }}"
                   class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-colors duration-150 {{ $active ? 'bg-teal-50 text-[#2DC5A2] font-semibold' : 'text-gray-600 hover:bg-teal-50 hover:text-[#2DC5A2]' }}">
                    <svg class="w-5 h-5 fill-none stroke-current flex-shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        {!! $menu['icon'] !!}
                    </svg>
                    <span class="text-sm">{{ $menu['label'] }}</span>
                    @if ($active)
                        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-[#2DC5A2]"></span>
                    @endif
                </a>
            @endforeach

        </nav>

        {{-- Logout --}}
        <div class="px-4 pb-6 mt-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-4 px-4 py-3.5 rounded-xl text-red-400 hover:bg-red-50 transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 fill-none stroke-current flex-shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN WRAPPER --}}
    <div class="flex flex-col min-h-screen">

        {{-- TOP NAVBAR --}}
        <header class="bg-white sticky top-0 z-30 shadow-sm">
            <div class="flex items-center justify-between px-4 py-3">

                {{-- Hamburger --}}
                <button onclick="openSidebar()" class="w-10 h-10 flex flex-col items-center justify-center gap-1.5 rounded-xl hover:bg-teal-50 transition-colors group">
                    <span class="w-5 h-0.5 bg-gray-500 group-hover:bg-[#2DC5A2] rounded-full transition-colors"></span>
                    <span class="w-5 h-0.5 bg-gray-500 group-hover:bg-[#2DC5A2] rounded-full transition-colors"></span>
                    <span class="w-3 h-0.5 bg-gray-500 group-hover:bg-[#2DC5A2] rounded-full transition-colors self-start ml-1"></span>
                </button>

                {{-- Brand --}}
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-[#2DC5A2] rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-gray-800 text-base">TokoKu</span>
                </div>

                {{-- Notif + Avatar --}}
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-gray-100 relative transition-colors">
                        <svg class="w-5 h-5 stroke-gray-500 fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="w-9 h-9 rounded-full bg-[#2DC5A2] flex items-center justify-center cursor-pointer" onclick="openSidebar()">
                        <span class="text-white font-bold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>

            </div>

            {{-- Page Title Sub-bar --}}
            @isset($header)
                <div class="px-4 pb-3 pt-0">
                    <div class="text-sm font-semibold text-gray-700">{{ $header }}</div>
                </div>
            @endisset
        </header>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 px-4 py-5">
            {{ $slot }}
        </main>

    </div>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('overlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('overlay').classList.remove('open');
            document.body.style.overflow = '';
        }
    </script>

</body>
</html>