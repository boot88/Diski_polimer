# Публикация PolymerDisk на обычном PHP-хостинге

## Что хранится в Git и что остаётся на сервере

Git хранит исходный код, шаблоны, конфигурацию Vite и изображения проекта. Не отправляйте в Git `.env`, `vendor`, `database/database.sqlite`, `storage` и `public/build`:

- `.env` содержит ключ Laravel и почтовые пароли;
- `database/database.sqlite` содержит данные сайта;
- `storage/app` содержит загруженные посетителями файлы;
- `public/build` — готовые CSS/JS-файлы, созданные Vite;
- `vendor` — PHP-зависимости Composer.

## Первый переход на Git-деплой

Пример рассчитан на сайт в `/var/www/p610780/data/www/happypils.ru/Diski_polimer`. Сначала создайте новую папку рядом с работающей, чтобы проверить сайт до переключения.

```bash
cd /var/www/p610780/data/www/happypils.ru
git clone -b YOUR_BRANCH --single-branch https://github.com/boot88/Diski_polimer.git Diski_polimer-next
```

Замените `YOUR_BRANCH` на ветку, которую хотите опубликовать. Затем перенесите закрытые и рабочие данные из прежней версии:

```bash
cp -p Diski_polimer/.env Diski_polimer-next/.env
cp -a Diski_polimer/vendor Diski_polimer-next/
cp -a Diski_polimer/storage/app/. Diski_polimer-next/storage/app/
cp -a Diski_polimer/public/build Diski_polimer-next/public/
```

Если база SQLite находится в `Diski_polimer/database/database.sqlite`, скопируйте её только непосредственно перед окончательным переключением, чтобы не потерять новые заявки:

```bash
cp -p Diski_polimer/database/database.sqlite Diski_polimer-next/database/database.sqlite
```

Подготовьте новую копию:

```bash
cd /var/www/p610780/data/www/happypils.ru/Diski_polimer-next
rm -f public/hot
chmod -R ug+rwX storage bootstrap/cache
/usr/bin/php82 artisan optimize:clear
/usr/bin/php82 artisan storage:link
```

Проверьте новую версию по адресу `http://happypils.ru/Diski_polimer-next/public/`. Когда она работает, сохраните старую папку как резервную и переключите название:

```bash
cd /var/www/p610780/data/www/happypils.ru
mv Diski_polimer Diski_polimer-backup-YYYYMMDD
cp -p Diski_polimer-backup-YYYYMMDD/database/database.sqlite Diski_polimer-next/database/database.sqlite
cp -a Diski_polimer-backup-YYYYMMDD/storage/app/. Diski_polimer-next/storage/app/
mv Diski_polimer-next Diski_polimer

cd Diski_polimer
rm -f public/hot
chmod -R ug+rwX storage bootstrap/cache
/usr/bin/php82 artisan optimize:clear
```

После этого прежняя ссылка `http://happypils.ru/Diski_polimer/public/` сохранится, а предыдущая версия останется в папке `Diski_polimer-backup-YYYYMMDD`.

## Обычное обновление

### На локальном компьютере

```bash
git pull --ff-only origin YOUR_BRANCH
npm ci
npm run build
git status
```

После проверки создайте и отправьте коммит. Затем передайте на хостинг только собранные фронтенд-файлы:

```bash
tar -czf /tmp/diski-polimer-build.tar.gz public/build
scp /tmp/diski-polimer-build.tar.gz p610780@happypils.ru:/var/www/p610780/data/www/happypils.ru/Diski_polimer/
```

### На хостинге

```bash
cd /var/www/p610780/data/www/happypils.ru/Diski_polimer
git pull --ff-only origin YOUR_BRANCH
tar -xzf diski-polimer-build.tar.gz
rm -f public/hot
/usr/bin/php82 artisan optimize:clear
```

`npm run dev` запускается только локально для разработки. На хостинге нужен `public/build/manifest.json`, а не работающий Vite-сервер.

## Переменные `.env` для почты

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=http://happypils.ru/Diski_polimer/public

MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=587
MAIL_SCHEME=smtp
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_FROM_ADDRESS=...
MAIL_FROM_NAME="PolymerDisk"
LEAD_TO_EMAIL=...
```

После изменения `.env` всегда выполните:

```bash
/usr/bin/php82 artisan config:clear
```
