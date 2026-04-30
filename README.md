# Kirby CMS Headless Starter (PHP 8.4 + Docker)

Шаблон для разработки Headless-проектов на Kirby CMS. Оптимизирован для локальной разработки с использованием Docker.

## 🚀 Быстрый старт

### 1. Подготовка
Склонируйте репозиторий в свою рабочую директорию:
```bash
git clone <url-вашего-репозитория> .
```
Создайте файл `.env`:

```bash
cp .env.example .env
```

### 2. Запуск Docker
Соберите образ и запустите контейнер:
```bash
docker-compose up -d --build
```
Панель управления доступна по адресу: `http://localhost:8080/panel`. Создайте пользователя при первом входе.

## 📡 Использование API

Все запросы к API должны содержать заголовок авторизации:

`Authorization: Bearer <your-secret-token>`

- `GET /home` — Данные главной страницы.
- `GET /globals` — Глобальные данные.
- `GET /some-page` — Данные других страниц.

**Пример fetch запроса:**
```javascript
const API_URL = 'http://localhost:8080';
const TOKEN = 'your-secret-token';

fetch(`${API_URL}/home`, {
  headers: {
    'Authorization': `Bearer ${TOKEN}`,
    'Accept': 'application/json'
  }
})
  .then(response => {
    if (!response.ok) {
      throw new Error(`Ошибка: ${response.status}`);
    }
    
    return response.json();
  })
  .then(data => {
    console.log('Данные от Kirby:', data);
    console.log('Заголовок:', data.title);
  })
  .catch(error => console.error('Что-то пошло не так:', error));
```

## 🛠 Команды для разработки

- **Собрать образ и запустить контейнер:** `docker-compose up -d --build`
- **Удалить образ и остановить контейнер:** `docker-compose down -v`
- **Запустить контейнер:** `docker-compose up`
- **Остановить контейнер:** `docker-compose stop`
- **Зайти внутрь контейнера:** `docker exec -it kirby-headless bash`
- **Просмотр логов:** `docker logs -f kirby-headless`

## 📦 Работа с плагинами и зависимостями

Все команды Composer должны выполняться внутри Docker-контейнера, чтобы изменения применились к изолированной папке `vendor`.

### 1. Установка нового плагина
```bash
docker exec -u root -it kirby-headless composer require <vendor/package>
```

### 2. Обновление всех плагинов
```bash
docker exec -u root -it kirby-headless composer update
```

### 3. Удаление плагина
```bash
docker exec -u root -it kirby-headless composer remove <vendor/package>
```

## 💡 Важно

### Права доступа

Контейнер запускается от имени пользователя с UID 1000. Это позволяет редактировать файлы без `sudo` на большинстве Linux-систем.
