import '../css/app.css';

const revealItems = [
    ...document.querySelectorAll(
        '.section-heading, .service-card, .process-grid li, .config-shell, .coating-card, .pricing-shell > *, .faq-grid > *, .contact-grid > *, .trust-grid > div'
    ),
];

if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.documentElement.classList.add('reveal-ready');

    revealItems.forEach((item, index) => {
        item.dataset.reveal = '';
        item.style.setProperty('--reveal-delay', `${(index % 4) * 70}ms`);
    });

    const revealObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

    revealItems.forEach(item => revealObserver.observe(item));
}
