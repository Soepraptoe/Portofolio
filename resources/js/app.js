import Lenis from 'lenis';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { Draggable } from 'gsap/Draggable';

gsap.registerPlugin(ScrollTrigger, Draggable);

const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
const $ = (s, c = document) => c.querySelector(s);
const $$ = (s, c = document) => [...c.querySelectorAll(s)];
const curtain = $('.curtain');

/* Smooth scroll */
if (!reduce) {
  const lenis = new Lenis();
  lenis.on('scroll', ScrollTrigger.update);
  gsap.ticker.add((t) => lenis.raf(t * 1000));
  gsap.ticker.lagSmoothing(0);
  $$('a[href*="#"]').forEach((a) => a.addEventListener('click', (e) => {
    const target = a.hash && $(a.hash);
    if (target && a.pathname === location.pathname) { e.preventDefault(); lenis.scrollTo(target); }
  }));
}

/* Pecah teks jadi huruf */
$$('[data-split]').forEach((el) => {
  const txt = el.textContent.trim();
  el.setAttribute('aria-label', txt);
  el.innerHTML = [...txt].map((c) => `<span class="ch" aria-hidden="true">${c === ' ' ? '&nbsp;' : c}</span>`).join('');
});

/* Momen utama: judul huruf-per-huruf + stiker muncul */
function intro() {
  if (reduce) return;
  gsap.from('.ch', { yPercent: 110, rotate: 8, duration: 1, ease: 'expo.out', stagger: 0.04 });
  gsap.from('.sticker', { scale: 0, rotate: -40, duration: 0.8, ease: 'back.out(2)', stagger: 0.1, delay: 0.4 });
}

/* Preloader sekali per sesi, atau tirai terangkat kalau datang dari halaman lain */
const pre = $('.preloader');
const arriving = sessionStorage.getItem('nav');
sessionStorage.removeItem('nav');
const hideCurtain = () => {
  gsap.set(curtain, { visibility: 'hidden' });
  document.documentElement.classList.remove('arriving');
};

if (pre && !sessionStorage.getItem('seen') && !reduce) {
  sessionStorage.setItem('seen', '1');
  hideCurtain();
  const icon = $('.preloader-icon', pre), bar = $('.bar-fill', pre);
  gsap.timeline()
    .fromTo(icon, { scale: 3, opacity: 0, rotate: -14 }, { scale: 1, opacity: 1, rotate: -6, duration: 0.35, ease: 'power4.in' }, 0.2)
    .addLabel('hit')
    .fromTo(icon, { scaleX: 1.08, scaleY: 0.9 }, { scaleX: 1, scaleY: 1, duration: 0.5, ease: 'elastic.out(1, 0.4)' }, 'hit')
    .fromTo(pre, { x: -12 }, { x: 0, duration: 0.5, ease: 'elastic.out(1, 0.15)' }, 'hit')
    .fromTo(bar, { width: '0%' }, { width: '100%', duration: 1.4, ease: 'power2.inOut' }, 0.2)
    .to(pre, { yPercent: -100, duration: 0.6, ease: 'expo.inOut' }, '+=0.1')
    .add(intro, '-=0.3');
} else {
  pre?.remove();
  if (arriving && !reduce) {
    gsap.set(curtain, { yPercent: 0, visibility: 'visible' });
    gsap.to(curtain, { yPercent: -100, duration: 0.7, ease: 'expo.inOut', onComplete: hideCurtain });
  } else {
    hideCurtain();
  }
  intro();
}

/* Transisi halaman: tirai pink naik dulu, baru pindah */
if (!reduce) {
  $$('a[href]').forEach((a) => {
    const url = new URL(a.href, location.href);
    if (url.origin !== location.origin || a.target === '_blank' || url.pathname === location.pathname) return;
    a.addEventListener('click', (e) => {
      if (e.metaKey || e.ctrlKey) return;
      e.preventDefault();
      sessionStorage.setItem('nav', '1');
      gsap.set(curtain, { visibility: 'visible' });
      gsap.fromTo(curtain, { yPercent: 100 }, { yPercent: 0, duration: 0.6, ease: 'expo.inOut', onComplete: () => (location.href = a.href) });
    });
  });
}

/* Tombol Back: buang tirai yang ikut tersimpan di cache browser */
addEventListener('pageshow', (e) => {
  if (e.persisted) {
    sessionStorage.removeItem('nav');
    document.documentElement.classList.remove('arriving');
    gsap.set(curtain, { yPercent: 100, visibility: 'hidden' });
  }
});

/* Cursor kustom */
const cursor = $('.cursor');
if (cursor && matchMedia('(hover: hover) and (pointer: fine)').matches) {
  const label = $('span', cursor);
  const x = gsap.quickTo(cursor, 'x', { duration: 0.35, ease: 'power3' });
  const y = gsap.quickTo(cursor, 'y', { duration: 0.35, ease: 'power3' });
  addEventListener('mousemove', (e) => { x(e.clientX); y(e.clientY); });
  $$('[data-cursor]').forEach((el) => {
    el.addEventListener('mouseenter', () => { label.textContent = el.dataset.cursor || ''; cursor.classList.toggle('big', !!el.dataset.cursor); });
    el.addEventListener('mouseleave', () => { label.textContent = ''; cursor.classList.remove('big'); });
  });
}

/* Stiker bisa di-drag */
if ($('.sticker')) {
  Draggable.create('.sticker', {
    type: 'x,y', bounds: '.hero',
    onPress() { gsap.to(this.target, { scale: 1.12, duration: 0.25 }); },
    onRelease() { gsap.to(this.target, { scale: 1, duration: 0.4, ease: 'elastic.out(1, .4)' }); },
  });
}

/* Karya: scroll vertikal jadi horizontal (desktop saja) */
const track = $('.works-track');
if (track && !reduce) {
  ScrollTrigger.matchMedia({
    '(min-width: 800px)': () => {
      gsap.to(track, {
        x: () => -(track.scrollWidth - innerWidth),
        ease: 'none',
        scrollTrigger: { trigger: '.works', start: 'top top', end: () => '+=' + (track.scrollWidth - innerWidth), pin: true, scrub: 1, invalidateOnRefresh: true },
      });
    },
  });
}

// ===== Tempel di PALING BAWAH resources/js/app.js =====

/* Menu aktif sesuai section yang sedang dilihat */
const navLinks = $$('.nav nav a');
const navSections = navLinks.map((a) => a.hash && $(a.hash)).filter(Boolean);
if (navSections.length) {
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) navLinks.forEach((a) => a.classList.toggle('on', a.hash === '#' + e.target.id));
    });
  }, { rootMargin: '-45% 0px -50% 0px' });
  navSections.forEach((s) => io.observe(s));
}

/* Setelah kirim form, halaman kembali ke bagian kontak */
addEventListener('load', () => setTimeout(() => {
  const t = location.hash && $(location.hash);
  if (t) { ScrollTrigger.refresh(); t.scrollIntoView(); }
}, 150));
