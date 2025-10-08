<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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