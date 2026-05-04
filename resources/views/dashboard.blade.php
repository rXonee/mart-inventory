<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>TokoNusantara — Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          sans: ['Plus Jakarta Sans', 'sans-serif'],
          display: ['Syne', 'sans-serif'],
        },
        colors: {
          teal: {
            50:  '#f0fdf9',
            100: '#ccfbef',
            200: '#99f6e0',
            300: '#5eead4',
            400: '#2DC5A2',
            500: '#14b8a6',
            600: '#0d9488',
            700: '#0f766e',
          },
          brand: '#2DC5A2',
        },
        keyframes: {
          fadeUp:   { '0%':{ opacity:'0', transform:'translateY(16px)' }, '100%':{ opacity:'1', transform:'translateY(0)' } },
          slideIn:  { '0%':{ opacity:'0', transform:'translateX(-20px)' }, '100%':{ opacity:'1', transform:'translateX(0)' } },
          fadeIn:   { '0%':{ opacity:'0' }, '100%':{ opacity:'1' } },
          shimmer:  { '0%':{ backgroundPosition:'-200% 0' }, '100%':{ backgroundPosition:'200% 0' } },
          pulse2:   { '0%,100%':{ opacity:'1', transform:'scale(1)' }, '50%':{ opacity:'.5', transform:'scale(1.5)' } },
          ringPulse:{ '0%,100%':{ opacity:'.15', transform:'translate(-50%,-50%) scale(1)' }, '50%':{ opacity:'.45', transform:'translate(-50%,-50%) scale(1.04)' } },
          barGrow:  { '0%':{ height:'0' }, '100%':{ height:'var(--h)' } },
          drawLine: { '0%':{ strokeDashoffset:'1000' }, '100%':{ strokeDashoffset:'0' } },
          spin:     { '100%':{ transform:'rotate(360deg)' } },
          clipOut:  { '0%':{ clipPath:'inset(0 0 0 0)' }, '100%':{ clipPath:'inset(0 0 100% 0)' } },
        },
        animation: {
          fadeUp:    'fadeUp .6s cubic-bezier(.22,1,.36,1) forwards',
          slideIn:   'slideIn .6s cubic-bezier(.22,1,.36,1) forwards',
          fadeIn:    'fadeIn .5s ease forwards',
          pulse2:    'pulse2 2s ease-in-out infinite',
          ringPulse: 'ringPulse 3s ease-in-out infinite',
          clipOut:   'clipOut .75s cubic-bezier(.76,0,.24,1) forwards',
        },
      }
    }
  }
