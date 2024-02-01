# Short Link

Cервис для сокращения ссылок и получения статистики по каждой ссылке.

## Функции

- Можем сгенерированную ссылку и собирать статистику по ней.
- Посмотреть статистику

## Getting Started

### 1. Clone this repository

```bash
git clone git@github.com:igor-gorovenko/short_link.git
```

```bash
cd short_link
```

### 2. Install dependencies

```bash
composer install
```

Копируем .env.example и меняем имя: .env

Генерируем ключ
```bash
php artisan key:generate
```

добавлвем данные для связи с БД в .env

### 3. Установка пакетов и миграции

Детали

Админка: https://github.com/balajidharma/laravel-vue-admin-panel

Пакет для ссылок: https://github.com/ash-jc-allen/short-url 

```bash
composer require ashallendesign/short-url
```

```bash
php artisan vendor:publish --tag=admin-core
```
```bash
php artisan migrate --seed --seeder=AdminCoreSeeder
```
```bash
php artisan vendor:publish --provider="AshAllenDesign\ShortURL\Providers\ShortURLProvider"
```

```bash
npm install
```

```bash
php artisan migrate
```

### 4. Запускаем сервер и доступ

Запуск сервера

```bash
npm run dev
```

Доступ

```
superadmin@example.com
password
```
