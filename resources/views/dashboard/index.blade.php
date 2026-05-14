<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TokoNusantara — Admin Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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

  <!-- NAVBAR -->
  @include('components.navbar')

  <!-- ── MAIN ── -->
  <div class="flex-1 flex flex-col overflow-hidden">

    <!-- TOPBAR -->
    @include('components.topbar')

    <!-- SCROLL AREA -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-6 space-y-5" id="main-scroll">

      <!-- ── ROW 1: HERO + IDEAS ── -->
      @include('dashboard.hero')

      <!-- ── ROW 2: 3 STAT CARDS ── -->
      @include('dashboard.stats')

      <!-- ── ROW 3: REVENUE CHART + DONUT ── -->
      <div class="grid grid-cols-3 gap-5">
        @include('dashboard.revenue-chart')
        @include('dashboard.product-sales-chart')
      </div>

      <!-- ── ROW 4: ORDERS TABLE + REVENUE BY LOCATION ── -->
      <div class="grid grid-cols-3 gap-5">
        @include('dashboard.orders-table')
        @include('dashboard.revenue-location')
      </div>

      <!-- ── ROW 5: SALES BY GENDER + TOP PRODUCTS ── -->
      <div class="grid grid-cols-3 gap-5 pb-6">
        @include('dashboard.gender-chart')
        @include('dashboard.top-products-table')
      </div>

    </main><!-- /main-scroll -->
  </div><!-- /flex-1 -->
</div><!-- /app -->

<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