</script>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
  body { font-family: 'Plus Jakarta Sans', sans-serif; }
  .font-display { font-family: 'Syne', sans-serif; }

  /* Loader */
  #loader { position:fixed; inset:0; z-index:9999; background:#0e1117; display:flex; align-items:center; justify-content:center; flex-direction:column; }
  .pl-ring { position:absolute; border-radius:50%; border:1px solid rgba(45,197,162,.15); transform:translate(-50%,-50%); left:50%; top:50%; animation:ringPulse 3s ease-in-out infinite; }
  #loader.exit { animation:clipOut .75s cubic-bezier(.76,0,.24,1) forwards; }
  @keyframes ringPulse { 0%,100%{opacity:.15;transform:translate(-50%,-50%) scale(1);}50%{opacity:.45;transform:translate(-50%,-50%) scale(1.04);} }
  @keyframes clipOut   { 0%{clip-path:inset(0 0 0 0);}100%{clip-path:inset(0 0 100% 0);} }

  /* Reveal */
  .rv  { opacity:0; transform:translateY(20px); transition:opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1); }
  .rv.in{ opacity:1; transform:translateY(0); }
  .rvl { opacity:0; transform:translateX(-18px); transition:opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1); }
  .rvl.in{ opacity:1; transform:translateX(0); }

  /* Sidebar */
  .sidebar-link { display:flex; align-items:center; gap:10px; padding:9px 14px; border-radius:8px; font-size:13px; font-weight:500; color:#6b7280; cursor:pointer; transition:all .15s; }
  .sidebar-link:hover { background:#f0fdf9; color:#0f766e; }
  .sidebar-link.active { background:#dcfce7; color:#0f766e; font-weight:600; }
  .sidebar-link svg { width:16px; height:16px; flex-shrink:0; }

  /* Active nav pill */
  .nav-active { background:#f0fdf9; color:#0f766e; font-weight:600; }

  /* Gradient hero */
  .hero-gradient { background: linear-gradient(135deg, #134e48 0%, #2DC5A2 50%, #f59e0b 100%); }

  /* Chart containers */
  .chart-wrap { position:relative; }

  /* Scrollbar */
  ::-webkit-scrollbar { width:5px; height:5px; }
  ::-webkit-scrollbar-track { background:transparent; }
  ::-webkit-scrollbar-thumb { background:#d1fae5; border-radius:99px; }

  /* Table hover */
  .trow:hover { background:#f0fdf9; }

  /* Progress bar */
  .prog-bar { height:4px; border-radius:99px; }

  /* Status badge */
  .badge-shipped   { background:#dcfce7; color:#166534; }
  .badge-pending   { background:#fef9c3; color:#854d0e; }
  .badge-cancelled { background:#fee2e2; color:#991b1b; }
  .badge-completed { background:#dcfce7; color:#166534; }
  .badge-instock   { background:#dcfce7; color:#166534; }
  .badge-lowstock  { background:#fef9c3; color:#854d0e; }
  .badge-outstock  { background:#fee2e2; color:#991b1b; }

  /* Typed cursor */
  .typed-cursor { display:inline-block; width:2px; height:.9em; background:#fff; margin-left:2px; vertical-align:middle; animation:blink 1s step-end infinite; }
  @keyframes blink { 0%,100%{opacity:1}50%{opacity:0} }

  /* sidebar collapse */
  #sidebar { width:220px; min-width:220px; transition:width .3s, min-width .3s; overflow:hidden; }
  #sidebar.collapsed { width:0; min-width:0; }

  /* App */
  #app { opacity:0; transition:opacity .5s ease; }
  #app.ready { opacity:1; }

  /* Donut hole */
  .donut-center { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; pointer-events:none; }

  /* Line chart tooltip */
  .chartjs-tooltip { pointer-events:none; }

  /* Card hover */
  .stat-card { transition:box-shadow .2s, transform .2s; }
  .stat-card:hover { box-shadow:0 8px 32px rgba(45,197,162,.13); transform:translateY(-2px); }
</style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- ═══════════════════════════════════
     LOADING SCREEN
═══════════════════════════════════ -->
<div id="loader">
  <!-- rings -->
  <div class="pl-ring" style="width:140px;height:140px;animation-delay:0s;"></div>
  <div class="pl-ring" style="width:260px;height:260px;animation-delay:.35s;"></div>
  <div class="pl-ring" style="width:380px;height:380px;animation-delay:.7s;"></div>
  <div class="pl-ring" style="width:500px;height:500px;animation-delay:1.05s;"></div>

  <!-- grid bg -->
  <div class="absolute inset-0" style="background-image:linear-gradient(rgba(45,197,162,.04)1px,transparent 1px),linear-gradient(90deg,rgba(45,197,162,.04)1px,transparent 1px);background-size:44px 44px;"></div>
  <!-- glow -->
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full" style="background:radial-gradient(circle,rgba(45,197,162,.1)0%,transparent 70%);"></div>

  <!-- center content -->
  <div class="relative z-10 flex flex-col items-center gap-7 text-center">
    <!-- icon -->
    <div style="opacity:0;animation:fadeUp .6s .1s cubic-bezier(.22,1,.36,1) forwards" class="relative">
      <div class="w-16 h-16 rounded-2xl bg-teal-400 flex items-center justify-center relative">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="absolute -inset-1.5 rounded-2xl border border-teal-400/30" style="animation:ringPulse 2s ease-in-out infinite;"></div>
      </div>
    </div>
    <!-- wordmark -->
    <div style="opacity:0;animation:fadeUp .6s .3s cubic-bezier(.22,1,.36,1) forwards">
      <h1 class="font-display text-3xl font-bold text-white tracking-tight">Toko<span class="text-teal-400">Nusantara</span></h1>
      <p class="text-xs text-white/30 tracking-widest uppercase mt-1 font-light">Admin Management System</p>
    </div>
    <!-- progress -->
    <div style="opacity:0;animation:fadeUp .6s .5s cubic-bezier(.22,1,.36,1) forwards" class="w-56">
      <div class="w-full h-0.5 bg-white/10 rounded-full overflow-hidden">
        <div id="plFill" class="h-full bg-teal-400 rounded-full transition-all duration-300 relative" style="width:0%">
          <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-white shadow-[0_0_6px_#2DC5A2]"></div>
        </div>
      </div>
      <div class="flex justify-between mt-2">
        <span class="text-white/20 text-xs font-light tracking-wider">Memuat sistem...</span>
        <span id="plPct" class="text-white/30 text-xs font-display font-semibold">0%</span>
      </div>
    </div>
    <!-- dots -->
    <div style="opacity:0;animation:fadeUp .6s .7s cubic-bezier(.22,1,.36,1) forwards" class="flex gap-2">
      <div class="w-1.5 h-1.5 rounded-full bg-teal-400" style="animation:pulse2 1.2s .0s ease-in-out infinite"></div>
      <div class="w-1.5 h-1.5 rounded-full bg-teal-400/60" style="animation:pulse2 1.2s .2s ease-in-out infinite"></div>
      <div class="w-1.5 h-1.5 rounded-full bg-teal-400/30" style="animation:pulse2 1.2s .4s ease-in-out infinite"></div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════
     APP SHELL
═══════════════════════════════════ -->
<div id="app" class="flex h-screen overflow-hidden">

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
          Katalog Produk
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

  <!-- ── MAIN ── -->
  <div class="flex-1 flex flex-col overflow-hidden">

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

    <!-- SCROLL AREA -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-6 space-y-5" id="main-scroll">

      <!-- ── ROW 1: HERO + IDEAS ── -->
      <div class="grid grid-cols-3 gap-5">
        <!-- Hero Banner -->
        <div class="col-span-2 hero-gradient rounded-2xl p-7 relative overflow-hidden rv" style="min-height:200px">
          <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle,rgba(255,255,255,.3)1px,transparent 1px);background-size:24px 24px;"></div>
          <div class="absolute -bottom-8 -right-8 w-48 h-48 rounded-full bg-white/5"></div>
          <div class="absolute -bottom-4 right-20 w-28 h-28 rounded-full bg-white/5"></div>
          <div class="relative z-10">
            <p class="text-white/70 text-sm font-medium mb-1">Selamat datang kembali,</p>
            <h2 class="font-display text-3xl font-bold text-white mb-1 leading-tight">
              👋 Halo, <span id="typedHero"></span><span class="typed-cursor"></span>
            </h2>
            <p class="text-white/60 text-sm font-light max-w-md mt-2 leading-relaxed">
              Selamat datang di Dashboard Admin TokoNusantara! Pantau penjualan, lacak kemajuan, dan dapatkan wawasan berharga.
            </p>
            <button class="mt-5 bg-white text-gray-800 text-sm font-semibold px-5 py-2 rounded-lg hover:bg-gray-100 transition-colors">
              Mulai Kelola →
            </button>
          </div>
        </div>

        <!-- Ideas card -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 rv" style="transition-delay:.1s">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-800">Ide untuk Anda</h3>
            <div class="flex gap-1">
              <button class="w-7 h-7 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition-colors">
                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2"/></svg>
              </button>
              <button class="w-7 h-7 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition-colors">
                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg>
              </button>
            </div>
          </div>
          <div class="space-y-4">
            <div class="p-4 bg-teal-50 rounded-xl border border-teal-100">
              <h4 class="font-semibold text-gray-800 text-sm mb-1">Buat Blog Post Produk</h4>
              <p class="text-xs text-gray-500 leading-relaxed">Tingkatkan visibilitas produk Anda dengan konten blog yang menarik dan SEO-friendly.</p>
              <button class="mt-3 text-xs font-semibold text-teal-600 bg-white border border-teal-200 px-3 py-1.5 rounded-lg hover:bg-teal-50 transition-colors">Baca Sekarang</button>
            </div>
            <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
              <h4 class="font-semibold text-gray-800 text-sm mb-1">Optimalkan Harga</h4>
              <p class="text-xs text-gray-500 leading-relaxed">Analisis kompetitor dan sesuaikan harga untuk meningkatkan konversi.</p>
              <button class="mt-3 text-xs font-semibold text-amber-700 bg-white border border-amber-200 px-3 py-1.5 rounded-lg hover:bg-amber-50 transition-colors">Lihat Tips</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ── ROW 2: 3 STAT CARDS ── -->
      <div class="grid grid-cols-3 gap-5">
        <!-- Orders -->
        <div class="stat-card bg-white rounded-2xl border border-gray-100 p-5 rv" data-d="0">
          <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
              <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5h12.8M9 19a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" stroke-width="2"/></svg>
            </div>
            <div class="flex items-center gap-1 text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" stroke-width="2.5"/></svg>
              2.29%
            </div>
          </div>
          <div class="text-xs text-gray-400 font-medium mb-1">Pesanan</div>
          <div class="font-display text-3xl font-bold text-gray-900">5,312</div>
          <div class="mt-4 h-14 chart-wrap"><canvas id="sparkOrders"></canvas></div>
        </div>

        <!-- Revenue -->
        <div class="stat-card bg-white rounded-2xl border border-gray-100 p-5 rv" data-d="1">
          <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center">
              <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
            </div>
            <div class="flex items-center gap-1 text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" stroke-width="2.5"/></svg>
              2.19%
            </div>
          </div>
          <div class="text-xs text-gray-400 font-medium mb-1">Pendapatan</div>
          <div class="font-display text-3xl font-bold text-gray-900">Rp 120jt</div>
          <div class="mt-4 h-14 chart-wrap"><canvas id="sparkRevenue"></canvas></div>
        </div>

        <!-- Conversion -->
        <div class="stat-card bg-white rounded-2xl border border-gray-100 p-5 rv" data-d="2">
          <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" stroke-width="2"/></svg>
            </div>
            <div class="flex items-center gap-1 text-xs font-semibold text-red-500 bg-red-50 px-2 py-1 rounded-full">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 17H5m0 0v-8m0 8l8-8 4 4 6-6" stroke-width="2.5"/></svg>
              3.19%
            </div>
          </div>
          <div class="text-xs text-gray-400 font-medium mb-1">Tingkat Konversi</div>
          <div class="font-display text-3xl font-bold text-gray-900">3.5%</div>
          <div class="mt-4 h-14 chart-wrap"><canvas id="sparkConv"></canvas></div>
        </div>
      </div>

      <!-- ── ROW 3: REVENUE CHART + DONUT ── -->
      <div class="grid grid-cols-3 gap-5">
        <!-- Revenue Line Chart -->
        <div class="col-span-2 bg-white rounded-2xl border border-gray-100 p-5 rv">
          <div class="flex items-start justify-between mb-5">
            <div>
              <h3 class="font-display text-base font-bold text-gray-900">Pendapatan</h3>
              <p class="text-xs text-gray-400 mt-0.5">Tren 7 bulan terakhir</p>
            </div>
            <div class="flex gap-3">
              <div class="flex items-center gap-2 text-xs">
                <div class="w-2.5 h-2.5 rounded-full bg-teal-400"></div>
                <span class="text-gray-500">Total Pemasukan</span>
                <span class="font-semibold text-gray-800">Rp 120jt</span>
              </div>
              <div class="flex items-center gap-2 text-xs">
                <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                <span class="text-gray-500">Total Pengeluaran</span>
                <span class="font-semibold text-gray-800">Rp 198jt</span>
              </div>
            </div>
          </div>
          <!-- inline legend boxes -->
          <div class="flex gap-4 mb-4">
            <div class="flex items-center gap-2 bg-teal-50 rounded-xl px-4 py-3">
              <div class="w-2 h-2 rounded-full bg-teal-400"></div>
              <div>
                <div class="text-xs text-gray-400">Total Pemasukan</div>
                <div class="font-display font-bold text-gray-900">Rp 120.000.000</div>
              </div>
            </div>
            <div class="flex items-center gap-2 bg-amber-50 rounded-xl px-4 py-3">
              <div class="w-2 h-2 rounded-full bg-amber-400"></div>
              <div>
                <div class="text-xs text-gray-400">Total Pengeluaran</div>
                <div class="font-display font-bold text-gray-900">Rp 198.214.000</div>
              </div>
            </div>
          </div>
          <div class="h-48 chart-wrap"><canvas id="revenueChart"></canvas></div>
        </div>

        <!-- Donut Product Sales -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 rv" style="transition-delay:.1s">
          <h3 class="font-display text-base font-bold text-gray-900 mb-4">Penjualan Produk</h3>
          <div class="relative h-44 flex items-center justify-center">
            <canvas id="donutChart"></canvas>
            <div class="donut-center">
              <div class="text-lg font-display font-bold text-gray-900">100%</div>
              <div class="text-xs text-gray-400">Total</div>
            </div>
          </div>
          <div class="mt-4 space-y-2">
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><div class="w-2.5 h-2.5 rounded-full bg-teal-400"></div><span class="text-gray-600">Smartphone</span></div>
              <div class="text-right"><span class="font-semibold text-gray-800">Rp 22,120</span> <span class="text-gray-400">38.1%</span></div>
            </div>
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div><span class="text-gray-600">Laptop</span></div>
              <div class="text-right"><span class="font-semibold text-gray-800">Rp 4,510</span> <span class="text-gray-400">28.6%</span></div>
            </div>
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><div class="w-2.5 h-2.5 rounded-full bg-blue-400"></div><span class="text-gray-600">Headphone</span></div>
              <div class="text-right"><span class="font-semibold text-gray-800">Rp 800</span> <span class="text-gray-400">23.8%</span></div>
            </div>
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><div class="w-2.5 h-2.5 rounded-full bg-red-400"></div><span class="text-gray-600">Kamera</span></div>
              <div class="text-right"><span class="font-semibold text-gray-800">Rp 420</span> <span class="text-gray-400">9.5%</span></div>
            </div>
          </div>
        </div>
      </div>

      <!-- ── ROW 4: ORDERS TABLE + REVENUE BY LOCATION ── -->
      <div class="grid grid-cols-3 gap-5">
        <!-- Orders Table -->
        <div class="col-span-2 bg-white rounded-2xl border border-gray-100 overflow-hidden rv">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="font-display text-base font-bold text-gray-900">Daftar Pesanan</h3>
            <button class="text-xs font-semibold text-teal-600 hover:text-teal-700 transition-colors">Lihat Semua →</button>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">ID Pesanan</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Jumlah</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Metode Kirim</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Tgl Terima</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody id="order-tbody"></tbody>
            </table>
          </div>
        </div>

        <!-- Revenue by Location -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 rv" style="transition-delay:.1s">
          <h3 class="font-display text-base font-bold text-gray-900 mb-4">Pendapatan per Wilayah</h3>
          <!-- simple world map SVG placeholder -->
          <div class="w-full h-28 bg-gray-50 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
            <svg viewBox="0 0 400 200" class="w-full h-full opacity-40" fill="none">
              <!-- simplified continents -->
              <ellipse cx="100" cy="90" rx="60" ry="45" fill="#2DC5A2" opacity=".3"/>
              <ellipse cx="210" cy="80" rx="90" ry="55" fill="#2DC5A2" opacity=".4"/>
              <ellipse cx="340" cy="100" rx="50" ry="40" fill="#2DC5A2" opacity=".25"/>
              <ellipse cx="250" cy="140" rx="40" ry="30" fill="#2DC5A2" opacity=".2"/>
              <!-- highlight dot -->
              <circle cx="220" cy="75" r="5" fill="#2DC5A2"/>
              <circle cx="330" cy="70" r="4" fill="#2DC5A2" opacity=".6"/>
              <circle cx="160" cy="95" r="3.5" fill="#f59e0b"/>
              <circle cx="215" cy="100" r="3" fill="#3b82f6" opacity=".7"/>
            </svg>
          </div>
          <div class="space-y-3">
            <div>
              <div class="flex justify-between text-xs mb-1.5">
                <span class="font-medium text-gray-700">Indonesia</span>
                <span class="font-semibold text-gray-900">Rp 22,120</span>
              </div>
              <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden"><div class="h-full bg-teal-400 rounded-full" style="width:85%"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs mb-1.5">
                <span class="font-medium text-gray-700">Malaysia</span>
                <span class="font-semibold text-gray-900">Rp 12,756</span>
              </div>
              <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden"><div class="h-full bg-teal-400 rounded-full" style="width:62%"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs mb-1.5">
                <span class="font-medium text-gray-700">Singapura</span>
                <span class="font-semibold text-gray-900">Rp 8,864</span>
              </div>
              <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden"><div class="h-full bg-amber-400 rounded-full" style="width:44%"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs mb-1.5">
                <span class="font-medium text-gray-700">Brunei</span>
                <span class="font-semibold text-gray-900">Rp 6,124</span>
              </div>
              <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden"><div class="h-full bg-amber-400 rounded-full" style="width:30%"></div></div>
            </div>
          </div>
        </div>
      </div>

      <!-- ── ROW 5: SALES BY GENDER + TOP PRODUCTS ── -->
      <div class="grid grid-cols-3 gap-5 pb-6">
        <!-- Sales by Gender donut -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 rv">
          <h3 class="font-display text-base font-bold text-gray-900 mb-4">Penjualan per Gender</h3>
          <div class="relative h-44 flex items-center justify-center">
            <canvas id="genderChart"></canvas>
            <div class="donut-center">
              <div class="text-base font-display font-bold text-gray-900">3 Segmen</div>
            </div>
          </div>
          <div class="flex justify-center gap-5 mt-4">
            <div class="flex items-center gap-1.5 text-xs"><div class="w-2.5 h-2.5 rounded-full bg-teal-400"></div><span class="text-gray-500">Pria</span></div>
            <div class="flex items-center gap-1.5 text-xs"><div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div><span class="text-gray-500">Wanita</span></div>
            <div class="flex items-center gap-1.5 text-xs"><div class="w-2.5 h-2.5 rounded-full bg-red-400"></div><span class="text-gray-500">femboy</span></div>
            <div class="flex items-center gap-1.5 text-xs"><div class="w-2.5 h-2.5 rounded-full bg-red-400"></div><span class="text-gray-500">Waria</span></div>
          </div>
        </div>

        <!-- Top Selling Products -->
        <div class="col-span-2 bg-white rounded-2xl border border-gray-100 overflow-hidden rv" style="transition-delay:.1s">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="font-display text-base font-bold text-gray-900">Produk Terlaris</h3>
            <button class="text-xs font-semibold text-teal-600 hover:text-teal-700 transition-colors">Lihat Semua →</button>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Produk</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Terjual</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pendapatan</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Rating</th>
                  <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                </tr>
              </thead>
              <tbody id="product-tbody"></tbody>
            </table>
          </div>
        </div>
      </div>

    </main><!-- /main-scroll -->
  </div><!-- /flex-1 -->
</div><!-- /app -->

<script>
/* ═══════════════════════════════
   LOADER
═══════════════════════════════ */
const plFill = document.getElementById('plFill');
const plPct  = document.getElementById('plPct');
let prog = 0;

const tick = setInterval(() => {
  prog = Math.min(prog + Math.random() * 13 + 3, 96);
  plFill.style.width = prog + '%';
  plPct.textContent  = Math.round(prog) + '%';
}, 200);

function boot() {
  clearInterval(tick);
  plFill.style.width = '100%';
  plPct.textContent  = '100%';
  setTimeout(() => {
    document.getElementById('loader').classList.add('exit');
    setTimeout(() => {
      document.getElementById('loader').style.display = 'none';
      document.getElementById('app').classList.add('ready');
      initTyped();
      initReveal();
      buildCharts();
      buildTables();
    }, 780);
  }, 350);
}

if (document.readyState === 'complete') { setTimeout(boot, 500); }
else { window.addEventListener('load', () => setTimeout(boot, 500)); }

/* ═══════════════════════════════
   TYPED
═══════════════════════════════ */
const heroWords = ['Admin!', 'TokoNusantara!', 'Pengelola Toko!'];
let hw = 0, hc = 0, hdel = false;
const heroEl = document.getElementById('typedHero');
function initTyped() { heroTick(); }
function heroTick() {
  const w = heroWords[hw];
  if (!hdel) {
    heroEl.textContent = w.slice(0, ++hc);
    if (hc === w.length) { hdel = true; setTimeout(heroTick, 2200); return; }
  } else {
    heroEl.textContent = w.slice(0, --hc);
    if (hc === 0) { hdel = false; hw = (hw + 1) % heroWords.length; }
  }
  setTimeout(heroTick, hdel ? 55 : 90);
}

/* ═══════════════════════════════
   SIDEBAR & NAV
═══════════════════════════════ */
let sideOpen = true;
function toggleSidebar() {
  sideOpen = !sideOpen;
  document.getElementById('sidebar').classList.toggle('collapsed', !sideOpen);
}
function setNav(el) {
  document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
  el.classList.add('active');
}

/* ═══════════════════════════════
   SCROLL REVEAL
═══════════════════════════════ */
function initReveal() {
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const d = parseInt(e.target.dataset.d || '0') * 80;
      setTimeout(() => e.target.classList.add('in'), d);
      io.unobserve(e.target);
    });
  }, { threshold: 0.08 });
  document.querySelectorAll('.rv, .rvl').forEach(el => io.observe(el));
}

/* ═══════════════════════════════
   CHARTS
═══════════════════════════════ */
function buildCharts() {
  const sparkOpts = (color) => ({
    type: 'line',
    data: {
      labels: Array(9).fill(''),
      datasets: [{ data: Array.from({length:9}, () => Math.random()*50+30),
        borderColor: color, borderWidth: 2, tension: .4,
        fill: true,
        backgroundColor: color.replace(')', ',.12)').replace('rgb', 'rgba'),
        pointRadius: 0 }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins:{ legend:{display:false}, tooltip:{enabled:false}}, scales:{ x:{display:false}, y:{display:false}} }
  });

  new Chart(document.getElementById('sparkOrders'),  sparkOpts('rgb(245,158,11)'));
  new Chart(document.getElementById('sparkRevenue'), sparkOpts('rgb(45,197,162)'));
  new Chart(document.getElementById('sparkConv'),    sparkOpts('rgb(59,130,246)'));

  // Revenue line chart
  new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul'],
      datasets: [
        { label:'Pemasukan', data:[30,40,32,52,47,100,95],
          borderColor:'#2DC5A2', borderWidth:2.5, tension:.4,
          fill:true, backgroundColor:'rgba(45,197,162,.08)',
          pointBackgroundColor:'#2DC5A2', pointRadius:4, pointHoverRadius:6 },
        { label:'Pengeluaran', data:[28,38,30,48,44,82,80],
          borderColor:'#f59e0b', borderWidth:2, tension:.4,
          fill:false, borderDash:[5,4],
          pointBackgroundColor:'#f59e0b', pointRadius:3, pointHoverRadius:5 }
      ]
    },
    options: {
      responsive:true, maintainAspectRatio:false,
      plugins:{ legend:{display:false}, tooltip:{ backgroundColor:'#fff', titleColor:'#1f2937', bodyColor:'#6b7280', borderColor:'#e5e7eb', borderWidth:1, padding:10, cornerRadius:10 }},
      scales:{
        x:{ grid:{display:false}, ticks:{ color:'#9ca3af', font:{size:11,family:'Plus Jakarta Sans'} } },
        y:{ grid:{ color:'rgba(0,0,0,.04)', drawBorder:false }, ticks:{ color:'#9ca3af', font:{size:11,family:'Plus Jakarta Sans'}, callback:v=>v+'k' } }
      }
    }
  });

  // Donut product sales
  new Chart(document.getElementById('donutChart'), {
    type:'doughnut',
    data:{
      datasets:[{ data:[38.1,28.6,23.8,9.5],
        backgroundColor:['#2DC5A2','#f59e0b','#60a5fa','#f87171'],
        borderWidth:0, hoverOffset:4, spacing:2 }]
    },
    options:{ responsive:true, maintainAspectRatio:false, cutout:'72%',
      plugins:{ legend:{display:false}, tooltip:{enabled:false}} }
  });

  // Gender donut
  new Chart(document.getElementById('genderChart'), {
    type:'doughnut',
    data:{
      datasets:[
        { data:[45,35,20], backgroundColor:['#2DC5A2','#f59e0b','#f87171'],
          borderWidth:0, hoverOffset:4, spacing:2 },
        { data:[40,30,30], backgroundColor:['rgba(45,197,162,.25)','rgba(245,158,11,.25)','rgba(248,113,113,.25)'],
          borderWidth:0, hoverOffset:2, spacing:2 }
      ]
    },
    options:{ responsive:true, maintainAspectRatio:false, cutout:'60%',
      plugins:{ legend:{display:false}, tooltip:{enabled:false}} }
  });
}

/* ═══════════════════════════════
   TABLES
═══════════════════════════════ */
function buildTables() {
  const orders = [
    { id:'#DU005', amount:'Rp 150rb', method:'Standar',    date:'20 Jan 2025', status:'Dikirim',  s:'shipped' },
    { id:'#DU004', amount:'Rp 200rb', method:'Ekspres',    date:'22 Jan 2025', status:'Proses',   s:'pending' },
    { id:'#DU003', amount:'Rp 300rb', method:'Same Day',   date:'18 Jan 2025', status:'Dibatal',  s:'cancelled' },
    { id:'#DU002', amount:'Rp 560rb', method:'Same Day',   date:'13 Jan 2025', status:'Selesai',  s:'completed' },
    { id:'#DU001', amount:'Rp 560rb', method:'Same Day',   date:'11 Jan 2025', status:'Selesai',  s:'completed' },
  ];
  const badgeMap = { shipped:'badge-shipped', pending:'badge-pending', cancelled:'badge-cancelled', completed:'badge-completed' };
  document.getElementById('order-tbody').innerHTML = orders.map(o => `
    <tr class="trow border-b border-gray-50 cursor-pointer transition-colors">
      <td class="px-5 py-3.5 text-sm font-semibold text-teal-600">${o.id}</td>
      <td class="px-5 py-3.5 text-sm text-gray-700">${o.amount}</td>
      <td class="px-5 py-3.5 text-sm text-gray-600">${o.method}</td>
      <td class="px-5 py-3.5 text-sm text-gray-500">${o.date}</td>
      <td class="px-5 py-3.5"><span class="text-xs font-semibold px-2.5 py-1 rounded-full ${badgeMap[o.s]}">${o.status}</span></td>
      <td class="px-5 py-3.5"><button class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-gray-200 hover:border-teal-300 hover:text-teal-600 hover:bg-teal-50 transition-colors">Lihat</button></td>
    </tr>
  `).join('');

  const prods = [
    { name:'Kacamata Transparan', emoji:'🕶️', sale:454, rev:'Rp 50jt', rating:'5/5', stock:'instock', lbl:'Tersedia' },
    { name:'Kacamata Vintage',    emoji:'👓', sale:454, rev:'Rp 50jt', rating:'5/5', stock:'instock', lbl:'Tersedia' },
    { name:'Frame Bulat',         emoji:'🥽', sale:124, rev:'Rp 30jt', rating:'4.0', stock:'lowstock', lbl:'Stok Sedikit' },
    { name:'Lensa Warna-warni',   emoji:'🕶️', sale:124, rev:'Rp 30jt', rating:'4.0', stock:'lowstock', lbl:'Stok Sedikit' },
    { name:'Frame Sporty',        emoji:'🥽', sale:124, rev:'Rp 30jt', rating:'4.0', stock:'lowstock', lbl:'Stok Sedikit' },
    { name:'Frame Premium',       emoji:'👓', sale:124, rev:'Rp 30jt', rating:'4.8', stock:'outstock', lbl:'Habis' },
  ];
  const stockMap = { instock:'badge-instock', lowstock:'badge-lowstock', outstock:'badge-outstock' };
  document.getElementById('product-tbody').innerHTML = prods.map(p => `
    <tr class="trow border-b border-gray-50 cursor-pointer transition-colors">
      <td class="px-5 py-3.5">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-lg flex-shrink-0">${p.emoji}</div>
          <span class="text-sm font-medium text-gray-800">${p.name}</span>
        </div>
      </td>
      <td class="px-5 py-3.5 text-sm text-gray-600">${p.sale}</td>
      <td class="px-5 py-3.5 text-sm font-semibold text-gray-800">${p.rev}</td>
      <td class="px-5 py-3.5"><span class="text-sm font-semibold text-amber-500">★ ${p.rating}</span></td>
      <td class="px-5 py-3.5"><span class="text-xs font-semibold px-2.5 py-1 rounded-full ${stockMap[p.stock]}">${p.lbl}</span></td>
    </tr>
  `).join('');
}
</script>
</body>
</html>