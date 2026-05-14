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
