const mobileBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const desktop = window.matchMedia('(min-width: 1121px)');
export const motionBehavior = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth';

function closeMenu(restoreFocus = false) {
    if (!mobileMenu || !mobileBtn) return;
    mobileMenu.hidden = true;
    document.body.classList.remove('menu-open');
    document.getElementById('top').inert = false;
    document.querySelector('.site-footer').inert = false;
    document.querySelector('.mobile-action-bar').inert = false;
    mobileBtn.setAttribute('aria-expanded', 'false');
    mobileBtn.setAttribute('aria-label', 'Открыть меню');
    if (restoreFocus) mobileBtn.focus();
}
mobileBtn?.addEventListener('click', () => {
    if (!mobileMenu.hidden) return closeMenu();
    mobileMenu.hidden = false;
    document.body.classList.add('menu-open');
    document.getElementById('top').inert = true;
    document.querySelector('.site-footer').inert = true;
    document.querySelector('.mobile-action-bar').inert = true;
    mobileBtn.setAttribute('aria-expanded', 'true');
    mobileBtn.setAttribute('aria-label', 'Закрыть меню');
    mobileMenu.querySelector('a')?.focus();
});
mobileMenu?.querySelectorAll('a').forEach(link => link.addEventListener('click', () => closeMenu()));
document.addEventListener('keydown', event => {
    if (!mobileMenu || mobileMenu.hidden) return;
    if (event.key === 'Escape') closeMenu(true);
    if (event.key === 'Tab') {
        const links = [...mobileMenu.querySelectorAll('a')];
        const first = mobileBtn;
        const last = links.at(-1);
        if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
        else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
    }
});
desktop.addEventListener('change', event => { if (event.matches) closeMenu(); });

export function scrollToSection(target) {
    if (!target) return;
    if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
    target.focus({ preventScroll: true });
    target.scrollIntoView({ behavior: motionBehavior(), block: 'start' });
}
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', event => {
        const hash = link.getAttribute('href');
        const target = document.getElementById(hash.slice(1));
        if (!target) return;
        event.preventDefault();
        closeMenu();
        scrollToSection(target);
        window.history.replaceState(null, '', hash);
    });
});

function applyDesign(design) {
    const selected = design === 'modern' ? 'modern' : 'classic';
    document.documentElement.dataset.design = selected;
    document.querySelectorAll('[data-design-choice]').forEach(button => {
        button.setAttribute('aria-pressed', String(button.dataset.designChoice === selected));
    });
    document.querySelector('meta[name="theme-color"]').content = selected === 'modern' ? '#17191a' : '#0d1115';
    try { localStorage.setItem('maxtar-design', selected); } catch { /* Private browsing may disable storage. */ }
}
applyDesign(document.documentElement.dataset.design);
document.querySelectorAll('[data-design-choice]').forEach(button => {
    button.addEventListener('click', () => {
        applyDesign(button.dataset.designChoice);
        const url = new URL(location.href);
        url.searchParams.set('design', button.dataset.designChoice);
        url.hash = 'top';
        history.replaceState(null, '', url);
        scrollToSection(document.getElementById('top'));
    });
});
