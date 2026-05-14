<!-- Stat Cards Row -->
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
