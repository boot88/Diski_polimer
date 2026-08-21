<<<<<<< HEAD
{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')

@php
    $sizes = $sizes ?? [
        ['label' => 'R15', 'folder' => 'images/R15', 'price' => 14400],  //dfgdf
        ['label' => 'R17', 'folder' => 'images/R15', 'price' => 16400],  //{{-- R17 --}}
        ['label' => 'R19', 'folder' => 'images/R15', 'price' => 18400],  //{{-- R19 --}}
    ];

    $finishes = $finishes ?? [
        ['key' => 'base',       'name' => 'Оригинал',           'file' => 'g_small.jpg'],
        ['key' => 'gloss',      'name' => 'Глянцевый чёрный',   'file' => 'g_g_small.jpg'],
        ['key' => 'matte',      'name' => 'Матовый чёрный',     'file' => 'g_m_small.jpg'],
        ['key' => 'silver',     'name' => 'Серебро',            'file' => 'g_s_small.jpg'],
        ['key' => 'anthracite', 'name' => 'Антрацит',           'file' => 'g_a_small.jpg'],
        ['key' => 'bronze',     'name' => 'Бронза',             'file' => 'g_b_small.jpg'],
    ];
@endphp

<section class="bg-gradient-to-b from-white to-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-14">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <div class="inline-flex items-center gap-2 chip">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span class="text-xs text-slate-600 font-semibold">Быстрая запись • Бердск</span>
                </div>
                <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                    Полимерная покраска дисков <span class="text-orange-500">с подбором цвета</span>
                </h1>
                <p class="mt-4 text-slate-600 leading-relaxed max-w-xl">
                    Обновим внешний вид и защитим диски от коррозии. Ниже — простой конфигуратор: выберите размер и цвет, и увидите пример результата + ориентировочную стоимость за комплект 4 дисков.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#config" class="btn-primary">Подобрать цвет</a>
                    <a href="#contact" class="btn-ghost">Узнать срок и цену</a>
                </div>

                <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="card p-4">
                        <div class="text-sm font-bold">Подготовка</div>
                        <div class="text-xs text-slate-500 mt-1">очистка/пескоструй</div>
                    </div>
                    <div class="card p-4">
                        <div class="text-sm font-bold">Порошок</div>
                        <div class="text-xs text-slate-500 mt-1">стойкое покрытие</div>
                    </div>
                    <div class="card p-4">
                        <div class="text-sm font-bold">Аккуратно</div>
                        <div class="text-xs text-slate-500 mt-1">ровный цвет</div>
                    </div>
                </div>
            </div>

            <div id="config" class="card p-6">
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm font-extrabold">Визуальный подбор</div>
                    <div class="text-xs text-slate-500">без сборки • работает на компрессоре</div>
                </div>

                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Блок с размерами/цветами/ценой --}}
                    <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4 order-2 sm:order-1">
                        <div class="text-xs font-bold text-slate-600">Размер</div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($sizes as $i => $s)
                                <button type="button"
                                        class="chip {{ $i===0 ? 'chip-active' : '' }}"
                                        data-size-index="{{ $i }}">
                                    {{ $s['label'] }}
                                </button>
                            @endforeach
                        </div>

                        <div class="mt-4 text-xs font-bold text-slate-600">Покрытие</div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($finishes as $i => $f)
                                <button type="button"
                                        class="chip {{ $i===0 ? 'chip-active' : '' }}"
                                        data-finish-index="{{ $i }}">
                                    {{ $f['name'] }}
                                </button>
                            @endforeach
                        </div>

                        <div class="mt-5 rounded-2xl bg-white border border-slate-200 p-4">
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-slate-500">Ориентировочно за комплект (4 шт.)</div>
                                <div id="priceLabel" class="text-lg font-extrabold">—</div>
                            </div>
                            <div class="mt-2 text-xs text-slate-500">
                                Итог зависит от состояния дисков, типа краски, необходимости ремонта и лака.
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border border-slate-200 p-4 order-1 sm:order-2">
                        <div class="text-xs font-bold text-slate-600">Превью</div>

                        <div class="mt-3 relative aspect-square w-full grid place-items-center overflow-hidden rounded-2xl bg-slate-50 border border-slate-200">
                            <img id="wheelImg"
                                 src="{{ asset('images/R15/g.png') }}"
                                 alt="Диск"
                                 class="w-[88%] h-[88%] object-contain"
                                 style="mix-blend-mode:multiply; filter:brightness(1) contrast(1.08);">
