/* ═══════════════════════════════
   LOADER
═══════════════════════════════ */
const plFill = document.getElementById('plFill');
const plPct = document.getElementById('plPct');
let prog = 0;

const tick = setInterval(() => {
  prog = Math.min(prog + Math.random() * 13 + 3, 96);
  plFill.style.width = prog + '%';
  plPct.textContent = Math.round(prog) + '%';
}, 200);

function boot() {
  clearInterval(tick);
  plFill.style.width = '100%';
  plPct.textContent = '100%';
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

if (document.readyState === 'complete') {
  setTimeout(boot, 500);
} else {
  window.addEventListener('load', () => setTimeout(boot, 500));
}

/* ═══════════════════════════════
   TYPED
═══════════════════════════════ */
const heroWords = ['Admin!', 'TokoNusantara!', 'Pengelola Toko!'];
let hw = 0, hc = 0, hdel = false;
const heroEl = document.getElementById('typedHero');

function initTyped() {
  heroTick();
}

function heroTick() {
  const w = heroWords[hw];
  if (!hdel) {
    heroEl.textContent = w.slice(0, ++hc);
    if (hc === w.length) {
      hdel = true;
      setTimeout(heroTick, 2200);
      return;
    }
  } else {
    heroEl.textContent = w.slice(0, --hc);
    if (hc === 0) {
      hdel = false;
      hw = (hw + 1) % heroWords.length;
    }
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
  }, {
    threshold: 0.08
  });
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
      datasets: [{
        data: Array.from({
          length: 9
        }, () => Math.random() * 50 + 30),
        borderColor: color,
        borderWidth: 2,
        tension: .4,
        fill: true,
        backgroundColor: color.replace(')', ',.12)').replace('rgb', 'rgba'),
        pointRadius: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      },
      scales: {
        x: {
          display: false
        },
        y: {
          display: false
        }
      }
    }
  });

  new Chart(document.getElementById('sparkOrders'), sparkOpts('rgb(245,158,11)'));
  new Chart(document.getElementById('sparkRevenue'), sparkOpts('rgb(45,197,162)'));
  new Chart(document.getElementById('sparkConv'), sparkOpts('rgb(59,130,246)'));

  // Revenue line chart
  new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
      datasets: [{
        label: 'Pemasukan',
        data: [30, 40, 32, 52, 47, 100, 95],
        borderColor: '#2DC5A2',
        borderWidth: 2.5,
        tension: .4,
        fill: true,
        backgroundColor: 'rgba(45,197,162,.08)',
        pointBackgroundColor: '#2DC5A2',
        pointRadius: 4,
        pointHoverRadius: 6
      }, {
        label: 'Pengeluaran',
        data: [28, 38, 30, 48, 44, 82, 80],
        borderColor: '#f59e0b',
        borderWidth: 2,
        tension: .4,
        fill: false,
        borderDash: [5, 4],
        pointBackgroundColor: '#f59e0b',
        pointRadius: 3,
        pointHoverRadius: 5
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          backgroundColor: '#fff',
          titleColor: '#1f2937',
          bodyColor: '#6b7280',
          borderColor: '#e5e7eb',
          borderWidth: 1,
          padding: 10,
          cornerRadius: 10
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          },
          ticks: {
            color: '#9ca3af',
            font: {
              size: 11,
              family: 'Plus Jakarta Sans'
            }
          }
        },
        y: {
          grid: {
            color: 'rgba(0,0,0,.04)',
            drawBorder: false
          },
          ticks: {
            color: '#9ca3af',
            font: {
              size: 11,
              family: 'Plus Jakarta Sans'
            },
            callback: v => v + 'k'
          }
        }
      }
    }
  });

  // Donut product sales
  new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [38.1, 28.6, 23.8, 9.5],
        backgroundColor: ['#2DC5A2', '#f59e0b', '#60a5fa', '#f87171'],
        borderWidth: 0,
        hoverOffset: 4,
        spacing: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '72%',
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      }
    }
  });

  // Gender donut
  new Chart(document.getElementById('genderChart'), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [45, 35, 20],
        backgroundColor: ['#2DC5A2', '#f59e0b', '#f87171'],
        borderWidth: 0,
        hoverOffset: 4,
        spacing: 2
      }, {
        data: [40, 30, 30],
        backgroundColor: ['rgba(45,197,162,.25)', 'rgba(245,158,11,.25)', 'rgba(248,113,113,.25)'],
        borderWidth: 0,
        hoverOffset: 2,
        spacing: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '60%',
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      }
    }
  });
}

/* ═══════════════════════════════
   TABLES
═══════════════════════════════ */
function buildTables() {
  const orders = [{
    id: '#DU005',
    amount: 'Rp 150rb',
    method: 'Standar',
    date: '20 Jan 2025',
    status: 'Dikirim',
    s: 'shipped'
  }, {
    id: '#DU004',
    amount: 'Rp 200rb',
    method: 'Ekspres',
    date: '22 Jan 2025',
    status: 'Proses',
    s: 'pending'
  }, {
    id: '#DU003',
    amount: 'Rp 300rb',
    method: 'Same Day',
    date: '18 Jan 2025',
    status: 'Dibatal',
    s: 'cancelled'
  }, {
    id: '#DU002',
    amount: 'Rp 560rb',
    method: 'Same Day',
    date: '13 Jan 2025',
    status: 'Selesai',
    s: 'completed'
  }, {
    id: '#DU001',
    amount: 'Rp 560rb',
    method: 'Same Day',
    date: '11 Jan 2025',
    status: 'Selesai',
    s: 'completed'
  }, ];

  const badgeMap = {
    shipped: 'badge-shipped',
    pending: 'badge-pending',
    cancelled: 'badge-cancelled',
    completed: 'badge-completed'
  };

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

  const prods = [{
    name: 'Kacamata Transparan',
    emoji: '🕶️',
    sale: 454,
    rev: 'Rp 50jt',
    rating: '5/5',
    stock: 'instock',
    lbl: 'Tersedia'
  }, {
    name: 'Kacamata Vintage',
    emoji: '👓',
    sale: 454,
    rev: 'Rp 50jt',
    rating: '5/5',
    stock: 'instock',
    lbl: 'Tersedia'
  }, {
    name: 'Frame Bulat',
    emoji: '🥽',
    sale: 124,
    rev: 'Rp 30jt',
    rating: '4.0',
    stock: 'lowstock',
    lbl: 'Stok Sedikit'
  }, {
    name: 'Lensa Warna-warni',
    emoji: '🕶️',
    sale: 124,
    rev: 'Rp 30jt',
    rating: '4.0',
    stock: 'lowstock',
    lbl: 'Stok Sedikit'
  }, {
    name: 'Frame Sporty',
    emoji: '🥽',
    sale: 124,
    rev: 'Rp 30jt',
    rating: '4.0',
    stock: 'lowstock',
    lbl: 'Stok Sedikit'
  }, {
    name: 'Frame Premium',
    emoji: '👓',
    sale: 124,
    rev: 'Rp 30jt',
    rating: '4.8',
    stock: 'outstock',
    lbl: 'Habis'
  }, ];

  const stockMap = {
    instock: 'badge-instock',
    lowstock: 'badge-lowstock',
    outstock: 'badge-outstock'
  };

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
