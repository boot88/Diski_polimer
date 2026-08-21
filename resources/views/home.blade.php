{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')

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
                    <div class="text-sm font-extrabold">Подбор цвета покрытия</div>
                    <div class="text-xs text-slate-500">размер влияет на цену, покрытие — на визуализацию</div>
                </div>

                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Блок с размерами/цветами/ценой --}}
                    <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4 order-2 sm:order-1">
                        <div class="text-xs font-bold text-slate-600">Размер диска</div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($sizes as $i => $s)
                                <button type="button"
                                        class="chip {{ $i===0 ? 'chip-active' : '' }}"
                                        data-size-index="{{ $i }}"
                                        aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                                    {{ $s['label'] }}
                                </button>
                            @endforeach
                        </div>

                        <p class="mt-2 text-xs leading-relaxed text-slate-500">Размер используется для расчёта. На иллюстрации не меняется модель или геометрия диска.</p>

                        <div class="mt-4 text-xs font-bold text-slate-600">Покрытие</div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($finishes as $i => $f)
                                <button type="button"
                                        class="chip {{ $i===0 ? 'chip-active' : '' }}"
                                        data-finish-index="{{ $i }}"
                                        aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
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
                        <div class="text-xs font-bold text-slate-600">Визуализация цвета</div>

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
                        <p class="mt-3 text-xs leading-relaxed text-slate-500">Условный диск показывает оттенок покрытия. Точный вид зависит от модели, фактуры и освещения.</p>

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
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">Варианты покрытия</h2>
            <p class="mt-2 text-slate-600 max-w-2xl">Посмотрите оттенки на условном диске. Галерею реальных работ «до/после» добавим, когда будут фотографии из мастерской.</p>
        </div>
        <div class="flex items-center gap-2" aria-label="Прокрутка вариантов покрытия">
            <button type="button" class="btn-ghost !px-3 !py-2" data-slider-direction="-1" aria-label="Предыдущий вариант">←</button>
            <button type="button" class="btn-ghost !px-3 !py-2" data-slider-direction="1" aria-label="Следующий вариант">→</button>
        </div>
    </div>

    <div id="coatingSlider" class="coating-slider mt-8 flex gap-4 overflow-x-auto snap-x snap-mandatory pb-4" aria-label="Варианты покрытия">
        @foreach($finishes as $i => $finish)
            <article class="coating-slide card w-[82vw] max-w-[360px] shrink-0 snap-start p-5 sm:w-[340px]">
                <div class="aspect-[4/3] overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 grid place-items-center">
                    <img src="{{ asset('images/R15/' . $finish['file']) }}"
                         alt="{{ $finish['name'] }} — визуализация покрытия"
                         class="h-[88%] w-[88%] object-contain"
                         loading="lazy"
                         style="mix-blend-mode:multiply; filter:brightness(1) contrast(1.08);">
                </div>
                <p class="mt-4 text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Покрытие</p>
                <h3 class="mt-1 text-lg font-extrabold text-slate-900">{{ $finish['name'] }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">Визуализация оттенка на условном диске.</p>
                <button type="button" class="btn-ghost mt-4 w-full text-sm" data-coating-index="{{ $i }}">Выбрать в подборе</button>
            </article>
        @endforeach
    </div>
    <p class="mt-2 text-sm text-slate-500 sm:hidden">Листайте варианты в сторону.</p>
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

    // Lightbox для увеличения иллюстрации покрытия.
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

    function renderPreview() {
        const s = SIZES[activeSize];
        const f = FINISHES[activeFinish];
        const filename = f.file || 'g.png';
        const src = joinUrl("{{ rtrim(asset('images/R15'), '/') }}", filename);

        if (wheelImg && wheelImg.dataset.finish !== filename) {
            wheelImg.src = src;
            wheelImg.dataset.finish = filename;
        }

        sizeTag.textContent = s.label || 'R15';
        finishTag.textContent = f.name || 'Оригинал';

        if (priceLabel && s.price) {
            priceLabel.textContent = new Intl.NumberFormat('ru-RU').format(s.price) + ' ₽';
        }
    }

    // Кнопки размеров
    document.querySelectorAll('[data-size-index]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[data-size-index]').forEach(b => {
                b.classList.remove('chip-active');
                b.setAttribute('aria-pressed', 'false');
            });
            btn.classList.add('chip-active');
            btn.setAttribute('aria-pressed', 'true');
            activeSize = Number(btn.dataset.sizeIndex);
            renderPreview();
        });
    });

    // Кнопки покрытий
    document.querySelectorAll('[data-finish-index]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[data-finish-index]').forEach(b => {
                b.classList.remove('chip-active');
                b.setAttribute('aria-pressed', 'false');
            });
            btn.classList.add('chip-active');
            btn.setAttribute('aria-pressed', 'true');
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

    const coatingSlider = document.getElementById('coatingSlider');
    document.querySelectorAll('[data-slider-direction]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (!coatingSlider) return;
            coatingSlider.scrollBy({
                left: Number(btn.dataset.sliderDirection) * coatingSlider.clientWidth * 0.82,
                behavior: 'smooth',
            });
        });
    });

    document.querySelectorAll('[data-coating-index]').forEach(btn => {
        btn.addEventListener('click', () => {
            const index = Number(btn.dataset.coatingIndex);
            const finishButton = document.querySelector(`[data-finish-index="${index}"]`);
            if (finishButton) finishButton.click();
            document.getElementById('config')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