<div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs">
                                <span id="sizeTag" class="chip bg-white/80 backdrop-blur">{{ $sizes[0]['label'] }}</span>
                                <span id="finishTag" class="chip bg-white/80 backdrop-blur">{{ $finishes[0]['name'] }}</span>
                            </div>
                        </div>

                        <div class="mt-4 flex gap-3">
                            <a href="#contact" class="btn-primary w-full text-center">Записаться</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex items-end justify-between gap-6 flex-wrap">
        <div>
            <h2 class="text-2xl sm:text-3xl font-extrabold">Услуги</h2>
            <p class="mt-2 text-slate-600 max-w-2xl">
                Полимерная покраска — это порошковое покрытие с высокой стойкостью. Подходит для ежедневной эксплуатации и наших дорог.
            </p>
        </div>
        <a href="#contact" class="btn-ghost">Задать вопрос</a>
    </div>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card p-6">
            <div class="text-lg font-extrabold">Покраска дисков</div>
            <p class="mt-2 text-sm text-slate-600">Полная подготовка + грунт + финишный слой порошка.</p>
        </div>
        <div class="card p-6">
            <div class="text-lg font-extrabold">Подбор цвета</div>
            <p class="mt-2 text-sm text-slate-600">Популярные стандартные оттенки + индивидуальные (по согласованию).</p>
        </div>
        <div class="card p-6">
            <div class="text-lg font-extrabold">Консультация</div>
            <p class="mt-2 text-sm text-slate-600">Подскажем по срокам и подготовке. Сориентируем по цене по фото.</p>
        </div>
    </div>
</section>

<section id="works" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-end justify-between gap-6 flex-wrap">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">Работы</h2>
            <p class="mt-2 text-slate-600">До/после и процесс — реальные примеры из мастерской.</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
        @for ($i = 1; $i <= 8; $i++)
            <button type="button" class="group rounded-2xl overflow-hidden bg-slate-100 border border-slate-200"
                    data-job-full="{{ asset('images/Job/' . $i . '.jpg') }}" aria-label="Открыть фото {{ $i }}">
                <img src="{{ asset('images/Job/' . $i . '.jpg') }}"
                     alt="Работа {{ $i }}"
                     class="w-full h-40 md:h-44 object-cover transition-transform duration-300 group-hover:scale-105">
            </button>
        @endfor
    </div>
</section>

<!-- Lightbox -->
<div id="lightbox" class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[9999] p-4">
    <img id="lightboxImg" class="max-w-[95vw] max-h-[90vh] rounded-2xl shadow-2xl" alt="">
</div>

<section id="reviews" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <h2 class="text-2xl sm:text-3xl font-extrabold">Отзывы</h2>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card p-6">
            <div class="text-sm font-extrabold">«Как новые!»</div>
            <p class="mt-2 text-sm text-slate-600">Ровный цвет, без потеков. Сделали быстро.</p>
        </div>
        <div class="card p-6">
            <div class="text-sm font-extrabold">«Понравился подбор»</div>
            <p class="mt-2 text-sm text-slate-600">Антрацит вживую выглядит супер. Спасибо!</p>
        </div>
        <div class="card p-6">
            <div class="text-sm font-extrabold">«Отличный сервис»</div>
            <p class="mt-2 text-sm text-slate-600">Все объяснили, сроки соблюли.</p>
        </div>
    </div>
</section>

<section id="contact" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        <div class="card p-6">
            <h2 class="text-2xl font-extrabold">Оставить заявку</h2>
