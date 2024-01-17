# Short Link

Cервис для сокращения ссылок и получения статистики по каждой ссылке.

## Функции

- Можно сократить ссылку
- Посмотреть статистику по созданной ссылке

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

```bash
php artisan key:generate
```

```bash
npm install
```

```bash
php artisan migrate
```