<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>TokoNusantara Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        ink:    '#0e1117',
        ink2:   '#1c2333',
        teal:   '#2DC5A2',
        'teal-d':'#1a9e82',
        'teal-l':'#e3f9f4',
        'teal-m':'#b2edde',
        cream:  '#f7f5f0',
        warm:   '#ede9e0',
        sand:   '#d4cfc5',
        coral:  '#ff6b6b',
        amber:  '#f5a623',
      },
      fontFamily: {
        display: ['Syne', 'sans-serif'],
        body:    ['DM Sans', 'sans-serif'],
      },
      borderRadius: {
        sm: '8px',
        md: '14px',
        lg: '20px',
        xl: '28px',
      },
      boxShadow: {
        sm: '0 2px 8px rgba(14,17,23,.06)',
        md: '0 8px 32px rgba(14,17,23,.10)',
        lg: '0 20px 60px rgba(14,17,23,.15)',
      },
      keyframes: {
        scanH:    { '0%,100%':{ top:'10%', opacity:'0' }, '50%':{ top:'50%', opacity:'1' } },
        scanV:    { '0%,100%':{ left:'10%', opacity:'0' }, '50%':{ left:'50%', opacity:'1' } },
        ringPulse:{ '0%,100%':{ opacity:'.15', transform:'translate(-50%,-50%) scale(1)' }, '50%':{ opacity:'.4', transform:'translate(-50%,-50%) scale(1.04)' } },
        plFadeUp: { from:{ opacity:'0', transform:'translateY(16px)' }, to:{ opacity:'1', transform:'translateY(0)' } },
        iconGlow: { '0%,100%':{ opacity:'.3', transform:'scale(1)' }, '50%':{ opacity:'1', transform:'scale(1.03)' } },
        blink:    { '0%,100%':{ opacity:'1' }, '50%':{ opacity:'0' } },
        edot:     { '0%,100%':{ transform:'scale(1)', opacity:'1' }, '50%':{ transform:'scale(1.6)', opacity:'.6' } },
        preloaderOut: { '0%':{ clipPath:'inset(0 0 0 0)' }, '100%':{ clipPath:'inset(0 0 100% 0)' } },
      },
      animation: {
        scanH:    'scanH 3s ease-in-out infinite',
        scanV:    'scanV 4s ease-in-out infinite',
        ring1:    'ringPulse 3s ease-in-out infinite 0s',
        ring2:    'ringPulse 3s ease-in-out infinite .4s',
        ring3:    'ringPulse 3s ease-in-out infinite .8s',
        ring4:    'ringPulse 3s ease-in-out infinite 1.2s',
        plFadeUp0:'plFadeUp .7s .1s cubic-bezier(.22,1,.36,1) both',
        plFadeUp1:'plFadeUp .7s .3s cubic-bezier(.22,1,.36,1) both',
        plFadeUp2:'plFadeUp .7s .5s cubic-bezier(.22,1,.36,1) both',
        plFadeUp3:'plFadeUp .7s .7s cubic-bezier(.22,1,.36,1) both',
        iconGlow: 'iconGlow 2s ease-in-out infinite',
        blink:    'blink 1s step-end infinite',
        edot:     'edot 2s ease-in-out infinite',
        preloaderOut: 'preloaderOut .8s cubic-bezier(.76,0,.24,1) forwards',
      },
    }
  }
}
</script>
<style>
  /* Minimal global resets not covered by Tailwind */
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }

  /* Clip-path animation for preloader exit */
  #preloader.out { animation: preloaderOut .8s cubic-bezier(.76,0,.24,1) forwards; }
  @keyframes preloaderOut {
    0%   { clip-path: inset(0 0 0 0); }
    100% { clip-path: inset(0 0 100% 0); }
  }

  /* Scroll reveal states */
  .rv   { opacity:0; transform:translateY(22px); transition:opacity .6s cubic-bezier(.22,1,.36,1), transform .6s cubic-bezier(.22,1,.36,1); }
  .rv-l { opacity:0; transform:translateX(-20px); transition:opacity .6s cubic-bezier(.22,1,.36,1), transform .6s cubic-bezier(.22,1,.36,1); }
  .rv.in, .rv-l.in { opacity:1; transform:none; }
</style>
</head>
<body class="font-body bg-cream text-ink overflow-x-hidden min-h-screen">

<!-- ══════════════════════════════════════════
     LOADING SCREEN
