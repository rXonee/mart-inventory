<!-- TOPBAR -->
<header class="h-14 bg-white border-b border-gray-100 flex items-center px-5 gap-4 flex-shrink-0 z-20">
  <button onclick="toggleSidebar()" class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center transition-colors">
    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round"/></svg>
  </button>
  <div class="w-px h-5 bg-gray-200"></div>

  <!-- breadcrumb -->
  <div class="flex items-center gap-1.5 text-sm">
    <span class="text-gray-400">E-Commerce</span>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg>
    <span class="text-gray-700 font-medium">Dashboard</span>
  </div>

  <div class="ml-auto flex items-center gap-3">
    <!-- search -->
    <div class="flex items-center gap-2 h-8 px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-400 hover:border-teal-300 transition-colors cursor-text">
      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"/></svg>
      <span class="text-xs hidden sm:block">Cari...</span>
      <span class="hidden sm:flex items-center gap-0.5 text-[10px] text-gray-300 bg-gray-100 rounded px-1.5 py-0.5">⌘K</span>
    </div>
    <!-- notif -->
    <button class="relative w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center transition-colors">
      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 17H9m6 0a3 3 0 11-6 0m6 0H9M5.07 9A7 7 0 1118.93 9C19.5 13 21 14 21 15H3c0-1 1.5-2 2.07-6z" stroke-width="2"/></svg>
      <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-400 rounded-full border border-white"></span>
      <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-400 rounded-full text-white text-[9px] font-bold flex items-center justify-center">2</span>
    </button>
    <!-- clock -->
    <button class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center transition-colors">
      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round"/></svg>
    </button>
    <!-- avatar -->
    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white text-xs font-bold cursor-pointer">AD</div>
  </div>
</header>
