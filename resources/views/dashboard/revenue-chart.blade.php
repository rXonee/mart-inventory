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
