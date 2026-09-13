import { motionBehavior, scrollToSection } from './navigation.js';

const config = JSON.parse(document.getElementById('wheelConfig').textContent);
const SIZES = config.sizes;
const FINISHES = config.finishes;
const ASSET_BASE = config.assetBase;
const TONE_CLASSES = FINISHES.map(finish => `tone-${finish.tone}`);

const priceFormatter = new Intl.NumberFormat('ru-RU');
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

    const source = joinUrl(ASSET_BASE, size.image);
    if (wheelImg.src !== source) wheelImg.src = source;
    wheelImg.classList.remove(...TONE_CLASSES);
    wheelImg.classList.add(`tone-${finish.tone}`);
    wheelImg.alt = `Диск ${size.label} в покрытии ${finish.name}`;

    sizeTag.textContent = size.label;
    finishTag.textContent = finish.name;
    modelTag.textContent = `${size.label} · ${size.name}`;
    priceLabel.textContent = `${priceFormatter.format(size.price)} ₽`;
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
            behavior: motionBehavior(),
        });
    });
});

document.querySelectorAll('[data-coating-index]').forEach(button => {
    button.addEventListener('click', () => {
        const finishButton = document.querySelector(`[data-finish-index="${button.dataset.coatingIndex}"]`);
        const sizeButton = document.querySelector(`[data-size-index="${button.dataset.gallerySizeIndex}"]`);
        if (sizeButton) sizeButton.click();
        if (finishButton) finishButton.click();
        scrollToSection(document.getElementById('config'));
    });
});

const leadForm = document.getElementById('leadForm');
const leadStatus = document.getElementById('leadFormStatus');
const leadBtnText = document.getElementById('leadFormBtnText');
const leadSpinner = document.getElementById('leadFormSpinner');
const photoInput = document.getElementById('photoInput');
const photoPreview = document.getElementById('photoPreview');
const photoPreviewImage = document.getElementById('photoPreviewImage');
const photoFileName = document.getElementById('photoFileName');
const photoRemove = document.getElementById('photoRemove');
let photoObjectUrl = null;
let isSubmitting = false;
const maxSourceSize = 25 * 1024 * 1024;
const maxUploadSize = 5 * 1024 * 1024;
const showStatus = (message, success = false) => {
    leadStatus.textContent = message;
    leadStatus.className = `form-message form-message-${success ? 'success' : 'error'}`;
    leadStatus.hidden = false;
    scrollToSection(leadStatus);
};

const clearPhotoPreview = () => {
    if (photoObjectUrl) URL.revokeObjectURL(photoObjectUrl);
    photoObjectUrl = null;
    if (photoInput) photoInput.value = '';
    if (photoPreviewImage) photoPreviewImage.removeAttribute('src');
    if (photoFileName) photoFileName.textContent = '';
    if (photoPreview) photoPreview.hidden = true;
};

if (photoInput && photoPreview && photoPreviewImage && photoFileName) {
    photoInput.addEventListener('change', () => {
        const file = photoInput.files?.[0];
        if (!file) return clearPhotoPreview();
        leadStatus.hidden = true;

        if (file.size > maxSourceSize) {
            clearPhotoPreview();
            showStatus('Выберите фотографию размером до 25 МБ.');
            return;
        }

        if (photoObjectUrl) URL.revokeObjectURL(photoObjectUrl);
        photoObjectUrl = URL.createObjectURL(file);
        photoPreviewImage.hidden = false;
        photoPreviewImage.onerror = () => { photoPreviewImage.hidden = true; };
        photoPreviewImage.src = photoObjectUrl;
        photoFileName.textContent = `${file.name} · ${(file.size / 1024 / 1024).toFixed(1)} МБ`;
        photoPreview.hidden = false;
        document.getElementById('photo')?.scrollIntoView({ behavior: motionBehavior(), block: 'center' });
    });
}

photoRemove?.addEventListener('click', clearPhotoPreview);

async function decodePhoto(file) {
    if ('createImageBitmap' in window) {
        try {
            const bitmap = await createImageBitmap(file);

            return {
                source: bitmap,
                width: bitmap.width,
                height: bitmap.height,
                release: () => bitmap.close(),
            };
        } catch (error) {
            // Safari can decode some iPhone formats through an Image element instead.
        }
    }

    const objectUrl = URL.createObjectURL(file);

    return new Promise((resolve, reject) => {
        const image = new Image();

        image.onload = () => resolve({
            source: image,
            width: image.naturalWidth,
            height: image.naturalHeight,
            release: () => URL.revokeObjectURL(objectUrl),
        });
        image.onerror = () => {
            URL.revokeObjectURL(objectUrl);
            reject(new Error('Не удалось открыть выбранное фото.'));
        };
        image.src = objectUrl;
    });
}

