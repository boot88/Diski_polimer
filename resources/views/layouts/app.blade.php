<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <meta name="description" content="Пескоструйная обработка в Бердске. Очистка от ржавчины, подготовка под покраску. Колёсные диски, кузова, фасады. Звоните +7 (913) 895-45-25"> <!-- ОБНОВЛЕНО -->
    <title>Пескоструйная обработка в Бердске | ООО "Макстар"</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-50 font-sans text-neutral-900 antialiased">
    <!-- Навигация -->
    <header class="sticky top-0 z-50 bg-white shadow-lg">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Логотип -->
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-bold text-primary-600">ООО "Макстар"</span>
                </div>

                <!-- Десктопное меню -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <a href="#services" class="text-neutral-700 hover:text-primary-500 px-3 py-2 text-sm font-medium">Услуги</a>
                        <a href="#portfolio" class="text-neutral-700 hover:text-primary-500 px-3 py-2 text-sm font-medium">Работы</a>
                        <a href="#about" class="text-neutral-700 hover:text-primary-500 px-3 py-2 text-sm font-medium">О нас</a>
                        <a href="#reviews" class="text-neutral-700 hover:text-primary-500 px-3 py-2 text-sm font-medium">Отзывы</a>
                        <a href="#contact" class="btn-primary text-sm py-2 px-4">Заказать звонок</a>
                    </div>
                </div>

                <!-- Телефон (виден на мобиле) -->
                <div class="md:hidden flex items-center">
                    <a href="tel:+79138954525" class="btn-primary text-sm py-2 px-3">
                        <span class="sr-only">Позвонить</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </a>
                    <button id="mobile-menu-button" type="button" class="ml-2 inline-flex items-center justify-center p-2 rounded-md text-neutral-400 hover:text-neutral-500 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Открыть меню</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Мобильное меню (скрыто по умолчанию) -->
            <div id="mobile-menu" class="md:hidden hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                    <a href="#services" class="block px-3 py-2 text-base font-medium text-neutral-700 hover:text-primary-500">Услуги</a>
                    <a href="#portfolio" class="block px-3 py-2 text-base font-medium text-neutral-700 hover:text-primary-500">Работы</a>
                    <a href="#about" class="block px-3 py-2 text-base font-medium text-neutral-700 hover:text-primary-500">О нас</a>
                    <a href="#reviews" class="block px-3 py-2 text-base font-medium text-neutral-700 hover:text-primary-500">Отзывы</a>
                    <a href="tel:+79138954525" class="block px-3 py-2 text-base font-medium text-neutral-700 hover:text-primary-500">+7 (913) 895-45-25</a>
                    <a href="#contact" class="block mt-2 btn-primary w-full text-center">Заказать звонок</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Футер -->
<footer class="bg-neutral-900 text-white py-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold mb-4 text-white">ООО "Макстар"</h3>
                <p class="text-neutral-300">Профессиональная пескоструйная обработка любых поверхностей. Очистка от ржавчины, грязи, копоти и гари. Подготовка под покраску.</p>
                
                <!-- Соцсети -->
                <h3 class="text-lg font-semibold mb-4 mt-6 text-white">Мы в соцсетях</h3>
                <div class="flex space-x-4">
                    <a href="https://vk.ru/public105621991" target="_blank" rel="noopener noreferrer" 
                       class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15.07 2H8.93C3.33 2 2 3.33 2 8.93v6.14c0 5.6 1.33 6.93 6.93 6.93h6.14c5.6 0 6.93-1.33 6.93-6.93V8.93C22 3.33 20.67 2 15.07 2zm3.13 14.27c-.41 1.16-1.46 2.08-2.76 2.08-1.63 0-2.53-1.12-3.88-1.12-1.35 0-2.07 1.12-3.88 1.12-1.3 0-2.35-.92-2.76-2.08-.16-.45-.25-.95-.25-1.45 0-1.35 1.08-2.45 2.41-2.45 1.32 0 2.41 1.1 2.41 2.45 0 .5-.09 1-.25 1.45.41-1.16 1.46-2.08 2.76-2.08 1.63 0 2.53 1.12 3.88 1.12 1.35 0 2.07-1.12 3.88-1.12 1.3 0 2.35.92 2.76 2.08.16.45.25.95.25 1.45 0 1.35-1.08 2.45-2.41 2.45-1.32 0-2.41-1.1-2.41-2.45 0-.5.09-1 .25-1.45z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 text-white">Контакты</h3>
                <p class="text-neutral-300">г. Бердск, пром. переулок 2а/4</p>
                <a href="tel:+79138954525" class="text-neutral-300 hover:text-blue-400 block mt-2">+7 (913) 895-45-25</a>
                <a href="mailto:info@maxtar-nsk.ru" class="text-neutral-300 hover:text-blue-400 block mt-2">info@maxtar-nsk.ru</a>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 text-white">Время работы</h3>
                <p class="text-neutral-300"><span class="font-medium">Пн-Пт:</span> 9:30 - 18:00</p>
                <p class="text-neutral-300"><span class="font-medium">Сб:</span> 10:30 - 16:00</p>
                <p class="text-neutral-300"><span class="font-medium">Вс:</span> Выходной</p>
            </div>
        </div>
        <div class="border-t border-neutral-700 mt-8 pt-8 text-center text-neutral-400">
            <p>&copy; {{ date('Y') }} ООО "Макстар". Все права защищены.</p>
        </div>
    </div>
</footer>

    @vite('resources/js/app.js')
    <script>
        // Простой JS для мобильного меню
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
>>>>>>> 940e35ecfb49a7c334f9e6f870acf7eea0daf4ac
