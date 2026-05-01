<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>TokoNusantara Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>

<style>
:root {
  --ink:      #0e1117;
  --ink2:     #1c2333;
  --teal:     #2DC5A2;
  --teal-d:   #1a9e82;
  --teal-l:   #e3f9f4;
  --teal-m:   #b2eddE;
  --cream:    #f7f5f0;
  --warm:     #ede9e0;
  --sand:     #d4cfc5;
  --coral:    #ff6b6b;
  --amber:    #f5a623;
  --blue:     #3b82f6;
  --white:    #ffffff;
  --r-sm:     8px;
  --r-md:     14px;
  --r-lg:     20px;
  --r-xl:     28px;
  --shadow-sm: 0 2px 8px rgba(14,17,23,.06);
  --shadow-md: 0 8px 32px rgba(14,17,23,.10);
  --shadow-lg: 0 20px 60px rgba(14,17,23,.15);
  --f-display: 'Syne', sans-serif;
  --f-body:    'DM Sans', sans-serif;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

body {
  font-family: var(--f-body);
  background: var(--cream);
  color: var(--ink);
  overflow-x: hidden;
  min-height: 100vh;
}

/* ══════════════════════════════════════════
   LOADING SCREEN
══════════════════════════════════════════ */
#preloader {
  position: fixed; inset: 0; z-index: 9999;
  background: var(--ink);
  display: flex; align-items: center; justify-content: center;
  flex-direction: column;
}

.pl-canvas {
  position: absolute; inset: 0; overflow: hidden;
}
.pl-line {
  position: absolute;
  background: rgba(45,197,162,.07);
  transform-origin: center;
}
.pl-line-h { height: 1px; width: 100%; top: 50%; animation: scanH 3s ease-in-out infinite; }
.pl-line-v { width: 1px; height: 100%; left: 50%; animation: scanV 4s ease-in-out infinite; }
@keyframes scanH { 0%,100%{top:10%;opacity:0} 50%{top:50%;opacity:1} }
@keyframes scanV { 0%,100%{left:10%;opacity:0} 50%{left:50%;opacity:1} }

.pl-rings {
  position: absolute; top: 50%; left: 50%;
  transform: translate(-50%,-50%);
}
.pl-ring {
  position: absolute;
  border-radius: 50%;
  border: 1px solid rgba(45,197,162,.15);
  transform: translate(-50%,-50%);
  animation: ringPulse 3s ease-in-out infinite;
}
.pl-ring:nth-child(1){width:160px;height:160px;animation-delay:0s;}
.pl-ring:nth-child(2){width:280px;height:280px;animation-delay:.4s;}
.pl-ring:nth-child(3){width:400px;height:400px;animation-delay:.8s;}
.pl-ring:nth-child(4){width:520px;height:520px;animation-delay:1.2s;}
@keyframes ringPulse {
  0%,100%{opacity:.15;transform:translate(-50%,-50%) scale(1);}
  50%{opacity:.4;transform:translate(-50%,-50%) scale(1.04);}
}

.pl-center {
  position: relative; z-index: 2;
  display: flex; flex-direction: column;
  align-items: center; gap: 28px;
  text-align: center;
}

.pl-logo-wrap {
  position: relative;
  opacity: 0;
  animation: plFadeUp .7s .1s cubic-bezier(.22,1,.36,1) forwards;
}
.pl-logo-icon {
  width: 64px; height: 64px;
  background: var(--teal);
  border-radius: 18px;
  display: flex; align-items: center; justify-content: center;
  position: relative;
}
.pl-logo-icon::before {
  content: '';
  position: absolute; inset: -6px;
  border: 1px solid rgba(45,197,162,.3);
  border-radius: 22px;
  animation: iconGlow 2s ease-in-out infinite;
}
@keyframes iconGlow {
  0%,100%{opacity:.3;transform:scale(1);}
  50%{opacity:1;transform:scale(1.03);}
}
.pl-logo-icon svg { width: 32px; height: 32px; color: var(--white); }

.pl-wordmark {
  opacity: 0;
  animation: plFadeUp .7s .3s cubic-bezier(.22,1,.36,1) forwards;
}
.pl-wordmark h1 {
  font-family: var(--f-display);
  font-size: 32px; font-weight: 800;
  color: var(--white);
  letter-spacing: -0.5px;
}
.pl-wordmark h1 span { color: var(--teal); }
.pl-wordmark p {
  font-size: 12px; font-weight: 300;
  color: rgba(255,255,255,.35);
  letter-spacing: .2em; text-transform: uppercase;
  margin-top: 4px;
}

.pl-progress-wrap {
  width: 240px;
  opacity: 0;
  animation: plFadeUp .7s .5s cubic-bezier(.22,1,.36,1) forwards;
}
.pl-progress-track {
  width: 100%; height: 2px;
  background: rgba(255,255,255,.08);
  border-radius: 100px;
  overflow: hidden;
  position: relative;
}
.pl-progress-fill {
  height: 100%; width: 0%;
  background: var(--teal);
  border-radius: 100px;
  transition: width .3s ease;
  position: relative;
}
.pl-progress-fill::after {
  content: '';
  position: absolute; right: 0; top: 50%;
  transform: translateY(-50%);
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--white);
  box-shadow: 0 0 8px var(--teal);
}
.pl-pct {
  font-family: var(--f-display);
  font-size: 11px; font-weight: 600;
  color: rgba(255,255,255,.35);
  text-align: right;
  margin-top: 8px;
  letter-spacing: .05em;
}

.pl-status {
  font-size: 12px; font-weight: 300;
  color: rgba(255,255,255,.25);
  letter-spacing: .12em; text-transform: uppercase;
  opacity: 0;
  animation: plFadeUp .7s .7s cubic-bezier(.22,1,.36,1) forwards;
}
.pl-status span {
  color: var(--teal);
  animation: blink 1s step-end infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

#preloader.out {
  animation: preloaderOut .8s cubic-bezier(.76,0,.24,1) forwards;
}
@keyframes preloaderOut {
  0%   { clip-path: inset(0 0 0 0); }
  100% { clip-path: inset(0 0 100% 0); }
}