<p class="mt-2 text-sm text-slate-600">
    Напишите номер и комментарий — перезвоним. Письмо уйдёт на почту.
</p>

@if (session('ok'))
    <div class="mt-4 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-900">
        {{ session('ok') }}
    </div>
@endif

@if ($errors->any())
    <div class="mt-4 rounded-2xl bg-red-50 border border-red-200 p-4 text-sm text-red-900">
        <div class="font-bold mb-2">Проверьте поля:</div>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Блок для AJAX-статуса --}}
<div id="leadFormStatus" class="mt-4 hidden text-sm rounded-2xl px-4 py-3"></div>

<form id="leadForm"
      class="mt-6 grid grid-cols-1 gap-4"
      method="POST"
      action="{{ route('lead.send') }}">
    @csrf
    <div>
        <label class="text-xs font-bold text-slate-600">Имя</label>
        <input name="name"
               value="{{ old('name') }}"
               class="mt-1 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:ring-2 focus:ring-orange-200"
               placeholder="Как к вам обращаться">
        <p class="mt-1 text-[11px] text-slate-400">
            Разрешены буквы (рус/англ), пробелы, запятые, точки. До 30 символов.
        </p>
    </div>
    <div>
        <label class="text-xs font-bold text-slate-600">Телефон *</label>
        <input name="phone"
               value="{{ old('phone') }}"
               required
               class="mt-1 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:ring-2 focus:ring-orange-200"
               placeholder="+7 (___) ___-__-__">
        <p class="mt-1 text-[11px] text-slate-400">
            Разрешены цифры, пробелы, +, -, (, ). До 20 символов.
        </p>
    </div>
    <div>
        <label class="text-xs font-bold text-slate-600">Комментарий</label>
        <textarea name="message"
                  rows="4"
                  class="mt-1 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:ring-2 focus:ring-orange-200"
                  placeholder="Размер, цвет, состояние дисков...">{{ old('message') }}</textarea>
        <p class="mt-1 text-[11px] text-slate-400">
            До 1000 символов.
        </p>
    </div>

    <button class="btn-primary w-full" type="submit">
        <span class="inline-flex items-center justify-center gap-2">
            <span id="leadFormBtnText">Отправить</span>
            <span id="leadFormSpinner"
                  class="hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
        </span>
    </button>

    <div class="text-xs text-slate-500">
        Отправляя форму, вы соглашаетесь на обработку контактных данных для обратной связи.
    </div>
</form>
        </div>

        <div class="card p-6">
            <h3 class="text-xl font-extrabold">Как нас найти</h3>
            <div class="mt-3 text-sm text-slate-600">
                НСО, г. Бердск, пер. Промышленный 2а/4
            </div>

            <div class="mt-5 overflow-hidden rounded-2xl border border-slate-200">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?ll=83.096077%2C54.766532&mode=whatshere&whatshere%5Bpoint%5D=83.096077%2C54.766532&whatshere%5Bzoom%5D=16&z=16"
                    width="100%" height="360" frameborder="0" allowfullscreen="true">
                </iframe>
            </div>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                <a href="tel:+79138954525" class="btn-primary text-center">Позвонить</a>
                <a href="#contact" class="btn-ghost text-center">Написать</a>
            </div>
        </div>
    </div>
</section>

