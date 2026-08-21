@extends('layouts.app')

@section('content')
<section class="hero-section" aria-labelledby="hero-title">
    <img src="{{ asset('images/brand/hero-workshop.webp') }}"
         alt="Мастер проверяет покрытие автомобильного диска"
         class="hero-image"
         width="1599"
         height="900"
         fetchpriority="high">
    <div class="hero-overlay"></div>

    <div class="container-wide hero-content">
        <div class="hero-copy">
            <p class="eyebrow eyebrow-light"><span></span> Порошковая покраска · Бердск</p>
            <h1 id="hero-title">Возвращаем дискам точную форму и <em>сильное покрытие</em></h1>
            <p class="hero-lead">Полная подготовка поверхности, порошковая окраска и контроль финиша. Работаем с комплектами R15–R19 и подбираем оттенок под автомобиль.</p>

            <div class="hero-actions">
                <a href="#contact" class="button button-accent">Рассчитать по фото</a>
                <a href="#config" class="button button-light">Подобрать покрытие</a>
            </div>

            <div class="hero-meta" aria-label="Основные условия">
                <div><strong>от 14 400 ₽</strong><span>комплект из 4 дисков</span></div>
                <div><strong>R15–R19</strong><span>легковые диски</span></div>
                <div><strong>Бердск</strong><span>пер. Промышленный, 2а/4</span></div>
            </div>
        </div>
    </div>
</section>

<section class="trust-strip" aria-label="Преимущества">
    <div class="container-wide trust-grid">
        <div><span>01</span><p><strong>Подготовка металла</strong>Снимаем старое покрытие и коррозию</p></div>
        <div><span>02</span><p><strong>Ровный финиш</strong>Порошок без подтёков и непрокрасов</p></div>
        <div><span>03</span><p><strong>Понятная смета</strong>Оцениваем состояние до начала работ</p></div>
    </div>
</section>

<section id="services" class="section section-light">
    <div class="container-wide">
        <div class="section-heading">
            <div>
                <p class="eyebrow"><span></span> Услуги мастерской</p>
                <h2>Не маскируем дефекты — восстанавливаем поверхность</h2>
            </div>
            <p>Покрытие держится только на правильно подготовленном металле. Поэтому результат начинается не с цвета, а с очистки и проверки диска.</p>
        </div>

        <div class="service-grid">
            <article class="service-card service-card-dark">
                <span class="service-number">01</span>
                <h3>Порошковая покраска</h3>
                <p>Стойкое покрытие для ежедневной эксплуатации: город, трасса, реагенты и перепады температуры.</p>
                <ul><li>Очистка поверхности</li><li>Грунтование</li><li>Финишный слой</li></ul>
            </article>
            <article class="service-card">
                <span class="service-number">02</span>
                <h3>Восстановление вида</h3>
                <p>Убираем следы старой краски, окисление и визуальные дефекты перед нанесением покрытия.</p>
                <ul><li>Осмотр дисков</li><li>Подготовка к окраске</li><li>Контроль геометрии</li></ul>
            </article>
            <article class="service-card">
                <span class="service-number">03</span>
                <h3>Подбор финиша</h3>
                <p>Серебро OEM, графит, чёрный, антрацит и бронза — в глянцевом, сатиновом или матовом исполнении.</p>
                <ul><li>Базовые оттенки</li><li>Подбор по образцу</li><li>Согласование до работ</li></ul>
            </article>
        </div>
    </div>
</section>

<section id="process" class="section process-section">
    <div class="container-wide">
        <div class="section-heading section-heading-light">
            <div>
                <p class="eyebrow eyebrow-light"><span></span> Как мы работаем</p>
                <h2>Четыре этапа до готового комплекта</h2>
            </div>
            <p>До начала окраски фиксируем состояние дисков и согласовываем итоговую стоимость.</p>
        </div>

        <ol class="process-grid">
            <li><span>01</span><h3>Оценка</h3><p>Размер, состояние, повреждения и желаемый цвет.</p></li>
            <li><span>02</span><h3>Подготовка</h3><p>Очистка от старого покрытия, коррозии и загрязнений.</p></li>
            <li><span>03</span><h3>Покрытие</h3><p>Грунт, порошковый слой и полимеризация в камере.</p></li>
            <li><span>04</span><h3>Контроль</h3><p>Проверяем равномерность цвета, кромки и финиш.</p></li>
        </ol>
    </div>
</section>