@keyframes plFadeUp {
  from { opacity:0; transform: translateY(16px); }
  to   { opacity:1; transform: translateY(0); }
}

/* ══════════════════════════════════════════
   APP SHELL
══════════════════════════════════════════ */
#app {
  min-height: 100vh;
  opacity: 0; 
  transform: translateY(8px);
  transition: opacity .6s ease, transform .6s ease;
}
#app.ready { opacity: 1; transform: translateY(0); }

/* ══════════════════════════════════════════
   TOPNAV
══════════════════════════════════════════ */
.topnav {
  height: 62px;
  background: var(--white);
  border-bottom: 1px solid var(--warm);
  display: flex; align-items: center;
  padding: 0 32px;
  gap: 0;
  position: sticky; top: 0; z-index: 200;
}

.nav-brand {
  display: flex; align-items: center; gap: 10px;
  margin-right: 40px; flex-shrink: 0;
}
.nav-brand-icon {
  width: 34px; height: 34px;
  background: var(--ink);
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
}
.nav-brand-icon svg { width: 18px; height: 18px; color: var(--teal); }
.nav-brand-name {
  font-family: var(--f-display);
  font-size: 16px; font-weight: 800;
  color: var(--ink); letter-spacing: -.3px;
}
.nav-brand-name em { font-style: normal; color: var(--teal); }

.nav-links {
  display: flex; align-items: center;
  gap: 2px; flex: 1;
}
.nav-link {
  height: 36px; padding: 0 14px;
  border-radius: var(--r-sm);
  font-family: var(--f-body);
  font-size: 13px; font-weight: 500;
  color: #6b7280; border: none;
  background: transparent; cursor: pointer;
  transition: all .15s; white-space: nowrap;
}
.nav-link:hover { background: var(--cream); color: var(--ink); }
.nav-link.on {
  background: var(--ink); color: var(--white);
  font-weight: 600;
}

.nav-right {
  display: flex; align-items: center; gap: 10px;
  margin-left: auto; flex-shrink: 0;
}