══════════════════════════════════════════ -->
<div id="preloader" class="fixed inset-0 z-[9999] bg-ink flex items-center justify-center flex-col">

  <!-- bg lines -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute h-px w-full bg-[rgba(45,197,162,.07)] animate-scanH" style="top:50%"></div>
    <div class="absolute w-px h-full bg-[rgba(45,197,162,.07)] animate-scanV" style="left:50%"></div>
  </div>

  <!-- rings -->
  <div class="absolute top-1/2 left-1/2">
    <div class="absolute w-40 h-40 rounded-full border border-[rgba(45,197,162,.15)] -translate-x-1/2 -translate-y-1/2 animate-ring1"></div>
    <div class="absolute w-[280px] h-[280px] rounded-full border border-[rgba(45,197,162,.15)] -translate-x-1/2 -translate-y-1/2 animate-ring2"></div>
    <div class="absolute w-[400px] h-[400px] rounded-full border border-[rgba(45,197,162,.15)] -translate-x-1/2 -translate-y-1/2 animate-ring3"></div>
    <div class="absolute w-[520px] h-[520px] rounded-full border border-[rgba(45,197,162,.15)] -translate-x-1/2 -translate-y-1/2 animate-ring4"></div>
  </div>

  <div class="relative z-10 flex flex-col items-center gap-7 text-center">

    <!-- logo -->
    <div class="animate-plFadeUp0">
      <div class="relative">
        <div class="w-16 h-16 bg-teal rounded-[18px] flex items-center justify-center relative">
          <div class="absolute inset-[-6px] border border-[rgba(45,197,162,.3)] rounded-[22px] animate-iconGlow"></div>
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- wordmark -->
    <div class="animate-plFadeUp1">
      <h1 class="font-display text-[32px] font-extrabold text-white tracking-[-0.5px]">Niga<span class="text-teal">Store</span></h1>
      <p class="text-[12px] font-light text-white/35 tracking-[.2em] uppercase mt-1">Admin Management System</p>
    </div>

    <!-- progress -->
    <div class="w-60 animate-plFadeUp2">
      <div class="w-full h-0.5 bg-white/[.08] rounded-full overflow-hidden relative">
        <div id="plFill" class="h-full w-0 bg-teal rounded-full transition-[width] duration-300 ease-out relative">
          <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-white shadow-[0_0_8px_#2DC5A2]"></div>
        </div>
      </div>
      <div id="plPct" class="font-display text-[11px] font-semibold text-white/35 text-right mt-2 tracking-[.05em]">0%</div>
    </div>

    <!-- status -->
    <div class="animate-plFadeUp3 text-[12px] font-light text-white/25 tracking-[.12em] uppercase">
      Memuat sistem<span class="text-teal animate-blink">_</span>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════
     APP
══════════════════════════════════════════ -->
<div id="app" class="min-h-screen opacity-0 translate-y-2 transition-[opacity,transform] duration-500 ease-out">

  <!-- NAV -->
  <nav class="h-[62px] bg-white border-b border-warm flex items-center px-8 gap-0 sticky top-0 z-[200]">
    <div class="flex items-center gap-2.5 mr-10 shrink-0">
      <div class="w-[34px] h-[34px] bg-ink rounded-[9px] flex items-center justify-center">
        <svg class="w-[18px] h-[18px] text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <span class="font-display text-[16px] font-extrabold text-ink tracking-[-0.3px]">Niga<span class="text-teal">Store</span></span>
    </div>

    <div class="hidden md:flex items-center gap-0.5 flex-1">
      <button class="nav-link h-9 px-3.5 rounded-sm font-body text-[13px] font-semibold bg-ink text-white border-none cursor-pointer transition-all whitespace-nowrap" onclick="setNav(this)">Dashboard</button>
      <button class="nav-link h-9 px-3.5 rounded-sm font-body text-[13px] font-medium text-[#6b7280] border-none bg-transparent cursor-pointer transition-all whitespace-nowrap hover:bg-cream hover:text-ink" onclick="setNav(this)">Katalog</button>
      <button class="nav-link h-9 px-3.5 rounded-sm font-body text-[13px] font-medium text-[#6b7280] border-none bg-transparent cursor-pointer transition-all whitespace-nowrap hover:bg-cream hover:text-ink" onclick="setNav(this)">Pesanan</button>
      <button class="nav-link h-9 px-3.5 rounded-sm font-body text-[13px] font-medium text-[#6b7280] border-none bg-transparent cursor-pointer transition-all whitespace-nowrap hover:bg-cream hover:text-ink" onclick="setNav(this)">Laporan</button>
      <button class="nav-link h-9 px-3.5 rounded-sm font-body text-[13px] font-medium text-[#6b7280] border-none bg-transparent cursor-pointer transition-all whitespace-nowrap hover:bg-cream hover:text-ink" onclick="setNav(this)">Pengaturan</button>
    </div>

    <div class="flex items-center gap-2.5 ml-auto shrink-0">
      <div class="flex items-center gap-2 h-9 px-3 bg-cream rounded-sm border border-warm cursor-text transition-all focus-within:bg-white focus-within:border-teal focus-within:shadow-[0_0_0_3px_rgba(45,197,162,.12)]">
        <svg class="w-3.5 h-3.5 text-[#9ca3af] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"/>
        </svg>
        <input type="text" placeholder="Cari produk, pesanan..." class="border-none bg-transparent outline-none font-body text-[13px] text-ink w-[150px] placeholder:text-[#9ca3af]"/>
      </div>
      <button class="w-9 h-9 rounded-sm bg-cream border border-warm flex items-center justify-center cursor-pointer transition-all relative hover:bg-white hover:border-sand">
        <svg class="w-4 h-4 text-[#6b7280]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M15 17H9m6 0a3 3 0 11-6 0m6 0H9M5.07 9A7 7 0 1118.93 9C19.5 13 21 14 21 15H3c0-1 1.5-2 2.07-6z" stroke-width="2"/>
        </svg>
        <span class="absolute top-[7px] right-[7px] w-[7px] h-[7px] rounded-full bg-coral border-[1.5px] border-white"></span>
      </button>
      <div class="flex items-center gap-2 h-9 px-1.5 bg-cream border border-warm rounded-full cursor-pointer transition-all hover:bg-white hover:border-sand">
        <div class="w-[26px] h-[26px] rounded-full bg-ink flex items-center justify-center font-display text-[11px] font-bold text-teal">AD</div>
        <span class="text-[13px] font-medium text-ink pr-1">Admin</span>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="bg-ink px-8 relative overflow-hidden min-h-[360px] grid md:grid-cols-2 items-stretch">
    <!-- bg grid -->
    <div class="absolute inset-0" style="background-image:linear-gradient(rgba(45,197,162,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(45,197,162,.04) 1px,transparent 1px);background-size:40px 40px"></div>
    <div class="absolute bottom-[-200px] right-[-100px] w-[500px] h-[500px] rounded-full border border-[rgba(45,197,162,.08)]"></div>
    <div class="absolute bottom-[-120px] right-[-20px] w-[300px] h-[300px] rounded-full border border-[rgba(45,197,162,.12)]"></div>
    <div class="absolute top-[-60px] right-[20%] w-[280px] h-[280px] rounded-full" style="background:radial-gradient(circle,rgba(45,197,162,.08) 0%,transparent 70%)"></div>

    <!-- left -->
    <div class="py-12 pr-10 relative z-10 flex flex-col justify-center gap-0 border-r border-white/[.06] max-md:pr-0 max-md:border-none max-md:py-10">
      <div class="inline-flex items-center gap-2 mb-5">
        <div class="w-2 h-2 rounded-full bg-teal animate-edot"></div>
        <span class="font-body text-[11px] font-semibold text-white/40 tracking-[.14em] uppercase">Admin Panel — Live Session</span>
      </div>

      <div class="mb-6">
        <h1 class="font-display text-[52px] font-extrabold leading-[.95] tracking-[-2px] text-white max-sm:text-[36px]">
          <span class="block">Selamat</span>
          <span class="block text-teal">Datang,</span>
          <span class="block" style="-webkit-text-stroke:1.5px rgba(255,255,255,.25);color:transparent">Admin.</span>
        </h1>
      </div>

      <div class="flex items-center gap-2.5 mb-7">
        <span class="text-[12px] font-light text-white/30 tracking-[.08em]">Mode aktif —</span>
        <span id="typedText" class="font-display text-[13px] font-bold text-teal tracking-[.04em]"></span>
        <span class="inline-block w-0.5 h-[.9em] bg-teal ml-0.5 align-middle animate-blink"></span>
      </div>

      <p class="text-[14px] font-light text-white/40 leading-[1.7] max-w-[380px] mb-8">
        Pantau kinerja toko, kelola produk, dan analisis penjualan secara real-time dari satu pusat kendali.
      </p>

      <div class="flex items-center gap-3">
        <button onclick="document.getElementById('main-content').scrollIntoView({behavior:'smooth'})"
          class="h-[42px] px-6 bg-teal text-ink font-body text-[13px] font-bold border-none rounded-sm cursor-pointer flex items-center gap-2 transition-all hover:-translate-y-px hover:bg-teal-d hover:shadow-[0_8px_24px_rgba(45,197,162,.35)]">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
          Buka Dashboard
        </button>
        <button class="h-[42px] px-5 bg-white/[.06] text-white/60 font-body text-[13px] font-medium border border-white/10 rounded-sm cursor-pointer transition-all hover:bg-white/10 hover:text-white hover:border-white/20">
          Lihat Laporan
        </button>
      </div>
    </div>

    <!-- right stats -->
    <div class="hidden md:flex py-12 pl-10 relative z-10 flex-col justify-center gap-3.5">
      <div class="bg-white/[.04] border border-white/[.07] rounded-md px-5 py-4.5 flex items-center gap-4.5 cursor-default transition-all hover:bg-white/[.07] hover:border-teal/20 hover:translate-x-1" style="padding-top:18px;padding-bottom:18px">
        <div class="w-11 h-11 rounded-xl bg-[rgba(45,197,162,.15)] flex items-center justify-center shrink-0">
          <svg class="w-5 h-5 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2"/></svg>
        </div>
        <div class="flex-1">
          <div class="font-display text-[26px] font-extrabold text-white leading-none tracking-[-0.5px]">248</div>
          <div class="text-[12px] font-light text-white/35 mt-0.5">Produk Aktif</div>
        </div>
        <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[rgba(45,197,162,.15)] text-teal">+12</span>
      </div>

      <div class="bg-white/[.04] border border-white/[.07] rounded-md px-5 flex items-center gap-4.5 cursor-default transition-all hover:bg-white/[.07] hover:border-teal/20 hover:translate-x-1" style="padding-top:18px;padding-bottom:18px">
        <div class="w-11 h-11 rounded-xl bg-[rgba(255,107,107,.12)] flex items-center justify-center shrink-0">
          <svg class="w-5 h-5 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5h12.8M9 19a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" stroke-width="2"/></svg>
        </div>
        <div class="flex-1">
          <div class="font-display text-[26px] font-extrabold text-white leading-none tracking-[-0.5px]">57</div>
          <div class="text-[12px] font-light text-white/35 mt-0.5">Pesanan Hari Ini</div>
        </div>
        <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[rgba(45,197,162,.15)] text-teal">+8%</span>
      </div>

      <div class="bg-white/[.04] border border-white/[.07] rounded-md px-5 flex items-center gap-4.5 cursor-default transition-all hover:bg-white/[.07] hover:border-teal/20 hover:translate-x-1" style="padding-top:18px;padding-bottom:18px">
        <div class="w-11 h-11 rounded-xl bg-[rgba(245,166,35,.12)] flex items-center justify-center shrink-0">
          <svg class="w-5 h-5 text-amber" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
        </div>
        <div class="flex-1">
          <div class="font-display text-[26px] font-extrabold text-white leading-none tracking-[-0.5px]">Rp 124jt</div>
          <div class="text-[12px] font-light text-white/35 mt-0.5">Pendapatan Bulan Ini</div>
        </div>
        <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[rgba(45,197,162,.15)] text-teal">+23%</span>
      </div>

      <div class="bg-white/[.04] border border-white/[.07] rounded-md px-5 flex items-center gap-4.5 cursor-default transition-all hover:bg-white/[.07] hover:border-teal/20 hover:translate-x-1" style="padding-top:18px;padding-bottom:18px">
        <div class="w-11 h-11 rounded-xl bg-[rgba(59,130,246,.12)] flex items-center justify-center shrink-0">
          <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" stroke-width="2"/></svg>
        </div>
        <div class="flex-1">
          <div class="font-display text-[26px] font-extrabold text-white leading-none tracking-[-0.5px]">1.4rb</div>
          <div class="text-[12px] font-light text-white/35 mt-0.5">Pengguna Aktif</div>
        </div>
        <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[rgba(45,197,162,.15)] text-teal">+5%</span>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <div id="main-content" class="grid gap-6 p-7 max-w-[1440px] items-start md:grid-cols-[256px_1fr] max-md:grid-cols-1 max-md:px-5">

    <!-- SIDEBAR -->
    <aside class="rv-l flex flex-col gap-3.5" id="sidebar">
      <!-- categories -->
      <div class="bg-white border border-warm rounded-lg p-5 shadow-sm">
        <div class="text-[10px] font-bold text-sand tracking-[.14em] uppercase mb-3">Kategori Produk</div>
        <div id="cat-list">
          <div class="cat-item flex items-center gap-2.5 px-3 py-2.5 rounded-sm cursor-pointer transition-all bg-ink" onclick="setCat(this,'Semua')">
            <div class="w-2 h-2 rounded-full bg-teal shrink-0 transition-colors"></div>
            <span class="text-[13px] font-semibold text-white flex-1 transition-colors">Semua Produk</span>
            <span class="text-[11px] font-bold bg-[rgba(45,197,162,.15)] text-teal px-2 py-0.5 rounded-full">248</span>
          </div>
          <div class="cat-item flex items-center gap-2.5 px-3 py-2.5 rounded-sm cursor-pointer transition-all hover:bg-cream" onclick="setCat(this,'Elektronik')">
            <div class="w-2 h-2 rounded-full bg-warm shrink-0"></div>
            <span class="text-[13px] font-medium text-[#6b7280] flex-1">Elektronik</span>
            <span class="text-[11px] font-bold bg-cream text-[#9ca3af] px-2 py-0.5 rounded-full">84</span>
          </div>
          <div class="cat-item flex items-center gap-2.5 px-3 py-2.5 rounded-sm cursor-pointer transition-all hover:bg-cream" onclick="setCat(this,'Kebutuhan')">
            <div class="w-2 h-2 rounded-full bg-warm shrink-0"></div>
            <span class="text-[13px] font-medium text-[#6b7280] flex-1">Kebutuhan Pokok</span>
            <span class="text-[11px] font-bold bg-cream text-[#9ca3af] px-2 py-0.5 rounded-full">62</span>
          </div>
          <div class="cat-item flex items-center gap-2.5 px-3 py-2.5 rounded-sm cursor-pointer transition-all hover:bg-cream" onclick="setCat(this,'Fashion')">
            <div class="w-2 h-2 rounded-full bg-warm shrink-0"></div>
            <span class="text-[13px] font-medium text-[#6b7280] flex-1">Fashion Pria</span>
            <span class="text-[11px] font-bold bg-cream text-[#9ca3af] px-2 py-0.5 rounded-full">47</span>
          </div>
          <div class="cat-item flex items-center gap-2.5 px-3 py-2.5 rounded-sm cursor-pointer transition-all hover:bg-cream" onclick="setCat(this,'Alat')">
            <div class="w-2 h-2 rounded-full bg-warm shrink-0"></div>
            <span class="text-[13px] font-medium text-[#6b7280] flex-1">Alat Tulis</span>
            <span class="text-[11px] font-bold bg-cream text-[#9ca3af] px-2 py-0.5 rounded-full">31</span>
          </div>
        </div>
      </div>

      <!-- upgrade -->
      <div class="rv-l bg-ink rounded-lg p-5 relative overflow-hidden" style="transition-delay:.08s">
        <div class="absolute top-[-40px] right-[-40px] w-[130px] h-[130px] rounded-full border border-[rgba(45,197,162,.2)]"></div>
        <div class="absolute top-[-20px] right-[-20px] w-20 h-20 rounded-full bg-[rgba(45,197,162,.06)]"></div>
        <div class="text-[10px] font-bold text-teal tracking-[.14em] uppercase mb-2.5">⭐ Premium</div>
        <div class="font-display text-[18px] font-extrabold text-white leading-[1.2] tracking-[-0.3px] mb-2">Harga Distributor Eksklusif</div>
        <div class="text-[12px] font-light text-white/40 leading-[1.6] mb-4.5" style="margin-bottom:18px">Hemat hingga 35% untuk semua kategori produk pilihan kami.</div>
        <button class="w-full h-[38px] bg-teal text-ink font-body text-[12px] font-bold border-none rounded-sm cursor-pointer transition-all hover:bg-teal-d hover:-translate-y-px">Upgrade Sekarang</button>
      </div>

      <!-- store status -->
      <div class="rv-l bg-white border border-warm rounded-lg p-5 shadow-sm" style="transition-delay:.14s">
        <div class="text-[10px] font-bold text-sand tracking-[.14em] uppercase mb-3">Status Toko</div>
        <div class="flex items-center justify-between py-2 border-b border-cream">
          <span class="text-[12px] font-normal text-[#9ca3af]">Stok menipis</span>
          <span class="text-[12px] font-bold text-amber">3 item</span>
        </div>
        <div class="flex items-center justify-between py-2 border-b border-cream">
          <span class="text-[12px] font-normal text-[#9ca3af]">Perlu dikemas</span>
          <span class="text-[12px] font-bold text-teal">12 item</span>
        </div>
        <div class="flex items-center justify-between py-2 border-b border-cream">
          <span class="text-[12px] font-normal text-[#9ca3af]">Ulasan baru</span>
          <span class="text-[12px] font-bold text-ink">7 ulasan</span>
        </div>
        <div class="flex items-center justify-between py-2">
          <span class="text-[12px] font-normal text-[#9ca3af]">Rating toko</span>
          <span class="text-[12px] font-bold text-ink">4.9 / 5.0</span>
        </div>
      </div>
    </aside>

    <!-- CONTENT -->
    <div class="flex flex-col gap-5">

      <!-- page header -->
      <div class="rv flex items-start justify-between gap-4 flex-wrap" id="ph">
        <div>
          <div class="font-display text-[26px] font-extrabold text-ink tracking-[-0.5px]">Katalog <em class="not-italic text-teal">Utama</em></div>
          <div class="text-[13px] font-normal text-[#9ca3af] mt-0.5">Kelola dan telusuri semua produk yang tersedia</div>
        </div>
        <div class="flex items-center gap-2">
          <button class="h-[38px] px-4 rounded-sm border border-warm font-body text-[12px] font-semibold bg-white text-[#6b7280] cursor-pointer flex items-center gap-1.5 transition-all hover:border-sand hover:text-ink">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 4h18M7 12h10M11 20h2" stroke-width="2" stroke-linecap="round"/></svg>
            Filter
          </button>
          <button class="h-[38px] px-4 rounded-sm border border-ink font-body text-[12px] font-semibold bg-ink text-white cursor-pointer flex items-center gap-1.5 transition-all hover:bg-ink2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round"/></svg>
            Tambah Produk
          </button>
        </div>
      </div>

      <!-- stat cards -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5">
        <!-- card 1 -->
        <div class="rv bg-white border border-warm rounded-lg p-5 relative overflow-hidden shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5 hover:border-teal-m" data-d="0">
          <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-lg bg-teal"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-[38px] h-[38px] rounded-[10px] bg-teal-l flex items-center justify-center">
              <svg class="w-[18px] h-[18px] text-teal-d" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2"/></svg>
            </div>
            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[#f0fdf4] text-[#15803d]">+12 baru</span>
          </div>
          <div class="font-display text-[28px] font-extrabold text-ink tracking-[-0.5px] leading-none">248</div>
          <div class="text-[12px] font-normal text-[#9ca3af] mt-1">Total Produk</div>
          <div class="flex items-end gap-0.5 h-8 mt-3.5 border-t border-cream pt-3" id="sp0"></div>
        </div>
        <!-- card 2 -->
        <div class="rv bg-white border border-warm rounded-lg p-5 relative overflow-hidden shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5 hover:border-teal-m" data-d="1">
          <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-lg bg-coral"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-[38px] h-[38px] rounded-[10px] bg-[#fff0f0] flex items-center justify-center">
              <svg class="w-[18px] h-[18px] text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5h12.8M9 19a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" stroke-width="2"/></svg>
            </div>
            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[#f0fdf4] text-[#15803d]">+8%</span>
          </div>
          <div class="font-display text-[28px] font-extrabold text-ink tracking-[-0.5px] leading-none">57</div>
          <div class="text-[12px] font-normal text-[#9ca3af] mt-1">Pesanan Hari Ini</div>
          <div class="flex items-end gap-0.5 h-8 mt-3.5 border-t border-cream pt-3" id="sp1"></div>
        </div>
        <!-- card 3 -->
        <div class="rv bg-white border border-warm rounded-lg p-5 relative overflow-hidden shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5 hover:border-teal-m" data-d="2">
          <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-lg bg-amber"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-[38px] h-[38px] rounded-[10px] bg-[#fef3dc] flex items-center justify-center">
              <svg class="w-[18px] h-[18px] text-amber" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
            </div>
            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[#f0fdf4] text-[#15803d]">+23%</span>
          </div>
          <div class="font-display text-[28px] font-extrabold text-ink tracking-[-0.5px] leading-none">Rp 124jt</div>
          <div class="text-[12px] font-normal text-[#9ca3af] mt-1">Pendapatan Bulan Ini</div>
          <div class="flex items-end gap-0.5 h-8 mt-3.5 border-t border-cream pt-3" id="sp2"></div>
        </div>
        <!-- card 4 -->
        <div class="rv bg-white border border-warm rounded-lg p-5 relative overflow-hidden shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5 hover:border-teal-m" data-d="3">
          <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-lg bg-blue-500"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-[38px] h-[38px] rounded-[10px] bg-[#eff6ff] flex items-center justify-center">
              <svg class="w-[18px] h-[18px] text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" stroke-width="2"/></svg>
            </div>
            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-[#f0fdf4] text-[#15803d]">+5%</span>
          </div>
          <div class="font-display text-[28px] font-extrabold text-ink tracking-[-0.5px] leading-none">1.4rb</div>
          <div class="text-[12px] font-normal text-[#9ca3af] mt-1">Pengguna Aktif</div>
          <div class="flex items-end gap-0.5 h-8 mt-3.5 border-t border-cream pt-3" id="sp3"></div>
        </div>
      </div>

      <!-- products panel -->
      <div class="rv bg-white border border-warm rounded-xl overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-cream flex items-center justify-between gap-4 flex-wrap">
          <div>
            <h3 class="font-display text-[17px] font-bold text-ink tracking-[-0.2px]">Daftar Produk</h3>
            <p class="text-[12px] text-[#9ca3af] mt-0.5">Menampilkan <span id="prod-count">8</span> produk</p>
          </div>
          <div class="flex items-center gap-2">
            <div class="flex bg-cream rounded-sm p-[3px] gap-0.5" id="tab-group">
              <button class="h-[30px] px-3 rounded-[6px] font-body text-[12px] font-semibold text-ink bg-white border-none cursor-pointer transition-all shadow-[0_1px_3px_rgba(0,0,0,.08)]" onclick="setTab(this)">Semua</button>
              <button class="h-[30px] px-3 rounded-[6px] font-body text-[12px] font-medium text-[#9ca3af] bg-transparent border-none cursor-pointer transition-all hover:text-ink" onclick="setTab(this)">Terlaris</button>
              <button class="h-[30px] px-3 rounded-[6px] font-body text-[12px] font-medium text-[#9ca3af] bg-transparent border-none cursor-pointer transition-all hover:text-ink" onclick="setTab(this)">Terbaru</button>
            </div>
          </div>
        </div>
        <div class="p-5 grid gap-3.5" id="prod-grid" style="grid-template-columns:repeat(auto-fill,minmax(150px,1fr))"></div>
      </div>

      <!-- bottom row -->
      <div class="grid gap-4 md:grid-cols-[1.4fr_1fr]">
        <!-- chart -->
        <div class="rv bg-white border border-warm rounded-lg p-5 shadow-sm">
          <div class="font-display text-[15px] font-bold text-ink tracking-[-0.2px] mb-1">Tren Penjualan</div>
          <div class="text-[12px] text-[#9ca3af] mb-5">Performa 7 hari terakhir</div>
          <div class="flex items-end gap-2.5 h-[100px]" id="chart"></div>
          <div class="flex items-center gap-4 mt-4 pt-4 border-t border-cream">
            <div class="flex items-center gap-1.5">
              <div class="w-2.5 h-2.5 rounded-[3px] bg-teal"></div>
              <span class="text-[11px] font-medium text-[#9ca3af]">Penjualan</span>
            </div>
            <div class="flex items-center gap-1.5">
              <div class="w-2.5 h-2.5 rounded-[3px] bg-cream border border-warm"></div>
              <span class="text-[11px] font-medium text-[#9ca3af]">Target</span>
            </div>
            <div class="font-display text-[13px] font-bold text-ink ml-auto">Rp 88.4jt minggu ini</div>
          </div>
        </div>

        <!-- activity -->
        <div class="rv bg-white border border-warm rounded-lg p-5 shadow-sm" style="transition-delay:.1s">
          <div class="font-display text-[15px] font-bold text-ink tracking-[-0.2px] mb-1">Aktivitas Terbaru</div>
          <div class="text-[12px] text-[#9ca3af] mb-5">Update real-time sistem</div>
          <div class="flex flex-col">

            <div class="flex items-start gap-3 py-[11px] border-b border-cream transition-all hover:pl-1">
              <div class="w-[34px] h-[34px] rounded-[10px] bg-teal-l flex items-center justify-center shrink-0 mt-px">
                <svg class="w-[15px] h-[15px] text-teal-d" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round"/></svg>
              </div>
              <div class="flex-1">
                <div class="text-[13px] font-medium text-ink leading-[1.4]">Pesanan #1892 dikonfirmasi</div>
                <div class="text-[11px] font-normal text-[#9ca3af] mt-0.5">Transfer — Rp 4.200.000</div>
              </div>
              <div class="text-[11px] font-medium text-[#9ca3af] whitespace-nowrap mt-0.5">2 mnt lalu</div>
            </div>

            <div class="flex items-start gap-3 py-[11px] border-b border-cream transition-all hover:pl-1">
              <div class="w-[34px] h-[34px] rounded-[10px] bg-[#fff0f0] flex items-center justify-center shrink-0 mt-px">
                <svg class="w-[15px] h-[15px] text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke-width="2"/></svg>
              </div>
              <div class="flex-1">
                <div class="text-[13px] font-medium text-ink leading-[1.4]">Stok SSD NVMe hampir habis</div>
                <div class="text-[11px] font-normal text-[#9ca3af] mt-0.5">Tersisa 3 unit saja</div>
              </div>
              <div class="text-[11px] font-medium text-[#9ca3af] whitespace-nowrap mt-0.5">15 mnt lalu</div>
            </div>

            <div class="flex items-start gap-3 py-[11px] border-b border-cream transition-all hover:pl-1">
              <div class="w-[34px] h-[34px] rounded-[10px] bg-[#eff6ff] flex items-center justify-center shrink-0 mt-px">
                <svg class="w-[15px] h-[15px] text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
              </div>
              <div class="flex-1">
                <div class="text-[13px] font-medium text-ink leading-[1.4]">14 pengguna baru terdaftar</div>
                <div class="text-[11px] font-normal text-[#9ca3af] mt-0.5">Target harian 93% tercapai</div>
              </div>
              <div class="text-[11px] font-medium text-[#9ca3af] whitespace-nowrap mt-0.5">1 jam lalu</div>
            </div>

            <div class="flex items-start gap-3 py-[11px] transition-all hover:pl-1">
              <div class="w-[34px] h-[34px] rounded-[10px] bg-[#fef3dc] flex items-center justify-center shrink-0 mt-px">
                <svg class="w-[15px] h-[15px] text-amber" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" stroke-width="2"/></svg>
              </div>
              <div class="flex-1">
                <div class="text-[13px] font-medium text-ink leading-[1.4]">Ulasan bintang 5 diterima</div>
                <div class="text-[11px] font-normal text-[#9ca3af] mt-0.5">Untuk produk Laptop Pro M1</div>
              </div>
              <div class="text-[11px] font-medium text-[#9ca3af] whitespace-nowrap mt-0.5">3 jam lalu</div>
            </div>

          </div>
        </div>
      </div>

    </div><!-- /content -->
  </div><!-- /main-wrap -->

</div><!-- /app -->

<script>
/* ════════════════════════════
   LOADER
════════════════════════════ */
const fill = document.getElementById('plFill');
const pct  = document.getElementById('plPct');
let progress = 0;

const ticker = setInterval(() => {
  const step = Math.random() * 14 + 3;
  progress = Math.min(progress + step, 96);
  fill.style.width = progress + '%';
  pct.textContent  = Math.round(progress) + '%';
}, 220);

function launchApp() {
  clearInterval(ticker);
  fill.style.width = '100%';
  pct.textContent  = '100%';

  setTimeout(() => {
    document.getElementById('preloader').classList.add('out');
    setTimeout(() => {
      document.getElementById('preloader').style.display = 'none';
      const app = document.getElementById('app');
      app.style.opacity = '1';
      app.style.transform = 'translateY(0)';
      initTyped();
      initReveal();
    }, 800);
  }, 300);
}

if (document.readyState === 'complete') {
  setTimeout(launchApp, 600);
} else {
  window.addEventListener('load', () => setTimeout(launchApp, 600));
}

/* ════════════════════════════
   TYPED
════════════════════════════ */
const phrases = ['Dashboard Admin', 'Pusat Kontrol', 'Manajemen Produk', 'Laporan Real-time'];
let pi = 0, ci = 0, erasing = false;
const typedEl = document.getElementById('typedText');

function initTyped() { runTyped(); }
function runTyped() {
  const ph = phrases[pi];
  if (!erasing) {
    typedEl.textContent = ph.slice(0, ++ci);
    if (ci === ph.length) { erasing = true; setTimeout(runTyped, 2200); return; }
  } else {
    typedEl.textContent = ph.slice(0, --ci);
    if (ci === 0) { erasing = false; pi = (pi + 1) % phrases.length; }
  }
  setTimeout(runTyped, erasing ? 50 : 90);
}

/* ════════════════════════════
   NAV
════════════════════════════ */
function setNav(el) {
  document.querySelectorAll('.nav-link').forEach(b => {
    b.className = 'nav-link h-9 px-3.5 rounded-sm font-body text-[13px] font-medium text-[#6b7280] border-none bg-transparent cursor-pointer transition-all whitespace-nowrap hover:bg-cream hover:text-ink';
  });
  el.className = 'nav-link h-9 px-3.5 rounded-sm font-body text-[13px] font-semibold bg-ink text-white border-none cursor-pointer transition-all whitespace-nowrap';
}

/* ════════════════════════════
   TABS
════════════════════════════ */
function setTab(el) {
  document.querySelectorAll('#tab-group button').forEach(b => {
    b.className = 'h-[30px] px-3 rounded-[6px] font-body text-[12px] font-medium text-[#9ca3af] bg-transparent border-none cursor-pointer transition-all hover:text-ink';
  });
  el.className = 'h-[30px] px-3 rounded-[6px] font-body text-[12px] font-semibold text-ink bg-white border-none cursor-pointer transition-all shadow-[0_1px_3px_rgba(0,0,0,.08)]';
}

/* ════════════════════════════
   SPARKLINES
════════════════════════════ */
const sparkData = [
  [3,5,4,7,5,8,6,9,7,10],
  [5,4,6,5,7,4,8,6,9,7],
  [4,6,5,8,7,9,8,10,9,11],
  [6,5,7,6,8,7,9,8,10,9],
];
sparkData.forEach((data, i) => {
  const mx = Math.max(...data);
  const el = document.getElementById('sp' + i);
  const hi = data.indexOf(mx);
  el.innerHTML = data.map((v, j) =>
    `<div class="flex-1 rounded-t-[3px] min-h-1 transition-colors ${j === hi ? 'bg-teal' : 'bg-cream'}" style="height:${Math.round(v/mx*28)}px"></div>`
  ).join('');
});

/* ════════════════════════════
   PRODUCTS
════════════════════════════ */
const products = [
  { n:'Laptop Pro M1',       p:'Rp 14.5jt', i:'💻', c:'Elektronik' },
  { n:'Mechanical Keyboard', p:'Rp 850rb',  i:'⌨️', c:'Elektronik' },
  { n:'Wireless Mouse',      p:'Rp 320rb',  i:'🖱️', c:'Elektronik' },
  { n:'Monitor 4K 27"',      p:'Rp 4.2jt',  i:'🖥️', c:'Elektronik' },
  { n:'Smartwatch Gen-5',    p:'Rp 2.1jt',  i:'⌚', c:'Elektronik' },
  { n:'Headset Gaming',      p:'Rp 750rb',  i:'🎧', c:'Elektronik' },
  { n:'USB-C Hub 7in1',      p:'Rp 450rb',  i:'🔌', c:'Elektronik' },
  { n:'SSD NVMe 1TB',        p:'Rp 1.2jt',  i:'💾', c:'Elektronik' },
];

let curCat = 'Semua';

function renderProds() {
  const grid = document.getElementById('prod-grid');
  const list = products.filter(p => curCat === 'Semua' || p.c.startsWith(curCat));
  document.getElementById('prod-count').textContent = list.length;

  grid.innerHTML = list.map((p, i) => `
    <div class="prod-card border border-[#f3f0eb] rounded-md p-3.5 cursor-pointer transition-all relative overflow-hidden hover:border-teal-m hover:shadow-[0_8px_28px_rgba(45,197,162,.15)] hover:-translate-y-[3px] hover:scale-[1.01]"
         style="opacity:0;transform:translateY(14px) scale(.97);transition:opacity .4s ${i*45}ms cubic-bezier(.22,1,.36,1),transform .4s ${i*45}ms cubic-bezier(.22,1,.36,1),box-shadow .2s,border-color .2s">
      <div class="aspect-square bg-cream rounded-[10px] flex items-center justify-center text-[30px] mb-3 transition-colors hover-parent-img relative z-10">${p.i}</div>
      <div class="text-[11px] font-semibold text-[#9ca3af] uppercase tracking-[.06em] mb-1.5 truncate relative z-10">${p.n}</div>
      <div class="flex items-center justify-between relative z-10">
        <span class="font-display text-[15px] font-extrabold text-ink">${p.p}</span>
        <button class="prod-add-btn w-7 h-7 rounded-[8px] bg-cream border-none cursor-pointer flex items-center justify-center transition-all" onclick="event.stopPropagation()">
          <svg class="w-[13px] h-[13px] text-[#9ca3af]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
    </div>
  `).join('');

  requestAnimationFrame(() => requestAnimationFrame(() => {
    grid.querySelectorAll('.prod-card').forEach(c => {
      c.style.opacity = '1';
      c.style.transform = 'translateY(0) scale(1)';
    });
  }));
}

function setCat(el, cat) {
  document.querySelectorAll('.cat-item').forEach(r => {
    r.className = 'cat-item flex items-center gap-2.5 px-3 py-2.5 rounded-sm cursor-pointer transition-all hover:bg-cream';
    r.querySelector('div').className = 'w-2 h-2 rounded-full bg-warm shrink-0';
    r.querySelector('span:first-of-type').className = 'text-[13px] font-medium text-[#6b7280] flex-1';
    r.querySelector('span:last-of-type').className = 'text-[11px] font-bold bg-cream text-[#9ca3af] px-2 py-0.5 rounded-full';
  });
  el.className = 'cat-item flex items-center gap-2.5 px-3 py-2.5 rounded-sm cursor-pointer transition-all bg-ink';
  el.querySelector('div').className = 'w-2 h-2 rounded-full bg-teal shrink-0';
  el.querySelector('span:first-of-type').className = 'text-[13px] font-semibold text-white flex-1';
  el.querySelector('span:last-of-type').className = 'text-[11px] font-bold bg-[rgba(45,197,162,.15)] text-teal px-2 py-0.5 rounded-full';
  curCat = cat;
  renderProds();
}

/* ════════════════════════════
   BAR CHART
════════════════════════════ */
const days = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];
const vals = [42, 65, 38, 72, 55, 88, 60];
const maxV = Math.max(...vals);

document.getElementById('chart').innerHTML = days.map((d, i) => `
  <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
    <div class="w-full rounded-t-[6px] transition-all relative overflow-hidden ${i === 5 ? 'bg-teal' : 'bg-cream'}" style="height:${Math.round(vals[i]/maxV*90)}px">
      ${i === 5 ? '<div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-[6px] bg-white/40"></div>' : ''}
    </div>
    <span class="text-[10px] font-semibold text-[#9ca3af]">${d}</span>
  </div>
`).join('');

/* ════════════════════════════
   SCROLL REVEAL
════════════════════════════ */
function initReveal() {
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const el = e.target;
      const d  = parseInt(el.dataset.d || '0') * 80;
      setTimeout(() => el.classList.add('in'), d);
      io.unobserve(el);
    });
  }, { threshold: 0.1 });
  document.querySelectorAll('.rv, .rv-l').forEach(el => io.observe(el));
}

/* ════════════════════════════
   INIT
════════════════════════════ */
renderProds();
</script>
</body>
</html>