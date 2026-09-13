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
    <div class="modern-hero-art modern-copy" aria-hidden="true">
        <span class="hero-orbit"></span><span class="hero-art-word">MAXTAR</span>
        <div class="hero-wheel" style="--hero-wheel-image: url('{{ asset($sizes[2]['image']) }}')"></div>
        <span class="hero-art-label">POWDER COATING / R15—R19</span>
        <span class="hero-art-note">Ваш стиль.<br>В каждой детали.</span>
    </div>

    <div class="container-wide hero-content">
        <div class="hero-copy">
            <p class="eyebrow eyebrow-light"><span></span> НСК Макстар · Бердск / Новосибирск</p>
            <h1 id="hero-title"><span class="classic-copy">Возвращаем дискам точную форму и <em>сильное покрытие</em></span><span class="modern-copy">Те же диски.<br>Совсем другой<br><em>характер.</em></span></h1>
            <p class="hero-lead">Порошковая покраска дисков в Бердске. От спокойного серебра до выразительного графита — подберём покрытие под ваш автомобиль.</p>

            <div class="hero-actions">
                <a href="#contact" class="button button-accent">Оценить по фото</a>
                <a href="#config" class="button button-light">Подобрать покрытие</a>
            </div>

            <div class="hero-meta" aria-label="Основные условия">
                <div><strong>от {{ number_format($sizes[0]['price'], 0, ',', ' ') }} ₽</strong><span>комплект из 4 дисков</span></div>
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
                <p>Выберите диаметр и оттенок. Посмотрите сочетание и узнайте предварительную стоимость комплекта из четырёх дисков. Реальный цвет согласуем по образцу.</p>

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
                    <div><span>Ориентир за комплект</span><strong id="priceLabel" aria-live="polite">{{ number_format($sizes[0]['price'], 0, ',', ' ') }} ₽</strong></div>
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
                         height="960" loading="lazy" decoding="async">
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
                             loading="lazy" decoding="async">
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
            @foreach($sizes as $size)
                <div><span>{{ $size['label'] }} · комплект</span><strong>от {{ number_format($size['price'], 0, ',', ' ') }} ₽</strong></div>
            @endforeach
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
            <p class="contact-intro">Приложите фото дисков, укажите размер и заметные повреждения — так предварительная оценка будет точнее.</p>

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

            <div id="leadFormStatus" class="form-message" role="status" aria-live="polite" tabindex="-1" hidden></div>

            <form id="leadForm" class="lead-form" method="POST" action="{{ route('lead.send') }}" enctype="multipart/form-data">
                @csrf
                <input aria-label="Оставьте поле пустым" class="honeypot-field" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
                <label>
                    <span>Имя</span>
                    <input name="name" maxlength="80" value="{{ old('name') }}" autocomplete="name" placeholder="Как к вам обращаться">
                </label>
                <label>
                    <span>Телефон *</span>
                    <input name="phone" type="tel" maxlength="32" value="{{ old('phone') }}" required inputmode="tel" autocomplete="tel" placeholder="+7 913 000-00-00">
                </label>
                <label>
                    <span>Размер, цвет, состояние</span>
                    <textarea name="message" maxlength="3000" rows="4" placeholder="Например: R17, графит, есть сколы и коррозия">{{ old('message') }}</textarea>
                </label>
                <div id="photo" class="photo-field">
                    <input id="photoInput"
                           class="photo-input"
                           type="file"
                           name="photo"
                           accept="image/jpeg,image/png,image/webp,image/heic,image/heif,image/avif"
                           aria-describedby="photoHelp photoState">
                    <label for="photoInput" class="photo-picker">
                        <span class="photo-picker-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path d="M4 7.5h3l1.4-2h7.2l1.4 2h3v11H4zM12 10a3.25 3.25 0 1 0 0 6.5A3.25 3.25 0 0 0 12 10z"/>
                            </svg>
                        </span>
                        <span>
                            <strong>Добавить фото дисков</strong>
                            <small id="photoHelp">JPG, PNG, WebP, HEIC или AVIF · исходник до 25 МБ, уменьшаем до 5 МБ для отправки</small>
                        </span>
                        <span class="photo-picker-action">Выбрать</span>
                    </label>
                    <div id="photoPreview" class="photo-preview" aria-live="polite" hidden>
                        <img id="photoPreviewImage" width="72" height="72" alt="Предпросмотр выбранного фото">
                        <div>
                            <strong id="photoState">Фото выбрано</strong>
                            <span id="photoFileName"></span>
                        </div>
                        <button id="photoRemove" type="button" aria-label="Удалить выбранное фото">×</button>
                    </div>
                </div>
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
                <a class="location-email" href="mailto:polimer@happypils.ru">polimer@happypils.ru</a>
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

<script id="wheelConfig" type="application/json">{!! json_encode(['sizes' => $sizes, 'finishes' => $finishes, 'assetBase' => rtrim(asset(''), '/')], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
@endsection
