<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0d1115">
    <meta name="description" content="НСК Макстар — порошковая покраска и восстановление автомобильных дисков в Бердске. Подготовка, покрытие и контроль результата.">
    <title>НСК Макстар — порошковая покраска дисков в Бердске</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preload" as="image" type="image/webp" href="{{ asset('images/brand/hero-workshop.webp') }}" fetchpriority="high">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'AutomotiveBusiness',
        'name' => 'НСК Макстар',
        'description' => 'Порошковая покраска и восстановление автомобильных дисков.',
        'telephone' => '+79138954525',
        'email' => 'polimer@happypils.ru',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Бердск',
            'streetAddress' => 'пер. Промышленный, 2а/4',
            'addressRegion' => 'Новосибирская область',
            'addressCountry' => 'RU',
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=106844214', 'ym');

        ym(106844214, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/106844214" class="metric-pixel" alt=""></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<body class="site-body">
<header class="site-header">
    <nav class="container-wide nav-shell" aria-label="Основная навигация">
        <a href="#top" class="brand" aria-label="НСК Макстар — на главную">
            <span class="brand-mark" aria-hidden="true">
                <img src="{{ asset('images/brand/logo-mark.svg') }}" alt="" width="42" height="42">
            </span>
            <span class="brand-copy">
                <strong>НСК Макстар</strong>
                <small>Покраска дисков · Бердск</small>
            </span>
        </a>

        <div class="desktop-nav">
            <a href="#services">Услуги</a>
            <a href="#process">Процесс</a>
            <a href="#config">Подбор покрытия</a>
            <a href="#works">Цвета</a>
            <a href="#contact">Контакты</a>
        </div>

        <div class="desktop-actions">
            <a href="tel:+79138954525" class="phone-link">+7 913 895-45-25</a>
            <a href="#contact" class="button button-accent button-small">Рассчитать стоимость</a>
        </div>

        <button id="mobileMenuBtn" class="menu-button" type="button" aria-controls="mobileMenu" aria-expanded="false" aria-label="Открыть меню">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <div id="mobileMenu" class="mobile-menu" hidden>
        <div class="container-wide mobile-menu-inner">
            <a href="#services">Услуги</a>
            <a href="#process">Как работаем</a>
            <a href="#config">Подбор покрытия</a>
            <a href="#works">Варианты цвета</a>
            <a href="#contact">Контакты</a>
            <a href="tel:+79138954525" class="mobile-menu-phone">+7 913 895-45-25</a>
            <a href="mailto:polimer@happypils.ru" class="mobile-menu-email">polimer@happypils.ru</a>
        </div>
    </div>
</header>

<main id="top">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container-wide footer-grid">
        <div class="footer-brand">
            <a href="#top" class="brand brand-footer">
                <span class="brand-mark" aria-hidden="true">
                    <img src="{{ asset('images/brand/logo-mark.svg') }}" alt="" width="42" height="42">
                </span>
                <span class="brand-copy">
                    <strong>НСК Макстар</strong>
                    <small>Порошковая покраска дисков</small>
                </span>
            </a>
            <p>Подготовка металла, восстановление покрытия и аккуратный финиш с контролем каждого этапа.</p>
        </div>

        <div>
            <h2 class="footer-title">Мастерская</h2>
            <p>НСО, г. Бердск<br>пер. Промышленный, 2а/4</p>
            <a href="https://yandex.ru/maps/?text=%D0%9D%D0%A1%D0%9E%2C%20%D0%91%D0%B5%D1%80%D0%B4%D1%81%D0%BA%2C%20%D0%BF%D0%B5%D1%80.%20%D0%9F%D1%80%D0%BE%D0%BC%D1%8B%D1%88%D0%BB%D0%B5%D0%BD%D0%BD%D1%8B%D0%B9%202%D0%B0%2F4" target="_blank" rel="noopener">Открыть маршрут</a>
        </div>

        <div>
            <h2 class="footer-title">Связаться</h2>
            <a href="tel:+79138954525">+7 913 895-45-25</a>
            <a href="mailto:polimer@happypils.ru">polimer@happypils.ru</a>
            <a href="https://wa.me/79138954525" target="_blank" rel="noopener">WhatsApp</a>
            <a href="https://vk.ru/club105621991" target="_blank" rel="noopener">ВКонтакте</a>
        </div>

        <div>
            <h2 class="footer-title">Режим работы</h2>
            <p>Пн–Пт: 9:30–18:00<br>Сб: 10:30–16:00<br>Вс: выходной</p>
        </div>
    </div>

    <div class="container-wide footer-bottom">
        <span>© {{ date('Y') }} НСК Макстар</span>
        <span>Порошковая покраска · Бердск</span>
    </div>
</footer>

<div class="mobile-action-bar" aria-label="Быстрые действия">
    <a href="tel:+79138954525">Позвонить</a>
    <a href="#contact" class="button button-accent">Оценить по фото</a>
</div>

<script>
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const pageBody = document.body;

    if (mobileBtn && mobileMenu) {
        const closeMobileMenu = () => {
            mobileMenu.hidden = true;
            pageBody.classList.remove('menu-open');
            mobileBtn.setAttribute('aria-expanded', 'false');
            mobileBtn.setAttribute('aria-label', 'Открыть меню');
        };

        mobileBtn.addEventListener('click', () => {
            const willOpen = mobileMenu.hidden;
            mobileMenu.hidden = !willOpen;
            pageBody.classList.toggle('menu-open', willOpen);
            mobileBtn.setAttribute('aria-expanded', String(willOpen));
            mobileBtn.setAttribute('aria-label', willOpen ? 'Закрыть меню' : 'Открыть меню');
        });

        mobileMenu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMobileMenu));
    }

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let scrollAnimationFrame = null;

    const smoothScrollTo = target => {
        if (scrollAnimationFrame) window.cancelAnimationFrame(scrollAnimationFrame);

        const header = document.querySelector('.site-header');
        const offset = header ? header.getBoundingClientRect().height : 0;
        const start = window.scrollY;
        const destination = Math.max(0, target.getBoundingClientRect().top + start - offset);

        if (reducedMotion || Math.abs(destination - start) < 2) {
            window.scrollTo(0, destination);
            return;
        }

        const distance = destination - start;
        const duration = Math.min(850, Math.max(550, Math.abs(distance) * 0.35));
        const startedAt = performance.now();

        const animate = now => {
            const progress = Math.min((now - startedAt) / duration, 1);
            const eased = progress < 0.5
                ? 4 * progress ** 3
                : 1 - ((-2 * progress + 2) ** 3) / 2;

            window.scrollTo(0, start + distance * eased);

            if (progress < 1) {
                scrollAnimationFrame = requestAnimationFrame(animate);
            } else {
                scrollAnimationFrame = null;
            }
        };

        scrollAnimationFrame = requestAnimationFrame(animate);
    };

    document.querySelectorAll('a[href^="#"]:not([data-photo-trigger])').forEach(link => {
        link.addEventListener('click', event => {
            const target = document.querySelector(link.getAttribute('href'));
            if (!target) return;

            event.preventDefault();
            smoothScrollTo(target);
            history.replaceState(null, '', link.getAttribute('href'));
        });
    });

    document.querySelectorAll('[data-photo-trigger]').forEach(trigger => {
        trigger.addEventListener('click', event => {
            const input = document.getElementById('photoInput');
            if (!input) return;
            event.preventDefault();
            input.click();
        });
    });
</script>
</body>
</html>