<script>
    // Данные из PHP (контроллер/вью)
    const SIZES = @json($sizes);
    const FINISHES = @json($finishes);

    let activeSize = 0;
    let activeFinish = 0;

    const wheelImg = document.getElementById('wheelImg');
    const sizeTag = document.getElementById('sizeTag');
    const finishTag = document.getElementById('finishTag');
    const priceLabel = document.getElementById('priceLabel');

    // Lightbox (для превью диска и галереи работ)
    const lb = document.getElementById('lightbox');
    const lbImg = document.getElementById('lightboxImg');

    function joinUrl(base, path) {
        try {
            return new URL(path, base.endsWith('/') ? base : (base + '/')).toString();
        } catch (e) {
            // fallback
            if (!base) return path;
            if (base.endsWith('/') && path.startsWith('/')) return base + path.slice(1);
            if (!base.endsWith('/') && !path.startsWith('/')) return base + '/' + path;
            return base + path;
        }
    }

    function getFolderFromSize(s) {
        if (s.folder) return s.folder; // например "images/R15"
        if (s.img) {
            // например "https://site.ru/images/R15/g.png" или "/images/R15/g.png"
            return s.img.replace(/\/[^\/]+$/, '');
        }
        return 'images/R15';
    }

    function renderPreview() {
        const s = SIZES[activeSize];
        const f = FINISHES[activeFinish];

        const folder = getFolderFromSize(s);
        const filename = f.file || 'g.png';

        // Если folder абсолютный URL, используем URL-конструктор
        let src;
        if (/^https?:\/\//i.test(folder)) {
            src = joinUrl(folder, filename);
        } else {
            // folder может быть "images/R15" или "/images/R15"
            const norm = folder.startsWith('/') ? folder.slice(1) : folder;
            src = joinUrl("{{ rtrim(asset(''), '/') }}", norm + '/' + filename);
        }

        wheelImg.src = src;

        sizeTag.textContent = s.label || 'R15';
        finishTag.textContent = f.name || 'Оригинал';

        if (priceLabel && s.price) {
            priceLabel.textContent = new Intl.NumberFormat('ru-RU').format(s.price) + ' ₽';
        }
    }

    // Кнопки размеров
    document.querySelectorAll('[data-size-index]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[data-size-index]').forEach(b => b.classList.remove('chip-active'));
            btn.classList.add('chip-active');
            activeSize = Number(btn.dataset.sizeIndex);
            renderPreview();
        });
    });

    // Кнопки покрытий
    document.querySelectorAll('[data-finish-index]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[data-finish-index]').forEach(b => b.classList.remove('chip-active'));
            btn.classList.add('chip-active');
            activeFinish = Number(btn.dataset.finishIndex);
            renderPreview();
        });
    });

    // Увеличение превью диска
    if (wheelImg) {
        wheelImg.addEventListener('click', () => {
            if (!lb || !lbImg) return;
            lbImg.src = wheelImg.src;
            lb.classList.remove('hidden');
            lb.classList.add('flex');
        });
    }

    // Lightbox close
    if (lb) {
        lb.addEventListener('click', (e) => {
            if (e.target === lb || e.target === lbImg) {
                lb.classList.add('hidden');
                lb.classList.remove('flex');
            }
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                lb.classList.add('hidden');
                lb.classList.remove('flex');
            }
        });
    }

    // Галерея работ: клик по миниатюре -> lightbox
    document.querySelectorAll('[data-job-full]').forEach(el => {
        el.addEventListener('click', () => {
            if (!lb || !lbImg) return;
            lbImg.src = el.dataset.jobFull;
            lb.classList.remove('hidden');
            lb.classList.add('flex');
        });
    });

    // Первый рендер
    renderPreview();


   // === AJAX-отправка формы заявки ===
    const leadForm = document.getElementById('leadForm');
    const leadStatus = document.getElementById('leadFormStatus');
    const leadBtnText = document.getElementById('leadFormBtnText');
    const leadSpinner = document.getElementById('leadFormSpinner');

    if (leadForm && leadStatus && leadBtnText && leadSpinner) {
        leadForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Сбрасываем статус
            leadStatus.classList.add('hidden');
            leadStatus.classList.remove(
                'bg-emerald-50', 'border-emerald-200', 'text-emerald-900',
                'bg-red-50', 'border-red-200', 'text-red-900', 'border'
            );
            leadStatus.textContent = '';

            // Блокируем кнопку и показываем спиннер
            const submitBtn = leadForm.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;
            leadBtnText.textContent = 'Отправляем...';
            leadSpinner.classList.remove('hidden');

            const url = leadForm.getAttribute('action');
            const formData = new FormData(leadForm);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const contentType = response.headers.get('content-type') || '';
                const isJson = contentType.includes('application/json');
                let data = {};

                if (isJson) {
                    data = await response.json();
                }

                if (!response.ok) {
                    // Ошибки валидации 422
                    if (response.status === 422 && isJson && data.errors) {
                        const messages = Object.values(data.errors).flat();
                        leadStatus.textContent = messages.join(' ');
                    } else {
                        leadStatus.textContent = data.message || 'Ошибка при отправке. Попробуйте ещё раз.';
                    }

                    leadStatus.classList.remove('hidden');
                    leadStatus.classList.add(
                        'border', 'bg-red-50', 'border-red-200', 'text-red-900'
                    );
                } else {
                    // Успешно
                    leadStatus.textContent = data.message || 'Заявка отправлена. Мы свяжемся с вами в ближайшее время.';
                    leadStatus.classList.remove('hidden');
                    leadStatus.classList.add(
                        'border', 'bg-emerald-50', 'border-emerald-200', 'text-emerald-900'
                    );
                    leadForm.reset();
                }
            } catch (error) {
                console.error(error);
                leadStatus.textContent = 'Ошибка соединения с сервером. Попробуйте ещё раз.';
                leadStatus.classList.remove('hidden');
                leadStatus.classList.add(
                    'border', 'bg-red-50', 'border-red-200', 'text-red-900'
                );
            } finally {
                // Возвращаем кнопку в нормальное состояние
                if (submitBtn) submitBtn.disabled = false;
                leadBtnText.textContent = 'Отправить';
                leadSpinner.classList.add('hidden');
            }
        });
    }


