<x-app-layout>
    <x-slot name="header">Marketplace Dashboard</x-slot>

    {{-- Container Full Width --}}
    <div class="w-full px-6 py-6 space-y-8">
        
        {{-- Top Bar: Info & Search --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-gray-800 tracking-tight">Katalog <span class="text-[#2DC5A2]">Utama</span></h1>
                <p class="text-xs text-gray-400 font-medium">Kelola dan telusuri semua produk yang tersedia</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2.5"/></svg>
                    </span>
                    <input type="text" placeholder="Cari barang..." class="pl-10 pr-4 py-2 bg-white border border-gray-100 rounded-xl text-xs w-64 focus:ring-1 focus:ring-[#2DC5A2] focus:border-[#2DC5A2] outline-none transition-all">
                </div>
                <button class="bg-gray-900 text-white p-2.5 rounded-xl hover:bg-black transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" stroke-width="2"/></svg>
                </button>
            </div>
        </div>

        {{-- Main Layout Grid --}}
        <div class="grid grid-cols-12 gap-6">
            
            {{-- Sidebar/Filter (3 Kolom) --}}
            <div class="col-span-12 lg:col-span-3 space-y-6">
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-800 mb-4">Kategori</h3>
                    <div class="space-y-2">
                        @php $cats = ['Semua Produk', 'Elektronik', 'Kebutuhan Pokok', 'Fashion Pria', 'Alat Tulis']; @endphp
                        @foreach($cats as $index => $c)
                        <label class="flex items-center gap-3 p-2 rounded-xl hover:bg-teal-50 group cursor-pointer transition-all">
                            <div class="w-2 h-2 rounded-full {{ $index == 0 ? 'bg-[#2DC5A2]' : 'bg-gray-200 group-hover:bg-[#2DC5A2]' }}"></div>
                            <span class="text-xs {{ $index == 0 ? 'font-bold text-gray-800' : 'text-gray-500' }}">{{ $c }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-5 text-white shadow-lg">
                    <p class="text-[10px] font-bold text-teal-400 uppercase tracking-widest">Premium Member</p>
                    <p class="text-sm font-medium mt-2 leading-relaxed">Dapatkan akses ke harga distributor.</p>
                    <button class="w-full mt-4 bg-teal-500 py-2 rounded-xl text-xs font-bold hover:bg-teal-400 transition-all">Upgrade Now</button>
                </div>
            </div>

            {{-- Product Grid (9 Kolom) --}}
            <div class="col-span-12 lg:col-span-9">
                {{-- Grid 4 Kolom di Desktop --}}
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                    @php
                        $products = [
                            ['n' => 'Laptop Pro M1', 'p' => '14.5jt', 'i' => '💻'],
                            ['n' => 'Mechanical Keyboard', 'p' => '850rb', 'i' => '⌨️'],
                            ['n' => 'Wireless Mouse', 'p' => '320rb', 'i' => '🖱️'],
                            ['n' => 'Monitor 4K 27"', 'p' => '4.2jt', 'i' => '🖥️'],
                            ['n' => 'Smartwatch Gen-5', 'p' => '2.1jt', 'i' => '⌚'],
                            ['n' => 'Headset Gaming', 'p' => '750rb', 'i' => '🎧'],
                            ['n' => 'USB-C Hub 7in1', 'p' => '450rb', 'i' => '🔌'],
                            ['n' => 'SSD NVMe 1TB', 'p' => '1.2jt', 'i' => '💾'],
                        ];
                    @endphp

                    @foreach($products as $p)
                    <div class="bg-white border border-gray-100 rounded-2xl p-3 hover:border-[#2DC5A2] hover:shadow-md transition-all group cursor-pointer">
                        {{-- Icon Placeholder --}}
                        <div class="aspect-square bg-gray-50 rounded-xl mb-3 flex items-center justify-center text-2xl group-hover:bg-teal-50 transition-colors">
                            {{ $p['i'] }}
                        </div>
                        {{-- Content --}}
                        <div class="space-y-1 px-1">
                            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-tight truncate">{{ $p['n'] }}</h4>
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-black text-gray-800">{{ $p['p'] }}</p>
                                <div class="w-7 h-7 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-[#2DC5A2] group-hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>