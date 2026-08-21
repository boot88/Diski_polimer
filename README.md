# PolymerDisk

Лендинг для записи на порошковую (полимерную) покраску колёсных дисков в Бердске.

## Локальный запуск

```bash
cp .env.example .env
composer install
php artisan key:generate
npm ci
npm run dev
php artisan serve
```

Для работы формы укажите в `.env` почтовые параметры `MAIL_*` и адрес получателя:

```dotenv
LEAD_TO_EMAIL=your-mail@example.com
```

## Проверки

```bash
php artisan test
npm run build
```

## Публикация

Инструкция по первому переносу на Git-деплой и обычным обновлениям: [DEPLOYMENT.md](DEPLOYMENT.md).