</script>
@endsection
=======
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23e74c3c'/><circle cx='50' cy='50' r='35' fill='%232c3e50'/><circle cx='50' cy='50' r='25' fill='%23e74c3c'/><circle cx='50' cy='50' r='15' fill='%232c3e50'/></svg>">
    <title>Покраска дисков - МАКСТАР</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #e74c3c;
            --accent: #3498db;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        header {
            background-color: var(--primary);
            color: white;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: var(--secondary);
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1563720223480-8ddab6905c0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .btn {
            display: inline-block;
            background-color: var(--secondary);
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #c0392b;
        }
        
        .section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2rem;
            color: var(--primary);
        }
        
        .services {
            background-color: white;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .service-card {
            background-color: var(--light);
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .service-icon {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 20px;
        }
        
        .service-card h3 {
            margin-bottom: 15px;
            color: var(--primary);
        }
        
        .visualizer {
            background-color: #f5f5f5;
        }
        
        .visualizer-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .wheel-display {
            width: 350px;
            height: 350px;
            margin-bottom: 30px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .wheel {
            width: 100%;
            height: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            transition: filter 0.5s ease;
            filter: brightness(1) saturate(1) hue-rotate(0deg);
        }
        
        .color-picker {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            max-width: 600px;
        }
        
        .color-option {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s;
            position: relative;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        .color-option:hover {
            transform: scale(1.1);
        }
        
        .color-option.active {
            border-color: var(--dark);
            transform: scale(1.15);
        }
        
        .color-name {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8rem;
            white-space: nowrap;
            color: var(--dark);
            font-weight: 500;
        }
        
        .size-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .size-option {
            padding: 12px 25px;
            background-color: white;
            border: 2px solid var(--primary);
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .size-option.active {
            background-color: var(--primary);
            color: white;
        }
        
        .style-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .style-option {
            padding: 10px 20px;
            background-color: white;
            border: 2px solid var(--accent);
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .style-option.active {
            background-color: var(--accent);
            color: white;
        }
        
        .visualizer-info {
            text-align: center;
            max-width: 600px;
            margin-top: 20px;
        }
        
        .contact {
            background-color: white;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        .contact-info h3 {
            margin-bottom: 20px;
            color: var(--primary);
        }
        
        .contact-info p {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .contact-info i {
            margin-right: 10px;
            color: var(--secondary);
        }
        
        .map {
            height: 300px;
            background-color: #eee;
            border-radius: 8px;
            overflow: hidden;
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: var(--secondary);
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }
            
            .logo {
                margin-bottom: 15px;
            }
            
            nav ul {
                flex-direction: column;
                align-items: center;
            }
            
            nav ul li {
                margin: 10px 0;
            }
            
            .mobile-menu-btn {
                display: block;
                position: absolute;
                right: 15px;
                top: 15px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .section {
                padding: 50px 0;
            }
            
            .wheel-display {
                width: 280px;
                height: 280px;
            }
            
            .color-option {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">МАКС<span>ТАР</span></div>
                <button class="mobile-menu-btn">☰</button>
                <nav>
                    <ul>
                        <li><a href="#services">Услуги</a></li>
                        <li><a href="#visualizer">Визуализатор</a></li>
                        <li><a href="#contact">Контакты</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Профессиональная покраска автомобильных дисков</h1>
            <p>Пескоструйная обработка и покраска полимерной краской. Вернем вашим дискам идеальный вид!</p>
            <a href="#visualizer" class="btn">Выбрать цвет</a>
        </div>
    </section>

    <section id="services" class="section services">
        <div class="container">
            <h2 class="section-title">Наши услуги</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🔄</div>
                    <h3>Пескоструйная обработка</h3>
                    <p>Тщательная очистка дисков от старого покрытия и коррозии перед покраской</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3>Покраска полимерной краской</h3>
                    <p>Используем качественные полимерные краски, устойчивые к внешним воздействиям</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">✨</div>
                    <h3>Полировка и защита</h3>
                    <p>Финальная полировка и нанесение защитного покрытия для долговечности</p>
                </div>
            </div>
        </div>
    </section>

    <section id="visualizer" class="section visualizer">
        <div class="container">
            <h2 class="section-title">Визуализатор покраски</h2>
            <div class="visualizer-container">
                <div class="wheel-display">
                    <div class="wheel" id="wheelImage"></div>
                </div>
                
                <div class="style-selector">
                    <div class="style-option active" data-style="sport">Спортивный</div>
                    <div class="style-option" data-style="classic">Классический</div>
                    <div class="style-option" data-style="modern">Современный</div>
                </div>
                
                <div class="size-selector">
                    <div class="size-option active" data-size="17">17"</div>
                    <div class="size-option" data-size="18">18"</div>
                    <div class="size-option" data-size="19">19"</div>
                </div>
                
                <div class="color-picker" id="colorPicker">
                    <!-- Colors will be added by JavaScript -->
                </div>
                
                <div class="visualizer-info">
                    <p>Выберите стиль, размер и цвет, чтобы увидеть как будут выглядеть ваши диски после покраски</p>
                    <p><strong>Реальный результат может незначительно отличаться от визуализации</strong></p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title">Контакты</h2>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>ООО "МАКСТАР"</h3>
                    <p><i>📍</i> г. Новосибирск, ул. Ленина, 12</p>
                    <p><i>📞</i> 8 (913) 895-45-25</p>
                    <p><i>🕒</i> Пн-Пт: 9:00-18:00, Сб: 10:00-16:00</p>
                    <p>Принимаем заказы на покраску автомобильных дисков. Приезжайте к нам для консультации и расчета стоимости работ.</p>
                </div>
                <div class="map">
                    <!-- Здесь будет карта -->
                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A5b4b4b4b4b4b4b4b4b4b4b4b4b4b4b4b&amp;source=constructor" width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>ООО "МАКСТАР" - Покраска автомобильных дисков</p>
            <div class="social-links">
                <a href="https://vk.ru/public105621991" target="_blank">VK</a>
            </div>
            <p>© 2023 Все права защищены</p>
        </div>
    </footer>

    <script>
        // Real wheel images from the internet - WORKING LINKS
        const wheelImages = {
    'sport': {
        '17': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjEyMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDEwbDYwIDEyMEg5MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI5MGwtNjAtMTIwaDYweiIgZmlsbD0iIzY2NiIvPjxwYXRoIGQ9Ik0xMCAxNTBsMTIwIDYwVjkweiIgZmlsbD0iIzY2NiIvPjxwYXRoIGQ9Ik0yOTAgMTUwbC0xMjAgNjB2LTEyMHoiIGZpbGw9IiM2NjYiLz48L3N2Zz4=',
        '18': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjExMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cmVjdCB4PSI3MCIgeT0iNzAiIHdpZHRoPSIxNjAiIGhlaWdodD0iMTYwIiByeD0iMjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHBhdGggZD0iTTE1MCA3MGwwIDE2ME03MCAxNTBoMTYwIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iMyIvPjwvc3ZnPg==',
        '19': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjEwMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDUwbDc1IDEzNUg3NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI1MGwtNzUtMTM1aDE1MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNNTAgMTUwbDEzNSA3NVY3NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMjUwIDE1MGwtMTM1IDc1Vjc1eiIgZmlsbD0iIzY2NiIvPjwvc3ZnPg=='
    },
    'classic': {
        '17': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjEwMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjMiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjYwIiBmaWxsPSJub25lIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iMiIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNDAiIGZpbGw9IiM2NjYiLz48L3N2Zz4=',
        '18': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjkwIiBmaWxsPSJub25lIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iNCIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHJlY3QgeD0iMTEwIiB5PSIxMTAiIHdpZHRoPSI4MCIgaGVpZ2h0PSI4MCIgcng9IjEwIiBmaWxsPSIjNjY2Ii8+PC9zdmc+',
        '19': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9Ijg1IiBmaWxsPSJub25lIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iNSIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNDUiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHBhdGggZD0iTTE1MCA2NWw0MCA4MEgxMTB6IiBmaWxsPSIjNjY2Ii8+PHBhdGggZD0iTTE1MCAyMzVsLTQwLTgwaDgweiIgZmlsbD0iIzY2NiIvPjxwYXRoIGQ9Ik02NSAxNTBsODAgNDBWNjV6IiBmaWxsPSIjNjY2Ii8+PHBhdGggZD0iTTIzNSAxNTBsLTgwIDQwVjY1eiIgZmlsbD0iIzY2NiIvPjwvc3ZnPg=='
    },
    'modern': {
        '17': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDQwbDcwIDE0MEg4MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI2MGwtNzAtMTQwaDE0MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMzAgMTUwbDE0MCA3MFY4MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMjcwIDE1MGwtMTQwIDcwVjgweiIgZmlsbD0iIzY2NiIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIyIi8+PC9zdmc+',
        '18': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cmVjdCB4PSI4MCIgeT0iODAiIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIiByeD0iMjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSI0Ii8+PHJlY3QgeD0iMTAwIiB5PSIxMDAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiByeD0iMTUiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHJlY3QgeD0iMTIwIiB5PSIxMjAiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcng9IjEwIiBmaWxsPSIjNjY2Ii8+PC9zdmc+',
        '19': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDU1bDU1IDExMEg5NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI0NWwtNTUtMTEwaDExMHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNNTUgMTUwbDExMCA1NVY5NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMjQ1IDE1MGwtMTEwIDU1Vjk1eiIgZmlsbD0iIzY2NiIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNzAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIyIi8+PGNpcmNsZSBjeD0iMTUwIiBjeT0iMTUwIiByPSIzNSIgZmlsbD0iIzY2NiIvPjwvc3ZnPg=='
    }
};

        // Fallback wheel images in case the main ones fail
        const fallbackWheelImages = {
            'sport': {
                '17': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Спорт+17%22',
                '18': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Спорт+18%22',
                '19': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Спорт+19%22'
            },
            'classic': {
                '17': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Классика+17%22',
                '18': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Классика+18%22',
                '19': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Классика+19%22'
            },
            'modern': {
                '17': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Модерн+17%22',
                '18': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Модерн+18%22',
                '19': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Модерн+19%22'
            }
        };

        // Colors for the wheel visualizer with proper hue values
        const colors = [
            { name: 'Серебристый', value: '#c0c0c0', hue: 0, saturation: 0, brightness: 1.2 },
            { name: 'Черный', value: '#2a2a2a', hue: 0, saturation: 0, brightness: 0.7 },
            { name: 'Белый', value: '#ffffff', hue: 0, saturation: 0, brightness: 1.3 },
            { name: 'Серый', value: '#808080', hue: 0, saturation: 0, brightness: 1.0 },
            { name: 'Красный', value: '#ff0000', hue: 0, saturation: 1.2, brightness: 1.1 },
            { name: 'Синий', value: '#0000ff', hue: 240, saturation: 1.3, brightness: 1.0 },
            { name: 'Золотой', value: '#ffd700', hue: 51, saturation: 1.2, brightness: 1.3 },
            { name: 'Бронзовый', value: '#cd7f32', hue: 30, saturation: 0.9, brightness: 1.1 },
            { name: 'Голубой', value: '#87ceeb', hue: 197, saturation: 0.7, brightness: 1.2 },
            { name: 'Оранжевый', value: '#ffa500', hue: 39, saturation: 1.2, brightness: 1.2 },
            { name: 'Зеленый', value: '#008000', hue: 120, saturation: 1.3, brightness: 0.9 },
            { name: 'Фиолетовый', value: '#800080', hue: 300, saturation: 1.2, brightness: 0.9 }
        ];

        // Initialize visualizer
        const colorPicker = document.getElementById('colorPicker');
        const wheelImage = document.getElementById('wheelImage');
        
        let currentStyle = 'sport';
        let currentSize = '17';
        let currentColor = colors[0];

        // Initialize color picker
        colors.forEach(color => {
            const colorOption = document.createElement('div');
            colorOption.className = 'color-option';
            colorOption.style.backgroundColor = color.value;
            colorOption.setAttribute('data-color', JSON.stringify(color));
            colorOption.setAttribute('title', color.name);
            
            const colorName = document.createElement('div');
            colorName.className = 'color-name';
            colorName.textContent = color.name;
            colorOption.appendChild(colorName);
            
            colorOption.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');
                
                currentColor = JSON.parse(this.getAttribute('data-color'));
                updateWheelAppearance();
            });
            
            colorPicker.appendChild(colorOption);
        });
        
        // Set first color as active
        document.querySelector('.color-option').classList.add('active');
        
        // Initialize style selector
        const styleOptions = document.querySelectorAll('.style-option');
        styleOptions.forEach(option => {
            option.addEventListener('click', function() {
                styleOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                
                currentStyle = this.getAttribute('data-style');
                updateWheelAppearance();
            });
        });
        
        // Initialize size selector
        const sizeOptions = document.querySelectorAll('.size-option');
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                sizeOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                
                currentSize = this.getAttribute('data-size');
                updateWheelAppearance();
            });
        });
        
        // Update wheel appearance
        function updateWheelAppearance() {
            const img = new Image();
            const mainImageUrl = wheelImages[currentStyle][currentSize];
            const fallbackImageUrl = fallbackWheelImages[currentStyle][currentSize];
            
            img.onload = function() {
                wheelImage.style.backgroundImage = `url('${mainImageUrl}')`;
                applyColorFilter();
            };
            
            img.onerror = function() {
                wheelImage.style.backgroundImage = `url('${fallbackImageUrl}')`;
                applyColorFilter();
            };
            
            img.src = mainImageUrl;
        }
        
        // Apply color filter to wheel
        function applyColorFilter() {
            const filter = `
                hue-rotate(${currentColor.hue}deg) 
                saturate(${currentColor.saturation}) 
                brightness(${currentColor.brightness})
            `;
            wheelImage.style.filter = filter;
        }
        
        // Initialize with default values
        updateWheelAppearance();
        
        // Mobile menu functionality
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const nav = document.querySelector('nav');
        
        mobileMenuBtn.addEventListener('click', function() {
            nav.style.display = nav.style.display === 'block' ? 'none' : 'block';
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
>>>>>>> 940e35ecfb49a7c334f9e6f870acf7eea0daf4ac
