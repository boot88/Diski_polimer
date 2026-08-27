# НСК Макстар — покраска дисков

Лендинг мастерской «НСК Макстар» для записи на порошковую (полимерную) покраску колёсных дисков в Бердске.

## Локальный запуск

```bash
cp .env.example .env
composer install
php artisan key:generate
npm ci
npm run dev
php artisan serve
```

Для работы формы укажите в `.env` почтовые параметры, получателей и MAX:

```dotenv
LEAD_TO_EMAILS=polimer@happypils.ru,povisok888@gmail.com
MAX_BOT_TOKEN=
MAX_USER_ID=
```

Форма принимает фото до 25 МБ и независимо доставляет заявку на оба email и в MAX. Для безопасной проверки без вывода секретов:

```bash
php artisan lead:test-delivery
```

## Проверки

```bash
php artisan test
npm run build
```

## Публикация

Инструкция по первому переносу на Git-деплой и обычным обновлениям: [DEPLOYMENT.md](DEPLOYMENT.md).