async function preparePhotoForUpload(file) {
    const safeUploadSize = 1500 * 1024;

    if (!file || file.size <= safeUploadSize) return file;

    let decodedPhoto;

    try {
        decodedPhoto = await decodePhoto(file);
        let maxSide = 1920;
        let quality = 0.82;
        let preparedBlob = null;

        for (let attempt = 0; attempt < 5; attempt += 1) {
            const scale = Math.min(1, maxSide / Math.max(decodedPhoto.width, decodedPhoto.height));
            const canvas = document.createElement('canvas');
            canvas.width = Math.max(1, Math.round(decodedPhoto.width * scale));
            canvas.height = Math.max(1, Math.round(decodedPhoto.height * scale));

            const context = canvas.getContext('2d', { alpha: false });
            if (!context) throw new Error('Браузер не поддерживает подготовку фото.');

            context.fillStyle = '#ffffff';
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.drawImage(decodedPhoto.source, 0, 0, canvas.width, canvas.height);
            preparedBlob = await new Promise(resolve => canvas.toBlob(resolve, 'image/jpeg', quality));

            if (preparedBlob && preparedBlob.size <= safeUploadSize) break;

            maxSide = Math.round(maxSide * 0.82);
            quality = Math.max(0.58, quality - 0.07);
        }

        if (!preparedBlob || preparedBlob.size > 1800 * 1024) {
            throw new Error('Не удалось уменьшить фотографию для отправки.');
        }

        const baseName = file.name.replace(/\.[^.]+$/, '') || 'diski';

        return new File([preparedBlob], `${baseName}.jpg`, {
            type: 'image/jpeg',
            lastModified: Date.now(),
        });
    } catch (error) {
        // HEIC may be valid on the server even when this browser cannot decode it.
        if (file.size <= maxUploadSize) return file;
        throw new Error('Не удалось подготовить фото. Сохраните его как JPG или сделайте снимок экрана и загрузите снова.');
    } finally {
        decodedPhoto?.release();
    }
}

if (leadForm && leadStatus && leadBtnText && leadSpinner) {
    leadForm.addEventListener('submit', async event => {
        event.preventDefault();
        if (isSubmitting) return;
        isSubmitting = true;
        leadForm.setAttribute('aria-busy', 'true');
        const submitButton = leadForm.querySelector('button[type="submit"]');

        leadStatus.hidden = true;
        leadStatus.className = 'form-message';
        if (submitButton) submitButton.disabled = true;
        leadBtnText.textContent = 'Отправляем…';
        leadSpinner.hidden = false;

        try {
            const formData = new FormData(leadForm);
            formData.set('size', SIZES[activeSize].label);
            formData.set('finish', FINISHES[activeFinish].key);
            const originalPhoto = photoInput?.files?.[0];
            if (originalPhoto) {
                const preparedPhoto = await preparePhotoForUpload(originalPhoto);
                formData.set('photo', preparedPhoto, preparedPhoto.name);
            }

            const response = await fetch(leadForm.action, {
                method: 'POST',
                headers: {'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json'},
                body: formData,
            });
            const isJson = (response.headers.get('content-type') || '').includes('application/json');
            const data = isJson ? await response.json() : {};

            if (!response.ok) {
                const errors = data.errors ? Object.values(data.errors).flat().join(' ') : null;
                const statusMessages = {
                    413: 'Фото слишком большое для сервера. Выберите меньший файл или отправьте заявку без фото.',
                    419: 'Срок действия страницы истёк. Обновите её перед отправкой; сохраните введённый текст.',
                    429: 'Слишком много попыток. Подождите минуту и попробуйте снова.',
                };
                throw new Error(errors || statusMessages[response.status] || data.message || 'Не удалось отправить заявку. Позвоните нам или попробуйте ещё раз.');
            }

            if (!isJson || data.status !== 'ok') throw new Error('Сервер не подтвердил отправку. Позвоните нам, чтобы уточнить получение заявки.');
            showStatus(data.message || 'Заявка отправлена. Мы свяжемся с вами.', true);
            leadForm.reset();
            clearPhotoPreview();
        } catch (error) {
            showStatus(error instanceof TypeError ? 'Соединение прервалось. Уточните получение заявки по телефону +7 913 895-45-25.' : error.message || 'Ошибка соединения. Попробуйте ещё раз.');
        } finally {
            isSubmitting = false;
            leadForm.removeAttribute('aria-busy');
            if (submitButton) submitButton.disabled = false;
            leadBtnText.textContent = 'Отправить заявку';
            leadSpinner.hidden = true;
        }
    });
}

renderPreview();
