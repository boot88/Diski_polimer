<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PolymerDisk — порошковая (полимерная) покраска дисков в Бердске. Быстро, аккуратно, долговечно. Звоните +7 (913) 895-45-25">
    <title>PolymerDisk — покраска дисков полимерной краской | Бердск</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind CDN (без сборки, стабильно на хостинге) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html{scroll-behavior:smooth}
        body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial}
        .btn-primary{background:#f97316;color:#111827;border-radius:9999px;padding:.75rem 1.1rem;font-weight:600}
        .btn-primary:hover{background:#ea580c}
        .btn-ghost{border:1px solid #e5e7eb;border-radius:9999px;padding:.75rem 1.1rem;font-weight:600}
        .card{background:#fff;border:1px solid #e5e7eb;border-radius:1rem;box-shadow:0 10px 30px rgba(0,0,0,.06)}
        .chip{border:1px solid #e5e7eb;border-radius:9999px;padding:.4rem .75rem;font-weight:600}
        .chip-active{border-color:#f97316}
    </style>
    
    

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
<noscript><div><img src="https://mc.yandex.ru/watch/106844214" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->






    
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 md:h-20 flex items-center justify-between">
            <a href="#top" class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl bg-slate-900 text-white grid place-items-center font-extrabold">PD</div>
                <div class="leading-tight">
                    <div class="text-lg md:text-xl font-extrabold">PolymerDisk</div>
                    <div class="text-xs text-slate-500 -mt-0.5">Покраска дисков • Бердск</div>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-6">
                <a href="#services" class="text-sm font-semibold text-slate-700 hover:text-slate-900">Услуги</a>
                <a href="#config" class="text-sm font-semibold text-slate-700 hover:text-slate-900">Подбор</a>
                <a href="#works" class="text-sm font-semibold text-slate-700 hover:text-slate-900">Работы</a>
                <a href="#reviews" class="text-sm font-semibold text-slate-700 hover:text-slate-900">Отзывы</a>
                <a href="#contact" class="text-sm font-semibold text-slate-700 hover:text-slate-900">Контакты</a>
                <a href="tel:+79138954525" class="btn-ghost text-sm">+7 (913) 895‑45‑25</a>
                <a href="#contact" class="btn-primary text-sm">Оставить заявку</a>
            </div>

            <div class="md:hidden flex items-center gap-2">
                <a href="tel:+79138954525" class="btn-primary text-sm py-2 px-3">Позвонить</a>
                <button id="mobileMenuBtn" class="btn-ghost text-sm py-2 px-3" aria-label="Открыть меню">Меню</button>
            </div>
        </div>

        <div id="mobileMenu" class="md:hidden hidden pb-4">
            <div class="flex flex-col gap-2 pt-2">
                <a href="#services" class="px-3 py-2 rounded-xl hover:bg-slate-100 font-semibold">Услуги</a>
                <a href="#config" class="px-3 py-2 rounded-xl hover:bg-slate-100 font-semibold">Подбор</a>
                <a href="#works" class="px-3 py-2 rounded-xl hover:bg-slate-100 font-semibold">Работы</a>
                <a href="#reviews" class="px-3 py-2 rounded-xl hover:bg-slate-100 font-semibold">Отзывы</a>
                <a href="#contact" class="px-3 py-2 rounded-xl hover:bg-slate-100 font-semibold">Контакты</a>
            </div>
        </div>
    </nav>
</header>

<main id="top">
    @yield('content')
</main>

<footer class="mt-16 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">
        <div class="md:col-span-2">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-white text-slate-900 grid place-items-center font-extrabold">PD</div>
                <div>
                    <div class="text-xl font-extrabold">PolymerDisk</div>
                    <div class="text-sm text-slate-300">Порошковая (полимерная) покраска дисков</div>
                </div>
            </div>
            <p class="mt-4 text-slate-300 text-sm leading-relaxed max-w-xl">
                Подготовка поверхности, грунт и финишная полимерная краска. Стойкое покрытие, аккуратный внешний вид и защита от коррозии.
            </p>
        </div>

        <div>
            <div class="text-sm font-bold tracking-wide text-white/90">Контакты</div>
            <p class="mt-3 text-slate-300 text-sm">НСО, г. Бердск, пер. Промышленный 2а/4</p>
            <a class="mt-2 block text-slate-200 hover:text-white text-sm font-semibold" href="tel:+79138954525">+7 (913) 895‑45‑25</a>
            <a class="mt-2 block text-slate-200 hover:text-white text-sm font-semibold" href="mailto:info@maxtar-nsk.ru">info@maxtar-nsk.ru</a>
        </div>

        <div>
            <div class="text-sm font-bold tracking-wide text-white/90">Режим</div>
            <p class="mt-3 text-slate-300 text-sm">Пн–Пт: 9:30–18:00</p>
            <p class="text-slate-300 text-sm">Сб: 10:30–16:00</p>
            <p class="text-slate-300 text-sm">Вс: выходной</p>
        </div>
    </div>

    <div class="border-t border-white/10 py-6 text-center text-xs text-slate-400">
        © {{ date('Y') }} PolymerDisk. Все права защищены.
    </div>
</footer>

<script>
    // Моб. меню
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    }
</script>
</body>
</html>