.nav-search {
  display: flex; align-items: center; gap: 8px;
  height: 36px; padding: 0 12px;
  background: var(--cream); border-radius: var(--r-sm);
  border: 1px solid var(--warm);
  cursor: text; transition: all .15s;
}
.nav-search:focus-within {
  background: var(--white); border-color: var(--teal);
  box-shadow: 0 0 0 3px rgba(45,197,162,.12);
}
.nav-search svg { width: 14px; height: 14px; color: #9ca3af; flex-shrink: 0; }
.nav-search input {
  border: none; background: transparent; outline: none;
  font-family: var(--f-body); font-size: 13px;
  color: var(--ink); width: 150px;
}
.nav-search input::placeholder { color: #9ca3af; }

.nav-icon-btn {
  width: 36px; height: 36px; border-radius: var(--r-sm);
  background: var(--cream); border: 1px solid var(--warm);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all .15s; position: relative;
}
.nav-icon-btn:hover { background: var(--white); border-color: var(--sand); }
.nav-icon-btn svg { width: 16px; height: 16px; color: #6b7280; }
.nav-notif-dot {
  position: absolute; top: 7px; right: 7px;
  width: 7px; height: 7px; border-radius: 50%;
  background: var(--coral); border: 1.5px solid var(--white);
}

.nav-user {
  display: flex; align-items: center; gap: 8px;
  height: 36px; padding: 0 6px 0 6px;
  background: var(--cream); border: 1px solid var(--warm);
  border-radius: 100px; cursor: pointer; transition: all .15s;
}
.nav-user:hover { background: var(--white); border-color: var(--sand); }
.nav-avatar {
  width: 26px; height: 26px; border-radius: 50%;
  background: var(--ink);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--f-display); font-size: 11px;
  font-weight: 700; color: var(--teal);
}
.nav-user-name {
  font-size: 13px; font-weight: 500;
  color: var(--ink); padding-right: 4px;
}

/* ══════════════════════════════════════════
   HERO — EDITORIAL STYLE
══════════════════════════════════════════ */
.hero {
  background: var(--ink);
  padding: 0 32px;
  position: relative;
  overflow: hidden;
  min-height: 360px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: stretch;
}

/* Decorative bg elements */
.hero-bg-grid {
  position: absolute; inset: 0;
  background-image:
    linear-gradient(rgba(45,197,162,.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(45,197,162,.04) 1px, transparent 1px);
  background-size: 40px 40px;
}
.hero-bg-arc {
  position: absolute;
  bottom: -200px; right: -100px;
  width: 500px; height: 500px;
  border-radius: 50%;
  border: 1px solid rgba(45,197,162,.08);
}
.hero-bg-arc2 {
  position: absolute;
  bottom: -120px; right: -20px;
  width: 300px; height: 300px;
  border-radius: 50%;
  border: 1px solid rgba(45,197,162,.12);
}
.hero-bg-blob {
  position: absolute;
  top: -60px; right: 20%;
  width: 280px; height: 280px;
  background: radial-gradient(circle, rgba(45,197,162,.08) 0%, transparent 70%);
}

.hero-left {
  padding: 48px 40px 48px 0;
  position: relative; z-index: 1;
  display: flex; flex-direction: column;
  justify-content: center; gap: 0;
  border-right: 1px solid rgba(255,255,255,.06);
}

.hero-eyebrow {
  display: inline-flex; align-items: center; gap: 8px;
  margin-bottom: 20px;
}
.hero-eyebrow-dot {
  width: 8px; height: 8px; border-radius: 50%;
  background: var(--teal);
  animation: edot 2s ease-in-out infinite;
}
@keyframes edot {
  0%,100%{transform:scale(1);opacity:1;}
  50%{transform:scale(1.6);opacity:.6;}
}
.hero-eyebrow span {
  font-family: var(--f-body);
  font-size: 11px; font-weight: 600;
  color: rgba(255,255,255,.4);
  letter-spacing: .14em; text-transform: uppercase;
}

.hero-title-block { margin-bottom: 24px; }
.hero-title {
  font-family: var(--f-display);
  font-size: 52px; font-weight: 800;
  line-height: .95; letter-spacing: -2px;
  color: var(--white);
}
.hero-title .tline-teal { color: var(--teal); display: block; }
.hero-title .tline-outline {
  -webkit-text-stroke: 1.5px rgba(255,255,255,.25);
  color: transparent; display: block;
}

.hero-typed-row {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 28px;
}
.hero-typed-label {
  font-size: 12px; font-weight: 400;
  color: rgba(255,255,255,.3);
  letter-spacing: .08em;
}
.hero-typed-val {
  font-family: var(--f-display);
  font-size: 13px; font-weight: 700;
  color: var(--teal);
  letter-spacing: .04em;
}
.typed-cur {
  display: inline-block;
  width: 2px; height: .9em;
  background: var(--teal);
  margin-left: 2px; vertical-align: middle;
  animation: blink 1s step-end infinite;
}

.hero-sub {
  font-size: 14px; font-weight: 300;
  color: rgba(255,255,255,.4);
  line-height: 1.7; max-width: 380px;
  margin-bottom: 32px;
}

.hero-actions { display: flex; align-items: center; gap: 12px; }
.hero-btn-primary {
  height: 42px; padding: 0 24px;
  background: var(--teal); color: var(--ink);
  font-family: var(--f-body); font-size: 13px; font-weight: 700;
  border: none; border-radius: var(--r-sm);
  cursor: pointer; display: flex; align-items: center; gap: 8px;
  transition: all .2s;
}
.hero-btn-primary:hover {
  background: #25b090; transform: translateY(-1px);
  box-shadow: 0 8px 24px rgba(45,197,162,.35);
}
.hero-btn-primary svg { width: 16px; height: 16px; }
.hero-btn-ghost {
  height: 42px; padding: 0 20px;
  background: rgba(255,255,255,.06);
  color: rgba(255,255,255,.6);
  font-family: var(--f-body); font-size: 13px; font-weight: 500;
  border: 1px solid rgba(255,255,255,.1); border-radius: var(--r-sm);
  cursor: pointer; transition: all .2s;
}
.hero-btn-ghost:hover {
  background: rgba(255,255,255,.1);
  color: var(--white); border-color: rgba(255,255,255,.2);
}

/* hero right — stat panel */
.hero-right {
  padding: 48px 0 48px 40px;
  position: relative; z-index: 1;
  display: flex; flex-direction: column;
  justify-content: center; gap: 14px;
}

.hero-stat-card {
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: var(--r-md);
  padding: 18px 22px;
  display: flex; align-items: center; gap: 18px;
  transition: all .2s;
  cursor: default;
}
.hero-stat-card:hover {
  background: rgba(255,255,255,.07);
  border-color: rgba(45,197,162,.2);
  transform: translateX(4px);
}
.hsc-icon {
  width: 44px; height: 44px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.hsc-icon svg { width: 20px; height: 20px; }
.hsc-icon.teal { background: rgba(45,197,162,.15); color: var(--teal); }
.hsc-icon.coral { background: rgba(255,107,107,.12); color: var(--coral); }
.hsc-icon.amber { background: rgba(245,166,35,.12); color: var(--amber); }
.hsc-icon.blue  { background: rgba(59,130,246,.12); color: var(--blue); }
.hsc-body { flex: 1; }
.hsc-val {
  font-family: var(--f-display);
  font-size: 26px; font-weight: 800;
  color: var(--white); line-height: 1;
  letter-spacing: -0.5px;
}
.hsc-lbl {
  font-size: 12px; font-weight: 400;
  color: rgba(255,255,255,.35); margin-top: 3px;
}
.hsc-badge {
  font-size: 11px; font-weight: 700;
  padding: 3px 9px; border-radius: 100px;
  letter-spacing: .03em;
}
.hsc-badge.up { background: rgba(45,197,162,.15); color: var(--teal); }
.hsc-badge.dn { background: rgba(255,107,107,.15); color: var(--coral); }

/* ══════════════════════════════════════════
   SCROLL REVEAL
══════════════════════════════════════════ */
.rv {
  opacity: 0; transform: translateY(22px);
  transition: opacity .6s cubic-bezier(.22,1,.36,1),
              transform .6s cubic-bezier(.22,1,.36,1);
}
.rv.in { opacity: 1; transform: translateY(0); }
.rv-l {
  opacity: 0; transform: translateX(-20px);
  transition: opacity .6s cubic-bezier(.22,1,.36,1),
              transform .6s cubic-bezier(.22,1,.36,1);
}
.rv-l.in { opacity: 1; transform: translateX(0); }

/* ══════════════════════════════════════════
   MAIN LAYOUT
══════════════════════════════════════════ */
.main-wrap {
  display: grid;
  grid-template-columns: 256px 1fr;
  gap: 24px;
  padding: 28px 32px;
  max-width: 1440px;
  align-items: start;
}

/* ══════════════════════════════════════════
   SIDEBAR
══════════════════════════════════════════ */
.sidebar { display: flex; flex-direction: column; gap: 14px; }

.sb-card {
  background: var(--white);
  border: 1px solid var(--warm);
  border-radius: var(--r-lg);
  padding: 20px;
  box-shadow: var(--shadow-sm);
}

.sb-section-label {
  font-size: 10px; font-weight: 700;
  color: var(--sand); letter-spacing: .14em;
  text-transform: uppercase; margin-bottom: 12px;
}

.cat-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 12px; border-radius: var(--r-sm);
  cursor: pointer; transition: all .15s;
}
.cat-item:hover { background: var(--cream); }
.cat-item.on { background: var(--ink); }
.cat-item-pip {
  width: 8px; height: 8px; border-radius: 50%;
  background: var(--warm); flex-shrink: 0;
  transition: background .15s;
}
.cat-item.on .cat-item-pip { background: var(--teal); }
.cat-item-name {
  font-size: 13px; font-weight: 500;
  color: #6b7280; flex: 1;
  transition: color .15s;
}
.cat-item.on .cat-item-name { color: var(--white); font-weight: 600; }
.cat-item-count {
  font-size: 11px; font-weight: 700;
  background: var(--cream); color: #9ca3af;
  padding: 2px 8px; border-radius: 100px;
  transition: all .15s;
}
.cat-item.on .cat-item-count { background: rgba(45,197,162,.15); color: var(--teal); }

/* upgrade banner */
.sb-upgrade {
  background: var(--ink);
  border-radius: var(--r-lg);
  padding: 22px 20px;
  position: relative; overflow: hidden;
}
.sb-upgrade::before {
  content: '';
  position: absolute;
  top: -40px; right: -40px;
  width: 130px; height: 130px;
  border-radius: 50%;
  border: 1px solid rgba(45,197,162,.2);
}
.sb-upgrade::after {
  content: '';
  position: absolute;
  top: -20px; right: -20px;
  width: 80px; height: 80px;
  border-radius: 50%;
  background: rgba(45,197,162,.06);
}
.up-eyebrow {
  font-size: 10px; font-weight: 700;
  color: var(--teal); letter-spacing: .14em;
  text-transform: uppercase; margin-bottom: 10px;
}
.up-headline {
  font-family: var(--f-display);
  font-size: 18px; font-weight: 800;
  color: var(--white); line-height: 1.2;
  letter-spacing: -.3px; margin-bottom: 8px;
}
.up-desc {
  font-size: 12px; font-weight: 300;
  color: rgba(255,255,255,.4);
  line-height: 1.6; margin-bottom: 18px;
}
.up-cta {
  width: 100%;
  height: 38px;
  background: var(--teal); color: var(--ink);
  font-family: var(--f-body); font-size: 12px;
  font-weight: 700; border: none; border-radius: var(--r-sm);
  cursor: pointer; transition: all .2s;
}
.up-cta:hover { background: #25b090; transform: translateY(-1px); }

.sb-status-row {
  display: flex; align-items: center;
  justify-content: space-between; padding: 8px 0;
  border-bottom: 1px solid var(--cream);
}
.sb-status-row:last-child { border-bottom: none; }
.sb-status-lbl { font-size: 12px; font-weight: 400; color: #9ca3af; }
.sb-status-val { font-size: 12px; font-weight: 700; }
.sv-teal { color: var(--teal); }
.sv-amber { color: var(--amber); }
.sv-ink { color: var(--ink); }

/* ══════════════════════════════════════════
   CONTENT AREA
══════════════════════════════════════════ */
.content { display: flex; flex-direction: column; gap: 20px; }

/* page header */
.page-header {
  display: flex; align-items: flex-start;
  justify-content: space-between; gap: 16px;
  flex-wrap: wrap;
}
.ph-title {
  font-family: var(--f-display);
  font-size: 26px; font-weight: 800;
  color: var(--ink); letter-spacing: -0.5px;
}
.ph-title em { font-style: normal; color: var(--teal); }
.ph-sub { font-size: 13px; font-weight: 400; color: #9ca3af; margin-top: 2px; }
.ph-actions { display: flex; align-items: center; gap: 8px; }

.btn {
  height: 38px; padding: 0 16px;
  border-radius: var(--r-sm); border: 1px solid var(--warm);
  font-family: var(--f-body); font-size: 12px; font-weight: 600;
  background: var(--white); color: #6b7280;
  cursor: pointer; display: flex; align-items: center; gap: 6px;
  transition: all .15s;
}
.btn svg { width: 14px; height: 14px; }
.btn:hover { border-color: var(--sand); color: var(--ink); }
.btn.primary {
  background: var(--ink); color: var(--white);
  border-color: var(--ink);
}
.btn.primary:hover { background: var(--ink2); }
.btn.teal {
  background: var(--teal); color: var(--ink);
  border-color: var(--teal);
}
.btn.teal:hover { background: var(--teal-d); }

/* ── STATS ROW ── */
.stats-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
}

.stat-card {
  background: var(--white);
  border: 1px solid var(--warm);
  border-radius: var(--r-lg);
  padding: 20px;
  position: relative; overflow: hidden;
  box-shadow: var(--shadow-sm);
  transition: all .2s;
}
.stat-card:hover {
  box-shadow: var(--shadow-md);
  transform: translateY(-2px);
  border-color: var(--teal-m);
}
.stat-card-stripe {
  position: absolute; top: 0; left: 0; right: 0;
  height: 3px; border-radius: var(--r-lg) var(--r-lg) 0 0;
}
.stripe-teal { background: var(--teal); }
.stripe-coral { background: var(--coral); }
.stripe-amber { background: var(--amber); }
.stripe-blue  { background: var(--blue); }

.sc-top {
  display: flex; align-items: flex-start;
  justify-content: space-between; margin-bottom: 16px;
}
.sc-icon {
  width: 38px; height: 38px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
}
.sc-icon svg { width: 18px; height: 18px; }
.sc-icon.teal { background: var(--teal-l); color: var(--teal-d); }
.sc-icon.coral { background: #fff0f0; color: var(--coral); }
.sc-icon.amber { background: #fef3dc; color: var(--amber); }
.sc-icon.blue  { background: #eff6ff; color: var(--blue); }
.sc-badge {
  font-size: 11px; font-weight: 700;
  padding: 3px 9px; border-radius: 100px;
}
.sc-badge.up { background: #f0fdf4; color: #15803d; }
.sc-badge.dn { background: #fff1f2; color: #be123c; }
.sc-val {
  font-family: var(--f-display);
  font-size: 28px; font-weight: 800;
  color: var(--ink); letter-spacing: -0.5px;
  line-height: 1;
}
.sc-lbl { font-size: 12px; font-weight: 400; color: #9ca3af; margin-top: 4px; }

/* mini sparkline */
.sc-sparkline {
  display: flex; align-items: flex-end;
  gap: 3px; height: 32px; margin-top: 14px;
  border-top: 1px solid var(--cream); padding-top: 12px;
}
.spark-bar {
  flex: 1; border-radius: 3px 3px 0 0;
  background: var(--cream); min-height: 4px;
  transition: background .2s;
}
.spark-bar.hi { background: var(--teal); }
.stat-card:hover .spark-bar { opacity: .8; }
.stat-card:hover .spark-bar.hi { background: var(--teal); opacity: 1; }

/* ── PRODUCT SECTION ── */
.product-panel {
  background: var(--white);
  border: 1px solid var(--warm);
  border-radius: var(--r-xl);
  overflow: hidden;
  box-shadow: var(--shadow-sm);
}

.product-panel-header {
  padding: 20px 24px;
  border-bottom: 1px solid var(--cream);
  display: flex; align-items: center;
  justify-content: space-between; gap: 16px;
  flex-wrap: wrap;
}
.pph-left h3 {
  font-family: var(--f-display);
  font-size: 17px; font-weight: 700;
  color: var(--ink); letter-spacing: -.2px;
}
.pph-left p { font-size: 12px; color: #9ca3af; margin-top: 1px; }

.pph-right { display: flex; align-items: center; gap: 8px; }

.tab-group {
  display: flex; background: var(--cream);
  border-radius: var(--r-sm); padding: 3px; gap: 2px;
}
.tab-g-btn {
  height: 30px; padding: 0 12px; border-radius: 6px;
  font-family: var(--f-body); font-size: 12px; font-weight: 500;
  color: #9ca3af; border: none; background: transparent;
  cursor: pointer; transition: all .15s;
}
.tab-g-btn.on {
  background: var(--white); color: var(--ink); font-weight: 600;
  box-shadow: 0 1px 3px rgba(0,0,0,.08);
}

.prod-grid {
  padding: 20px 24px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 14px;
}

.prod-card {
  border: 1px solid var(--cream);
  border-radius: var(--r-md);
  padding: 14px;
  cursor: pointer; transition: all .2s;
  position: relative; overflow: hidden;
}
.prod-card::before {
  content: '';
  position: absolute; inset: 0;
  background: var(--teal);
  opacity: 0; transition: opacity .2s;
  border-radius: var(--r-md);
}
.prod-card:hover {
  border-color: var(--teal-m);
  box-shadow: 0 8px 28px rgba(45,197,162,.15);
  transform: translateY(-3px) scale(1.01);
}
.prod-card:hover::before { opacity: .03; }

.prod-img {
  aspect-ratio: 1;
  background: var(--cream);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 30px; margin-bottom: 12px;
  transition: background .2s; position: relative; z-index: 1;
}
.prod-card:hover .prod-img { background: var(--teal-l); }

.prod-name {
  font-size: 11px; font-weight: 600;
  color: #9ca3af; text-transform: uppercase;
  letter-spacing: .06em; margin-bottom: 6px;
  overflow: hidden; text-overflow: ellipsis;
  white-space: nowrap; position: relative; z-index: 1;
}
.prod-footer {
  display: flex; align-items: center;
  justify-content: space-between;
  position: relative; z-index: 1;
}
.prod-price {
  font-family: var(--f-display);
  font-size: 15px; font-weight: 800;
  color: var(--ink);
}
.prod-add {
  width: 28px; height: 28px; border-radius: 8px;
  background: var(--cream); border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: all .15s; flex-shrink: 0;
}
.prod-add svg { width: 13px; height: 13px; color: #9ca3af; }
.prod-card:hover .prod-add { background: var(--ink); }
.prod-card:hover .prod-add svg { color: var(--teal); }

/* ── BOTTOM SECTION ── */
.bottom-grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr;
  gap: 16px;
}

.bot-card {
  background: var(--white);
  border: 1px solid var(--warm);
  border-radius: var(--r-lg);
  padding: 22px;
  box-shadow: var(--shadow-sm);
}
.bot-card-title {
  font-family: var(--f-display);
  font-size: 15px; font-weight: 700;
  color: var(--ink); letter-spacing: -.2px;
  margin-bottom: 4px;
}
.bot-card-sub { font-size: 12px; color: #9ca3af; margin-bottom: 20px; }

/* chart */
.chart-area {
  display: flex; align-items: flex-end;
  gap: 10px; height: 100px;
}
.ch-col {
  flex: 1; display: flex; flex-direction: column;
  align-items: center; gap: 6px; height: 100%;
  justify-content: flex-end;
}
.ch-bar {
  width: 100%; border-radius: 6px 6px 0 0;
  background: var(--cream); transition: all .2s;
  position: relative; overflow: hidden;
}
.ch-bar.active { background: var(--teal); }
.ch-bar::after {
  content: '';
  position: absolute; top: 0; left: 0; right: 0;
  height: 3px;
  background: rgba(255,255,255,.4);
  border-radius: 6px 6px 0 0;
  opacity: 0;
}
.ch-bar.active::after { opacity: 1; }
.ch-col:hover .ch-bar { background: var(--teal); opacity: .7; }
.ch-day { font-size: 10px; font-weight: 600; color: #9ca3af; }

.chart-meta {
  display: flex; align-items: center;
  gap: 16px; margin-top: 16px;
  padding-top: 16px; border-top: 1px solid var(--cream);
}
.cm-item { display: flex; align-items: center; gap: 7px; }
.cm-pip { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }
.cm-txt { font-size: 11px; font-weight: 500; color: #9ca3af; }
.cm-val {
  font-family: var(--f-display);
  font-size: 13px; font-weight: 700; color: var(--ink);
  margin-left: auto;
}

/* activity */
.act-feed { display: flex; flex-direction: column; gap: 0; }
.act-item {
  display: flex; align-items: flex-start; gap: 12px;
  padding: 11px 0;
  border-bottom: 1px solid var(--cream);
  transition: all .15s;
}
.act-item:last-child { border-bottom: none; padding-bottom: 0; }
.act-item:hover { padding-left: 4px; }
.act-icon {
  width: 34px; height: 34px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; margin-top: 1px;
}
.act-icon svg { width: 15px; height: 15px; }
.ai-teal { background: var(--teal-l); color: var(--teal-d); }
.ai-coral { background: #fff0f0; color: var(--coral); }
.ai-blue  { background: #eff6ff; color: var(--blue); }
.ai-amber { background: #fef3dc; color: var(--amber); }
.act-body { flex: 1; }
.act-title { font-size: 13px; font-weight: 500; color: var(--ink); line-height: 1.4; }
.act-desc  { font-size: 11px; font-weight: 400; color: #9ca3af; margin-top: 2px; }
.act-time  { font-size: 11px; font-weight: 500; color: #9ca3af; white-space: nowrap; margin-top: 3px; }

/* ══════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════ */
@media (max-width: 1100px) {
  .hero { grid-template-columns: 1fr; min-height: auto; }
  .hero-right { display: none; }
  .hero-left { padding: 40px 0; border-right: none; }
  .main-wrap { grid-template-columns: 220px 1fr; }
  .stats-row { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 900px) {
  .main-wrap { grid-template-columns: 1fr; padding: 20px 20px; }
  .nav-links { display: none; }
  .hero { padding: 0 20px; }
  .topnav { padding: 0 20px; }
  .bottom-grid { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
  .stats-row { grid-template-columns: 1fr 1fr; }
  .hero-title { font-size: 36px; }
}
</style>
</head>
<body>

<!-- ══════════════════════════════════════════
     LOADING SCREEN
══════════════════════════════════════════ -->
<div id="preloader">
  <div class="pl-canvas">
    <div class="pl-line pl-line-h"></div>
    <div class="pl-line pl-line-v"></div>
  </div>
  <div class="pl-rings">
    <div class="pl-ring"></div>
    <div class="pl-ring"></div>
    <div class="pl-ring"></div>
    <div class="pl-ring"></div>
  </div>

  <div class="pl-center">
    <div class="pl-logo-wrap">
      <div class="pl-logo-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>

    <div class="pl-wordmark">
      <h1>Toko<span>Nusantara</span></h1>
      <p>Admin Management System</p>
    </div>

    <div class="pl-progress-wrap">
      <div class="pl-progress-track">
        <div class="pl-progress-fill" id="plFill"></div>
      </div>
      <div class="pl-pct" id="plPct">0%</div>
    </div>

    <div class="pl-status">
      Memuat sistem<span>_</span>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════
     APP
══════════════════════════════════════════ -->
<div id="app">

  <!-- NAV -->
  <nav class="topnav">
    <div class="nav-brand">
      <div class="nav-brand-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <span class="nav-brand-name">Toko<em>Nusantara</em></span>
    </div>

    <nav class="nav-links">
      <button class="nav-link on" onclick="setNav(this)">Dashboard</button>
      <button class="nav-link" onclick="setNav(this)">Katalog</button>
      <button class="nav-link" onclick="setNav(this)">Pesanan</button>
      <button class="nav-link" onclick="setNav(this)">Laporan</button>
      <button class="nav-link" onclick="setNav(this)">Pengaturan</button>
    </nav>

    <div class="nav-right">
      <div class="nav-search">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"/>
        </svg>
        <input type="text" placeholder="Cari produk, pesanan..."/>
      </div>
      <button class="nav-icon-btn">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M15 17H9m6 0a3 3 0 11-6 0m6 0H9M5.07 9A7 7 0 1118.93 9C19.5 13 21 14 21 15H3c0-1 1.5-2 2.07-6z" stroke-width="2"/>
        </svg>
        <span class="nav-notif-dot"></span>
      </button>
      <div class="nav-user">
        <div class="nav-avatar">AD</div>
        <span class="nav-user-name">Admin</span>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-bg-grid"></div>
    <div class="hero-bg-arc"></div>
    <div class="hero-bg-arc2"></div>
    <div class="hero-bg-blob"></div>

    <div class="hero-left">
      <div class="hero-eyebrow">
        <div class="hero-eyebrow-dot"></div>
        <span>Admin Panel — Live Session</span>
      </div>

      <div class="hero-title-block">
        <h1 class="hero-title">
          <span>Selamat</span>
          <span class="tline-teal">Datang,</span>
          <span class="tline-outline">Admin.</span>
        </h1>
      </div>

      <div class="hero-typed-row">
        <span class="hero-typed-label">Mode aktif —</span>
        <span class="hero-typed-val" id="typedText"></span><span class="typed-cur"></span>
      </div>

      <p class="hero-sub">
        Pantau kinerja toko, kelola produk, dan analisis penjualan secara real-time dari satu pusat kendali.
      </p>

      <div class="hero-actions">
        <button class="hero-btn-primary" onclick="document.getElementById('main-content').scrollIntoView({behavior:'smooth'})">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
          Buka Dashboard
        </button>
        <button class="hero-btn-ghost">Lihat Laporan</button>
      </div>
    </div>

    <div class="hero-right">
      <div class="hero-stat-card">
        <div class="hsc-icon teal">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2"/>
          </svg>
        </div>
        <div class="hsc-body">
          <div class="hsc-val">248</div>
          <div class="hsc-lbl">Produk Aktif</div>
        </div>
        <span class="hsc-badge up">+12</span>
      </div>

      <div class="hero-stat-card">
        <div class="hsc-icon coral">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5h12.8M9 19a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" stroke-width="2"/>
          </svg>
        </div>
        <div class="hsc-body">
          <div class="hsc-val">57</div>
          <div class="hsc-lbl">Pesanan Hari Ini</div>
        </div>
        <span class="hsc-badge up">+8%</span>
      </div>

      <div class="hero-stat-card">
        <div class="hsc-icon amber">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/>
          </svg>
        </div>
        <div class="hsc-body">
          <div class="hsc-val">Rp 124jt</div>
          <div class="hsc-lbl">Pendapatan Bulan Ini</div>
        </div>
        <span class="hsc-badge up">+23%</span>
      </div>

      <div class="hero-stat-card">
        <div class="hsc-icon blue">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" stroke-width="2"/>
          </svg>
        </div>
        <div class="hsc-body">
          <div class="hsc-val">1.4rb</div>
          <div class="hsc-lbl">Pengguna Aktif</div>
        </div>
        <span class="hsc-badge up">+5%</span>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <div class="main-wrap" id="main-content">

    <!-- SIDEBAR -->
    <aside class="sidebar rv-l" id="sidebar">
      <div class="sb-card">
        <div class="sb-section-label">Kategori Produk</div>
        <div id="cat-list">
          <div class="cat-item on" onclick="setCat(this,'Semua')">
            <div class="cat-item-pip"></div>
            <span class="cat-item-name">Semua Produk</span>
            <span class="cat-item-count">248</span>
          </div>
          <div class="cat-item" onclick="setCat(this,'Elektronik')">
            <div class="cat-item-pip"></div>
            <span class="cat-item-name">Elektronik</span>
            <span class="cat-item-count">84</span>
          </div>
          <div class="cat-item" onclick="setCat(this,'Kebutuhan')">
            <div class="cat-item-pip"></div>
            <span class="cat-item-name">Kebutuhan Pokok</span>
            <span class="cat-item-count">62</span>
          </div>
          <div class="cat-item" onclick="setCat(this,'Fashion')">
            <div class="cat-item-pip"></div>
            <span class="cat-item-name">Fashion Pria</span>
            <span class="cat-item-count">47</span>
          </div>
          <div class="cat-item" onclick="setCat(this,'Alat')">
            <div class="cat-item-pip"></div>
            <span class="cat-item-name">Alat Tulis</span>
            <span class="cat-item-count">31</span>
          </div>
        </div>
      </div>

      <div class="sb-upgrade rv-l" style="transition-delay:.08s">
        <div class="up-eyebrow">⭐ Premium</div>
        <div class="up-headline">Harga Distributor Eksklusif</div>
        <div class="up-desc">Hemat hingga 35% untuk semua kategori produk pilihan kami.</div>
        <button class="up-cta">Upgrade Sekarang</button>
      </div>

      <div class="sb-card rv-l" style="transition-delay:.14s">
        <div class="sb-section-label">Status Toko</div>
        <div class="sb-status-row">
          <span class="sb-status-lbl">Stok menipis</span>
          <span class="sb-status-val sv-amber">3 item</span>
        </div>
        <div class="sb-status-row">
          <span class="sb-status-lbl">Perlu dikemas</span>
          <span class="sb-status-val sv-teal">12 item</span>
        </div>
        <div class="sb-status-row">
          <span class="sb-status-lbl">Ulasan baru</span>
          <span class="sb-status-val sv-ink">7 ulasan</span>
        </div>
        <div class="sb-status-row">
          <span class="sb-status-lbl">Rating toko</span>
          <span class="sb-status-val sv-ink">4.9 / 5.0</span>
        </div>
      </div>
    </aside>

    <!-- CONTENT -->
    <div class="content">

      <!-- page header -->
      <div class="page-header rv" id="ph">
        <div>
          <div class="ph-title">Katalog <em>Utama</em></div>
          <div class="ph-sub">Kelola dan telusuri semua produk yang tersedia</div>
        </div>
        <div class="ph-actions">
          <button class="btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M3 4h18M7 12h10M11 20h2" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Filter
          </button>
          <button class="btn primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
            Tambah Produk
          </button>
        </div>
      </div>

      <!-- stat cards -->
      <div class="stats-row">
        <div class="stat-card rv" data-d="0">
          <div class="stat-card-stripe stripe-teal"></div>
          <div class="sc-top">
            <div class="sc-icon teal">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7" stroke-width="2"/>
              </svg>
            </div>
            <span class="sc-badge up">+12 baru</span>
          </div>
          <div class="sc-val">248</div>
          <div class="sc-lbl">Total Produk</div>
          <div class="sc-sparkline" id="sp0"></div>
        </div>

        <div class="stat-card rv" data-d="1">
          <div class="stat-card-stripe stripe-coral"></div>
          <div class="sc-top">
            <div class="sc-icon coral">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5h12.8M9 19a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" stroke-width="2"/>
              </svg>
            </div>
            <span class="sc-badge up">+8%</span>
          </div>
          <div class="sc-val">57</div>
          <div class="sc-lbl">Pesanan Hari Ini</div>
          <div class="sc-sparkline" id="sp1"></div>
        </div>

        <div class="stat-card rv" data-d="2">
          <div class="stat-card-stripe stripe-amber"></div>
          <div class="sc-top">
            <div class="sc-icon amber">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/>
              </svg>
            </div>
            <span class="sc-badge up">+23%</span>
          </div>
          <div class="sc-val">Rp 124jt</div>
          <div class="sc-lbl">Pendapatan Bulan Ini</div>
          <div class="sc-sparkline" id="sp2"></div>
        </div>

        <div class="stat-card rv" data-d="3">
          <div class="stat-card-stripe stripe-blue"></div>
          <div class="sc-top">
            <div class="sc-icon blue">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" stroke-width="2"/>
              </svg>
            </div>
            <span class="sc-badge up">+5%</span>
          </div>
          <div class="sc-val">1.4rb</div>
          <div class="sc-lbl">Pengguna Aktif</div>
          <div class="sc-sparkline" id="sp3"></div>
        </div>
      </div>

      <!-- products -->
      <div class="product-panel rv">
        <div class="product-panel-header">
          <div class="pph-left">
            <h3>Daftar Produk</h3>
            <p>Menampilkan <span id="prod-count">8</span> produk</p>
          </div>
          <div class="pph-right">
            <div class="tab-group" id="tab-group">
              <button class="tab-g-btn on" onclick="setTab(this)">Semua</button>
              <button class="tab-g-btn" onclick="setTab(this)">Terlaris</button>
              <button class="tab-g-btn" onclick="setTab(this)">Terbaru</button>
            </div>
          </div>
        </div>
        <div class="prod-grid" id="prod-grid"></div>
      </div>

      <!-- bottom row -->
      <div class="bottom-grid">
        <div class="bot-card rv">
          <div class="bot-card-title">Tren Penjualan</div>
          <div class="bot-card-sub">Performa 7 hari terakhir</div>
          <div class="chart-area" id="chart"></div>
          <div class="chart-meta">
            <div class="cm-item">
              <div class="cm-pip" style="background:var(--teal)"></div>
              <span class="cm-txt">Penjualan</span>
            </div>
            <div class="cm-item">
              <div class="cm-pip" style="background:var(--cream);border:1px solid var(--warm)"></div>
              <span class="cm-txt">Target</span>
            </div>
            <div class="cm-val">Rp 88.4jt minggu ini</div>
          </div>
        </div>

        <div class="bot-card rv" style="transition-delay:.1s">
          <div class="bot-card-title">Aktivitas Terbaru</div>
          <div class="bot-card-sub">Update real-time sistem</div>
          <div class="act-feed">
            <div class="act-item">
              <div class="act-icon ai-teal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="act-body">
                <div class="act-title">Pesanan #1892 dikonfirmasi</div>
                <div class="act-desc">Transfer — Rp 4.200.000</div>
              </div>
              <div class="act-time">2 mnt lalu</div>
            </div>
            <div class="act-item">
              <div class="act-icon ai-coral">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke-width="2"/>
                </svg>
              </div>
              <div class="act-body">
                <div class="act-title">Stok SSD NVMe hampir habis</div>
                <div class="act-desc">Tersisa 3 unit saja</div>
              </div>
              <div class="act-time">15 mnt lalu</div>
            </div>
            <div class="act-item">
              <div class="act-icon ai-blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/>
                </svg>
              </div>
              <div class="act-body">
                <div class="act-title">14 pengguna baru terdaftar</div>
                <div class="act-desc">Target harian 93% tercapai</div>
              </div>
              <div class="act-time">1 jam lalu</div>
            </div>
            <div class="act-item">
              <div class="act-icon ai-amber">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" stroke-width="2"/>
                </svg>
              </div>
              <div class="act-body">
                <div class="act-title">Ulasan bintang 5 diterima</div>
                <div class="act-desc">Untuk produk Laptop Pro M1</div>
              </div>
              <div class="act-time">3 jam lalu</div>
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
      document.getElementById('app').classList.add('ready');
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
  document.querySelectorAll('.nav-link').forEach(b => b.classList.remove('on'));
  el.classList.add('on');
}

/* ════════════════════════════
   TABS
════════════════════════════ */
function setTab(el) {
  document.querySelectorAll('.tab-g-btn').forEach(b => b.classList.remove('on'));
  el.classList.add('on');
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
  const mx  = Math.max(...data);
  const el  = document.getElementById('sp' + i);
  const hi  = data.indexOf(mx);
  el.innerHTML = data.map((v, j) =>
    `<div class="spark-bar ${j === hi ? 'hi' : ''}" style="height:${Math.round(v/mx*28)}px"></div>`
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

let curCat = 'Semua', curQ = '';

function renderProds() {
  const grid = document.getElementById('prod-grid');
  const list = products.filter(p =>
    (curCat === 'Semua' || p.c.startsWith(curCat)) &&
    p.n.toLowerCase().includes(curQ.toLowerCase())
  );
  document.getElementById('prod-count').textContent = list.length;

  grid.innerHTML = list.map((p, i) => `
    <div class="prod-card" style="opacity:0;transform:translateY(14px) scale(.97);
         transition:opacity .4s ${i*45}ms cubic-bezier(.22,1,.36,1),
                    transform .4s ${i*45}ms cubic-bezier(.22,1,.36,1),
                    box-shadow .2s, border-color .2s;">
      <div class="prod-img">${p.i}</div>
      <div class="prod-name">${p.n}</div>
      <div class="prod-footer">
        <span class="prod-price">${p.p}</span>
        <button class="prod-add" onclick="event.stopPropagation()">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
  document.querySelectorAll('.cat-item').forEach(r => r.classList.remove('on'));
  el.classList.add('on');
  curCat = cat; renderProds();
}

/* ════════════════════════════
   BAR CHART
════════════════════════════ */
const days = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];
const vals = [42, 65, 38, 72, 55, 88, 60];
const maxV = Math.max(...vals);

document.getElementById('chart').innerHTML = days.map((d, i) => `
  <div class="ch-col">
    <div class="ch-bar ${i === 5 ? 'active' : ''}" style="height:${Math.round(vals[i]/maxV*90)}px"></div>
    <span class="ch-day">${d}</span>
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