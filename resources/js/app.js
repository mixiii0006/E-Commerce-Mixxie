import './bootstrap';
import 'preline'

const root = document.documentElement;
const shotMode = new URLSearchParams(location.search).has('shot');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

let observer;

function initReveal() {
    const items = document.querySelectorAll('[data-reveal]:not(.is-in)');

    if (shotMode || reduceMotion || !('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-in'));
        return;
    }

    root.classList.add('js-motion');
    observer?.disconnect();
    observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-in');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    items.forEach((el) => observer.observe(el));
}

function initNavShadow() {
    const nav = document.getElementById('site-nav');
    if (!nav) return;
    const update = () => nav.classList.toggle('is-scrolled', window.scrollY > 12);
    update();
    window.addEventListener('scroll', update, { passive: true });
}

if (shotMode) root.classList.add('shot');

document.addEventListener('DOMContentLoaded', () => {
    initReveal();
    initNavShadow();
});

document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
    initReveal();
    initNavShadow();
});
