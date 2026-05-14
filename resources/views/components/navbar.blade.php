<!-- ── SIDEBAR ── -->
<aside id="sidebar" class="bg-white border-r border-gray-100 flex flex-col h-full z-30 flex-shrink-0">
  <div class="flex-1 overflow-y-auto px-3 py-4">
    <!-- Brand -->
    <div class="flex items-center gap-2.5 px-3 mb-6">
      <div class="w-8 h-8 bg-teal-400 rounded-lg flex items-center justify-center flex-shrink-0">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <span class="font-display text-base font-bold text-gray-900">Toko<span class="text-teal-500">Nusantara</span></span>
    </div>

    <!-- E-commerce section -->
    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-3 mb-2">E-Commerce</p>
    <div class="space-y-0.5 mb-4">
      <div class="sidebar-link active" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/></svg>
        Dashboard
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2"/></svg>
        Manajemen
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5h12.8M9 19a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" stroke-width="2"/></svg>
        Pesanan
        <span class="ml-auto bg-teal-100 text-teal-700 text-[10px] font-bold px-1.5 py-0.5 rounded-full">12</span>
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z" stroke-width="2"/><circle cx="4" cy="4" r="2" stroke-width="2"/></svg>
        Pelanggan
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" stroke-width="2"/></svg>
        Laporan
      </div>
    </div>

    <!-- Pages section -->
    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-3 mb-2 mt-4">Halaman</p>
    <div class="space-y-0.5 mb-4">
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/></svg>
        Halaman
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2"/></svg>
        Autentikasi
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round"/></svg>
        Menu Level
      </div>
    </div>

    <!-- Other -->
    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-3 mb-2 mt-4">Lainnya</p>
    <div class="space-y-0.5">
      <div class="sidebar-link text-gray-300 cursor-not-allowed hover:bg-transparent">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" stroke-width="2"/></svg>
        Dinonaktifkan
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" stroke-width="2"/></svg>
        Label
        <span class="ml-auto bg-teal-400 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full">Baru</span>
      </div>
      <div class="sidebar-link" onclick="setNav(this)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" stroke-width="2"/></svg>
        Link Eksternal
      </div>
    </div>
  </div>

  <!-- User -->
  <div class="border-t border-gray-100 p-3">
    <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 cursor-pointer transition-colors">
      <div class="w-9 h-9 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">AD</div>
      <div class="min-w-0">
        <div class="text-sm font-semibold text-gray-800 truncate">Admin User</div>
        <div class="text-xs text-gray-400 truncate">Versi Gratis · 1 Bulan</div>
      </div>
      <svg class="w-4 h-4 text-gray-300 ml-auto flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/></svg>
    </div>
  </div>
</aside>
