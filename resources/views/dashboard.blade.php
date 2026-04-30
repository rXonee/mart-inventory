<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="space-y-5">

        {{-- Greeting --}}
        <div>
            <p class="text-gray-400 text-sm font-medium">Selamat datang kembali 👋</p>
            <h1 class="text-gray-800 font-extrabold text-xl mt-0.5">{{ Auth::user()->name }}</h1>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 gap-3">

            <div class="bg-gradient-to-br from-[#2DC5A2] to-[#1FA88A] rounded-2xl p-4 text-white hover:-translate-y-0.5 transition-transform">
                <p class="text-white/70 text-xs font-medium">Total Penjualan</p>
                <p class="text-2xl font-extrabold mt-1">Rp 4,2jt</p>
                <div class="flex items-center gap-1 mt-2">
                    <svg class="w-3 h-3 fill-white/80" viewBox="0 0 24 24"><path d="M7 14l5-5 5 5H7z"/></svg>
                    <span class="text-white/80 text-xs">+12% hari ini</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-gray-100 hover:-translate-y-0.5 transition-transform">
                <p class="text-gray-400 text-xs font-medium">Transaksi</p>
                <p class="text-2xl font-extrabold text-gray-800 mt-1">38</p>
                <div class="flex items-center gap-1 mt-2">
                    <svg class="w-3 h-3 fill-[#2DC5A2]" viewBox="0 0 24 24"><path d="M7 14l5-5 5 5H7z"/></svg>
                    <span class="text-[#2DC5A2] text-xs">+5 hari ini</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-gray-100 hover:-translate-y-0.5 transition-transform">
                <p class="text-gray-400 text-xs font-medium">Stok Menipis</p>
                <p class="text-2xl font-extrabold text-gray-800 mt-1">7</p>
                <div class="flex items-center gap-1 mt-2">
                    <svg class="w-3 h-3 fill-orange-400" viewBox="0 0 24 24">
                        <path d="M12 2L1 21h22L12 2zm0 3.5L20.5 19h-17L12 5.5zM11 10v4h2v-4h-2zm0 6v2h2v-2h-2z"/>
                    </svg>
                    <span class="text-orange-400 text-xs">Perlu restok</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-gray-100 hover:-translate-y-0.5 transition-transform">
                <p class="text-gray-400 text-xs font-medium">Pengeluaran</p>
                <p class="text-2xl font-extrabold text-gray-800 mt-1">Rp 1,8jt</p>
                <div class="flex items-center gap-1 mt-2">
                    <svg class="w-3 h-3 fill-red-400 rotate-180" viewBox="0 0 24 24"><path d="M7 14l5-5 5 5H7z"/></svg>
                    <span class="text-red-400 text-xs">-3% minggu ini</span>
                </div>
            </div>

        </div>

        {{-- Transaksi Terakhir --}}
        <div>
            <div class="flex items-center justify-between mb-3">
                <h2 class="font-bold text-gray-800 text-base">Transaksi Terakhir</h2>
                <span class="text-[#2DC5A2] text-xs font-semibold cursor-pointer hover:underline">Lihat semua</span>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 divide-y divide-gray-50 overflow-hidden">
                @php
                    $transaksi = [
                        ['nama' => 'Mie Instan Goreng', 'waktu' => '10:32', 'jumlah' => '+Rp 15.000', 'type' => 'in'],
                        ['nama' => 'Sabun Mandi x3',    'waktu' => '10:15', 'jumlah' => '+Rp 24.000', 'type' => 'in'],
                        ['nama' => 'Restock Gula 5kg',  'waktu' => '09:40', 'jumlah' => '-Rp 85.000', 'type' => 'out'],
                        ['nama' => 'Minuman Botol x2',  'waktu' => '09:12', 'jumlah' => '+Rp 10.000', 'type' => 'in'],
                    ];
                @endphp

                @foreach ($transaksi as $item)
                    <div class="flex items-center gap-3 px-4 py-3.5">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 {{ $item['type'] === 'in' ? 'bg-teal-50' : 'bg-red-50' }}">
                            <svg class="w-4 h-4 {{ $item['type'] === 'in' ? 'stroke-[#2DC5A2]' : 'stroke-red-400' }} fill-none" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                @if ($item['type'] === 'in')
                                    <path d="M12 5v14M5 12l7 7 7-7"/>
                                @else
                                    <path d="M12 19V5M5 12l7-7 7 7"/>
                                @endif
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-700 truncate">{{ $item['nama'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $item['waktu'] }}</p>
                        </div>
                        <span class="text-sm font-bold flex-shrink-0 {{ $item['type'] === 'in' ? 'text-[#2DC5A2]' : 'text-red-400' }}">
                            {{ $item['jumlah'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Quick Access --}}
        <div>
            <h2 class="font-bold text-gray-800 text-base mb-3">Akses Cepat</h2>
            <div class="grid grid-cols-4 gap-3">
                @php
                    $quick = [
                        ['label' => 'Jual',    'color' => 'bg-teal-50 text-[#2DC5A2]',   'icon' => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>'],
                        ['label' => 'Beli',    'color' => 'bg-blue-50 text-blue-500',     'icon' => '<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>'],
                        ['label' => 'Kasir',   'color' => 'bg-orange-50 text-orange-500', 'icon' => '<rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>'],
                        ['label' => 'Laporan', 'color' => 'bg-purple-50 text-purple-500', 'icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>'],
                    ];
                @endphp

                @foreach ($quick as $q)
                    <div class="flex flex-col items-center gap-2 cursor-pointer group">
                        <div class="w-14 h-14 {{ $q['color'] }} rounded-2xl flex items-center justify-center group-hover:scale-95 transition-transform">
                            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                {!! $q['icon'] !!}
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-600">{{ $q['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="h-4"></div>
    </div>

</x-app-layout>