<section id="config" class="section configurator-section">
    <div class="container-wide">
        <div class="config-shell">
            <div class="config-copy">
                <p class="eyebrow"><span></span> Визуальный подбор</p>
                <h2>Подберите размер и покрытие</h2>
                <p>Теперь для R15, R17 и R19 используются разные модели дисков. Цветовая визуализация показывает характер оттенка, но итог зависит от освещения и фактуры металла.</p>

                <fieldset class="selector-group">
                    <legend>1. Размер и модель</legend>
                    <div class="size-selector">
                        @foreach($sizes as $i => $size)
                            <button type="button"
                                    class="selector-button {{ $i === 0 ? 'is-active' : '' }}"
                                    data-size-index="{{ $i }}"
                                    aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                                <strong>{{ $size['label'] }}</strong>
                                <span>{{ $size['name'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset class="selector-group">
                    <legend>2. Покрытие</legend>
                    <div class="finish-selector">
                        @foreach($finishes as $i => $finish)
                            <button type="button"
                                    class="finish-button {{ $i === 0 ? 'is-active' : '' }}"
                                    data-finish-index="{{ $i }}"
                                    aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                                <span class="finish-swatch" style="--swatch: {{ $finish['swatch'] }}"></span>
                                <span>{{ $finish['name'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </fieldset>

                <div class="config-price">
                    <div><span>Ориентир за комплект</span><strong id="priceLabel">14 400 ₽</strong></div>
                    <p>Точная цена зависит от состояния, ширины диска, сложности цвета и дополнительных работ.</p>
                </div>
            </div>

            <div class="wheel-stage">
                <div class="wheel-stage-top">
                    <span>Визуализация цвета</span>
                    <span id="modelTag">R15 · Classic 5</span>
                </div>
                <div class="wheel-backdrop" aria-live="polite">
                    <div class="wheel-halo"></div>
                    <img id="wheelImg"
                         src="{{ asset($sizes[0]['image']) }}"
                         alt="Диск R15 в покрытии Серебро OEM"
                         class="wheel-visual tone-{{ $finishes[0]['tone'] }}"
                         width="960"
                         height="960">
                </div>
                <div class="wheel-stage-bottom">
                    <div><span>Размер</span><strong id="sizeTag">{{ $sizes[0]['label'] }}</strong></div>
                    <div><span>Покрытие</span><strong id="finishTag">{{ $finishes[0]['name'] }}</strong></div>
                </div>
                <a href="#contact" class="button button-dark button-full">Получить точный расчёт</a>
            </div>
        </div>
    </div>
</section>

<section id="works" class="section coatings-section">
    <div class="container-wide">
        <div class="section-heading">
            <div>
                <p class="eyebrow"><span></span> Варианты покрытия</p>
                <h2>Шесть спокойных автомобильных оттенков</h2>
            </div>
            <div class="slider-controls" aria-label="Прокрутка вариантов">
                <button type="button" data-slider-direction="-1" aria-label="Предыдущий вариант">←</button>
                <button type="button" data-slider-direction="1" aria-label="Следующий вариант">→</button>
            </div>
        </div>

        <div id="coatingSlider" class="coating-slider" aria-label="Галерея вариантов покрытия">
            @foreach($finishes as $i => $finish)
                @php($gallerySize = $sizes[$i % count($sizes)])
                <article class="coating-card">
                    <div class="coating-visual">
                        <span>{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <img src="{{ asset($gallerySize['image']) }}"
                             alt="{{ $finish['name'] }} на модели {{ $gallerySize['label'] }}"
                             class="tone-{{ $finish['tone'] }}"
                             width="960"
                             height="960"
                             loading="lazy">
                    </div>
                    <div class="coating-info">
                        <div><p>{{ $gallerySize['label'] }} · {{ $gallerySize['name'] }}</p><h3>{{ $finish['name'] }}</h3></div>
                        <button type="button" data-coating-index="{{ $i }}" data-gallery-size-index="{{ $i % count($sizes) }}">Выбрать</button>
                    </div>
                </article>
            @endforeach
        </div>
        <p class="swipe-hint">Проведите пальцем в сторону, чтобы посмотреть все варианты.</p>
    </div>
</section>

<section class="section pricing-section">
    <div class="container-wide pricing-shell">
        <div>
            <p class="eyebrow eyebrow-light"><span></span> Стоимость</p>
            <h2>Цена зависит от работы, а не только от диаметра</h2>
        </div>
        <div class="pricing-list">
            <div><span>R15 · комплект</span><strong>от 14 400 ₽</strong></div>
            <div><span>R17 · комплект</span><strong>от 16 400 ₽</strong></div>
            <div><span>R19 · комплект</span><strong>от 18 400 ₽</strong></div>
            <p>На расчёт влияют слой старого покрытия, коррозия, сложность изделия, размер и выбранный финиш.</p>
        </div>
    </div>
</section>

<section class="section faq-section">
    <div class="container-wide faq-grid">
        <div>
            <p class="eyebrow"><span></span> Частые вопросы</p>
            <h2>Перед тем как привезти диски</h2>
        </div>
        <div class="faq-list">
            <details open><summary>Можно оценить работу по фотографии?</summary><p>Да. Пришлите общий вид комплекта и крупно самые повреждённые места. Предварительно назовём диапазон цены, окончательно — после осмотра.</p></details>
            <details><summary>Цвет на экране совпадёт с реальным?</summary><p>Визуализатор показывает направление оттенка. На восприятие влияют экран, освещение, фактура и степень блеска, поэтому цвет согласуем отдельно.</p></details>
            <details><summary>Что входит в ориентировочную цену?</summary><p>Базовая подготовка и порошковая окраска комплекта. Ремонт повреждений и сложные многослойные покрытия оцениваются отдельно.</p></details>
        </div>
    </div>
</section>

<section id="contact" class="section contact-section">
    <div class="container-wide contact-grid">
        <div class="contact-form-card">
            <p class="eyebrow"><span></span> Заявка на расчёт</p>
            <h2>Опишите комплект — мы перезвоним</h2>
            <p class="contact-intro">Укажите размер дисков, желаемый цвет и заметные повреждения.</p>

            @if (session('ok'))
                <div class="form-message form-message-success">{{ session('ok') }}</div>
            @endif

            @if ($errors->any())
                <div class="form-message form-message-error">
                    <strong>Проверьте поля:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="leadFormStatus" class="form-message" hidden></div>

            <form id="leadForm" class="lead-form" method="POST" action="{{ route('lead.send') }}">
                @csrf
                <label>
                    <span>Имя</span>
                    <input name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Как к вам обращаться">
                </label>
                <label>
                    <span>Телефон *</span>
                    <input name="phone" value="{{ old('phone') }}" required inputmode="tel" autocomplete="tel" placeholder="+7 913 000-00-00">
                </label>
                <label>
                    <span>Размер, цвет, состояние</span>
                    <textarea name="message" rows="4" placeholder="Например: R17, графит, есть сколы и коррозия">{{ old('message') }}</textarea>
                </label>
                <button class="button button-accent button-full" type="submit">
                    <span id="leadFormBtnText">Отправить заявку</span>
                    <span id="leadFormSpinner" class="form-spinner" hidden></span>
                </button>
                <small>Нажимая кнопку, вы соглашаетесь на обработку контактных данных для обратной связи.</small>
            </form>
        </div>

        <div class="location-card">
            <div class="location-copy">
                <p class="eyebrow eyebrow-light"><span></span> Мастерская</p>
                <h2>Бердск, пер. Промышленный, 2а/4</h2>
                <p>Режим работы уточняйте по телефону перед поездкой.</p>
                <div class="location-actions">
                    <a href="tel:+79138954525" class="button button-accent">Позвонить</a>
                    <a href="https://yandex.ru/maps/?text=%D0%9D%D0%A1%D0%9E%2C%20%D0%91%D0%B5%D1%80%D0%B4%D1%81%D0%BA%2C%20%D0%BF%D0%B5%D1%80.%20%D0%9F%D1%80%D0%BE%D0%BC%D1%8B%D1%88%D0%BB%D0%B5%D0%BD%D0%BD%D1%8B%D0%B9%202%D0%B0%2F4" class="button button-outline-light" target="_blank" rel="noopener">Как проехать</a>
                </div>
            </div>
            <iframe
                title="НСК Макстар на карте"
                src="https://yandex.ru/map-widget/v1/?ll=83.096077%2C54.766532&mode=whatshere&whatshere%5Bpoint%5D=83.096077%2C54.766532&whatshere%5Bzoom%5D=16&z=16"
                loading="lazy"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<script>
    const SIZES = @json($sizes);
    const FINISHES = @json($finishes);
    const ASSET_BASE = @json(rtrim(asset(''), '/'));
    const TONE_CLASSES = FINISHES.map(finish => `tone-${finish.tone}`);

    let activeSize = 0;
    let activeFinish = 0;

    const wheelImg = document.getElementById('wheelImg');
    const sizeTag = document.getElementById('sizeTag');
    const finishTag = document.getElementById('finishTag');
    const modelTag = document.getElementById('modelTag');
    const priceLabel = document.getElementById('priceLabel');

    function joinUrl(base, path) {
        try {
            return new URL(path, base.endsWith('/') ? base : `${base}/`).toString();
        } catch (error) {
            return `${base.replace(/\/$/, '')}/${path.replace(/^\//, '')}`;
        }
    }

    function setSelectedButtons(selector, selectedButton) {
        document.querySelectorAll(selector).forEach(button => {
            const isSelected = button === selectedButton;
            button.classList.toggle('is-active', isSelected);
            button.setAttribute('aria-pressed', String(isSelected));
        });
    }

    function renderPreview() {
        const size = SIZES[activeSize];
        const finish = FINISHES[activeFinish];

        wheelImg.src = joinUrl(ASSET_BASE, size.image);
        wheelImg.classList.remove(...TONE_CLASSES);
        wheelImg.classList.add(`tone-${finish.tone}`);
        wheelImg.alt = `Диск ${size.label} в покрытии ${finish.name}`;

        sizeTag.textContent = size.label;
        finishTag.textContent = finish.name;
        modelTag.textContent = `${size.label} · ${size.name}`;
        priceLabel.textContent = `${new Intl.NumberFormat('ru-RU').format(size.price)} ₽`;
    }

    document.querySelectorAll('[data-size-index]').forEach(button => {
        button.addEventListener('click', () => {
            activeSize = Number(button.dataset.sizeIndex);
            setSelectedButtons('[data-size-index]', button);
            renderPreview();
        });
    });

    document.querySelectorAll('[data-finish-index]').forEach(button => {
        button.addEventListener('click', () => {
            activeFinish = Number(button.dataset.finishIndex);
            setSelectedButtons('[data-finish-index]', button);
            renderPreview();
        });
    });

    const coatingSlider = document.getElementById('coatingSlider');
    document.querySelectorAll('[data-slider-direction]').forEach(button => {
        button.addEventListener('click', () => {
            if (!coatingSlider) return;
            coatingSlider.scrollBy({
                left: Number(button.dataset.sliderDirection) * Math.min(coatingSlider.clientWidth * 0.86, 760),
                behavior: 'smooth',
            });
        });
    });

    document.querySelectorAll('[data-coating-index]').forEach(button => {
        button.addEventListener('click', () => {
            const finishButton = document.querySelector(`[data-finish-index="${button.dataset.coatingIndex}"]`);
            const sizeButton = document.querySelector(`[data-size-index="${button.dataset.gallerySizeIndex}"]`);
            if (sizeButton) sizeButton.click();
            if (finishButton) finishButton.click();
            document.getElementById('config').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    const leadForm = document.getElementById('leadForm');
    const leadStatus = document.getElementById('leadFormStatus');
    const leadBtnText = document.getElementById('leadFormBtnText');
    const leadSpinner = document.getElementById('leadFormSpinner');

    if (leadForm && leadStatus && leadBtnText && leadSpinner) {
        leadForm.addEventListener('submit', async event => {
            event.preventDefault();
            const submitButton = leadForm.querySelector('button[type="submit"]');

            leadStatus.hidden = true;
            leadStatus.className = 'form-message';
            if (submitButton) submitButton.disabled = true;
            leadBtnText.textContent = 'Отправляем…';
            leadSpinner.hidden = false;

            try {
                const response = await fetch(leadForm.action, {
                    method: 'POST',
                    headers: {'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json'},
                    body: new FormData(leadForm),
                });
                const isJson = (response.headers.get('content-type') || '').includes('application/json');
                const data = isJson ? await response.json() : {};

                if (!response.ok) {
                    const errors = data.errors ? Object.values(data.errors).flat().join(' ') : null;
                    throw new Error(errors || data.message || 'Не удалось отправить заявку. Позвоните нам или попробуйте ещё раз.');
                }

                leadStatus.textContent = data.message || 'Заявка отправлена. Мы свяжемся с вами в ближайшее время.';
                leadStatus.classList.add('form-message-success');
                leadStatus.hidden = false;
                leadForm.reset();
            } catch (error) {
                leadStatus.textContent = error.message || 'Ошибка соединения. Попробуйте ещё раз.';
                leadStatus.classList.add('form-message-error');
                leadStatus.hidden = false;
            } finally {
                if (submitButton) submitButton.disabled = false;
                leadBtnText.textContent = 'Отправить заявку';
                leadSpinner.hidden = true;
            }
        });
    }

    renderPreview();
</script>
@endsection
